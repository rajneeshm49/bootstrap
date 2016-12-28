<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Contacts Controller
 *
 */
class ContactsController extends AppController
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
    	$client_id = NULL;
    	$client_name = '';
    	$conditions = array();
    	if(!empty($this->request->data) && isset($this->request->query )) {
    		$paginateParams = array_merge($this->request->query, $this->request->data);
    	}
    	elseif(!empty($this->request->data))
    	{
    		$paginateParams = $this->request->data;
    		$this->request->query = $paginateParams;
    	}
    	elseif(isset($this->request->query ))
    	{
    		$paginateParams = $this->request->query;
    		$this->request->data = $this->request->query;
    	}
//     	pr($paginateParams); exit;
    	if (!empty($paginateParams)) {
    	   
    		if (!empty($paginateParams['name'])) {
    			$conditions["OR"] = array(
    					'first_name like' => '%' . $paginateParams['name'] . '%',
    					'last_name like' => '%' . $paginateParams['name'] . '%',
    			);
    		}
    		
    		if (!empty($paginateParams['email'])) {
    			$conditions["email LIKE "] = "%".$paginateParams['email']."%";
    		}
    		
    		if (!empty($paginateParams['country_id'])) {
    			$conditions["Contacts.country_id"] = $paginateParams['country_id'];
    		}
    		
    		if (!empty($paginateParams['client_id'])) {
    			$client_id = $conditions["client_id"] = $paginateParams['client_id'];
    		}
    		
    		if (!empty($paginateParams['client_name'])) {
    			$client_name = $paginateParams['client_name'];
    		}
    	}
    	$this->paginate ['conditions'] = $conditions;
    	$contacts = $this->paginate($this->Contacts, ['limit' => RECORDS_PER_PAGE, 'order' => ['id' => 'DESC'], 'contain' => ['Countries']]);
    	
    	$this->loadModel('Countries');
    	$countries = $this->Countries->getAllCountries();
    	
        $this->set(compact('contacts', 'client_id', 'client_name', 'paginateParams', 'countries'));
        $this->set('_serialize', ['contacts', 'client_id', 'client_name', 'paginateParams', 'countries']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */    
    public function add($id = NULL)
    {
        $contact = $this->Contacts->newEntity();
        $client_id = !empty($this->request->query['client_id']) ? $this->request->query['client_id'] : NULL; 
        if($id){
            $client_id = $id;
        }
        if ($this->request->is('post')) {
        	$client = $this->Contacts->patchEntity($contact, $this->request->data);
        	$contact->created_by = $this->Auth->user('id');
            $contact->modified_by = $this->Auth->user('id');
           
            if ($this->Contacts->save($client)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index', '?' => ['client_id' => $client_id]]);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Countries');
        $countries = $this->Countries->getAllCountries();
        
        $this->set(compact('contact', 'countries', 'client_id'));
        $this->set('_serialize', ['contact', 'countries', 'client_id']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$clients_id = null)
    {
        $contact = $this->Contacts->get($id);
        $client_id = (!empty($this->request->query['client_id'])) ? $this->request->query['client_id'] : NULL;
        if($clients_id){
            $client_id = $clients_id;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
				return $this->redirect(['action' => 'index', '?' => ['client_id' => $client_id]]);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        
        
//         pjs($contact);exit;
        $this->loadModel('Countries');
        $countries = $this->Countries->getAllCountries();
        
        $this->set(compact('contact', 'client_id','countries'));
        $this->set('_serialize', ['contact', 'client_id', 'countries']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$clients_id = null)
    {
        if($clients_id){
            $client_id = $clients_id;
        }
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
            if($clients_id){
                return $this->redirect(['controller'=>'clients','action' => 'edit',$client_id]);
            }
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }
        if($clients_id){
            return $this->redirect(['controller'=>'clients','action' => 'index',$client_id]);
        } else{
            return $this->redirect(['controller'=>'contacts','action' => 'index']);
        }
    }
}