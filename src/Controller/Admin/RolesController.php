<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class RolesController extends AppController
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
    		 
    		if (!empty($getParams['role_name'])) {
    			$conditions["role_name LIKE "] = "%".$getParams['role_name']."%";
    		}
    	}
    	$roles = $this->paginate($this->Roles, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('roles','paginateParams'));
        $this->set('_serialize', ['roles','paginateParams']);
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
        $role = $this->Roles->get($id);

        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        
        if ($this->request->is('post')) {
        	$role = $this->Roles->patchEntity($role, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
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
        $role = $this->Roles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
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
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$rolecount = $this->Roles->getRoleCount();
        $this->set(compact('rolecount'));
    }
    
	public function validate_unique_role()
    {
    	$id = 0;
    	$role = $_REQUEST['role_name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->Roles->isRoleNameExists($role, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
