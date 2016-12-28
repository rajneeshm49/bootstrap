<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class MilestonesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('admin');
    }

    public function index()
    {
        $conditions = array();
        if (! empty($this->request->data)) {
            $paginateParams = $this->request->data;
            $this->request->query = $paginateParams;
        } else if (isset($this->request->query)) {
            $paginateParams = $this->request->query;
            $this->request->data = $this->request->query;
        }
        if (! empty($paginateParams)) {
            
            $getParams = $paginateParams;
            if (! empty($getParams['project_id'])) {
                $conditions["project_id"] = $getParams['project_id'];
            }
            if (! empty($getParams['name'])) {
                $conditions["Milestones.id"] = $getParams['name'];
            }
            if (! empty($getParams['client_id'])) {
                $conditions["Clients.id"] = $getParams['client_id'];
            }
            if (! empty($getParams['milestone_status_id'])) {
                $conditions["milestone_status_id"] = $getParams['milestone_status_id'];
            }
        }
        
        $conditions2 = $this->getRoleConditionsForMilestones();
        $conditions = array_merge($conditions, $conditions2);
        
        $milestones = $this->paginate($this->Milestones, 
                [
                    'sortWhitelist' => [
                        'project_id',
                        'Clients.id',
                        'name',
                        'start_date',
                        'end_date',
                        'amount',
                        'invoice_no',
                        'amount_recd',
                        'milestone_status_id'
                    ],
                    'conditions' => $conditions,
                    'contain' => [
                        'Projects.Clients',
                        'Projects.Currencies' => function ($q)
                        {
                            return $q->autoFields(false)
                            ->select(
                                    [
                                        'Currencies.id',
                                        'Currencies.name'
                                    ]);
                        },
                    ],
                    'limit' => RECORDS_PER_PAGE,
                    'order' => [
                        'name' => 'ASC'
                    ]
                ]);
//         pr($milestones);exit;
        $milestones_list = $this->Milestones->getActiveMilestones();
        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->loadModel('Clients');
        $clients = $this->Clients->getClients();
        
        $this->loadModel('MilestoneStatuses');
        $milestone_statuses = $this->MilestoneStatuses->getActiveMilestoneStatuses();
        
        $this->set(
                compact('milestones', 'paginateParams', 'milestones_list', 
                        'projects', 'clients', 'milestone_statuses'));
        $this->set('_serialize', 
                [
                    'milestones',
                    'paginateParams',
                    'milestones_list',
                    'projects',
                    'clients',
                    'milestone_statuses'
                ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders
     *         view otherwise.
     */
    public function add()
    {
        $milestone = $this->Milestones->newEntity();
        
        if ($this->request->is('post')) {
            $milestone = $this->Milestones->patchEntity($milestone, 
                    $this->request->data);
            
            if ($this->Milestones->save($milestone)) {
                $this->Flash->success(__('The milestone has been saved.'));
                return $this->redirect(
                        [
                            'action' => 'index'
                        ]);
            } else {
                // pr($user->errors());exit;
                $this->Flash->error(
                        __(
                                'The milestone could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('MilestoneStatuses');
        $milestone_statuses = $this->MilestoneStatuses->getActiveMilestoneStatuses();
        
        $this->set(
                compact('milestone', 'milestone_statuses', 'projects', 
                        'departments'));
        $this->set('_serialize', 
                [
                    'milestone',
                    'milestone_statuses',
                    'projects',
                    'departments'
                ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders
     *         view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $milestone = $this->Milestones->get($id);
        $params = $this->request->query;
        if ($this->request->is(
                [
                    'patch',
                    'post',
                    'put'
                ])) {
            $milestone = $this->Milestones->patchEntity($milestone, 
                    $this->request->data);
            if ($this->Milestones->save($milestone)) {
                $this->Flash->success(__('The milestone has been saved.'));
                return $this->redirect(
                        array_merge(
                                [
                                    'action' => 'index'
                                ], $params));
            } else {
                $this->Flash->error(
                        __(
                                'The milestone could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Projects');
        $clients = $this->Projects->getProjectClientDetail(
                $milestone->project_id);
        
        $this->loadModel('MilestoneStatuses');
        $milestone_statuses = $this->MilestoneStatuses->getActiveMilestoneStatuses();
        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->set(
                compact('milestone', 'params', 'milestone_statuses', 'projects', 
                        'clients', 'departments'));
        $this->set('_serialize', 
                [
                    'milestone',
                    'params',
                    'milestone_statuses',
                    'projects',
                    'clients',
                    'departments'
                ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record
     *         not found.
     */
    public function delete($id = null)
    {
        $milestone = $this->Milestones->get($id);
        $params = $this->request->query;
        if ($this->Milestones->delete($milestone)) {
            $this->Flash->success(__('The milestone has been deleted.'));
        } else {
            $this->Flash->error(
                    __('The milestone could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(
                array_merge(
                        [
                            'action' => 'index'
                        ], $params));
    }

    public function validate_unique_milestone()
    {
        $id = 0;
        $milestone = $_REQUEST['name'];
        if (! empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        $isAvailable = $this->Milestones->isNameExists($milestone, $id);
        
        echo json_encode(array(
            'valid' => $isAvailable
        ));
        exit();
    }

    public function reqInvoice($milestone_name, $milestone_id)
    {
        $session = $this->request->session()->read('Auth.Admin');
        $milestone = $this->Milestones->get($milestone_id);
        $data['email'] = GM_EMAIL;
        $data['full_name'] = GM_NAME;
        $data['milestone_name'] = $milestone_name;
        $data['admin_name'] = $session['first_name'] . ' ' .
                 $session['last_name'];
        
        if (sendTemplatedMail('REQUEST_INVOICE', $data, 'Request for Invoice')) {
            $milestone->invoice_requested = 1;
            $this->Milestones->save($milestone);
            
            $this->Flash->success(
                    __('Request mail for invoice successfully sent.'));
        } else {
            $this->Flash->error(
                    __(
                            'Could not send request mail for invoice. Please try again.'));
        }
        return $this->redirect([
            'action' => 'index'
        ]);
    }

    public function getMilestonesForProjects()
    {
        $req_data = $this->request->data;
        
        $projects = $this->Milestones->getMilestonesForProjectsM(
                $req_data['project_id']);
        $projects_html = '';
        if (count($projects) > 0) {
            $projects_html .= '<option value=\'\'>(Choose one)</option>';
        }
        foreach ($projects as $k => $v) {
            $projects_html .= '<option value="' . $k . '">' . $v . '</option>';
        }
        echo json_encode($projects_html);
        exit();
    }

    public function invoice_index()
    {
        $invoice_status = invoice_status();
        $conditions = array();
        if (! empty($this->request->data)) {
            $paginateParams = $this->request->data;
            $this->request->query = $paginateParams;
        } else if (isset($this->request->query)) {
            $paginateParams = $this->request->query;
            $this->request->data = $this->request->query;
        }
        $getParams = $paginateParams;
        
        if (! empty($getParams['project_id'])) {
            $conditions["project_id"] = $getParams['project_id'];
        }
        if (! empty($getParams['department_id'])) {
            $conditions["department_id"] = $getParams['department_id'];
        }
        if (! empty($getParams['id'])) {
            $conditions["id"] = $getParams['id'];
        }
        if (! empty($getParams['invoice_status'])) {
            $conditions["invoice_status"] = $getParams['invoice_status'];
        } else {
            $conditions["invoice_status"] = text_to_id('Pending', 
                    invoice_status());
        }
        $this->paginate['conditions'] = $conditions;
        $invoice_lists = $this->paginate($this->Milestones, 
                [
                    'conditions' => [
                        $conditions,
                        'invoice_requested' => 1
                    ],
                    'limit' => RECORDS_PER_PAGE
                ]);
        
        $milestones = $this->Milestones->getActiveMilestones();
        
        $this->loadModel('Departments');
        $departments = $this->Departments->getActiveDepartments();
        
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjects();
        
        $this->set(
                compact('invoice_lists', 'paginateParams', 'departments', 
                        'projects', 'milestones', 'invoice_status'));
        $this->set('_serialize', 
                [
                    'invoice_lists',
                    'paginateParams',
                    'departments',
                    'projects',
                    'milestones',
                    'invoice_status'
                ]);
    }

    public function invoice_edit($id = null)
    {
        $invoice = $this->Milestones->get($id, 
                [
                    'contain' => [
                        'Receipts'
                    ]
                ]);
        if ($this->request->is(
                [
                    'patch',
                    'post',
                    'put'
                ])) {
            $invoice = $this->Milestones->patchEntity($invoice, 
                    $this->request->data);
            if ($invoice->invoice_amount != 0.00) {
                $invoice->invoice_status = text_to_id('Entered', 
                        invoice_status());
            } else {
                $invoice->invoice_status = text_to_id('Pending', 
                        invoice_status());
            }
            if ($this->Milestones->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
                return $this->redirect(
                        [
                            'action' => 'invoice_index'
                        ]);
            } else {
                $this->Flash->error(
                        __('The invoice could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('invoice'));
        $this->set('_serialize', [
            'invoice'
        ]);
    }
    
    public function getRoleConditionsForMilestones()
    {
        $sess = $this->request->session();
        $conditions = array();
    
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
    
        $role_id = $sess->read('Auth.Admin.role_id');
        $role_name = id_to_text($role_id, $roles);
    
        switch($role_name) {
            case 'Developer':
            case 'Project Lead':
                $projects = $this->getProjectsToBeShown();
                $projects = (count($projects)>0)?array_keys($projects):array();
                $conditions['project_id IN'] = $projects;
                return $conditions;
                break;
    
            default:
                $projects = $this->getProjectsToBeShown();
                $projects = (count($projects)>0)?array_keys($projects):array();
                $conditions['project_id IN'] = $projects;
                return $conditions;
                break;
        }
    }
}
