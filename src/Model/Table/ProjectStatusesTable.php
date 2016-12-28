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
class ProjectStatusesTable extends Table
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

        $this->table('project_statuses');
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
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
    
    public function isProjectStatusExists($status, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['status'] = $status;
    
    	$projectstatusTable = TableRegistry::get('ProjectStatuses');
    	$project_statuses = $projectstatusTable->find()
    	->where($conditions);
    	if($project_statuses->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getProjectStatusCount()
    {
    	$project_statuses = array();
    	$projectstatusesTable = TableRegistry::get('ProjectStatuses');
    
    	$query_active_project_statuses = $projectstatusesTable->find('all');
    
    	$query_all_project_statuses = $projectstatusesTable->find('all');
    	$project_statuses['all'] = $query_all_project_statuses->count();
    
    	return $project_statuses;
    }
    
    public function getActiveProjectStatuses()
    {
    	$projectstatusTable = TableRegistry::get('ProjectStatuses');
    	$project_statuses = $projectstatusTable->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'status'	
    		])
    		->order(['status' => 'ASC'])
    		->toArray();
    	
    	return $project_statuses;
    }
}
