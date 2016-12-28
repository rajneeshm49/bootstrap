<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class DesignationsController extends AppController
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
    		 
    		if (!empty($getParams['designation_name'])) {
    			$conditions["designation_name LIKE "] = "%".$getParams['designation_name']."%";
    		}
    	}
    	$designations = $this->paginate($this->Designations, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('designations','paginateParams'));
        $this->set('_serialize', ['designations','paginateParams']);
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
        $designation = $this->Designations->get($id);

        $this->set('designation', $designation);
        $this->set('_serialize', ['designation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $designation = $this->Designations->newEntity();
        
        if ($this->request->is('post')) {
        	$designation = $this->Designations->patchEntity($designation, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->Designations->save($designation)) {
                $this->Flash->success(__('The designation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('designation'));
        $this->set('_serialize', ['designation']);
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
        $designation = $this->Designations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $designation = $this->Designations->patchEntity($designation, $this->request->data);
            if ($this->Designations->save($designation)) {
                $this->Flash->success(__('The designation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designation could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('designation'));
        $this->set('_serialize', ['designation']);
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
        $designation = $this->Designations->get($id);
        if ($this->Designations->delete($designation)) {
            $this->Flash->success(__('The designation has been deleted.'));
        } else {
            $this->Flash->error(__('The designation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$designationcount = $this->Designations->getDesignationCount();
        $this->set(compact('designationcount'));
    }
    
	public function validate_unique_designation()
    {
    	$id = 0;
    	$designation = $_REQUEST['designation_name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->Designations->isDesignationNameExists($designation, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
