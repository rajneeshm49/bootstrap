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
class SalariesTable extends Table
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

        $this->table('salaries');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->requirePresence('increment_date', 'create')
            ->notEmpty('increment_date');
        
        $validator
//         	->naturalNumber('amount','sfdgs','create')
	        ->numeric('amount','create')
	        ->notEmpty('amount');
// 	        ->greaterThan('amount', 0 );
        
        $validator
	        ->requirePresence('role_id', 'create')
	        ->notEmpty('role_id');
        
        $validator
	        ->requirePresence('designation_id', 'create')
	        ->notEmpty('designation_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    
    public function getSalaryCount()
    {
        $salaries = array();
        $salariesTable = TableRegistry::get('Salaries');
        
        $query_all_salaries = $salariesTable->find('all');
        $salaries['all'] = $query_all_salaries->count();
        
        return $salaries;
    }
    
    public function getSalaryUserList()
    {
    	$salaries = array();
    	$salaries = TableRegistry::get('Salaries');
    	$salary_arr = array();
    
    	$salary_query = $salaries->find()->toArray();
    
    	foreach($salary_query as $query) {
    		$salary_arr[$query->user_id] = $query->user_id;
    	}
    	return $salary_arr;
    }
    
    public function getDepartmentHeadUserList()
    {
    	$salaries = array();
    	$salaries = TableRegistry::get('Salaries');
    	$salary_query = $salaries->find('list', [
    			'valueField' => 'role_id'
    	])->toArray();
    	
    	$user_list = $salaries->find('list', [
    			'valueField' => 'user_id'
    	])
    	->where(['role_id'=>7])
    	->toArray();
    	
    	return $user_list;
    }
}
