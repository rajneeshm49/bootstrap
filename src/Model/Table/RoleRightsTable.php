<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoleRights Model
 *
 */
class RoleRightsTable extends Table
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

        $this->table('role_rights');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Roles', [
        	'className' => 'Roles',
        		'foreignKey' => 'id',
        		'bindingKey' => 'role_id'
        ]);
    }

    public function isRoleExists($role_id)
    {
    	$conditions['role_id'] = $role_id;
    
    	$roleRightsTable = TableRegistry::get('RoleRights');
    	$rit = $roleRightsTable->find()
    	->where($conditions);
    	if($rit->count() == 0) {
    		return true;
    	}
    	return false;
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
//     public function validationDefault(Validator $validator)
//     {
//         return $validator;
//     }   
}
