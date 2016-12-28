<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ResourceAllocationsController extends AppController
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
    
    public function index()
    {
        $conditions = array();
        if(!empty($this->request->data))
        {
        	$paginateParams = $this->request->data;
        	$this->request->query = $paginateParams;
        }
        else if(isset($this->request->query ))
        {
        	$paginateParams = $this->request->query;
        	$this->request->data = $this->request->query;
        }
        if (!empty($paginateParams)) {
        
            $getParams = $paginateParams;
            if (!empty($getParams['department_id'])) {
                $conditions["department_id"] = $getParams['department_id'];
            }
            if (!empty($getParams['project_id'])) {
        		$conditions["project_id"] = $getParams['project_id'];
        	}
        	if (!empty($getParams['user_id'])) {
        		$conditions["user_id"] = $getParams['user_id'];
        	}
        }
        $departments = $this->getDepartmentsToBeShown();
        $department_keys = array_keys($departments);
        
        $conditions['department_id IN'] = $department_keys;

        $conditions2 = $this->getRoleConditionsForResourceAllocations();
        $conditions = array_merge($conditions, $conditions2);
        
        $resource_allocations = $this->paginate($this->ResourceAllocations, [
        		'conditions' => $conditions,
                'limit' => RECORDS_PER_PAGE, 'order' => ['id' => 'ASC']
        ]);
                        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->loadModel('Users');
        $users = $this->Users->getActiveUsers();
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->set(compact('resource_allocations', 'paginateParams','projects','departments','users','roles'));
        $this->set('_serialize', ['resource_allocations', 'paginateParams','projects','departments','users','roles']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resource_allocation = $this->ResourceAllocations->newEntity();
        if ($this->request->is('post')) {
            $resource_allocation = $this->ResourceAllocations->patchEntity($resource_allocation, $this->request->data);
            $error = 'The record could not be saved. Please, try again.';
            if ($this->ResourceAllocations->save($resource_allocation)) {
                $this->Flash->success(__('The resource allocation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $error_arr = $resource_allocation->errors();
                $error = implode("&",array_map(function($a) {return implode("~",$a);},$error_arr));
                $this->Flash->error(__($error));
            }
        }
        
        $departments = $this->getDepartmentsToBeShown();
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->set(compact('resource_allocation','departments','roles'));
        $this->set('_serialize', ['resource_allocation','departments','roles']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	$resource_allocation = $this->ResourceAllocations->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$resource_allocation = $this->ResourceAllocations->patchEntity($resource_allocation, $this->request->data);
    		$error = 'The record could not be saved. Please, try again.';
    		if ($this->ResourceAllocations->save($resource_allocation)) {
    			$this->Flash->success(__('The resource allocation has been saved.'));
    			return $this->redirect(array_merge(['action' => 'index'], $params));
    		} else {
    			$error_arr = $resource_allocation->errors();
                $error = implode("&",array_map(function($a) {return implode("~",$a);},$error_arr));
                $this->Flash->error(__($error));
    		}
    	}
        
    	$departments = $this->getDepartmentsToBeShown();
    	
    	$this->loadModel('Roles');
    	$roles = $this->Roles->getActiveRoles();
    
    	$this->loadModel('Users');
    	$users = $this->Users->getActiveUsers();
    	
    	$this->loadModel('Projects');
    	$projects = $this->Projects->getProjects();
    	
    	$this->set(compact('resource_allocation','params','roles','departments','users','projects'));
    	$this->set('_serialize', ['resource_allocation', 'params','roles','departments','users','projects']);
    }
    
    public function release_user($resource_allocation_id)
    {
    	$session = $this->request->session()->read('Auth.Admin');
    	$resource_allocation = $this->ResourceAllocations->get($resource_allocation_id);
    	
    	$resource_allocation->release_user = 1;
    	$resource_allocation->release_date = date('Y-m-d');
    	
    	if($this->ResourceAllocations->save($resource_allocation)){
    	    $this->Flash->success(__('The resource has been released sucessfully.'));
        } else {
            $this->Flash->error(__('Could not release resource. Please try again.'));
        }
        return $this->redirect(['action' => 'index']);
         
    }
    
    public function recall_user($resource_allocation_id)
    {
        $session = $this->request->session()->read('Auth.Admin');
        $resource_allocation = $this->ResourceAllocations->get($resource_allocation_id);
        
        $resource_allocation->release_user = 0;
        
        if($this->ResourceAllocations->save($resource_allocation)){
            $this->Flash->success(__('The resource has been recalled sucessfully.'));
        } else {
            $this->Flash->error(__('Could not recall resource. Please try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function getUsersForProjects()
    {
    	$req_data = $this->request->data;
    
    	$users = $this->ResourceAllocations->getUsersForProjectsM($req_data['project_id']);
    	$users_html = '<option value=\'\'>No Resource allocated</option>';
    	if(count($users) > 0) {
    		$users_html = '<option value=\'\'>(Choose User)</option>';
    	}
    	foreach($users as $k => $v) {
    		$users_html .= '<option value="' . $k . '">' . $v . '</option>';
    	}
    	echo json_encode($users_html); exit;
    }
    
    public function getRoleConditionsForResourceAllocations()
    {
        $sess = $this->request->session();
        $conditions = array();
    
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
    
        $role_id = $sess->read('Auth.Admin.role_id');
        $role_name = id_to_text($role_id, $roles);
    
        switch($role_name) {
            case 'Developer':
            case 'Project Lead':
                $projects = $this->getProjectsToBeShown();
                $projects = (count($projects)>0)?array_keys($projects):array();
                $conditions['project_id IN'] = $projects;
                return $conditions;
                break;
    
            default:
                $projects = $this->getProjectsToBeShown();
                $projects = (count($projects)>0)?array_keys($projects):array();
                $conditions['project_id IN'] = $projects;
                return $conditions;
                break;
        }
    }
    
    public function getProjectsForUserWithinDates()
    {
    	$date = $this->request->data('date');
    	$projects = $this->getProjectsToBeShown($date);

    	echo json_encode($projects); exit;
    }
}
