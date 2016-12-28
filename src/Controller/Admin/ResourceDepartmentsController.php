<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Query;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ResourceDepartmentsController extends AppController
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
//     	pr($this->request); exit;
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
    		
    		if (1 == $paginateParams['department_head']) {
    			$conditions['department_head'] = $paginateParams['department_head'];
    		} elseif (0 == $paginateParams['department_head']) {
    			$conditions['department_head'] = $paginateParams['department_head'];
    		}
    		
    		if (!empty($paginateParams['user_name'])) {
    			$conditions["OR"] = array(
    					'first_name like' => '%' . $paginateParams['user_name'] . '%',
    					'last_name like' => '%' . $paginateParams['user_name'] . '%'
    			);
    		}
    		
    		if (!empty($paginateParams['user_id'])) {
    			$conditions['OR']["user_id"] = $paginateParams['user_id'];
    		}
    		
    		if (!empty($paginateParams['department_id'])) {
    			$conditions["department_id"] = $paginateParams['department_id'];
    		}
    	} else {
    		$paginateParams['department_head'] = 2;
    	}
    	$this->paginate ['conditions'] = $conditions;
    	$resource_departments = $this->paginate($this->ResourceDepartments, [
    			'limit' => RECORDS_PER_PAGE,
    			'contain' => ['Users', 'Departments'],
    			'order' => ['modified' => 'DESC']
    	]);
    	$this->loadModel('Users');
    	$users = $this->Users->getUserList();
        
    	$this->loadModel('Departments');
    	$departments = $this->Departments->getActiveDepartments();
    	
    	$head_of_departments = array();
    	$this->loadModel('Salaries');
    	$user_list = $this->Salaries->getDepartmentHeadUserList();
    	foreach($user_list as $key=>$value){
    		$head_of_departments[] = id_to_text($value, $users);
    	}
    	
    	$this->set(compact('resource_departments', 'paginateParams','users','departments','head_of_departments'));
        $this->set('_serialize', ['resource_departments', 'paginateParams','users','departments','head_of_departments']);
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
        $resource_department = $this->ResourceDepartments->get($id);

        $this->set('resource_department', $resource_department);
        $this->set('_serialize', ['resource_department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resource_department = $this->ResourceDepartments->newEntity();
        $user_id = '';
        if ($this->request->is('post')) {
            $user_id = $this->request->data['user_id'];
        	if(empty($user_id)) {
        		$this->Flash->error(__('User not found. Please select proper User'));
        		goto a;
        	}
        	$req_data = $this->request->data;
        	$alloc_valid = $this->ResourceDepartments->getUsersAllocations($req_data['user_id'], $req_data['percentage_allocate']);
        	if(!$alloc_valid) {
        		$this->Flash->error(__('User allocation exceeds 100%. Please try with lower value.'));
        		goto a;
        	}
        	
        	$resource_department = $this->ResourceDepartments->patchEntity($resource_department, $this->request->data);
            $resource_department->created_by = $this->Auth->user('id');
            $resource_department->modified_by = $this->Auth->user('id');
			
			$this->saveResourceDepartmentDtl($resource_department);
        }
        a:
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        $this->set(compact('resource_department', 'departments', 'user_id'));
        $this->set('_serialize', ['resource_department', 'departments', 'user_id']);
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
        $resource_department = $this->ResourceDepartments->get($id, ['contain' => ['Users']]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$user_id = $this->request->data['user_id'];
        	if(empty($user_id)) {
        		$this->Flash->error(__('User not found. Please select proper User'));
        		goto a;
        	}
        	$req_data = $this->request->data;
        	$alloc_valid = $this->ResourceDepartments->getUsersAllocations($req_data['user_id'], $req_data['percentage_allocate'], $id);
        	if(!$alloc_valid) {
        		$this->Flash->error(__('User allocation exceeds 100%. Please try with lower value.'));
        		goto a;
        	}
        	$resource_department = $this->ResourceDepartments->patchEntity($resource_department, $this->request->data);
            $resource_department->modified_by = $this->Auth->user('id');
            
            $this->saveResourceDepartmentDtl($resource_department);
        }
        
        a:
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        $this->set(compact('resource_department', 'departments'));
        $this->set('_serialize', ['resource_department', 'departments']);
    
    }

    public function saveResourceDepartmentDtl($data)
    {
    	$params = $this->request->query;
    	$save_rslt = $this->ResourceDepartments->save($data);
    	$error = 'The record could not be saved. Please, try again.';
    	if ($save_rslt) {
    		 
    		//if user has selected it as default_department, then make default department in other entries as false
    		if($save_rslt->default_department) {
    			$query = $this->ResourceDepartments->query();
    			$query->update()
    			->set(['default_department' => false])
    			->where(['id <>' => $save_rslt->id, 'user_id' => $save_rslt->user_id])
    			->execute();
    		}
    		
    		//if user is department_head, then make other department heads for this department as false
    		if($save_rslt->department_head) {
    			$query = $this->ResourceDepartments->query();
    			$query->update()
    			->set(['department_head' => false])
    			->where(['id <>' => $save_rslt->id, 'department_id' => $save_rslt->department_id])
    			->execute();
    		}
    		$this->Flash->success(__('The record has been saved.'));
    		return $this->redirect(array_merge(['action' => 'index'], $params));
    	} else {
    		$error_arr = $resource_department->errors();
    		$error = implode("&",array_map(function($a) {return implode("~",$a);},$error_arr));
    		$this->Flash->error(__($error));
    		 
    	}
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
    	$params = $this->request->query;
        $resource_department = $this->ResourceDepartments->get($id);
        if ($this->ResourceDepartments->delete($resource_department)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function dashboard()
    {
 		$resource_departmentcount = $this->ResourceDepartments->getResourceDepartmentCount();
        $this->set(compact('resource_departmentcount'));
    }
    
    public function getUsersForDpt()
    {
    	$keyword = $_REQUEST['term'];
    	$cond['OR'] = array(
    			'first_name like' => '%' . $keyword . '%',
    			'last_name like' => '%' . $keyword . '%',
    			'username like' => '%' . $keyword . '%',
    			'email like' => '%' . $keyword . '%',
    	);
    	$this->loadModel('Users');
    	$users = $this->Users->getUserList($cond, 'first_name');
    	echo json_encode($users); exit;
    }
    
    public function getUsersForDepartments($get_only_dpt_head = Null)
    {
        $req_data = $this->request->data;
        
        $departments = $this->ResourceDepartments->getUsersForDepartmentsM($req_data['department_id'], $get_only_dpt_head);
        
        $departments_html = '';
        if(count($departments) > 0) {
            $departments_html .= '<option value=\'\'>(Choose one)</option>';
        }
        foreach($departments as $k => $v) {
            $departments_html .= '<option value="' . $k . '">' . $v . '</option>';
        }
        echo json_encode($departments_html); exit;
    }
    
    public function getDefaultDepartment()
    {
    	$req_data = $this->request->data;
    	$dflt_Dpt = $this->ResourceDepartments->getUserDefaultDepartment($req_data['user_id']);
    	echo $dflt_Dpt; exit;
    	
    }
}
