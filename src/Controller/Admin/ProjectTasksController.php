<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Hash;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectTasksController extends AppController
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
        
        $conditions2 = $this->getConditionsForProjectTasks();
        $conditions = array_merge($conditions, $conditions2);
//         pr($conditions); exit;
        $this->paginate = [
        		'joins' => array(
        				array(
        						'alias' => 'ProjectTaskDetails',
        						'table' => 'project_task_details',
        						'type' => 'INNER',
        						'conditions' => '`ProjectTaskDetails`.`project_task_id` = `ProjectTasks`.`id`'
        				)
        		),
        		'conditions' => $conditions,
        		'limit' => RECORDS_PER_PAGE
        		
        ];
        
        $project_tasks = $this->paginate($this->ProjectTasks);
//                debug($project_tasks); exit;
        $project_tasks_list = $this->ProjectTasks->getActiveProjectTasks();

        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->loadModel('TaskStatuses');
        $task_statuses = $this->TaskStatuses->getActiveTaskStatuses();
        
        $this->set(compact('project_tasks', 'paginateParams','project_tasks_list','departments','projects','task_statuses'));
        $this->set('_serialize', ['project_tasks', 'paginateParams','project_tasks_list','departments','projects','task_statuses']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project_task = $this->ProjectTasks->newEntity();
        
        if ($this->request->is('post')) {
            $project_task = $this->ProjectTasks->patchEntity($project_task, $this->request->data);
            
            if ($this->ProjectTasks->save($project_task)) {
                $this->Flash->success(__('The project task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project task could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('DepartmentTasks');
        $department_tasks = $this->DepartmentTasks->getActiveDepartmentTasks();
        
        $this->loadModel('TaskStatuses');
        $task_statuses = $this->TaskStatuses->getActiveTaskStatuses();
        
        $this->set(compact('project_task','departments','projects','department_tasks','task_statuses'));
        $this->set('_serialize', ['project_task','departments','projects','department_tasks','task_statuses']);
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
    	$project_task = $this->ProjectTasks->get($id,['contain'=>['ProjectTaskDetails']]);
    	
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$project_task = $this->ProjectTasks->patchEntity($project_task, $this->request->data);
    		if ($this->ProjectTasks->save($project_task)) {
    			$this->Flash->success(__('The project task has been saved.'));
    			return $this->redirect(array_merge(['action' => 'index'], $params));
    		} else {
    			$this->Flash->error(__('The project task could not be saved. Please, try again.'));
    		}
    	}
    	
    	$this->loadModel('Users');
    	$users = $this->Users->getActiveUsers();
    	
    	$this->loadModel('Departments');
    	$departments = $this->Departments->getActiveDepartments();
    	
    	$this->loadModel('Projects');
    	$projects = $this->Projects->getProjects();
    	
    	$this->loadModel('DepartmentTasks');
    	$department_tasks = $this->DepartmentTasks->getActiveDepartmentTasks();
    	
    	$this->loadModel('TaskStatuses');
    	$task_statuses = $this->TaskStatuses->getActiveTaskStatuses();
    	
    	$this->loadModel('ProjectPhases');
    	$project_phases = $this->ProjectPhases->getActiveProjectPhases();
    	 
    	$this->loadModel('Milestones');
    	$milestones = $this->Milestones->getActiveMilestones();
    	
    	$this->loadModel('ProjectModules');
    	$project_modules = $this->ProjectModules->getActiveProjectModules();
    	
    	$this->set(compact('project_task','params','departments','projects','department_tasks','task_statuses','project_phases','milestones','project_modules','users'));
    	$this->set('_serialize', ['project_task', 'params','departments','projects','department_tasks','task_statuses','project_phases','milestones','project_modules','users']);
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
        $project_task = $this->ProjectTasks->get($id);
        $params = $this->request->query;
        if ($this->ProjectTasks->delete($project_task)) {
            $this->Flash->success(__('The project task has been deleted.'));
        } else {
            $this->Flash->error(__('The project task could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function validate_unique_project_task()
    {
        $id = 0;
    	$project_task = $_REQUEST['name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	$isAvailable = $this->ProjectTasks->isNameExists($project_task, $id);
    	 
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
    
	public function getConditionsForProjectTasks()
    {
        $sess = $this->request->session();
        $conditions = array();
    
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
    
        $role_id = $sess->read('Auth.Admin.role_id');
        $role_name = id_to_text($role_id, $roles);
    
        switch($role_name) {
            case 'Developer':
                $this->loadModel('ProjectTaskDetails');
                $project_tasks = $this->ProjectTaskDetails->getProjectTasksFromUserId($this->Auth->user('id'));
                $project_task_ids = Hash::extract($project_tasks, '{n}.project_task_id');
                $conditions['id IN'] = (!empty($project_task_ids))?$project_task_ids:array(NULL);
                return $conditions;
                break;
    
            default:
                $projects = $this->getProjectsToBeShown();
                $tasks = $this->ProjectTasks->getTasksForProjectsM($projects);
                $conditions['id IN'] = (!empty($tasks))?array_keys($tasks):array(NULL);
                return $conditions;
                break;
        }
    }
}
