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
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        
        $this->hasOne('Salaries', [
        		'foreignKey' => 'user_id'
        ]);
        
        $this->hasOne('ResourceDepartments', [
        		'foreignKey' => 'user_id'
        ]);
        
        $this->hasOne('Role', [
        		'className' => 'Roles',
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator->add(
        		'email',
        		['unique' => [
        				'rule' => 'validateUnique',
        				'provider' => 'table',
        				'message' => 'Not unique1']
        		]
        );
        
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
    
    public function isEmailExists($email_id, $id = 0)
    {
        if(!empty($id)) {
            $conditions['id <>'] = $id;
        }
        $conditions['email'] = $email_id;
        $conditions['is_active'] = 1;
            
        $userTable = TableRegistry::get('Users');
        $users = $userTable->find()
        ->where($conditions);
        if($users->count() == 0) {
            return true;
        }
        return false;
    }
    
    public function isUsernameExists($username, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['username'] = $username;
    	$conditions['is_active'] = 1;
    
    	$userTable = TableRegistry::get('Users');
    	$users = $userTable->find()
    	->where($conditions);
    	if($users->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getDeptHeadsM($dept_id = NULL)
    {
    	$usersTbl = TableRegistry::get('users');
    
    	$query = $usersTbl->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'first_name'
    	])->where([
    			'is_active' => 1,
    			'ResourceDepartments.department_id' => $dept_id
    	])
    	->innerJoinWith(
    			'ResourceDepartments', function ($q) {
    				return $q->where(['ResourceDepartments.department_head' => 1
    				]);
    	    
    			}
    	)->toArray();
    	return $query;
    }
    
    public function getUserCount()
    {
        $users = array();
        $usersTable = TableRegistry::get('Users');
        
        $query_active_users = $usersTable->find('all', ['conditions' => ['Users.is_active' => 1]]);
        $users['active'] = $query_active_users->count();
        
        $query_all_users = $usersTable->find('all');
        $users['all'] = $query_all_users->count();
        
        return $users;
        
        
    }
    
    public function getUserList($cond = array(), $sort_by = 'username')
    {
    	$users = array();
    	$users = TableRegistry::get('Users');
    	$user_arr = array();
    	$cond['is_active'] = 1; 
    
    	$user_query = $users->find()->where($cond)->order([$sort_by =>'ASC'])->toArray();
    
    	foreach($user_query as $query) {
    		if($sort_by == 'first_name') {
    			$user_arr[] = array(
    					'value' => $query->first_name . ' ' . $query->last_name,
    					'label' => $query->first_name . ' ' . $query->last_name,
    					'id' => $query->id
    			);
    		} else {
    			$user_arr[$query->id] = $query->username;
    		}
    	}
    	return $user_arr;
    }
    
    public function getUsersWithoutSalary($salary_list)
    {
    	$users = array();
    	$users = TableRegistry::get('Users');
    	$user_arr = array();
    	$user_query = $users->find('all')->where(['Users.is_active' => 1])->order(['username' =>'ASC'])->toArray();
    	foreach($user_query as $query) {
    		$user_arr[$query->id] = $query->username;
    	}
    	return $user_arr;
    }
        
    public function getActiveUsers()
    {
        $usersTable = TableRegistry::get('Users');
        $users = $usersTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'username'
        ])
        ->order(['username' => 'ASC'])
        ->toArray();
        return $users;
         
    }
    
    public function getUsersforProjectNotReleased()
    {
        $users = array();
        $users = TableRegistry::get('Users');
        $user_arr = array();
        $user_query = $users->find('all')->where(['Users.is_active' => 1,'Users.id NOT IN ' => $salary_list])->order(['username' =>'ASC'])->toArray();
        foreach($user_query as $query) {
            $user_arr[$query->id] = $query->username;
        }
        return $user_arr;
    }
    
    public function getUsersFromProject($project_ids = array(0))
    {
        $project = array_keys($project_ids);
        
        $project_id_str = implode(',', $project_ids);
        $condition = array();
        if(!empty($project_id_str)) {
            $condition['project_id IN'] = $project;
        }
        $userTbl = TableRegistry::get('resource_allocations');
        $users = $userTbl->find('list',
                [
                    'keyField' => 'project_id',
                    'valueField' => 'user_id'
                ])
                ->where($condition)
                ->order(['user_id' => 'ASC'])
                ->toArray();
        return $users;
    }
}
