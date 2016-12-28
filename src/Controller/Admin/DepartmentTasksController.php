<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class DepartmentTasksController extends AppController
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
            if (!empty($getParams['task_id'])) {
        		$conditions["task_id"] = $getParams['task_id'];
        	}
        	if (!empty($getParams['name'])) {
        		$conditions["name LIKE"] = '%'.$getParams['name'].'%';
        	}
        }
        $department_tasks = $this->paginate($this->DepartmentTasks, [
        		'conditions' => $conditions ,'limit' => RECORDS_PER_PAGE]);
                
        $department_tasks_list = $this->DepartmentTasks->getActiveDepartmentTasks();

        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Tasks');
        $tasks = $this->Tasks->getActiveTasks();
        
        $this->set(compact('department_tasks', 'paginateParams','department_tasks_list','departments','tasks'));
        $this->set('_serialize', ['department_tasks', 'paginateParams','department_tasks_list','departments','tasks']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department_task = $this->DepartmentTasks->newEntity();
        
        if ($this->request->is('post')) {
            $department_task = $this->DepartmentTasks->patchEntity($department_task, $this->request->data);
            
            if ($this->DepartmentTasks->save($department_task)) {
                $this->Flash->success(__('The department task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The department task could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Tasks');
        $tasks = $this->Tasks->getActiveTasks();
        
        $this->set(compact('department_task','departments','tasks'));
        $this->set('_serialize', ['department_task','departments','tasks']);
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
    	$department_task = $this->DepartmentTasks->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$department_task = $this->DepartmentTasks->patchEntity($department_task, $this->request->data);
    		if ($this->DepartmentTasks->save($department_task)) {
    			$this->Flash->success(__('The department task has been saved.'));
    			return $this->redirect(array_merge(['action' => 'index'], $params));
    		} else {
    			$this->Flash->error(__('The department task could not be saved. Please, try again.'));
    		}
    	}
    	
    	$this->loadModel('Departments');
    	$departments = $this->Departments->getActiveDepartments();
    	
    	$this->loadModel('Tasks');
    	$tasks = $this->Tasks->getActiveTasks();
    	
    	$this->set(compact('department_task','params','departments','tasks'));
    	$this->set('_serialize', ['department_task', 'params','departments','tasks']);
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
        $department_task = $this->DepartmentTasks->get($id);
        $params = $this->request->query;
        if ($this->DepartmentTasks->delete($department_task)) {
            $this->Flash->success(__('The department task has been deleted.'));
        } else {
            $this->Flash->error(__('The department task could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function validate_unique_department_task()
    {
    	$id = 0;
    	$department_task = $_REQUEST['name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	$isAvailable = $this->DepartmentTasks->isNameExists($department_task, $id);
    	 
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
