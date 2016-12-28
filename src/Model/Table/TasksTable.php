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
class TasksTable extends Table
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

        $this->table('tasks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

//         $this->belongsTo('Departments', [
//             'foreignKey' => 'department_id'
//         ]);
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
            ->requirePresence('task_name', 'create')
            ->notEmpty('task_name');

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
//         $rules->add($rules->isUnique(['technology_name']));
        return $rules;
    }
    
    public function isTaskNameExists($task_name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['task_name'] = $task_name;
    
    	$taskTable = TableRegistry::get('Tasks');
    	$tasks = $taskTable->find()
    	->where($conditions);
    	if($tasks->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getTaskCount()
    {
    	$tasks = array();
    	$tasksTable = TableRegistry::get('Tasks');
    
    	$query_active_tasks = $tasksTable->find('all');
    
    	$query_all_tasks = $tasksTable->find('all');
    	$tasks['all'] = $query_all_tasks->count();
    
    	return $tasks;
    
    
    }
    
    public function getActiveTasks()
    {
    	$tasksTable = TableRegistry::get('Tasks');
    	$tasks = $tasksTable->find('list', [
			    'keyField' => 'id',
			    'valueField' => 'task_name'
			])
    		->order(['task_name' => 'ASC'])
    		->toArray();
    	return $tasks;
    	
    }
}
