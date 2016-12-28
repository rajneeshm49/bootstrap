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
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options =
 *         [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface
 *         $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface
 *         $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array
 *         $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback =
 *         null)
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartmentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config
     *            The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->table('departments');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        // $this->belongsTo('Departments', [
        // 'foreignKey' => 'department_id'
        // ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator
     *            Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->requirePresence('department_name', 'create')->notEmpty(
                'department_name');
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules
     *            The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        // $rules->add($rules->isUnique(['department_name']));
        return $rules;
    }

    public function isDepartmentNameExists($department_name, $id = 0)
    {
        if (! empty($id)) {
            $conditions['id <>'] = $id;
        }
        $conditions['department_name'] = $department_name;
        $conditions['is_active'] = 1;
        
        $departmentTable = TableRegistry::get('Departments');
        $departments = $departmentTable->find()->where($conditions);
        if ($departments->count() == 0) {
            return true;
        }
        return false;
    }

    public function getDepartmentCount()
    {
        $departments = array();
        $departmentsTable = TableRegistry::get('Departments');
        
        $query_active_departments = $departmentsTable->find('all', 
                [
                    'conditions' => [
                        'Departments.is_active' => 1
                    ]
                ]);
        $departments['active'] = $query_active_departments->count();
        
        $query_all_departments = $departmentsTable->find('all');
        $departments['all'] = $query_all_departments->count();
        
        return $departments;
    }

    public function getDepartmentsWithoutSeatCost($seatcost_list)
    {
        $departments = array();
        $departments = TableRegistry::get('Departments');
        $department_arr = array();
        $department_query = $departments->find('all')
            ->where(
                [
                    'Departments.is_active' => 1,
                    'Departments.id NOT IN ' => $seatcost_list
                ])
            ->order([
            'department_name' => 'ASC'
        ])
            ->toArray();
        // debug($user_query);
        foreach ($department_query as $query) {
            $department_arr[$query->id] = $query->department_name;
        }
        return $department_arr;
    }

    public function getActiveDepartments()
    {
        $departmentsTable = TableRegistry::get('Departments');
        $departments = $departmentsTable->find('list', 
                [
                    'keyField' => 'id',
                    'valueField' => 'department_name'
                ])
            ->order([
            'department_name' => 'ASC'
        ])
            ->toArray();
        return $departments;
    }
}
