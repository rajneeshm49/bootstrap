<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectPhasesController extends AppController
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
            if (!empty($getParams['project_id'])) {
        		$conditions["project_id"] = $getParams['project_id'];
        	}
        	if (!empty($getParams['name'])) {
        		$conditions["name LIKE"] = '%'.$getParams['name'].'%';
        	}
        }
        
        $conditions2 = $this->getRoleConditionsForProjectPhases();
        $conditions = array_merge($conditions, $conditions2);
        
        $project_phases = $this->paginate($this->ProjectPhases, [
        		'conditions' => $conditions ,'limit' => RECORDS_PER_PAGE]);
                
        $project_phases_list = $this->ProjectPhases->getActiveProjectPhases();

        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->set(compact('project_phases', 'paginateParams','project_phases_list','departments','projects'));
        $this->set('_serialize', ['project_phases', 'paginateParams','project_phases_list','departments','projects']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project_phase = $this->ProjectPhases->newEntity();
        
        if ($this->request->is('post')) {
            $project_phase = $this->ProjectPhases->patchEntity($project_phase, $this->request->data);
            
            if ($this->ProjectPhases->save($project_phase)) {
                $this->Flash->success(__('The project phase has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project phase could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->set(compact('project_phase','departments','projects'));
        $this->set('_serialize', ['project_phase','departments','projects']);
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
    	$project_phase = $this->ProjectPhases->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$project_phase = $this->ProjectPhases->patchEntity($project_phase, $this->request->data);
    		if ($this->ProjectPhases->save($project_phase)) {
    			$this->Flash->success(__('The project phase has been saved.'));
    			return $this->redirect(array_merge(['action' => 'index'], $params));
    		} else {
    			$this->Flash->error(__('The project phase could not be saved. Please, try again.'));
    		}
    	}
    	
    	$this->loadModel('Departments');
    	$departments = $this->Departments->getActiveDepartments();
    	
    	$this->loadModel('Projects');
    	$projects = $this->Projects->getProjects();
    	
    	$this->set(compact('project_phase','params','departments','projects'));
    	$this->set('_serialize', ['project_phase', 'params','departments','projects']);
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
        $project_phase = $this->ProjectPhases->get($id);
        $params = $this->request->query;
        if ($this->ProjectPhases->delete($project_phase)) {
            $this->Flash->success(__('The project phase has been deleted.'));
        } else {
            $this->Flash->error(__('The project phase could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function validate_unique_project_phase()
    {
    	$id = 0;
    	$project_phase = $_REQUEST['name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	$isAvailable = $this->ProjectPhases->isNameExists($project_phase, $id);
    	 
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
    
    public function getPhasesForProjects()
    {
        $req_data = $this->request->data;
    
        $projects = $this->ProjectPhases->getPhasesForProjectsM($req_data['project_id']);
        $projects_html = '';
        if(count($projects) > 0) {
            $projects_html .= '<option value=\'\'>(Choose one)</option>';
        }
        foreach($projects as $k => $v) {
            $projects_html .= '<option value="' . $k . '">' . $v . '</option>';
        }
        echo json_encode($projects_html); exit;
    
    
    }
    
    public function getRoleConditionsForProjectPhases()
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
}
