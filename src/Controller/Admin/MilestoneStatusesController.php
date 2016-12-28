<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class MilestoneStatusesController extends AppController
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
    	$milestone_statuses = $this->paginate($this->MilestoneStatuses, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('milestone_statuses','paginateParams'));
        $this->set('_serialize', ['milestone_statuses','paginateParams']);
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
        $milestone_status = $this->MilestoneStatuses->get($id);

        $this->set('milestone_status', $milestone_status);
        $this->set('_serialize', ['milestone_status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $milestone_status = $this->MilestoneStatuses->newEntity();
        
        if ($this->request->is('post')) {
        	$milestone_status = $this->MilestoneStatuses->patchEntity($milestone_status, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->MilestoneStatuses->save($milestone_status)) {
                $this->Flash->success(__('The milestone status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The milestone status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('milestone_status'));
        $this->set('_serialize', ['milestone_status']);
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
        $milestone_status = $this->MilestoneStatuses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $milestone_status = $this->MilestoneStatuses->patchEntity($milestone_status, $this->request->data);
            if ($this->MilestoneStatuses->save($milestone_status)) {
                $this->Flash->success(__('The milestone status has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The milestone status could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('milestone_status'));
        $this->set('_serialize', ['milestone_status']);
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
        $milestone_status = $this->MilestoneStatuses->get($id);
        if ($this->MilestoneStatuses->delete($milestone_status)) {
            $this->Flash->success(__('The milestone status has been deleted.'));
        } else {
            $this->Flash->error(__('The milestone status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$milestone_status_count = $this->MilestoneStatuses->getMilestoneStatusCount();
        $this->set(compact('milestone_status_count'));
    }
    
	public function validate_unique_milestone_status()
    {
    	$id = 0;
    	$milestone_status = $_REQUEST['status'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->MilestoneStatuses->isMilestoneStatusExists($milestone_status, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
