<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class SeatCostsController extends AppController
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
    	$getparams = array();
        if(!empty($this->request->data))
        {
        	$paginateParams = $this->request->data;
        	$this->request->query = $paginateParams;
        }
        else if(isset($this->request->query ))
        {
        	$paginateParams = $this->request->query;
        	$this->request->data = $this->request->query;
        	$this->request->query = $paginateParams;
        }
        if (!empty($paginateParams)) {
        
            $getParams = $paginateParams;
                
        	if (!empty($getParams['department_id'])) {
        		$conditions["department_id"] = $getParams['department_id'];
        	}
        	if (!empty($getParams['year'])) {
        		$conditions["year"] = $getParams['year'];
        	}
        	if (!empty($getParams['cost'])) {
        		$conditions["cost"] = $getParams['cost'];
        	}
        }
        $seatcosts = $this->paginate($this->SeatCosts, ['conditions' => $conditions,'limit' => RECORDS_PER_PAGE]);
		        
       	$this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->set(compact('seatcosts', 'paginateParams','departments'));
        $this->set('_serialize', ['seatcosts', 'paginateParams','departments']);
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
        $seatcost = $this->SeatCosts->get($id);

        $this->set('seatcost', $seatcost);
        $this->set('_serialize', ['seatcost']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $seatcost = $this->SeatCosts->newEntity();
        if ($this->request->is('post')) {
//             pjs($this->request->data);
            $seatcost = $this->SeatCosts->patchEntity($seatcost, $this->request->data);
//             pjs($seatcost); exit;
	            if ($this->SeatCosts->save($seatcost)) {
	            	$this->Flash->success(__('Seat Cost has been saved.'));
	                return $this->redirect(['action' => 'index']);
	            } else {
	                $this->Flash->error(__('Seat Cost could not be saved. Please, try again.'));
	            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->set(compact('seatcost', 'departments'));
        $this->set('_serialize', ['seatcost', 'departments']);
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
    	$seatcost = $this->SeatCosts->get($id);
        $params = $this->request->query;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seatcost = $this->SeatCosts->patchEntity($seatcost, $this->request->data);
            
            if ($this->SeatCosts->save($seatcost)) {
            	$this->Flash->success(__('Seat Cost has been saved.'));
                return $this->redirect(array_merge(['action' => 'index'], $params));
            } else {
                $this->Flash->error(__('Seat Cost could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->set(compact('seatcost', 'departments','params'));
        $this->set('_serialize', ['seatcost', 'departments', 'params']);
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
        $seatcost = $this->SeatCosts->get($id);
        $params = $this->request->query;
        if ($this->SeatCosts->delete($seatcost)) {
            $this->Flash->success(__('Seat Cost has been deleted.'));
        } else {
            $this->Flash->error(__('Seat Cost could not be deleted. Please, try again.'));
        }

        return $this->redirect(array_merge(['action' => 'index'], $params));
    }
    
    public function validate_unique_seatcost()
    {
    	$id = 0;
    	$department = $_REQUEST['department_id'];
    	$year = $_REQUEST['year'];
    	
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->SeatCosts->isSeatCostExists($department,$id,$year);
    	
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
