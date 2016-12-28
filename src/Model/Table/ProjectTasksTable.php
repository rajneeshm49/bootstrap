<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
class ProjectTasksTable extends Table
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

        $this->table('project_tasks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('ProjectTaskDetails', [
            'foreignKey' => 'project_task_id'
        ]);
        
        $this->hasOne('Projects', [
            'bindingKey' => 'project_id',
            'foreignKey' => 'id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        
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
        return $rules;
    }
    
    public function isNameExists($name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['name'] = $name;
    
    	$projecttaskTable = TableRegistry::get('ProjectTasks');
    	$project_tasks = $projecttaskTable->find()
    	->where($conditions);
    	if($project_tasks->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getActiveProjectTasks()
    {
    	$projecttaskTable = TableRegistry::get('ProjectTasks');
    	$project_tasks = $projecttaskTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])
    	->order(['name' => 'ASC'])
    	->toArray();
    	return $project_tasks;
    	 
    }

    public function getTasksForProjectsM($project_id = NULL, $date = false)
    {
        $tasksTbl = TableRegistry::get('project_tasks');
    
        if(is_array($project_id)) {
        	$conditions['project_id IN'] = (!empty($project_id))?array_keys($project_id):array(NULL);
        } else {
        	$conditions['project_id'] = $project_id;
        }
        if($date) {
        	$conditions['start_date <='] = $date;
        	$conditions['end_date >='] = $date;
        }
        $query = $tasksTbl->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where([$conditions])
        ->toArray();
        return $query;
    }
    
    public function updateStatus($req_data, $user_id)
    {
    	$tasksTbl = TableRegistry::get('project_tasks');
    	
    	$task = $tasksTbl->get($req_data['pk']);
    	$task->task_status_id = $req_data['value'];
    	$task->modified_by = $user_id;
    	$task->modified = date('Y-m-d H:i:s');
    	if($tasksTbl->save($task)) {
    		return true;
    	}
    	return false;
    }
}
