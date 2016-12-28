<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactsTable extends Table
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

        $this->table('contacts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Countries', [
        		'className' => 'Countries',
        		'foreignKey' => 'country_id',
        		'bindingKey' => 'country_id'
        ]);
    }
    
    public function getContactsForClientsM($client_id = NULL)
    {
    	$contactsTbl = TableRegistry::get('contacts');
    
    	$query = $contactsTbl->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'first_name'
    	])->where([
    			'client_id' => $client_id
    	])->toArray();
    	return $query;
    }
}