<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Holidays Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HolidaysTable extends Table
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

        $this->table('holidays');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }
   
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function validationDefault(Validator $validator)
    {
    	return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
    	$rules->add($rules->isUnique(['holiday_date']));
    
    	return $rules;
    }
    
    public function getHolidaysCount()
    {
    	$holidaysTable = TableRegistry::get('Holidays');
    	 
    	$query_holidays = $holidaysTable->find('all');
    	$holidays = $query_holidays->count();
    	 
    	return $holidays;
    	 
    }
    
    public function getHolidaysForYear()
    {    	
    	$conn = ConnectionManager::get('default');
    	$stmt = $conn->execute("select holiday_date from holidays where year(holiday_date) = " . date('Y'));
    	$rows = $stmt->fetchAll('assoc');

    	$holidays = array();
    	foreach ($rows as $row) {
    		$holidays[] = $row['holiday_date'];
    	}
    	
    	return $holidays;
    }
}