<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Emails
 * @property \Cake\ORM\Association\BelongsTo $Departments
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MilestonesTable extends Table
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

        $this->table('milestones');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id'
        ]);
        
        $this->hasMany('Receipts', [
            'foreignKey' => 'milestone_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('department_id', 'create')
            ->notEmpty('department_id');
        
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//         $rules->add($rules->isUnique(['username']));
//         $rules->add($rules->isUnique(['email']));
//         $rules->add($rules->existsIn(['email_id'], 'Emails'));
//         $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
    
    public function isNameExists($name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['name'] = $name;
    
    	$milestoneTable = TableRegistry::get('Milestones');
    	$milestones = $milestoneTable->find()
    	->where($conditions);
    	if($milestones->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getActiveMilestones($project_id = NULL)
    {
    	$milestonesTable = TableRegistry::get('Milestones');
    	if($project_id == NULL){
        	$milestones = $milestonesTable->find('list', [
        			'keyField' => 'id',
        			'valueField' => 'name'
        	])
        	->order(['name' => 'ASC'])
        	->toArray();
    	} else {
    	    $milestones = $milestonesTable->find()
                ->where([
                    'project_id' => $project_id
                    ])
                ->toArray();
    	}
    	
    	return $milestones;
    	 
    }
    
    public function getMilestonesForProjectsM($project_id = NULL)
    {
        $milestonesTbl = TableRegistry::get('milestones');
    
        $query = $milestonesTbl->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where([
            'project_id' => $project_id
        ])->toArray();
        return $query;
    }
    
//     public function getInvoices()
//     {
//         $milestonesTbl = TableRegistry::get('milestones');
    
//         $query = $milestonesTbl->find('all')
//                     ->where(['invoice_requested' => 1])
//                     ->toArray();
//         return $query;
//     }
}
