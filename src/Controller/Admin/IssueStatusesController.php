<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class IssueStatusesController extends AppController
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
    	$issue_statuses = $this->paginate($this->IssueStatuses, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('issue_statuses','paginateParams'));
        $this->set('_serialize', ['issue_statuses','paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issue_status = $this->IssueStatuses->newEntity();
        
        if ($this->request->is('post')) {
        	$issue_status = $this->IssueStatuses->patchEntity($issue_status, $this->request->data);
            if ($this->IssueStatuses->save($issue_status)) {
                $this->Flash->success(__('The issue status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The issue status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('issue_status'));
        $this->set('_serialize', ['issue_status']);
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
        $issue_status = $this->IssueStatuses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue_status = $this->IssueStatuses->patchEntity($issue_status, $this->request->data);
            if ($this->IssueStatuses->save($issue_status)) {
                $this->Flash->success(__('The issue status has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The issue status could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('issue_status'));
        $this->set('_serialize', ['issue_status']);
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
        $issue_status = $this->IssueStatuses->get($id);
        if ($this->IssueStatuses->delete($issue_status)) {
            $this->Flash->success(__('The issue status has been deleted.'));
        } else {
            $this->Flash->error(__('The issue status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
	public function validate_unique_issue_status()
    {
    	$id = 0;
    	$issue_status = $_REQUEST['status'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->IssueStatuses->isIssueStatusExists($issue_status, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
