<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Users
 */
class DepartmentsController extends AppController {
	
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter ( $event );
		$this->viewBuilder ()->layout ( 'admin' );
	}
	public function index() {
		$conditions = array ();
		if (! empty ( $this->request->data )) {
			$paginateParams = $this->request->data;
			$this->request->query = $paginateParams;
		} else if (isset ( $this->request->query )) {
			$paginateParams = $this->request->query;
			$this->request->data = $this->request->query;
		}
		$getParams = $paginateParams;
		
		if (! empty ( $getParams ['department_name'] )) {
			$conditions ["department_name LIKE "] = "%" . $getParams ['department_name'] . "%";
		}
		if (isset ( $getParams ['is_active'] ) && $getParams ['is_active'] == 0) {
			$conditions ["Departments.is_active"] = text_to_id ( 'Inactive', status_master () );
		} else {
			$conditions ["Departments.is_active"] = text_to_id ( 'Active', status_master () );
		}
		$this->paginate ['conditions'] = $conditions;
		$departments = $this->paginate ( $this->Departments, [ 
				'limit' => RECORDS_PER_PAGE 
		] );
		
		$this->set ( compact ( 'departments', 'paginateParams' ) );
		$this->set ( '_serialize', [ 
				'departments',
				'paginateParams' 
		] );
	}
	
	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null) {
		$department = $this->Departments->get ( $id );
		
		$this->set ( 'department', $department );
		$this->set ( '_serialize', [ 
				'department' 
		] );
	}
	
	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$department = $this->Departments->newEntity ();
		
		if ($this->request->is ( 'post' )) {
			$department = $this->Departments->patchEntity ( $department, $this->request->data );
			// $user->created_by = $this->Auth->user('id');
			// $user->modified_by = $this->Auth->user('id');
			if ($this->Departments->save ( $department )) {
				$this->Flash->success ( __ ( 'The department has been saved.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'The department could not be saved. Please, try again.' ) );
			}
		}
		$this->set ( compact ( 'department' ) );
		$this->set ( '_serialize', [ 
				'department' 
		] );
	}
	
	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$department = $this->Departments->get ( $id );
		if ($this->request->is ( [ 
				'patch',
				'post',
				'put' 
		] )) {
			$department = $this->Departments->patchEntity ( $department, $this->request->data );
			if ($this->Departments->save ( $department )) {
				$this->Flash->success ( __ ( 'The department has been saved.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'The department could not be saved. Please, try again.' ) );
			}
		}
		$this->set ( compact ( 'department', 'activestatus' ) );
		$this->set ( '_serialize', [ 
				'department' 
		] );
	}
	
	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null) {
		$department = $this->Departments->get ( $id );
		if ($this->Departments->delete ( $department )) {
			$this->Flash->success ( __ ( 'The department has been deleted.' ) );
		} else {
			$this->Flash->error ( __ ( 'The department could not be deleted. Please, try again.' ) );
		}
		
		return $this->redirect ( [ 
				'action' => 'index' 
		] );
	}
	public function dashboard() {
		$departmentcount = $this->Departments->getDepartmentCount ();
		$this->set ( compact ( 'departmentcount' ) );
	}
	
	public function validate_unique_department()
    {
    	$id = 0;
    	$department = $_REQUEST['department_name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	$isAvailable = $this->Departments->isDepartmentNameExists($department, $id);
    	
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
