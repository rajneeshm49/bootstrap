<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectStatusesController extends AppController
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
    		 
    		if (!empty($getParams['status'])) {
    			$conditions["status LIKE "] = "%".$getParams['status']."%";
    		}
    	}
    	$project_statuses = $this->paginate($this->ProjectStatuses, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('project_statuses','paginateParams'));
        $this->set('_serialize', ['project_statuses','paginateParams']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project_status = $this->ProjectStatuses->get($id);

        $this->set('project_status', $project_status);
        $this->set('_serialize', ['project_status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project_status = $this->ProjectStatuses->newEntity();
        
        if ($this->request->is('post')) {
        	$project_status = $this->ProjectStatuses->patchEntity($project_status, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->ProjectStatuses->save($project_status)) {
                $this->Flash->success(__('The project status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('project_status'));
        $this->set('_serialize', ['project_status']);
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
        $project_status = $this->ProjectStatuses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project_status = $this->ProjectStatuses->patchEntity($project_status, $this->request->data);
            if ($this->ProjectStatuses->save($project_status)) {
                $this->Flash->success(__('The project status has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project status could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('project_status'));
        $this->set('_serialize', ['project_status']);
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
        $project_status = $this->ProjectStatuses->get($id);
        if ($this->ProjectStatuses->delete($project_status)) {
            $this->Flash->success(__('The project status has been deleted.'));
        } else {
            $this->Flash->error(__('The project status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$project_status_count = $this->ProjectStatuses->getProjectStatusCount();
        $this->set(compact('project_status_count'));
    }
    
	public function validate_unique_project_status()
    {
    	$id = 0;
    	$project_status = $_REQUEST['status'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->ProjectStatuses->isProjectStatusExists($project_status, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
