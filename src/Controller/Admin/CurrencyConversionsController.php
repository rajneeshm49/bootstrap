<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * CurrencyConversions Controller
 * 
 *
 * @property \App\Model\Table\CurrencyConversionsTable
 */
class CurrencyConversionsController extends AppController
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
    		
    		if (!empty($paginateParams['date_from'])) {
    			$conditions["update_date >="] = $paginateParams['date_from'];
    		}
    		
    		if (!empty($paginateParams['date_to'])) {
    			$conditions["update_date <="] = $paginateParams['date_to'];
    		}
    	}
    	$this->paginate ['conditions'] = $conditions;

    	$currency_conversions = $this->paginate($this->CurrencyConversions, [
    			'limit' => RECORDS_PER_PAGE,
    			'contain' => ['Currencies'],
    			'order' => ['modified' => 'DESC']
    		]);
		
    	$this->loadModel('Currencies');
    	$all_currencies = $this->Currencies->getAllCurrencies();
        $this->set(compact('currency_conversions', 'paginateParams', 'all_currencies'));
        $this->set('_serialize', ['currency_conversions', 'paginateParams', 'all_currencies']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    
    public function add()
    {
        $conversion = $this->CurrencyConversions->newEntity();
        
        if ($this->request->is('post')) {
        	$conversion = $this->CurrencyConversions->patchEntity($conversion, $this->request->data);
            $conversion->created_by = $this->Auth->user('id');
            $conversion->modified_by = $this->Auth->user('id');
            if ($this->CurrencyConversions->save($conversion)) {
                $this->Flash->success(__('The currency conversion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
//             	pr($conversion->errors());exit;
                $this->Flash->error(__('The currency conversion could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Currencies');
        $all_currencies = $this->Currencies->getAllCurrencies();
        $this->set(compact('conversion', 'all_currencies'));
        $this->set('_serialize', ['conversion', 'all_currencies']);
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
        $conversion = $this->CurrencyConversions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conversion = $this->CurrencyConversions->patchEntity($conversion, $this->request->data);
            if ($this->CurrencyConversions->save($conversion)) {
                $this->Flash->success(__('The currency conversion has been saved.'));
				return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The currency conversion could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Currencies');
        $all_currencies = $this->Currencies->getAllCurrencies();
        $this->set(compact('conversion', 'all_currencies'));
        $this->set('_serialize', ['conversion', 'all_currencies']);
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
        $conversion = $this->Currencies->get($id);
        if ($this->Currencies->delete($conversion)) {
            $this->Flash->success(__('The currency has been deleted.'));
        } else {
            $this->Flash->error(__('The currency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboard()
    {
 		$currency_count = $this->Currencies->getDepartmentCount();
        $this->set(compact('currency_count'));
    }
    
    public function validate_unique_currency()
    {
    	$currency = $_REQUEST['name'];
    	$isAvailable = $this->Currencies->isCurrencyExists($currency);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    }
    
    public function get_inr_value()
    {
    	$value_in_inr = currencyConverter($_POST['currency']);
    	echo json_encode($value_in_inr); exit;
    }
}