<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Projects Controller
 *
 */
class ProjectsController extends AppController
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
    	$qry = $this->request->query;
    	$to_be_approved = '';
    	if(!empty($qry['to_be_approved'])) {
    		$to_be_approved = 1;
    	}
//     	$this->viewBuilder()->template('index');
//     	$to_be_approved = 1;
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
    		 
    		if (!empty($paginateParams['project_id'])) {
    			$conditions["Projects.id"] = $paginateParams['project_id'];
    		}
    		 
    		if (!empty($paginateParams['client_id'])) {
    			$conditions["client_id"] = $paginateParams['client_id'];
    		}
    		 
    		if (!empty($paginateParams['is_approved'])) {
    			$conditions["approval_status"] = $paginateParams['is_approved'];
    		}
    	}
    	
    	$session = $this->request->session()->read('Auth.Admin');
		$role_name = strtolower($session['role_name']);
		if(1 == $to_be_approved) {
    		$conditions['Projects.approval_status'] = 1;
    	}
    	
    	$conditions['Projects.is_active'] = 1;
    	$conditions['Projects.is_deleted'] = 0;
    	$project_names = $this->getProjectsToBeShown();
    	$project_ids = $project_names?array_keys($project_names):array(null);
    	
    	$conditions['Projects.id IN'] = $project_ids;

    	$this->paginate ['conditions'] = $conditions;
    	$projects = $this->paginate($this->Projects, [
    			'limit' => RECORDS_PER_PAGE,
    			'contain' => [
    					'Clients' => function ($q) {
    						return $q->autoFields(false)->select(['name']);
    					},
    					'Currencies' => function ($q) {
    						return $q->autoFields(false)->select(['name']);
    					},
    					'ProjectStatuses' => function ($q) {
    						return $q->autoFields(false)->select(['status']);
    					},
    					'Departments' => function ($q) {
    						return $q->autoFields(false)->select(['department_name']);
    					}
    			],
    			'order' => ['id' => 'DESC']]);
    
    	$this->loadModel('ProjectStatuses');
    	$project_status = $this->ProjectStatuses->getActiveProjectStatuses();
    
    	$this->loadModel('Clients');
    	$clients = $this->Clients->getClients();
    
    	$this->loadModel('Projects');
//     	$project_names = $this->Projects->getProjects(1);

    	
//     	pr($project_names);exit;
    	$this->set(compact('projects', 'paginateParams', 'project_status', 'clients', 'project_names', 'to_be_approved', 'role_name'));
    	$this->set('_serialize', ['projects', 'paginateParams', 'project_status', 'clients', 'projects', 'to_be_approved', 'role_name']);
    }


    public function toBeApproved()
    {}
    
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */    
    public function add()
    {
        $project = $this->Projects->newEntity();
        
        if ($this->request->is('post')) {
        	$project = $this->Projects->patchEntity($project, $this->request->data);
            $project->created_by = $this->Auth->user('id');
            $project->modified_by = $this->Auth->user('id');
            
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Clients');
        $clients = $this->Clients->getClients();
        
        $this->loadModel('Currencies');
        $currencies = $this->Currencies->getAllCurrencies();
        
        $this->loadModel('Technologies');
        $technologies = $this->Technologies->getActiveTechnologies();
        
        $this->loadModel('ProjectStatuses');
        $project_status = $this->ProjectStatuses->getActiveProjectStatuses();
        
        $this->loadModel('ProjectTypes');
        $project_types = $this->ProjectTypes->getActiveProjectTypes();
        
        $departments = $this->getDepartmentsToBeShown();
        $this->set(compact('project', 'departments', 'clients', 'currencies', 'technologies', 'project_status', 'project_types'));
        $this->set('_serialize', ['project', 'departments', 'clients', 'currencies', 'technologies', 'project_status', 'project_types']);
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
    	
        $project = $this->Projects->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$project = $this->Projects->patchEntity($project, $this->request->data);
            $project->created_by = $this->Auth->user('id');
            $project->modified_by = $this->Auth->user('id');
            
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Users');
        $sm_responsibles = $this->Users->getDeptHeadsM($project->department_id);
        
        $this->loadModel('Clients');
        $clients = $this->Clients->getClients();
        
        $this->loadModel('Contacts');
        $contacts = $this->Contacts->getContactsForClientsM($project->client_id);
        
        $this->loadModel('Currencies');
        $currencies = $this->Currencies->getAllCurrencies();
        
        $this->loadModel('Technologies');
        $technologies = $this->Technologies->getActiveTechnologies();
        
        $this->loadModel('ProjectStatuses');
        $project_status = $this->ProjectStatuses->getActiveProjectStatuses();
        
        $this->loadModel('ProjectTypes');
        $project_types = $this->ProjectTypes->getActiveProjectTypes();
        
        $departments = $this->getDepartmentsToBeShown();
        
        $this->set(compact('project', 'departments', 'sm_responsibles', 'clients', 'contacts', 'currencies', 'technologies', 'project_status', 'project_types'));
        $this->set('_serialize', ['project', 'departments', 'clients', 'currencies', 'technologies', 'project_status', 'project_types']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $client = $this->Projects->get($id);
        $client->is_active = 1;
        $client->is_deleted = 1;
        if ($this->Projects->save($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function reqForApproval($project_obj)
    {
    	$project = json_decode($project_obj);
    	
    	$session = $this->request->session()->read('Auth.Admin');
    	$data['email'] = GM_EMAIL;
    	$data['full_name'] = GM_NAME;
    	$data['project_name'] = $project->name;
    	$data['admin_name'] = $session['first_name'] . ' ' .$session['last_name'];
    	
    	$query = $this->Projects->query();
    	$upd_stat = $query->update()
    	->set(['approval_status' => text_to_id('Request Sent', projectApprovalStatus())])
    	->where(['id' => $project->id])
    	->execute();
    	
    	if($upd_stat) {
    		if (sendTemplatedMail('REQUEST_FOR_APPROVAL', $data, 'Request for Project Approval')) {
    			$this->Flash->success(__('Request mail successfully sent for approval.'));
    		} else {
    			$project_obj->approval_status = 0;
    			$this->Projects->save($project_obj);
    			$this->Flash->error(__('Could not send request mail for approval. Please try again.'));
    		}
    	} else {
    		$this->Flash->error(__('Could not send request mail for approval. Please try again.'));
    	}
    	
    	return $this->redirect(['action' => 'index']);
    	
    }
    public function dashboard()
    {
 		$clients_count = $this->Clients->getClientsCount();
        $this->set(compact('clients_count'));
    }
    public function getClientsForProjects()
    {
        $req_data = $this->request->data;
         
//         $this->loadModel('Clients');
        $projects = $this->Projects->getClientsForProjectsM($req_data['id']);
        $projects_html = '';
        if(count($projects) > 0) {
            $projects_html .= '';
        }
        foreach($projects as $k => $v) {
            $projects_html .= $v ;
        }
        echo json_encode($projects_html); exit;
    
         
    }
    
    public function getProjectsForDepartments()
    {
    	$req_data = $this->request->data;
    	$departments = $this->Projects->getProjectsForDepartmentsM($req_data['department_id']);
    	$departments_html = '';
    	if(count($departments) > 0) {
    		$departments_html .= '<option value=\'\'>(Choose one)</option>';
    	}
    	foreach($departments as $k => $v) {
    		$departments_html .= '<option value="' . $k . '">' . $v . '</option>';
    	}
    	echo json_encode($departments_html); exit;
    
    	 
    }
    
    public function getDptHeads()
    {
    	$req_data = $this->request->data;
    	 
    	$this->loadModel('Users');
    	$sm_responsibles = $this->Users->getDeptHeadsM($req_data['department_id']);
    	$sm_responsibles_html = '';
    	if(count($sm_responsibles) > 0) {
    		$sm_responsibles_html .= '<option value=\'\'>(Choose one)</option>';
    	}
    	foreach($sm_responsibles as $k => $v) {
    		$sm_responsibles_html .= '<option value="' . $k . '">' . $v . '</option>';
    	}
    	echo json_encode($sm_responsibles_html); exit;
    }
    
    public function getContactsForClients()
    {
    	$req_data = $this->request->data;
    	 
    	$this->loadModel('Contacts');
    	$clients = $this->Contacts->getContactsForClientsM($req_data['client_id']);
    	$clients_html = '';
    	if(count($clients) > 0) {
    		$clients_html .= '<option value=\'\'>(Choose one)</option>';
    	}
    	foreach($clients as $k => $v) {
    		$clients_html .= '<option value="' . $k . '">' . $v . '</option>';
    	}
    	echo json_encode($clients_html); exit;
    
    	 
    }
    
    public function getDatesOfProjects()
    {
    	$req_data = $this->request->data();
    	$project = $this->Projects->getDates($req_data['project_id']);
    	echo json_encode($project);exit;
    }
    
    public function getCurrenciesForProjects()
    {
        $req_data = $this->request->data;
        $projects = $this->Projects->getCurrenciesForProjectsM($req_data['id']);
        $projects_html = '';
        if(count($projects) > 0) {
            $projects_html .= '';
        }
        foreach($projects as $k => $v) {
            $projects_html .= $v ;
        }
        echo json_encode($projects_html); exit;
    
         
    }
}