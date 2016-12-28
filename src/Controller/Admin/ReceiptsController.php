<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ReceiptsController extends AppController
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
        
        $receipts = $this->paginate($this->Receipts, [
        		'limit' => RECORDS_PER_PAGE]);
                
        $receipt_list = $this->Receipts->getActiveReceipts();
        
        $this->loadModel('Milestones');
        $milestones = $this->Milestones->getActiveMilestones();
        
        $this->set(compact('receipts', 'paginateParams','receipt_list','milestones'));
        $this->set('_serialize', ['receipts', 'paginateParams','receipt_list','milestones']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = NULL)
    {
        $milestone_id = $id;
        $receipt = $this->Receipts->newEntity();
        if ($this->request->is('post')) {
            $receipt = $this->Receipts->patchEntity($receipt, $this->request->data);
            $receipt->milestone_id = $milestone_id;
            if ($this->Receipts->save($receipt)) {
                $this->Flash->success(__('The receipt has been saved.'));
                return $this->redirect(['controller'=>'milestones','action' => 'invoice_edit',$milestone_id]);
            } else {
                $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Milestones');
        $milestone = $this->Milestones->get($id);
  
        $this->set(compact('receipt','milestone_id'));
        $this->set('_serialize', ['receipt','milestone_id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$milestone_id = null)
    {
    	$receipt = $this->Receipts->get($id);
    	$params = $this->request->query;
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$receipt = $this->Receipts->patchEntity($receipt, $this->request->data);
    		$receipt->milestone_id = $milestone_id;
    		if ($this->Receipts->save($receipt)) {
    			$this->Flash->success(__('The receipt has been saved.'));
    			return $this->redirect(['controller'=>'milestones','action' => 'invoice_edit',$milestone_id]);
    		} else {
    			$this->Flash->error(__('The receipt could not be saved. Please, try again.'));
    		}
    	}
    	
    
        $this->loadModel('Milestones');
        $milestone = $this->Milestones->get($milestone_id);
    	
    	$this->set(compact('receipt','params','milestone_id'));
    	$this->set('_serialize', ['receipt', 'params','milestone_id']);
    }
    
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//     public function delete($id = null,$task_id = null)
//     {
//         $project_task_resource = $this->ProjectTaskResources->get($id);
//         $params = $this->request->query;
//         if ($this->ProjectTaskResources->delete($project_task_resource)) {
//             $this->Flash->success(__('The project task resource has been deleted.'));
//             return $this->redirect(['controller'=>'project_tasks','action' => 'edit',$task_id]);
//         } else {
//             $this->Flash->error(__('The project task resource could not be deleted. Please, try again.'));
//         }

//         return $this->redirect(array_merge(['action' => 'index'], $params));
//     }
}
