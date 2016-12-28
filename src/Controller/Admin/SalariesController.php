<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class SalariesController extends AppController
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
                
        	if (!empty($getParams['user_id'])) {
        		$conditions["user_id"] = $getParams['user_id'];
        	}
        	if (!empty($getParams['increment_date'])) {
        		$conditions["increment_date"] = $getParams['increment_date'];
        	}
        	if (!empty($getParams['role_id'])) {
        		$conditions["role_id"] = $getParams['role_id'];
        	}
        	if (!empty($getParams['designation_id'])) {
        		$conditions["designation_id"] = $getParams['designation_id'];
        	}
        }
        $salaries = $this->paginate($this->Salaries, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $salarylist = $this->Salaries->getSalaryUserList();
        $salarylist = (count($salarylist))?$salarylist:array(null);
        $this->loadModel('Users');
        $userswithoutsalary = $this->Users->getUsersWithoutSalary($salarylist);
        
        $users = $this->Users->getUserList();

        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Designations');
        $designations = $this->Designations->getActiveDesignations();
        
        $this->set(compact('salaries', 'paginateParams','users','roles','designations','userswithoutsalary'));
        $this->set('_serialize', ['salaries', 'paginateParams','users','roles','designations','userswithoutsalary']);
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
        $salary = $this->Salaries->get($id);

        $this->set('salary', $salary);
        $this->set('_serialize', ['salary']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salary = $this->Salaries->newEntity();
        if ($this->request->is('post')) {
            $salary = $this->Salaries->patchEntity($salary, $this->request->data);
//             $user->modified_by = $this->Auth->user('id');
	            if ($this->Salaries->save($salary)) {
	            	$this->loadModel('Users');
	            	$this->Users->updateAll(['role_id' => $this->request->data['role_id'],'designation_id' => $this->request->data['designation_id']], ['id' => $this->request->data['user_id']]);
	                $this->Flash->success(__('Salary has been saved.'));
	                return $this->redirect(['action' => 'index']);
	            } else {
	                $this->Flash->error(__('Salary could not be saved. Please, try again.'));
	            }
        }
        
        $salarylist = $this->Salaries->getSalaryUserList();
        $this->loadModel('Users');
        $salarylist = (count($salarylist))?$salarylist:array('');
        $userswithoutsalary = $this->Users->getUsersWithoutSalary($salarylist);
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Designations');
        $designations = $this->Designations->getActiveDesignations();
        
        $this->set(compact('salary', 'roles', 'designations','users','userswithoutsalary'));
        $this->set('_serialize', ['salary', 'roles', 'designations','users','userswithoutsalary']);
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
    	$salary = $this->Salaries->get($id);
        $params = $this->request->query;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salary = $this->Salaries->patchEntity($salary, $this->request->data);
            
            if ($this->Salaries->save($salary)) {
            	$this->loadModel('Users');
            	$this->Users->updateAll(['role_id' => $this->request->data['role_id'],'designation_id' => $this->request->data['designation_id']], ['id' => $this->request->data['user_id']]);
            	$this->Flash->success(__('Salary has been saved.'));
                return $this->redirect(array_merge(['action' => 'index'], $params));
            } else {
                $this->Flash->error(__('Salary could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Users');
       	$users = $this->Users->getUserList();
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Designations');
        $designations = $this->Designations->getActiveDesignations();
        
        $this->set(compact('salary', 'roles', 'designations', 'params','users'));
        $this->set('_serialize', ['salary', 'roles', 'designations', 'params','users']);
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
        $salary = $this->Salaries->get($id);
        $params = $this->request->query;
        if ($this->Salaries->delete($salary)) {
            $this->Flash->success(__('Salary has been deleted.'));
        } else {
            $this->Flash->error(__('Salary could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function dashboard()
    {
        $salarycount = $this->Salaries->getSalaryCount();
        $this->set(compact('salarycount'));
    }
}
