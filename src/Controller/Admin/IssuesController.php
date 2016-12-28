<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Issues Controller
 *
 * @property \App\Model\Table\IssuesTable $Issues
 */
class IssuesController extends AppController 
{
	
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter ( $event );
		$this->viewBuilder ()->layout ( 'admin' );
		
		$this->loadModel('LookupDetails');
		$this->loadModel('Users');
	}
	
	public function index() 
	{	
		$conditions = array ();
		if (! empty ( $this->request->data )) {
			$paginateParams = $this->request->data;
			$this->request->query = $paginateParams;
		} else if (isset ( $this->request->query )) {
			$paginateParams = $this->request->query;
			$this->request->data = $this->request->query;
		}
// 		echo '11'; exit;
		if (!empty($paginateParams)) {
    	    	
    		if (!empty($paginateParams['project_id'])) {
    			$conditions["Projects.id"] = $paginateParams['project_id'];
    		}
    		if (!empty($paginateParams['assign_to'])) {
    			$conditions["assign_to"] = $paginateParams['assign_to'];
    		}
    		if (!empty($paginateParams['severity'])) {
    			$conditions["severity"] = $paginateParams['severity'];
    		}
    		if (!empty($paginateParams['priority'])) {
    			$conditions["priority"] = $paginateParams['priority'];
    		}
    		if (!empty($paginateParams['issue_type'])) {
    			$conditions["issue_type"] = $paginateParams['issue_type'];
    		}
    		if (!empty($paginateParams['issue_status_id'])) {
    			$conditions["issue_status_id"] = $paginateParams['issue_status_id'];
    		}
    	}
    	$conditions['OR'] = array(
    			'reported_by' => $this->Auth->user('id'),
    			'assign_to' => $this->Auth->user('id')
    	);
    	$project_names = $this->getProjectsToBeShown();
    	$projects_id = array_keys($project_names);
    	$conditions['Issues.project_id IN'] = $projects_id;
    	
    	$this->paginate ['conditions'] = $conditions;
		$issues = $this->paginate ( $this->Issues, [ 
				'limit' => RECORDS_PER_PAGE,
				'order' => ['id' => 'DESC'],
				'contain' => [
						'Projects' => function ($q) {
                			return $q->autoFields(false)->select(['name']);
            			},
            			'ReportedByUser' => function ($q) {
                			return $q->autoFields(false)->select(['first_name', 'last_name']);
            			},
            			'AssignedToUser' => function ($q) {
                			return $q->autoFields(false)->select(['first_name', 'last_name']);
            			},
            			'ProjectModules'
            			] 
		]);
		$issues_arr = $issues->toArray();
		$assign_to = Hash::combine($issues_arr, '{n}.assign_to', ['%s %s', '{n}.assigned_to_user.first_name', '{n}.assigned_to_user.last_name']);
		
		$lookup_severity = $this->LookupDetails->getDetails("Severity");
		$lookup_priority = $this->LookupDetails->getDetails("Priority");
		$project_names = $this->getProjectsToBeShown();
		
		$this->set ( compact ( 'issues', 'paginateParams', 'lookup_severity', 'lookup_priority', 'project_names', 'assign_to' ) );
		$this->set ( '_serialize', ['issues', 'paginateParams', 'lookup_severity', 'lookup_priority', 'project_names', 'assign_to'] );
	}
	
	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() 
	{
		$issue = $this->Issues->newEntity ();
// 		pr($this->request->data); exit;
		if ($this->request->is ( 'post' )) {

			if($this->request->data['upload_file']['name'])
			{
				$file = $this->request->data['upload_file']; //put the data into a var for easy use

		        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
		        $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
		
		        //only process if the extension is valid
		        if(in_array($ext, $arr_ext))
        		{
		            //do the actual uploading of the file. First arg is the tmp name, second arg is
		            //where we are putting it
		            move_uploaded_file($file['tmp_name'], ISSUES_IMG . $file['name']);
		
		            //prepare the filename for database entry
		            $this->request->data['upload_file'] = $file['name'];
        		} else {
        			$this->Flash->error ( __ ( "Not allowed to upload .$ext file type." ) );
        			goto a;
        		}
			}
			else
			{
				unset($this->request->data['upload_file']);
			}
			
			$issue = $this->Issues->patchEntity ( $issue, $this->request->data );
			
			$issue->created_by = $this->Auth->user('id');
			$issue->modified_by = $this->Auth->user('id');
			$issue->reported_by = $this->Auth->user('id');
			$issue->issue_status_id = text_to_id('Assigned', issueStatus());
			
			$saved_issue = $this->Issues->save ( $issue );
			
			if ($saved_issue) {
				
				$last_issue = $this->Issues->get($saved_issue->id, [
							'contain' => [
								'Projects' => function ($q) {
		                			return $q->autoFields(false)->select(['name']);
		            			},
		            			'ReportedByUser' => function ($q) {
		                			return $q->autoFields(false)->select(['first_name', 'last_name', 'email']);
		            			},
		            			'AssignedToUser' => function ($q) {
		                			return $q->autoFields(false)->select(['first_name', 'email']);
		            			}
	            			]
            			]);
				
				//send mail to 'Assigned to' and 'Assigned by' users
				$data['email'] = $last_issue->assigned_to_user['email'];
				$data['cc'] = $last_issue->reported_by_user['email'];
				$data['full_name'] = $last_issue->assigned_to_user['first_name'];
				$data['assigned_by'] = $last_issue->reported_by_user['first_name'];
				$data['issue_no'] = "'".$saved_issue->id."'";
				$data['project_name'] = $last_issue->project['name'];
				$data['admin_name'] = ADMIN_NAME;
				
				sendTemplatedMail('ASSIGN_ISSUE', $data, 'Issue Assigned');
				
				$this->Flash->success ( __ ( 'Issue created successfully.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'Issue could not be created. Please, try again.' ) );
			}
		}
		
		a:
		$project_names = $this->getProjectsToBeShown();
			
		$lookup_reproducibility = $this->LookupDetails->getDetails("Reproducibility");
		$lookup_priority = $this->LookupDetails->getDetails("Priority");
		$lookup_severity = $this->LookupDetails->getDetails("Severity");
// 		$assign_to = $this->Users->getActiveUsers();

		$this->loadModel('ProjectModules');
        $modules = $this->ProjectModules->getActiveProjectModules(); 
		
		$this->set ( compact ( 'issue', 'project_names', 'lookup_reproducibility', 'lookup_priority', 'lookup_severity', 'modules') );
		$this->set ( '_serialize', [ 
				'issue', 'modules'
		] );
	}
	
	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) 
	{
		$issue = $this->Issues->get ( $id , ['contain' => ['IssueComments', 'IssueMonitorings']]);
		if ($this->request->is ( ['patch', 'post', 'put'] )) { 
			$issue = $this->Issues->patchEntity ( $issue, $this->request->data );

			//Handling Issue Comments
			$issue_comment = $this->Issues->IssueComments->newEntity();
			$issue_comment->update_date = new Time("now");
			$issue_comment->user_id = $this->Auth->user('id');
			$issue_comment->comment = $this->request->data['comment'];
			$issue->issue_comments = [$issue_comment];

			//Issue Status Monitoring
			$issue_status = $this->Issues->IssueMonitorings->newEntity();
			$issue_status->update_date = new Time("now");
			$issue_status->user_id = $this->Auth->user('id');
			$issue_status->issue_status_id = $this->request->data['issue_status_id'];
			$issue->issue_monitorings = [$issue_status];
			
			$issue->modified_by = $this->Auth->user('id');
				
			$saved_issue = $this->Issues->save ( $issue );
			
			if ($saved_issue) {
				
				//save File uploaded				
				if($this->request->data['upload_file']['name'])
				{
					$file = $this->request->data['upload_file']; //put the data into a var for easy use
				
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
					
					//only process if the extension is valid
					if(in_array($ext, $arr_ext))
					{
						//do the actual uploading of the file. First arg is the tmp name, second arg is
						//where we are putting it
						$new_filename = generateRandomString(32);
						move_uploaded_file($file['tmp_name'], ISSUES_IMG . $new_filename . '.' . $ext);
				
						//saving the uploaded image as Issue file
						$this->loadModel('IssueFiles');
						$issue_file = $this->IssueFiles->newEntity();
						$issue_file->file_name = $file['name'];
						$this->IssueFiles->save($issue_file);
					}
				}
				
				
				$last_issue = $this->Issues->get($saved_issue->id, [
							'contain' => [
								'Projects' => function ($q) {
		                			return $q->autoFields(false)->select(['name']);
		            			},
		            			'ReportedByUser' => function ($q) {
		                			return $q->autoFields(false)->select(['first_name', 'last_name', 'email']);
		            			},
		            			'AssignedToUser' => function ($q) {
		                			return $q->autoFields(false)->select(['first_name', 'email']);
		            			}
	            			]
            			]);
				
				//send mail to 'Assigned to' and 'Assigned by' users
				$data['email'] = $last_issue->assigned_to_user['email'];
				$data['cc'] = $last_issue->reported_by_user['email'];
				$data['full_name'] = $last_issue->assigned_to_user['first_name'];
				$data['assigned_by'] = $last_issue->reported_by_user['first_name'];
				$data['issue_no'] = "'".$saved_issue->id."'";
				$data['project_name'] = $last_issue->project['name'];
				$data['admin_name'] = ADMIN_NAME;
				
				sendTemplatedMail('ASSIGN_ISSUE', $data, 'Issue Assigned');
				
				$this->Flash->success ( __ ( 'Issue created successfully.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'Issue could not be created. Please, try again.' ) );
			}
		}
		
		a:
		$project_names = $this->getProjectsToBeShown();
			
		$lookup_reproducibility = $this->LookupDetails->getDetails("Reproducibility");
		$lookup_priority = $this->LookupDetails->getDetails("Priority");
		$lookup_severity = $this->LookupDetails->getDetails("Severity");
		$this->loadModel('ResourceAllocations');
		$assign_to = $this->ResourceAllocations->getUsersForProjectsM($issue->project_id);
		
		$this->loadModel('ProjectModules');
		$modules = $this->ProjectModules->getActiveProjectModules();
		
		$this->set ( compact ( 'issue', 'project_names', 'lookup_reproducibility', 'lookup_priority', 'lookup_severity', 'assign_to', 'modules') );
		$this->set ( '_serialize', [ 
				'issue' , 'modules'
		] );
	}
	
	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null) {
		$issue = $this->Issues->get ( $id );
		if ($this->Issues->delete ( $issue )) {
			$this->Flash->success ( __ ( 'The issue has been deleted.' ) );
		} else {
			$this->Flash->error ( __ ( 'The issue could not be deleted. Please, try again.' ) );
		}
		
		return $this->redirect ( [ 
				'action' => 'index' 
		] );
	}
	public function dashboard() {
		$departmentcount = $this->Departments->getDepartmentCount ();
		$this->set ( compact ( 'departmentcount' ) );
	}
	
	public function validate_unique_department()
    {
    	$id = 0;
    	$department = $_REQUEST['department_name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	$isAvailable = $this->Departments->isDepartmentNameExists($department, $id);
    	
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}