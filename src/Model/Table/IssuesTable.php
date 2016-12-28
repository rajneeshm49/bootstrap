<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issues Model
 *
 */
class IssuesTable extends Table
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

        $this->table('issues');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projects', [
            'className' => 'Projects'
        ]);
        
        $this->hasOne('ReportedByUser', [
        		'className' => 'Users',
        		'foreignKey' => 'id',
        		'bindingKey' => 'reported_by'
        ]);
        
        $this->hasOne('AssignedToUser', [
        		'className' => 'Users',
        		'foreignKey' => 'id',
        		'bindingKey' => 'assign_to'
        ]);
        
        $this->hasMany('IssueComments', [
        		'className' => 'IssueComments',
        		'dependent' => true
        ]);
        
        $this->hasMany('IssueMonitorings', [
        		'className' => 'IssueMonitorings',
        		'dependent' => true
        ]);
        
        $this->hasOne('ProjectModules', [
            'foreignKey' => 'id',
            'bindingKey' => 'module'
        ]);
    }
    
    public function getIssuesForProjectsM($project_id = NULL)
    {       
        $issuesTbl = TableRegistry::get('issues');
    
        $query = $issuesTbl->find('list', [
        		'keyField' => 'id',
        		'valueField' => function ($row) {
        			return '#' . $row['id'];
        		}
        ])
        ->where([
            'project_id' => $project_id
        ]);
        
        return $query;
    }
    
    public function getActiveIssues()
    {
        $issuesTable = TableRegistry::get('Issues');
        $issues = $issuesTable->find('list',
                [
                    'valueField' => 'id'
                ])
                ->order([
                    'id' => 'ASC'
                ])
                ->toArray();
        return $issues;
    }
    
    public function updateStatus($req_data, $user_id)
    {
    	$issuesTbl = TableRegistry::get('Issues');
    	 
    	$issue = $issuesTbl->get($req_data['pk']);
    	$issue->issue_status_id = $req_data['value'];
    	$issue->modified_by = $user_id;
    	$issue->modified = date('Y-m-d H:i:s');
    	if($issuesTbl->save($issue)) {
    		return true;
    	}
    	return false;
    }
}