<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectCoversheets Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectCoversheetsTable extends Table
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

        $this->table('project_coversheets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Users', [
        		'className' => 'Users',
        		'foreignKey' => 'id',
        		'bindingKey' => 'user_id'
        ]);
    }
    
    public function getProjectComments($project_id)
    {
    	$coversheetTbl = TableRegistry::get('project_coversheets');
    	$coversheets = $coversheetTbl->find()
    	->contain(['Users'])
    		->where(['project_id' => $project_id])
    		->order(['approval_request_date' => 'ASC'])
    		->toArray();
    	
    	return $coversheets;
    }
}