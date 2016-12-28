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
class SeatCostsTable extends Table
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

        $this->table('seat_costs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
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
//         $validator
//             ->requirePresence('department_id', 'create')
//             ->notEmpty('department_id');

//         $validator
//             ->requirePresence('year', 'create')
//             ->notEmpty('year');
        
//         $validator
// //         	->naturalNumber('amount','sfdgs','create')
// 			->numeric('cost','create')
// 	        ->notEmpty('cost');
// // 	        ->greaterThan('amount', 0 );

        return $validator;
    }

//     public function buildRules(RulesChecker $rules)
//     {
//         $rules->add($rules->isUnique(['dept_id', 'year']));
        
//         return $rules;
//     }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    
    public function getSeatCostCount()
    {
        $seatcosts = array();
        $seatcostsTable = TableRegistry::get('SeatCosts');
        
        $query_all_seatcosts = $seatcostsTable->find('all');
        $seatcosts['all'] = $query_all_seatcosts->count();
        
        return $seatcosts;
    }
    
    public function getSeatCostDepartmentList()
    {
    	$seatcosts = array();
    	$seatcosts = TableRegistry::get('SeatCosts');
    	$seatcost_arr = array();
    
    	$seatcost_query = $seatcosts->find()->toArray();
    	//pr($seatcost_query);
    	if(!empty($seatcost_query)){
	    	foreach($seatcost_query as $query) {
	    		$seatcost_arr[$query->department_id] = $query->department_id;
	    	}
    	}
    	return $seatcost_arr;
    }
    
    public function isSeatCostExists($department, $id = 0, $year)
    {
        if (! empty($id)) {
            $conditions['id <>'] = $id;
        }
        $conditions['department_id'] = $department;
        $conditions['year'] = $year;
        
        $seatcostTable = TableRegistry::get('SeatCosts');
        $seatcosts = $seatcostTable->find()->where($conditions);
        
        if ($seatcosts->count() == 0) {
            return true;
        }
        return false;
    }
}
