<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class IssueTypesController extends AppController
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
    		 
    		if (!empty($getParams['type'])) {
    			$conditions["type LIKE "] = "%".$getParams['type']."%";
    		}
    	}
    	$issue_types = $this->paginate($this->IssueTypes, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('issue_types','paginateParams'));
        $this->set('_serialize', ['issue_types','paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issue_type = $this->IssueTypes->newEntity();
        
        if ($this->request->is('post')) {
        	$issue_type = $this->IssueTypes->patchEntity($issue_type, $this->request->data);
            if ($this->IssueTypes->save($issue_type)) {
                $this->Flash->success(__('The issue type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The issue type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('issue_type'));
        $this->set('_serialize', ['issue_type']);
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
        $issue_type = $this->IssueTypes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue_type = $this->IssueTypes->patchEntity($issue_type, $this->request->data);
            if ($this->IssueTypes->save($issue_type)) {
                $this->Flash->success(__('The issue type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The issue type could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('issue_type'));
        $this->set('_serialize', ['issue_type']);
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
        $issue_type = $this->IssueTypes->get($id);
        if ($this->IssueTypes->delete($issue_type)) {
            $this->Flash->success(__('The issue type has been deleted.'));
        } else {
            $this->Flash->error(__('The issue type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
	public function validate_unique_issue_type()
    {
    	$id = 0;
    	$issue_type = $_REQUEST['type'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->IssueTypes->isIssueTypeExists($issue_type, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
