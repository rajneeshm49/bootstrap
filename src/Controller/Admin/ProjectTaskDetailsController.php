<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectTaskDetailsController extends AppController
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
        
        $project_task_details = $this->paginate($this->ProjectTaskDetails, [
        		'limit' => RECORDS_PER_PAGE]);
                
        $project_task_details_list = $this->ProjectTaskDetails->getActiveProjectTaskDetails();
        
        $this->loadModel('ProjectTasks');
        $project_tasks = $this->ProjectTasks->getActiveProjectTasks();
        
        $this->loadModel('Users');
        $users = $this->Users->getActiveUsers();
        
        $this->set(compact('project_task_details', 'paginateParams','project_task_details_list','project_tasks','users'));
        $this->set('_serialize', ['project_task_details', 'paginateParams','project_task_details_list','project_tasks','users']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = NULL)
    {
        $prj_task_id = $id;
        $project_task_detail = $this->ProjectTaskDetails->newEntity();
        if ($this->request->is('post')) {
            $project_task_detail = $this->ProjectTaskDetails->patchEntity($project_task_detail, $this->request->data);
            $project_task_detail->project_task_id = $prj_task_id;
            if ($this->ProjectTaskDetails->save($project_task_detail)) {
                $this->Flash->success(__('The project task detail has been saved.'));
                return $this->redirect(['controller'=>'project_tasks','action' => 'edit',$prj_task_id]);
            } else {
                $this->Flash->error(__('The project task detail could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('ProjectTasks');
        $project_task = $this->ProjectTasks->get($id);
        
        $this->loadModel('ResourceAllocations');
        $project_task_conditions['project_id'] = $project_task->project_id;
        $project_task_conditions['release_user'] = 0;
        
        $resource_list = $this->ResourceAllocations->getUnReleasedUsers($project_task_conditions);

        $this->loadModel('Users');
        $users = $this->Users->getActiveUsers();
        $resource_users_arr = array();
        foreach($resource_list as $resources => $resource_users){
            $resource_users_arr[$resource_users->user_id] = id_to_text($resource_users->user_id, $users);
        }
  
        $this->set(compact('project_task_detail', 'resource_users_arr','prj_task_id'));
        $this->set('_serialize', ['project_task_detail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$task_id = null)
    {
    	$project_task_detail = $this->ProjectTaskDetails->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$project_task_detail = $this->ProjectTaskDetails->patchEntity($project_task_detail, $this->request->data);
    		$project_task_detail->project_task_id = $task_id;
    		if ($this->ProjectTaskDetails->save($project_task_detail)) {
    			$this->Flash->success(__('The project task detail has been saved.'));
    			return $this->redirect(['controller'=>'project_tasks','action' => 'edit',$task_id]);
    		} else {
    			$this->Flash->error(__('The project task detail could not be saved. Please, try again.'));
    		}
    	}
    	
    
        $this->loadModel('ProjectTasks');
        $project_task = $this->ProjectTasks->get($task_id);
        
        $this->loadModel('ResourceAllocations');
        $project_task_conditions['project_id'] = $project_task->project_id;
        $project_task_conditions['release_user'] = 0;
        
        $resource_list = $this->ResourceAllocations->getUnReleasedUsers($project_task_conditions);

        $this->loadModel('Users');
        $users = $this->Users->getActiveUsers();
        $resource_users_arr = array();
        foreach($resource_list as $resources => $resource_users){
            $resource_users_arr[$resource_users->user_id] = id_to_text($resource_users->user_id, $users);
        }
    	
    	$this->set(compact('project_task_detail','params','resource_users_arr','task_id'));
    	$this->set('_serialize', ['project_task_detail', 'params']);
    }
    
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$task_id = null)
    {
        $project_task_detail = $this->ProjectTaskDetails->get($id);
        $params = $this->request->query;
        if ($this->ProjectTaskDetails->delete($project_task_detail)) {
            $this->Flash->success(__('The project task detail has been deleted.'));
            return $this->redirect(['controller'=>'project_tasks','action' => 'edit',$task_id]);
        } else {
            $this->Flash->error(__('The project task detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
}
