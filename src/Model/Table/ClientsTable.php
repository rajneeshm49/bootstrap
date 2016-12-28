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
class ClientsTable extends Table
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

        $this->table('clients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Countries', [
        		'className' => 'Countries',
        		'foreignKey' => 'country_id',
        		'bindingKey' => 'country_id'
        ]);
        
        $this->hasMany('Contacts', [
            'foreignKey' => 'client_id'
        ]);
    }
    
    public function getClientsCount()
    {
    	$clientsTable = TableRegistry::get('Clients');
    	
    	$query_clients = $clientsTable->find('all');
    	$clients = $query_clients->count();
    	
    	return $clients;
    }
    
    public function getClients()
    {
    	$clientsTable = TableRegistry::get('Clients');
    	$clients = $clientsTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])
    	->order(['name' => 'ASC'])
    	->toArray();
    	return $clients;
    
    }
}