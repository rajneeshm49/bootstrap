<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Emails
 * @property \Cake\ORM\Association\BelongsTo $Departments
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimeLogsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('time_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Projects', [
        	'foreignKey' => 'id',
        	'bindingKey' => 'project_id'
        ]);
        
        $this->hasOne('ProjectTasks', [
        		'foreignKey' => 'id',
        		'bindingKey' => 'project_task_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('project_id', 'create')
            ->notEmpty('project_id');
       
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//         $rules->add($rules->isUnique(['username']));
//         $rules->add($rules->isUnique(['email']));
//         $rules->add($rules->existsIn(['email_id'], 'Emails'));
//         $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
    
    public function getTasksForDate($date, $user_id)
    {
    	$time_logsTbl = TableRegistry::get('time_logs');
    	$timesheets = $time_logsTbl->find()->where([
    			'log_date' => $date,
    			'user_id' => $user_id
    	])
    	->contain([
    			'Projects' => function ($q) {
		                			return $q->autoFields(false)->select(['id', 'name']);
		            			},
		        'ProjectTasks' => function ($q) {
		            				return $q->autoFields(false)->select(['id', 'name']);
		            			}    			 
    	])->toArray();
    	return $timesheets;
    }
        
    public function getFilledDays($user_id)
    {
    	$conn = ConnectionManager::get('default');
    	
    	$begin = date("Y-m-d", strtotime("-".TIMESHEET_DAYS_AVAILABLE." days"));
    	$end = date("Y-m-d");
    	
    	$where = 'log_date <= "' . $end . '"';
    	$where .= ' and log_date >= "' . $begin . '"';
    	$where .= " and user_id = $user_id";
    	 
    	$stmt = $conn->execute("select sum(hours) as sum_hrs, log_date from time_logs where $where group by log_date");
    	$rows = $stmt->fetchAll('assoc');
    
    	$time_logsTbl = TableRegistry::get('time_logs');
    	
    	$query = $time_logsTbl->find();
    	   	
    	$date1 = $query->func()->date_format([
    			'log_date' => 'literal',
    			"'%d-%m-%Y'" => 'literal'
    	]);
    	 
    	
    	$rslt = $query->select([
    			'sum_hrs' => $query->func()->sum('hours'),
    			 'log_date'=>'DATE_FORMAT(log_date, "%d-%m-%Y")'
    	])
    	->group('log_date')
    	->where([$where])->toArray();
    	
    	$timesheet = array();

    	foreach ($rslt as $row) {
    		$timesheet[date('Y-m-d', strtotime($row['log_date']))] = $row['sum_hrs'];
    	}
    
    	$rr = array();
    	$curr_date = $begin;
    	
    	$c = 0;
    	while (strtotime($curr_date) <= strtotime($end)) {
    		$rr[$c]['hours'] = (empty($timesheet[$curr_date]))?0:$timesheet[$curr_date];
    		$rr[$c]['date'] = $curr_date;
    		$curr_date = date ("Y-m-d", strtotime("+1 day", strtotime($curr_date)));
    		
    		$c++;
		}
		return $rr;
    }
}
