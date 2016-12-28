<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class ResourceDepartmentsTable extends Table
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

        $this->table('resource_departments');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Users', [
            'className' => 'Users',
            'foreignKey' => 'id',
        	'bindingKey' => 'user_id'
        ]);
        $this->hasOne('Departments', [
            'className' => 'Departments',
            'foreignKey' => 'id',
        	'bindingKey' => 'department_id'
        ]);
        $this->hasOne('DepartmentLead', [
        		'className' => 'Users',
        		'foreignKey' => 'id',
        		'bindingKey' => 'user_id',
        		'joinType' => 'INNER',
        		'conditions' => ['department_head']
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
//         $rules->add($rules->isUnique(['user_id','department_id']));
        
        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['user_id','department_id'],'User already allocated to this department'));
    
        return $rules;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    
    public function getUsersAllocations($user_id, $allocation_percent, $id = '')
    {
    	$resDpt = TableRegistry::get('resource_departments');
    	$cond['user_id'] = $user_id;
    	if(!empty($id)) {
    		$cond['id <>'] = $id;
    	}
    	
    	$res_alloc = $resDpt->find()->select(['percentage_allocate'])
    		->where($cond)->toArray();
    	
    	foreach($res_alloc as $alloc) {
    		$allocation_percent += $alloc['percentage_allocate'];
    	}
    	if($allocation_percent > 100) {
    		return false;
    	}
    	return true;
    }
    
    public function getUsersForDepartmentsM($department_id = NULL, $get_only_dpt_head = NULL)
    {
    	$projectsTbl = TableRegistry::get('resource_departments');
    
    	if($get_only_dpt_head) {
    		$conditions['department_head'] = 1;
    	}
    	$conditions['department_id'] = $department_id;
    	
    	$query = $projectsTbl->find()
    	->contain(['Users' => function ($q) {
    						return $q->autoFields(false)->select(['id', 'first_name', 'last_name']);
    					}])
    	->where($conditions)
    	->map(function ($row) {
	    	$row->full_name = $row->user['first_name'] . ' ' . $row->user['last_name'];
	    	return $row;
	    })
	    ->combine('user.id', 'full_name')->toArray();
    	return $query;
    }
    
    public function getDepartments($user_id)
    {
    	$resDpt = TableRegistry::get('resource_departments');
    	$dept_ids = $resDpt->find('list',
    			[
    					'keyField' => 'Departments.id',
    					'valueField' => 'Departments.department_name'
    			])
    				->select(['Departments.id', 'Departments.department_name'])->contain(['Departments'])
    				->where(['user_id' => $user_id])->toArray();
    	return $dept_ids;
    }
    
    public function getUserDefaultDepartment($user_id)
    {
    	$resDpt = TableRegistry::get('resource_departments');
    	$dflt_Dpt = $resDpt->find()
    	->where([
    			'user_id' => $user_id,
    			'default_department' => 1
    	])
    	->first();
    	if(!empty($dflt_Dpt)) {
    		return json_encode($dflt_Dpt->department_id);
    	} 
    	return false;    	 
    }
}