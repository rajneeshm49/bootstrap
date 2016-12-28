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
class ResourceAllocationsTable extends Table
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

        $this->table('resource_allocations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Projects', [
            'foreignKey' => 'id',
        		'bindingKey' => 'project_id',
        ]);
        $this->hasMany('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasOne('Users', [
            'foreignKey' => 'id',
        	'bindingKey' => 'user_id'
        ]);
        $this->hasOne('Roles', [
             'foreignKey' => 'id',
        	 'bindingKey' => 'role_id'
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
            ->requirePresence('department_id', 'create')
            ->notEmpty('department_id');

        $validator
            ->requirePresence('project_id', 'create')
            ->notEmpty('project_id');
        
        $validator
        ->requirePresence('user_id', 'create')
        ->notEmpty('user_id');
        
        $validator
        ->requirePresence('start_date', 'create')
        ->notEmpty('start_date');
        
        $validator
        ->requirePresence('role_id', 'create')
        ->notEmpty('role_id');
        
        $validator
        ->requirePresence('end_date', 'create')
        ->notEmpty('end_date');
        
        $validator
        ->requirePresence('allocated_percent', 'create')
        ->notEmpty('allocated_percent');
        
        $validator
        ->requirePresence('hours', 'create')
        ->notEmpty('hours');
        
        $validator
        ->requirePresence('reporting_to', 'create')
        ->notEmpty('reporting_to');
        
        $validator
        ->requirePresence('billable', 'create')
        ->notEmpty('billable');
        
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
        $rules->add($rules->isUnique(['user_id','project_id'],'User already allocated to this project'));
//         $rules->add($rules->isUnique(['username']));
//         $rules->add($rules->isUnique(['email']));
//         $rules->add($rules->existsIn(['email_id'], 'Emails'));
//         $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
    
    public function getActiveResourceAllocations($project_id = NULL)
    {
    	$resourceallocationsTable = TableRegistry::get('ResourceAllocations');
    	if($project_id == NULL){
    	    $resource_allocations = $resourceallocationsTable->find('list', [
        			'keyField' => 'project_id',
        			'valueField' => 'user_id'
        	])
        	->order(['user_id' => 'ASC'])
        	->toArray();
    	} else {
    	    $resource_allocations = $resourceallocationsTable->find()
    	    ->where([
    	        'project_id' => $project_id
    	    ])->contain(['Users','Roles'])
    	    ->toArray();
    	}
    	
    	return $resource_allocations;
    }
    
    public function getUnReleasedUsers($project_task_conditions)
    {
        $resourceallocationsTable = TableRegistry::get('ResourceAllocations');
    	$resource_list = $resourceallocationsTable->find('all')
        ->where([$project_task_conditions])
        ->toArray();
        
        return $resource_list;
    }
    
	public function getUsersForProjectsM($project_id = NULL)
    {
    	$resAllocnTbl = TableRegistry::get('resource_allocations');
    
    	$query = $resAllocnTbl->find()
	    	->where([
	    			'project_id' => $project_id
	    	])
	    	->contain(['Users'=> function ($q) {
		                			return $q->autoFields(false)->select(['id', 'first_name', 'last_name']);
		            			}
		    ])
	    	->map(function ($row) {
	    		$row->full_name = $row->user['first_name'] . ' ' . $row->user['last_name'];
	    		return $row;
	    	})
	    	->combine('user.id', 'full_name')
	    	->toArray();
    	return $query;
    }
    
    public function getProjectsForUser($user_id)
    {
    	$resAllocnTbl = TableRegistry::get('resource_allocations');
    	
    	$query = $resAllocnTbl->find()
    	->where([
    			'user_id' => $user_id,
    	])
    	->contain(['Projects'=> function ($q) {
    			return $q->autoFields(false)->select(['id', 'name']);
    		}
    	])
    	->map(function ($row) {
    		$row->project_name = $row->project['name'];
    		return $row;
    	})
    	->combine('project_id', 'project_name')
    	->toArray();
    	return $query;
    }
    
    public function getProjectsWithinDatesForUser($user_id, $date)
    {
    	$resAllocnTbl = TableRegistry::get('resource_allocations');
    	 
    	$query = $resAllocnTbl->find()
    	->where([
    			'user_id' => $user_id,
    			'resource_allocations.start_date <=' => $date,
    			'resource_allocations.end_date >=' => $date
    	])
    	->contain(['Projects'=> function ($q) {
    		return $q->autoFields(false)->select(['id', 'name']);
    	}
    		])
    		->map(function ($row) {
    			$row->project_name = $row->project['name'];
    			return $row;
    		})
    		->combine('project_id', 'project_name')
    		->toArray();
    		return $query;
    }
}
