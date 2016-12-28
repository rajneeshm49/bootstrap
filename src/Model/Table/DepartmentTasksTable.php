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
class DepartmentTasksTable extends Table
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

        $this->table('department_tasks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

//         $this->belongsTo('Projects', [
//             'foreignKey' => 'project_id'
//         ]);
        
//         $this->hasOne('Receipts', [
//             'foreignKey' => 'milestone_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

//         $validator
//             ->requirePresence('last_name', 'create')
//             ->notEmpty('last_name');

//         $validator->add(
//         		'email',
//         		['unique' => [
//         				'rule' => 'validateUnique',
//         				'provider' => 'table',
//         				'message' => 'Not unique1']
//         		]
//         );
        
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
    
    public function isNameExists($name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['name'] = $name;
    
    	$departmenttaskTable = TableRegistry::get('DepartmentTasks');
    	$department_tasks = $departmenttaskTable->find()
    	->where($conditions);
    	if($department_tasks->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getActiveDepartmentTasks()
    {
    	$departmenttaskTable = TableRegistry::get('DepartmentTasks');
    	$department_tasks = $departmenttaskTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])
    	->order(['name' => 'ASC'])
    	->toArray();
    	return $department_tasks;
    	 
    }
}
