<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class TaskStatusesController extends AppController
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
    		 
    		if (!empty($getParams['name'])) {
    			$conditions["name LIKE "] = "%".$getParams['name']."%";
    		}
    	}
    	$task_statuses = $this->paginate($this->TaskStatuses, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('task_statuses','paginateParams'));
        $this->set('_serialize', ['task_statuses','paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task_status = $this->TaskStatuses->newEntity();
        
        if ($this->request->is('post')) {
        	$task_status = $this->TaskStatuses->patchEntity($task_status, $this->request->data);
            if ($this->TaskStatuses->save($task_status)) {
                $this->Flash->success(__('The task status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('task_status'));
        $this->set('_serialize', ['task_status']);
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
        $task_status = $this->TaskStatuses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task_status = $this->TaskStatuses->patchEntity($task_status, $this->request->data);
            if ($this->TaskStatuses->save($task_status)) {
                $this->Flash->success(__('The task status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task status could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('task_status'));
        $this->set('_serialize', ['task_status']);
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
        $task_status = $this->TaskStatuses->get($id);
        if ($this->TaskStatuses->delete($task_status)) {
            $this->Flash->success(__('The task status has been deleted.'));
        } else {
            $this->Flash->error(__('The task status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
	public function validate_unique_task_status()
    {
    	$id = 0;
    	$task_status = $_REQUEST['name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->TaskStatuses->isTaskStatusNameExists($task_status, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
