<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * EmailTemplates Controller
 *
 * @property \App\Model\Table\EmailTemplatesTable $EmailTemplates
 */
class EmailTemplatesController extends AppController {
	
	/**
	 * Index method
	 *
	 * @return void
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
			$this->request->query = $paginateParams;
		}
		$getParams = $paginateParams;
		
		if (isset ( $getParams ['is_active'] ) && $getParams ['is_active'] == 0) {
			$conditions ["EmailTemplates.is_active"] = text_to_id ( 'Inactive', status_master () );
		} else {
			$conditions ["EmailTemplates.is_active"] = text_to_id ( 'Active', status_master () );
		}
		// pr($getParams['is_active']);exit;
		$this->paginate ['conditions'] = $conditions;
		$email_templates = $this->paginate ( $this->EmailTemplates, [ 
				'limit' => RECORDS_PER_PAGE 
		] );
		
		$this->set ( compact ( 'email_templates', 'paginateParams' ) );
		$this->set ( '_serialize', [ 
				'email_templates',
				'paginateParams' 
		] );
	}
	
	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	Email Template id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$params = $this->request->query;
		$emailTemplate = $this->EmailTemplates->get ( $id, [ 
				'contain' => [ ] 
		] );
		if ($this->request->is ( [ 
				'patch',
				'post',
				'put' 
		] )) {
			// $email_type = strtoupper($this->request->data['email_type']);
			// $this->request->data['email_type'] = $email_type;
			$emailTemplate = $this->EmailTemplates->patchEntity ( $emailTemplate, $this->request->data );
			if (! empty ( $this->request->data ( [ 
					'message' 
			] ) )) {
				if ($this->EmailTemplates->save ( $emailTemplate )) {
					$this->Flash->success ( __ ( 'The email template has been saved.' ) );
					return $this->redirect ( array_merge ( [ 
							'action' => 'index' 
					], $params ) );
				} else {
					$this->Flash->error ( __ ( 'The email template could not be saved. Please, try again.' ) );
				}
			} else {
				$this->Flash->error ( __ ( 'Email Message cant be left empty' ) );
			}
		}
		$this->set ( compact ( 'emailTemplate', 'params' ) );
		$this->set ( '_serialize', [ 
				'emailTemplate' 
		] );
	}
}
