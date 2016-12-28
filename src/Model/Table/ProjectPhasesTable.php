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
class ProjectPhasesTable extends Table
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

        $this->table('project_phases');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Projects', [
                    'foreignKey' => 'project_id'
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
        return $rules;
    }
    
    public function isNameExists($name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['name'] = $name;
    
    	$projectphaseTable = TableRegistry::get('ProjectPhases');
    	$project_phases = $projectphaseTable->find()
    	->where($conditions);
    	if($project_phases->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getActiveProjectPhases()
    {
    	$projectphaseTable = TableRegistry::get('ProjectPhases');
    	$project_phases = $projectphaseTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])
    	->order(['name' => 'ASC'])
    	->toArray();
    	return $project_phases;
    	 
    }
    
    public function getPhasesForProjectsM($project_id = NULL)
    {
        $phasesTbl = TableRegistry::get('project_phases');
    
        $query = $phasesTbl->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where([
            'project_id' => $project_id
        ])->toArray();
        return $query;
    }
}
