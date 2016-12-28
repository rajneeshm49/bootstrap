<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rights Model
 *
 */
class RightsTable extends Table
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

        $this->table('rights');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RightsChild', [
        	'className' => 'Rights',
            'foreignKey' => 'parent_id',
        	'dependent' => true,
        	'sort' => 'display_order'
        ]);
        
//         $this->belongsTo('RightsParent', [
//         		'className' => 'Rights',
//         		'foreignKey' => 'id',
//         		'bindingKey' => 'parent_id',
//         		'joinType' => 'INNER',
//         ]);
        
        $this->hasOne('Parent', [
        		'className' => 'Rights',
        		'foreignKey' => 'id',
        		'bindingKey' => 'parent_id',
//         		'joinType' => 'INNER',
        ]);
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
