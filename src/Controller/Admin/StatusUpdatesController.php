<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Clients Controller
 */
class StatusUpdatesController extends AppController
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

    public function update_task_index($id = null)
    {
        $this->loadModel('ProjectTaskDetails');
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
            if (! empty($getParams['department_id'])) {
                $conditions["Projects.department_id"] = $getParams['department_id'];
            }
            if (! empty($getParams['project_id'])) {
                $conditions["project_id"] = $getParams['project_id'];
            }
            if (! empty($getParams['project_task_id'])) {
                $conditions["project_task_id"] = $getParams['project_task_id'];
            }
            if (! empty($getParams['task_status_id'])) {
                $conditions["ProjectTasks.task_status_id"] = $getParams['task_status_id'];
            }
        }
        
        $this->loadModel('ProjectTasks');
        $conditions2 = $this->getConditionsForProjectTasks();
        $conditions = array_merge($conditions, $conditions2);

        $project_task_details = $this->paginate($this->ProjectTaskDetails, 
                [
                    'conditions' => $conditions,
                    'limit' => RECORDS_PER_PAGE,
                    'contain' => [
                        'ProjectTasks' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select(
                                    [
                                        'ProjectTasks.id',
                                        'ProjectTasks.name',
                                        'ProjectTasks.task_status_id'
                                    ]);
                        },
                        'ProjectTasks.Projects' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'Projects.id',
                                'Projects.name'
                            ]);
                        },
                        'ProjectTasks.Projects.Departments' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select(
                                    [
                                        'Departments.id',
                                        'Departments.department_name'
                                    ]);
                        },
                        'Users' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'Users.id'
                            ]);
                        },
                        'Users.Role' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'Role.id',
                                'Role.role_name'
                            ]);
                        }
                    ]
                ]);
        
        $this->loadModel('Departments');
        $departments = $this->getDepartmentsToBeShown();
        
        $this->loadModel('Projects');
        $projects = $this->getProjectsToBeShown();
        
        
        $project_tasks = $this->ProjectTasks->getActiveProjectTasks();
        
        $this->loadModel('TaskStatuses');
        $task_statuses = $this->TaskStatuses->getActiveTaskStatuses();
        
        if ($id) {
            $project_task_detail = $this->ProjectTaskDetails->get($id);
            if ($this->request->is([
                'patch',
                'post',
                'put'
            ])) {
                $project_task_detail = $this->ProjectTaskDetails->patchEntity(
                        $project_task_detail, $this->request->data);
                
                if ($this->ProjectTaskDetails->save($project_task_detail)) {
                    $this->Flash->success(
                            __('Project Task Details has been updated.'));
                    return $this->redirect(
                            [
                                'controller' => 'status_updates',
                                'action' => 'update_task_index'
                            ]);
                } else {
                    $this->Flash->error(
                            __(
                                    'Project Task Details could not be updated. Please, try again.'));
                }
            }
        }
        $this->set(
                compact('project_task_details', 'departments', 'projects', 
                        'project_tasks', 'task_statuses', 'paginateParams'));
        $this->set('_serialize', 
                [
                    'project_task_details',
                    'departments',
                    'projects',
                    'project_tasks',
                    'task_statuses',
                    'paginateParams'
                ]);
    }

    public function update_issue_index($id = null)
    {
        $this->loadModel('Issues');
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
            if (! empty($getParams['department_id'])) {
                $conditions["Projects.department_id"] = $getParams['department_id'];
            }
            if (! empty($getParams['project_id'])) {
                $conditions["project_id"] = $getParams['project_id'];
            }
            if (! empty($getParams['issue_id'])) {
                $conditions["Issues.id"] = $getParams['issue_id'];
            }
            if (! empty($getParams['issue_status_id'])) {
                $conditions["issue_status_id"] = $getParams['issue_status_id'];
            }
        }
        $conditions2 = $this->getRoleConditionsForIssues();

        $conditions = array_merge($conditions, $conditions2);
        
        $issue_details = $this->paginate($this->Issues, 
                [
                    'conditions' => $conditions,
                    'limit' => RECORDS_PER_PAGE,
                    'contain' => [
                        'Projects' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'Projects.id',
                                'Projects.name'
                            ]);
                        },
                        'Projects.Departments' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select(
                                    [
                                        'Departments.id',
                                        'Departments.department_name'
                                    ]);
                        },
                        'AssignedToUser' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'AssignedToUser.id'
                            ]);
                        },
                        'AssignedToUser.Role' => function ($q)
                        {
                            return $q->autoFields(false)
                                ->select([
                                'Role.id',
                                'Role.role_name'
                            ]);
                        }
                    ]
                ]);
        $this->loadModel('Departments');
        $departments = $this->getDepartmentsToBeShown();
        
        $this->loadModel('Projects');
        $projects = $this->getProjectsToBeShown();
        
        $this->loadModel('Issues');
        $issues = $this->Issues->getActiveIssues();
        
        $this->loadModel('IssueStatuses');
        $issue_statuses = $this->IssueStatuses->getActiveIssueStatuses();
        
        $this->loadModel('Users');
        $users = $this->Users->getActiveUsers();
        
        if ($id) {
            $issue = $this->Issues->get($id);
            if ($this->request->is([
                'patch',
                'post',
                'put'
            ])) {
                $issue = $this->Issues->patchEntity(
                        $issue, $this->request->data);
                
                if ($this->Issues->save($issue)) {
                    $this->Flash->success(
                            __('Project Issue Details has been updated.'));
                    return $this->redirect(
                            [
                                'controller' => 'status_updates',
                                'action' => 'update_issue_index'
                            ]);
                } else {
                    $this->Flash->error(
                            __(
                                    'Project Issue Details could not be updated. Please, try again.'));
                }
            }
        }
        $this->set(
                compact('issue_details', 'departments', 'projects', 
                        'issues', 'issue_statuses', 'paginateParams','users'));
        $this->set('_serialize', 
                [
                    'issue_details',
                    'departments',
                    'projects',
                    'issues',
                    'issue_statuses',
                    'paginateParams',
                    'users'
                ]);
        
    }
    
    public function getRoleConditionsForIssues()
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
                $conditions['assign_to'] = $this->Auth->user('id');
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
    
    public function getConditionsForProjectTasks()
    {
        $sess = $this->request->session();
        $conditions = array();
    
        $this->loadModel('Roles');
        $roles = $this->Roles->getActiveRoles();
    
        $role_id = $sess->read('Auth.Admin.role_id');
        $role_name = id_to_text($role_id, $roles);
    
        switch($role_name) {
            case 'Developer':
                $conditions['user_id'] = $this->Auth->user('id');
                return $conditions;
                break;
    
            default:
                $projects = $this->getProjectsToBeShown();
                
                $this->loadModel('Users');
                $users = $this->Users->getUsersFromProject($projects);
                $users1 = array_values($users);
                $conditions['user_id IN'] = $users1;
                return $conditions;
                break;
        }
    }
    
    public function changeStatus()
    {
    	$success = false;
    	$req_data = $this->request->data();
    	$sess = $this->request->session()->read('Auth.Admin');
    	
    	switch($req_data['name']) {
    		case 'task_status_id': 
    			$this->loadModel('ProjectTasks');
    			$success = $this->ProjectTasks->updateStatus($req_data, $sess['id']);
    			break;
    		
    		case 'issue_status_id':
    			$this->loadModel('Issues');
    			$success = $this->Issues->updateStatus($req_data, $sess['id']);
    	}
    }
}