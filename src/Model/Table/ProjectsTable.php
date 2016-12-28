<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
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
        
        $this->table('projects');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->hasOne('Clients', 
                [
                    'foreignKey' => 'id',
                    'bindingKey' => 'client_id'
                ]);
        
        $this->hasOne('Currencies', 
                [
                    'foreignKey' => 'id',
                    'bindingKey' => 'currency_id'
                ]);
        
        $this->hasOne('ProjectStatuses', 
                [
                    'foreignKey' => 'id',
                    'bindingKey' => 'project_status_id'
                ]);
        
        $this->hasOne('Departments',
        		[
        				'foreignKey' => 'id',
        				'bindingKey' => 'department_id'
        		]);
        
        $this->hasMany('ResourceAllocations',
                [
                		'foreignKey' => 'id',
        				'bindingKey' => 'project_id'
                ]);
    }

    public function getProjects($to_be_approved = 0)
    {
    	$projectTbl = TableRegistry::get('projects');
        $conditions = array();
        if(!empty($to_be_approved)) {
        	$conditions['approval_status'] = 1;
        }
        $projects = $projectTbl->find('list', 
                [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])
                ->where([$conditions])
            ->order([
            'name' => 'ASC'
        ])
            ->toArray();
        
        return $projects;
    }

    public function getProjectClient()
    {
        $projectTbl = TableRegistry::get('projects');
        $projects = $projectTbl->find('list', 
                [
                    'contain' => [
                        'Clients'
                    ],
                    'keyField' => 'name',
    			'valueField' => 'client_id'
    	])
    	->order(['projects.name' => 'ASC'])
    	->toArray();
    }
    
    public function getProjectClientDetail($project_id)
    {
        $projectTbl = TableRegistry::get('projects');
        $projects = $projectTbl->find()
                ->contain(['Clients'])
                ->where(['projects.id'=>$project_id])
                ->first();
        
        return $projects;
    }
    
    public function getProjectsForDepartmentsM($department_id = NULL)
    {
    	$projectsTbl = TableRegistry::get('projects');
    
    	$query = $projectsTbl->find('list', [
    			'keyField' => 'id',
    			'valueField' => 'name'
    	])->where([
    			'department_id' => $department_id
    	])->toArray();
    	return $query;
    }
    
    public function getProjectsFromDpt($dept_ids = array(0))
    {
    	
    	$dept = array_keys($dept_ids);
    	
    	$dept_id_str = implode(',', $dept_ids);
    	$condition = array();
    	if(!empty($dept_id_str)) {
    		$condition['department_id IN'] = $dept;
    	}
    	$projectTbl = TableRegistry::get('projects');
    	$projects = $projectTbl->find('list',
    			[
    					'keyField' => 'id',
    					'valueField' => 'name'
    			])
    			->where($condition)
    			->order(['projects.name' => 'ASC'])
    			->toArray();
    	return $projects;
    }
    
    public function getDates($project_id)
    {
    	$projectTbl = TableRegistry::get('Projects');
    	$pr = $projectTbl->get($project_id,['fields' => ['start_date', 'end_date'], 'condition' => ['id' => $project_id]]);
    	return $pr;
    }

    public function getClientsForProjectsM($id = NULL)
    {
        $projectsTbl = TableRegistry::get('projects');
    
        $query = $projectsTbl->find('list', [
                    'keyField' => 'client_id',
                    'valueField' => 'client.name'
                ])
                ->contain(['Clients'])
                ->where([
                'projects.id' => $id
                ])
                ->toArray();
        return $query;
    }
    
    public function getProjectsByUser($user_id)
    {
    	$projectTbl = TableRegistry::get('projects');
    	$condition['OR'] = array(
    			'created_by' => $user_id,
    			'modified_by' => $user_id
    	);
    	$projects = $projectTbl->find('list',
    			[
    					'keyField' => 'id',
    					'valueField' => 'name'
    			])
    			->where($condition)
    			->order(['projects.name' => 'ASC'])
    			->toArray();
    	return $projects;
    }
    
    public function getCurrenciesForProjectsM($id = NULL)
    {
        $projectsTbl = TableRegistry::get('projects');
    
        $query = $projectsTbl->find('list', [
            'keyField' => 'currency_id',
            'valueField' => 'currency.name'
        ])
        ->contain(['Currencies'])
        ->where([
            'projects.id' => $id
        ])
        ->toArray();
        return $query;
    }
}
