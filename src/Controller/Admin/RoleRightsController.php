<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Collection\Collection;
use Cake\Utility\Hash;
/**
 * RoleRights Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class RoleRightsController extends AppController
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
        
        $sess = $this->request->session();
        $role_id = $sess->read('Auth.Admin.role_id');
        
        $conditions["role_id <>"] = $role_id;
        
        $role_rights = $this->paginate($this->RoleRights, [
        		'conditions' => $conditions,
        		'limit' => RECORDS_PER_PAGE,
        		'order' => ['id' => 'DESC'],
        		'group' => ['role_id'],
        		'contain' => ['Roles']
        ]);

        $this->set(compact('role_rights', 'paginateParams'));
        $this->set('_serialize', ['role_rights', 'paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	if ($this->request->is('post')) {
        	$success = 1;
        	        	
        	foreach($this->request->data['Child'] as $k => $v) {
        		if($v) {
//         			pr($this->request->data); exit;
	        		$role_rights = $this->RoleRights->newEntity();
	        		$role_rights->role_id = $this->request->data['role_id'];
	        		$role_rights->right_id = $k;
	        		$role_rights->created_by = $this->Auth->user('id');
	        		$role_rights->modified_by = $this->Auth->user('id');
	        		if(!$this->RoleRights->save($role_rights)) {
	        			$success = 0;
	        			break;
	        		}
        		}
        	}
        	
            if ($success) {
                $this->Flash->success(__('The Rights has been saved for this Role.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Rights could not be saved for this Role. Please, try again.'));
            }
        }
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Rights');
        $rights = $this->Rights->find()
        	->where(['Rights.level' => 1])
        	->contain(['RightsChild', 'Parent'])
        	->toArray();

        $collection = new Collection($rights);
        $rights = $collection->groupBy('parent.menu');

        $this->set(compact('role_rights', 'rights', 'roles'));
        $this->set('_serialize', ['role_rights', 'rights', 'roles']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
	public function edit($id)
    {
    	$this->loadModel('Roles');
    	$role = $this->Roles->get($id);
    	$role_rights = $this->RoleRights->find()
    		->where(['role_id' => $role->id])->toArray();
// pjs($role_rights); exit;
    	$rights_id = Hash::extract($role_rights, '{n}.right_id');

    	if ($this->request->is(['patch', 'post', 'put'])) {
        	$success = 1;
        	if(!$this->RoleRights->deleteAll(['role_id' => $this->request->data['role_id']])) {
        		$success = 0;
        		goto a;
        	}
        	
        	foreach($this->request->data['Child'] as $k => $v) {
        		if($v) {        			
	        		$role_rights = $this->RoleRights->newEntity();
	        		$role_rights->role_id = $this->request->data['role_id'];
	        		$role_rights->right_id = $k;
	        		$role_rights->created_by = $this->Auth->user('id');
	        		$role_rights->modified_by = $this->Auth->user('id');
	        		if(!$this->RoleRights->save($role_rights)) {
	        			break;
	        		}
        		}
        	}
        	
			a:
            if ($success) {
                $this->Flash->success(__('The Rights has been saved for this Role.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Rights could not be saved for this Role. Please, try again.'));
            }
        }
        
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
        
        $this->loadModel('Rights');
        $rights = $this->Rights->find()
        	->where(['Rights.level' => 1])
        	->contain(['RightsChild', 'Parent'])
        	->toArray();

        $collection = new Collection($rights);
        $rights = $collection->groupBy('parent.menu');

        $this->set(compact('rights', 'roles', 'role', 'rights_id'));
        $this->set('_serialize', ['rights', 'roles', 'role', 'rights_id']);
    }
    
    public function _group_by($array, $key) {
    	$return = array();
    	foreach($array as $val) {
    		$return[$val[$key]][] = $val;
    	}
    	return $return;
    }
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($role_id = null)
    {
        $params = $this->request->query;
        if ($this->RoleRights->deleteAll(['role_id' => $role_id])) {
            $this->Flash->success(__('The Rights for this Role has been deleted.'));
        } else {
            $this->Flash->error(__('The Rights for this Role could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function validate_unique_role()
    {
    	$role_id = $_POST['role_id'];
    	$isAvailable = $this->RoleRights->isRoleExists($role_id);
    	    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    }
}