<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Clients Controller
 *
 */
class ClientsController extends AppController
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
//     	pr($paginateParams); exit;
    	if (!empty($paginateParams)) {
    	    	
    		if (!empty($paginateParams['name'])) {
    			$conditions["name LIKE "] = "%".$paginateParams['name']."%";
    		}
    		
    		if (!empty($paginateParams['email'])) {
    			$conditions["email LIKE "] = "%".$paginateParams['email']."%";
    		}
    		
    		if (!empty($paginateParams['country_id'])) {
    			$conditions["Clients.country_id"] = $paginateParams['country_id'];
    		}
    	}
    	$this->paginate ['conditions'] = $conditions;
    	$clients = $this->paginate($this->Clients, ['limit' => RECORDS_PER_PAGE, 'order' => ['id' => 'DESC'], 'contain' => ['Countries']]);
    	$this->loadModel('Countries');
    	$countries = $this->Countries->getAllCountries();
        $this->set(compact('clients', 'paginateParams', 'countries'));
        $this->set('_serialize', ['clients', 'paginateParams', 'countries']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */    
    public function add()
    {
        $client = $this->Clients->newEntity();
        
        if ($this->request->is('post')) {
        	$client = $this->Clients->patchEntity($client, $this->request->data);
            $client->created_by = $this->Auth->user('id');
            $client->modified_by = $this->Auth->user('id');
            
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Countries');
        $countries = $this->Countries->getAllCountries();
        $this->set(compact('client', 'countries'));
        $this->set('_serialize', ['client', 'countries']);
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
        $client = $this->Clients->get($id,['contain'=>['Contacts.Countries']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));
				return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Countries');
        $countries = $this->Countries->getAllCountries();
        $this->set(compact('client', 'countries'));
        $this->set('_serialize', ['client', 'countries']);
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
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
 		$clients_count = $this->Clients->getClientsCount();
        $this->set(compact('clients_count'));
    }
}
