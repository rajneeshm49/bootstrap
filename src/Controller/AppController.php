<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
	protected $permissions;
	
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'dashboard'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authError' =>'Invalid Username or Password',
            'storage' => ['className' => 'Session', 'key' => 'Auth.Admin']
        ]);
        
        //initializing all the rights for this logged in user in property '$this->permissions'
        $this->getRoleRights();
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    
    public function getRoleRights()
    {
    	$role_id = $this->request->session()->read('Auth.Admin.role_id');
    	 
    	$this->permissions = array();
    	 
    	$conn = ConnectionManager::get('default');
    	if(1 != $role_id) {
	    	$stmt = $conn->execute(
	    			'select rights.* from role_rights join rights on rights.id = role_rights.right_id where role_rights.role_id = ?',
	    			[$role_id]
	    	);
    	} else {
    		$stmt = $conn->execute(
    				'select * from rights'
    		);
    	}
    	 
    	$rows = $stmt->fetchAll('assoc');
    	foreach ($rows as $row) {
    		$this->permissions[$row["controller"]][$row["action"]] = true;
    	}
    	return $this->permissions;
    }
    
    // check if User has rights
    public function hasRights($controller, $action) {
    	return isset($this->permissions[$controller][$action]);
    }
    
    public function beforeFilter(Event $event)
    {
    	$controller = $this->request->params['controller'];
    	$action = $this->request->params['action'];
//     	echo $action; exit;
//     	if($action == 'index') {
    		$can_add = $this->hasRights($controller, 'add');
    		$can_edit = $this->hasRights($controller, 'edit');
    		$can_delete = $this->hasRights($controller, 'delete');
//     	}
    	
    	$this->set(compact('can_add', 'can_edit', 'can_delete'));
    	
    	$allowed = array(
    			'login',
    			'logout',
    			'dashboard',
    			'index',
    			'view'
    	);
    	
    	if(in_array($action, $allowed)) {
    		goto a;
    	}
    	
    	if(!$this->hasRights($controller, $action)) {
    		$this->viewBuilder()->template('/Admin/NoAccess');
    	}
    	
    	a:
    }
    
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function getProjectsToBeShown($date = false)
    {
    	$sess = $this->request->session()->read('Auth.Admin');
    	
    	$this->loadModel('Roles');
    	$roles = $this->Roles->getActiveRoles();
    	
    	$role_name = id_to_text($sess['role_id'], $roles);
//     	$date = (!empty($this->request->data('date')))?$this->request->data('date'):date('Y-m-d');
    	
    	switch($role_name) {
    		case 'Developer':
    		case 'Project Lead':
    			$this->loadModel('ResourceAllocations');
    			if($date) {
    				$proj = $this->ResourceAllocations->getProjectsWithinDatesForUser($sess['id'], $date);
    			} else {
    				$proj = $this->ResourceAllocations->getProjectsForUser($sess['id']);
    			}
    			return $proj;
    			break;

    		case 'Project Manager':
    			$this->loadModel('ResourceAllocations');
    			if($date) {
    				$proj1 = $this->ResourceAllocations->getProjectsWithinDatesForUser($sess['id'], $date);
    			} else {
    				$proj1 = $this->ResourceAllocations->getProjectsForUser($sess['id']);
    			}
    			$proj2 = $this->Projects->getProjectsByUser($sess['id']);
    			$proj = $proj1 + $proj2;
    			return $proj;
    			break;
    				
    		default:
    			$dpt_ids = $this->getDepartmentsToBeShown();
    			$this->loadModel('Projects');
    			$projects = $this->Projects->getProjectsFromDpt($dpt_ids);
    			return $projects;
    			break;
    	}
    }
    
	public function getDepartmentsToBeShown($user = NULL)
    {
    	$sess = $this->request->session();
    
    	$this->loadModel('Roles');
    	$roles = $this->Roles->getActiveRoles();
    	$user = ($user === NULL)?$sess->read('Auth.Admin'):$user;
    	$role_name = id_to_text($user['role_id'], $roles);

    	switch($role_name) {
    
    		case 'Super Admin':
    		case 'General Manager':
    		case 'General Manager':
    			$this->loadModel('Departments');
    			$dpt_ids = $this->Departments->getActiveDepartments();
    			return $dpt_ids;
    			break;
    			
    		case 'Department Head':
    		case 'Project Manager':
    		case 'Project Lead':
    		case 'Developer':
    			$this->loadModel('ResourceDepartments');
    			$dpt_ids = $this->ResourceDepartments->getDepartments($user['id']);
    			return $dpt_ids;
    			break;
    	}
    }
}
