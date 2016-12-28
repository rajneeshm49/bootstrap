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
class CurrencyConversionsTable extends Table
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

        $this->table('currency_conversions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Currencies', [
        		'className' => 'Currencies'
        ]);
    }
    
    public function buildRules(RulesChecker $rules)
    {
    	$rules->add($rules->isUnique(['currency_id', 'update_date']));
    
    	return $rules;
    }
    
    public function getCurrencyConversionsCount()
    {
    	$currConvTable = TableRegistry::get('CurrencyConversions');
    	$currconv = $currConvTable->find();
    	return $currconv->count();
    }
}
