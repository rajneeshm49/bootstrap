<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * LookupDetails Model
 *
 */
class LookupDetailsTable extends Table
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

        $this->table('lookup_details');
        $this->primaryKey('id');
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    
    public function getDetails($lookup_name)
    {
    	$dtlTbl = TableRegistry::get('lookup_details');
    	$lookups = $dtlTbl->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'	
    		])
    		->join([
    				'table' => 'lookup_masters',
    				'alias' => 'lm',
    				'type' => 'INNER',
    				'conditions' => 'lm.id = lookup_details.lookup_master_id',
    		])
    		->where(['lm.name' => $lookup_name])->toArray();
    	
    	return $lookups;
    }
}
