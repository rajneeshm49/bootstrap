<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CurrenciesTable extends Table
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

        $this->table('currencies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }
    
    public function isCurrencyExists($currency, $id)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['name'] = $currency;
    
    	$currencyTable = TableRegistry::get('Currencies');
    	$currency = $currencyTable->find()
    	->where($conditions);
    	if($currency->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getAllCurrencies()
    {
    	$currencyTbl = TableRegistry::get('Currencies');
    	return $currencyTbl->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])
    	->order(['name' => 'ASC'])
    				->toArray();
    }
}