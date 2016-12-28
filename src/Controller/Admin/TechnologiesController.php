<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class TechnologiesController extends AppController
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
    		 
    		if (!empty($getParams['technology_name'])) {
    			$conditions["technology_name LIKE "] = "%".$getParams['technology_name']."%";
    		}
    	}
    	$technologies = $this->paginate($this->Technologies, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('technologies','paginateParams'));
        $this->set('_serialize', ['technologies','paginateParams']);
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
        $technology = $this->Technologies->get($id);

        $this->set('technology', $technology);
        $this->set('_serialize', ['technology']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $technology = $this->Technologies->newEntity();
        
        if ($this->request->is('post')) {
        	$technology = $this->Technologies->patchEntity($technology, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->Technologies->save($technology)) {
                $this->Flash->success(__('The technology has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The technology could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('technology'));
        $this->set('_serialize', ['technology']);
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
        $technology = $this->Technologies->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $technology = $this->Technologies->patchEntity($technology, $this->request->data);
            if ($this->Technologies->save($technology)) {
                $this->Flash->success(__('The technology has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The technology could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('technology'));
        $this->set('_serialize', ['technology']);
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
        $technology = $this->Technologies->get($id);
        if ($this->Technologies->delete($technology)) {
            $this->Flash->success(__('The technology has been deleted.'));
        } else {
            $this->Flash->error(__('The technology could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$technologycount = $this->Technologies->getTechnologyCount();
        $this->set(compact('technologycount'));
    }
    
	public function validate_unique_technology()
    {
    	$id = 0;
    	$technology = $_REQUEST['technology_name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->Technologies->isTechnologyNameExists($technology, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
