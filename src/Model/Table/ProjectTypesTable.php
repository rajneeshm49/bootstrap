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
class ProjectTypesTable extends Table
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

        $this->table('project_types');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

//         $this->belongsTo('Departments', [
//             'foreignKey' => 'department_id'
//         ]);
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

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
//         $rules->add($rules->isUnique(['designation_name']));
//         $rules->add($rules->existsIn(['email_id'], 'Emails'));
//         $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
    
    public function isProjectTypeExists($type, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['type'] = $type;
    
    	$projecttypeTable = TableRegistry::get('ProjectTypes');
    	$project_types = $projecttypeTable->find()
    	->where($conditions);
    	if($project_types->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getProjectTypeCount()
    {
    	$project_types = array();
    	$projecttypesTable = TableRegistry::get('ProjectTypes');
    
    	$query_active_project_types = $projecttypesTable->find('all');
    
    	$query_all_project_types = $projecttypesTable->find('all');
    	$project_types['all'] = $query_all_project_types->count();
    
    	return $project_types;
    }
    
    public function getActiveProjectTypes()
    {
    	$projecttypeTable = TableRegistry::get('ProjectTypes');
    	$project_types = $projecttypeTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'type'	
    		])
    		->order(['type' => 'ASC'])
    		->toArray();
    	
    	return $project_types;
    }
}
