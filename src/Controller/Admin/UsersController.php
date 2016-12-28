<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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
    
    public function login()
    {
        $this->viewBuilder()->layout('login');
        if ($this->request->is ( 'post' )) {
            $user = $this->Auth->identify();
            if($user) {
                $this->do_login($user);
            } else {
                $this->Flash->error ( __( 'Invalid Username or Password' ) );
            }
        } elseif (! empty ( $this->request->session()->read('Auth.User'))) {
            $user = $this->request->session()->read('Auth.Admin');
            $this->do_login($user);
        }
    }
    
    public function do_login($user) {
    	
    	//start - set users default department id in session 
    	$this->loadModel('ResourceDepartments');
//     	$default_department_id = $this->ResourceDepartments->getUserDefaultDepartment($user['id']);
    	$access_to_departments = $this->getDepartmentsToBeShown($user);
    	if($access_to_departments) {
//     		$user['department'] = $default_department_id;
    		$this->loadModel('Roles');
    		$roles = $this->Roles->getActiveRoles();
    		$user['role_name'] = id_to_text($user['role_id'], $roles);
    		$this->Auth->setUser($user);
    		return $this->redirect(['controller' => 'Users', 'action' => '/dashboard']);
    	} else {
    		$this->Flash->error ( __( 'You haven\'t yet been assigned to any department') );
    	}        
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
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
        $conditions["Users.is_active"] = 1;
        $conditions["Role.id <>"] = SUPER_ADMIN;
        if (!empty($paginateParams)) {
        
            $getParams = $paginateParams;
                
        	if (!empty($getParams['first_name'])) {
        		$conditions["first_name LIKE "] = "%".$getParams['first_name']."%";
        	}
        	if (!empty($getParams['last_name'])) {
        		$conditions["last_name LIKE "] = "%".$getParams['last_name']."%";
        	}
        	if (!empty($getParams['username'])) {
        		$conditions["username LIKE "] = "%".$getParams['username']."%";
        	}
        	if (!empty($getParams['email'])) {
        		$conditions["email LIKE "] = "%".$getParams['email']."%";
        	}
        }
        $users = $this->paginate($this->Users, ['conditions' => $conditions,
        		 'limit' => RECORDS_PER_PAGE,
        		 'order' => ['id' => 'DESC'],
        		'contain' => ['Role' => function ($q) {
    						return $q->autoFields(false)->select(['role_name']);
    					},]
        ]);

        $this->set(compact('users', 'paginateParams'));
        $this->set('_serialize', ['users', 'paginateParams']);
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
        $user = $this->Users->get($id);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->created_by = $this->Auth->user('id');
            $user->modified_by = $this->Auth->user('id');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
//             	pr($user->errors());exit;
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Roles');       
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Designations');
        $designations = $this->Designations->getActiveDesignations();
        
        $this->set(compact('user', 'roles', 'designations'));
        $this->set('_serialize', ['user', 'roles', 'designations']);
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
    	$user = $this->Users->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$user = $this->Users->patchEntity($user, $this->request->data);
    		$user->modified_by = $this->Auth->user('id');
    		if ($this->Users->save($user)) {
    			$this->Flash->success(__('The user has been saved.'));
    			return $this->redirect(array_merge(['action' => 'index'], $params));
    		} else {
    			$this->Flash->error(__('The user could not be saved. Please, try again.'));
    		}
    	}
    
    	$this->loadModel('Roles');
    	$roles = $this->Roles->getActiveRoles();
    
    	$this->loadModel('Designations');
    	$designations = $this->Designations->getActiveDesignations();
    
    	$this->set(compact('user', 'roles', 'designations', 'params'));
    	$this->set('_serialize', ['user', 'roles', 'designations', 'params']);
    }
    
    public function validate_unique_fields()
    {
        switch ($_POST['type']) {
        	case 'email':
        		$email = $_POST['email'];
        		$isAvailable = $this->Users->isEmailExists($email);
        		break;
        		
        	case 'username':
        		$username = $_POST['username'];
        		$isAvailable = $this->Users->isUsernameExists($username);
        		break;
        }
        
		echo json_encode(array(
        		'valid' => $isAvailable,
        ));exit;
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
        $user = $this->Users->get($id);
        $params = $this->request->query;
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function dashboard()
    {
        $usercount = $this->Users->getUserCount();
        
        $this->loadModel('CurrencyConversions');
        $currencyconv = $this->CurrencyConversions->getCurrencyConversionsCount();
        
        $this->loadModel('Clients');
        $clientsCount = $this->Clients->getClientsCount();
        
        $this->loadModel('Holidays');
        $holidaysCount = $this->Holidays->getHolidaysCount();
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        $sess = $this->request->session();
        $role_id = $sess->read('Auth.Admin.role_id');
        $role_name = id_to_text($role_id, $roles);
        
        $this->set(compact('usercount', 'currencyconv', 'clientsCount', 'holidaysCount', 'role_name'));
    }
}
