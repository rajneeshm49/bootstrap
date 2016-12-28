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
class TechnologiesTable extends Table
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

        $this->table('technologies');
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
            ->requirePresence('technology_name', 'create')
            ->notEmpty('technology_name');

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
//         $rules->add($rules->isUnique(['technology_name']));
        return $rules;
    }
    
    public function isTechnologyNameExists($technology_name, $id = 0)
    {
    	if(!empty($id)) {
    		$conditions['id <>'] = $id;
    	}
    	$conditions['technology_name'] = $technology_name;
    
    	$technologyTable = TableRegistry::get('Technologies');
    	$technologies = $technologyTable->find()
    	->where($conditions);
    	if($technologies->count() == 0) {
    		return true;
    	}
    	return false;
    }
    
    public function getTechnologyCount()
    {
    	$technologies = array();
    	$technologiesTable = TableRegistry::get('Technologies');
    
    	$query_active_technologies = $technologiesTable->find('all');
    
    	$query_all_technologies = $technologiesTable->find('all');
    	$technologies['all'] = $query_all_technologies->count();
    
    	return $technologies;
    
    
    }
    
    public function getActiveTechnologies()
    {
    	$technologiesTable = TableRegistry::get('Technologies');
    	$technologies = $technologiesTable->find('list', [
			    'keyField' => 'id',
			    'valueField' => 'technology_name'
			])
    		->order(['technology_name' => 'ASC'])
    		->toArray();
    	return $technologies;
    	
    }
}
