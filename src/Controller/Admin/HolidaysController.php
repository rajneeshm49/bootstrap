<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Holidays Controller
 * 
 *
 * @property \App\Model\Table\HolidaysTable
 */
class HolidaysController extends AppController
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
    	
    		if (!empty($paginateParams['currency_id'])) {
    			$conditions["currency_id"] = $paginateParams['currency_id'];
    		}
    		if (!empty($paginateParams['year'])) {
    		    $year = $paginateParams['year'];
    			$conditions["holiday_date >="] = $year . "-01-" . "-01";
    			$conditions["holiday_date <="] = $year . "-12-" . "-31";
    		}
    	}
    	$this->paginate ['conditions'] = $conditions;

    	$holidays = $this->paginate($this->Holidays, [
    			'limit' => RECORDS_PER_PAGE,
    			'order' => ['id' => 'DESC']
    		]);
		
    	$this->set(compact('holidays', 'paginateParams'));
        $this->set('_serialize', ['holidays', 'paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    
    public function add()
    {
        $holiday = $this->Holidays->newEntity();
        
        if ($this->request->is('post')) {
        	$holiday = $this->Holidays->patchEntity($holiday, $this->request->data);
            $holiday->created_by = $this->Auth->user('id');
            $holiday->modified_by = $this->Auth->user('id');
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('holiday'));
        $this->set('_serialize', ['holiday']);
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
        $holiday = $this->Holidays->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->data);
//             pjs($holiday); exit;
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));
				return $this->redirect(['action' => 'index']);
            } else {
            	$this->Flash->error(__('The holiday could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('holiday'));
        $this->set('_serialize', ['conversion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function dashboard()
    {
 		$currency_count = $this->Currencies->getDepartmentCount();
        $this->set(compact('currency_count'));
    }
}