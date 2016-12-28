<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Currencies Controller
 *
 * @property \App\Model\Table\CurrenciesTable
 */
class CurrenciesController extends AppController
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
    	
    		if (!empty($getParams['name'])) {
    			$conditions["name LIKE "] = "%".$getParams['name']."%";
    		}
    	}
    	$this->paginate ['conditions'] = $conditions;
    	$currencies = $this->paginate($this->Currencies, ['limit' => RECORDS_PER_PAGE, 'order' => ['id' => 'DESC']]);

        $this->set(compact('currencies', 'paginateParams'));
        $this->set('_serialize', ['currencies', 'paginateParams']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function validate($input)
    {
    	return in_array(mb_strtoupper($input), $this->currencyCodes, true);
    }
    
    
    public function add()
    {
        $currency = $this->Currencies->newEntity();
        
        if ($this->request->is('post')) {
        	$currency = $this->Currencies->patchEntity($currency, $this->request->data);
            $currency->created_by = $this->Auth->user('id');
            $currency->modified_by = $this->Auth->user('id');
            $currency->name = strtoupper($currency->name);
            if(!in_array($currency->name, currencyCodes())) {
            	$this->Flash->error(__('Invalid Currency'));
            	goto a;
            }
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The currency could not be saved. Please, try again.'));
            }
        }
        a:
        $this->set(compact('currency'));
        $this->set('_serialize', ['currency']);
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
        $currency = $this->Currencies->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $currency = $this->Currencies->patchEntity($currency, $this->request->data);
            $currency->modified_by = $this->Auth->user('id');
            $currency->name = strtoupper($currency->name);
            if(!in_array($currency->name, currencyCodes())) {
            	$this->Flash->error(__('Invalid Currency'));
            	goto a;
            }
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));
				return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The currency could not be saved. Please, try again.'));
            }
        }
        a:
        $this->set(compact('currency'));
        $this->set('_serialize', ['currency']);
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
        $currency = $this->Currencies->get($id);
        if ($this->Currencies->delete($currency)) {
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
    	$id = 0;
    	$currency = $_REQUEST['name'];
    	if(!empty($_REQUEST['id'])) {
    		$id = $_REQUEST['id'];
    	}
    	
    	$isAvailable = $this->Currencies->isCurrencyExists($currency, $id);
    
    	echo json_encode(array(
    			'valid' => $isAvailable,
    	));exit;
    
    }
}
