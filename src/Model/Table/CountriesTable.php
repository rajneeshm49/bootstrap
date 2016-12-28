<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table
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

        $this->table('countries');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }
    
    public function getAllCountries()
    {
    	$countryTbl = TableRegistry::get('Countries');
    	return $countryTbl->find('list', [
    			'keyField' => 'country_id',
    			'valueField' => 'country_name'
    	])
    	->order(['country_name' => 'ASC'])
    				->toArray();
    }
}