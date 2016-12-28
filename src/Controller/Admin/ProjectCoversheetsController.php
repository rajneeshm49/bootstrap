<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
/**
 * ProjectCoversheets Controller
 *
 */
class ProjectCoversheetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('admin');
    }
    
    public function view($project_id)
    {
    	$confirm = $success = false;
    	$to_be_approved= '';
    	
    	$this->loadModel('Projects');
    	$project = $project = $this->Projects->get($project_id);
		$coversheet = $this->ProjectCoversheets->newEntity();
		
		//This case is true when action is taking place from GM's screen
		if(!empty($this->request->query['to_be_approved'])) {
			$to_be_approved = $this->request->query;
		}
		
    	if ($this->request->is('POST')) {
    		$coversheet = $this->ProjectCoversheets->patchEntity($coversheet, $this->request->data);
    		$coversheet->project_id = $project_id;
    		$coversheet->approval_request_date = Time::now();
    		$coversheet->user_id = $this->Auth->user('id');
    		$coversheet->created_by = $this->Auth->user('id');
    		$coversheet->modified_by = $this->Auth->user('id');
    		$coversheet->created = Time::now();
    		$coversheet->modified = Time::now();
    		
    		
    		//confirm would be done by head of the organization
    		if(isset($this->request->data['confirm'])) {
    			
    			//If the coversheet is confirmed, change the coversheet's status as 'Approved' in Projects table
    			$coversheet->status = text_to_id('Approved', projectCoversheetStatus());
    			$confirm = true;
    		}
    		
    		$save_rslt = $this->ProjectCoversheets->save($coversheet);
    		if($save_rslt) {
	    		if ($confirm) {
	    			
	    			//If the coversheet is confirmed, change the project's status as 'Approved' in Projects table
	    			$project->approval_status = text_to_id('Approved', projectApprovalStatus());
	    			$upd_stat = $this->Projects->save($project);
	    		} else {
	    			
	    			//If it is not confirmed, it's sent for approval. In this case we will send a mail to GM asking him to approve
	    			$to_email = GM_EMAIL;
	    			$to_name = GM_NAME;
	    			$email_tmp = 'REQUEST_FOR_APPROVAL';
	    			if($to_be_approved) {
	    				
	    				//this condition is true if GM's is operating the screen, here we send mail to Department head 
	    				$this->loadModel('ResourceDepartments');
	    				$department_head_id = $this->ResourceDepartments->find()
	    										->select(['DepartmentLead.id'])
	    										->contain(['DepartmentLead'])
	    										->where([
	    												'department_id' => $project->department_id
	    												
	    										])->first();
	    										
	    				$this->loadModel('Users');
	    				$rr = $this->Users->get($department_head_id['DepartmentLead']['id'], ['fields' => ['email', 'first_name']]);
						$to_email = $rr->email;
						$to_name = $rr->first_name;
						$email_tmp = 'COMMENT_FROM_GM';
	    			}
	    			$project->approval_status = text_to_id('Request Sent', projectApprovalStatus());
	    			$upd_stat = $this->Projects->save($project);
	    			
	    			$session = $this->request->session()->read('Auth.Admin');
	    			$data['email'] = $to_email;
	    			$data['full_name'] = $to_name;
	    			$data['project_name'] = $project->name;
	    			$data['admin_name'] = $session['first_name'] . ' ' .$session['last_name'];
	    			 
	    			sendTemplatedMail($email_tmp, $data, 'Request for Project Approval');
	    		}
	    		
	    		$this->Flash->success(__('The comment has been saved.'));
	    		if($to_be_approved) {
	    			return $this->redirect(['action' => 'view', $project_id, '?' => ['to_be_approved' => 1]]);
	    		} else {
	    			return $this->redirect(['action' => 'view', $project_id]);
	    		}
	    	
	    	
	    			
    		} else {
    			$this->Flash->error(__('The comment could not be saved. Please, try again.'));
    		}
    	}
    	
    	$this->loadModel('Departments');
    	$departments = $this->Departments->getActiveDepartments();
    	
    	$this->loadModel('Clients');
    	$clients = $this->Clients->getClients();
    	
    	$this->loadModel('Currencies');
    	$currencies = $this->Currencies->getAllCurrencies();
    	
    	$this->loadModel('ProjectTypes');
    	$project_types = $this->ProjectTypes->getActiveProjectTypes();
    	
    	$comments = $this->ProjectCoversheets->getProjectComments($project_id);
    	
    	$this->loadModel('Milestones');
    	$milestones = $this->Milestones->getActiveMilestones($project_id);
    	
    	$this->loadModel('ResourceAllocations');
    	$resource_allocations = $this->ResourceAllocations->getActiveResourceAllocations($project_id);
    	
    	$this->set(compact('project', 'departments', 'clients', 'currencies', 'project_types', 'comments', 'to_be_approved','milestones','resource_allocations'));
    	$this->set('_serialize', ['project', 'departments', 'clients', 'currencies', 'project_types', 'comments', 'to_be_approved','milestones','resource_allocations']);
    	
    }

}