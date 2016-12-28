<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectTypesController extends AppController
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
    		 
    		if (!empty($getParams['type'])) {
    			$conditions["type LIKE "] = "%".$getParams['type']."%";
    		}
    	}
    	$project_types = $this->paginate($this->ProjectTypes, ['conditions' => $conditions, 'limit' => RECORDS_PER_PAGE]);

        $this->set(compact('project_types','paginateParams'));
        $this->set('_serialize', ['project_types','paginateParams']);
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
        $project_type = $this->ProjectTypes->get($id);

        $this->set('project_type', $project_type);
        $this->set('_serialize', ['project_type']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project_type = $this->ProjectTypes->newEntity();
        
        if ($this->request->is('post')) {
        	$project_type = $this->ProjectTypes->patchEntity($project_type, $this->request->data);
//             $user->created_by = $this->Auth->user('id');
//             $user->modified_by = $this->Auth->user('id');
            if ($this->ProjectTypes->save($project_type)) {
                $this->Flash->success(__('The project type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('project_type'));
        $this->set('_serialize', ['project_type']);
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
        $project_type = $this->ProjectTypes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project_type = $this->ProjectTypes->patchEntity($project_type, $this->request->data);
            if ($this->ProjectTypes->save($project_type)) {
            	$data['to'] = 'm.jaisinghani@direction.biz';
            	$data['email'] = 'm.jaisinghani@direction.biz';
            	$data['full_name'] = 'Mohit Jaisinghani';
            	sendTemplatedMail('INTRODUCTION_MAIL', $data);
                $this->Flash->success(__('The project type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project type could not be saved. Please, try again.'));
            }
        } 
        
        $this->set(compact('project_type'));
        $this->set('_serialize', ['project_type']);
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
        $project_type = $this->ProjectTypes->get($id);
        if ($this->ProjectTypes->delete($project_type)) {
            $this->Flash->success(__('The project type has been deleted.'));
        } else {
            $this->Flash->error(__('The project type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
		$project_type_count = $this->ProjectTypes->getProjectTypeCount();
        $this->set(compact('project_type_count'));
    }
    
	public function validate_unique_project_type()
    {
    	$id = 0;
    	$project_type = $_REQUEST['type'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->ProjectTypes->isProjectTypeExists($project_type, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
