<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Users
 */
class TimesheetsController extends AppController {
	
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter ( $event );
		$this->viewBuilder ()->layout ( 'admin' );
	}
	
	public function timesheet_entry() 
	{
	    
		$selectedDate = (!empty($this->request->query('date')))?$this->request->query('date'):date("Y-m-d");
		
		$this->request->query('date');
			    
	    $this->loadModel('Projects');
				
		$min=array("00","25","50","75");
		
		for($i=0; $i<=16; $i++) {
		    foreach ($min as $v){
		    	$i = sprintf("%02d", $i);
		      $hours["$i.$v"] = "$i.$v";
		      if("$i.$v" == "16.00") {
		          break;
		      }
		    }
		}
				
		array_shift($hours);
		$date = date('Y-m-d');
		$projects = $this->getProjectsToBeShown($date);
		
		$timesheets = $this->getTasksForDay();
// 		pjs($timesheets); exit;
		$this->loadModel('Holidays');
		$holidays = $this->Holidays->getHolidaysForYear();
		
		$user = $this->request->session()->read('Auth.Admin');
		
		$days_color = $this->TimeLogs->getFilledDays($user['id']);

		$events = array();
		foreach($holidays as $h){
			$events[$h] = "holiday";
		}
// 		pjs($days_color);
		foreach($days_color as $day){
			$value = '';
			if(array_key_exists($day['date'], $events)) {
				
				$value = $events[$day['date']] . ' ';
			}
			if($day['hours'] == 0) {
				$events[$day['date']] = $value . "timesheet_not_filled";
			} elseif($day['hours'] < TIMESHEET_HOURS_FOR_A_DAY) {
				$events[$day['date']] = $value . "timesheet_lsr_than";
			} else {
				$events[$day['date']] = $value . "timesheet";
			}
		}
		if(array_key_exists($selectedDate, $events)) {
			$events[$day['date']] = $events[$day['date']] . " active";
		}
		$event_str = '';
		$i = 0;
		foreach($events as $key => $event) {
			$str = '';
			if($i > 0) {
				$str = ', ';
			}
			$event_str .= $str . '"'. $key . '":{"class":"' . $event . '"}';
			$i++;
		}
// 		echo $selectedDate;exit;
		
		$this->set(compact('projects','hours', 'selectedDate', 'timesheets', 'timesheet', 'event_str'));
		$this->set('_serialize', ['projects','hours', 'selectedDate', 'timesheets', 'timesheet', 'event_str']);
	}
	
	public function getTasksForProjects()
	{
	    $req_data = $this->request->data;
	    
	    $this->loadModel('ProjectTasks');
	    $date= false;
	    if($req_data['date']) {
	    	$date = $req_data['date'];
	    }
	    $tasks = $this->ProjectTasks->getTasksForProjectsM($req_data['project_id'], $date);
	    
	    echo json_encode($tasks); exit;
	}
	
	public function getIssuesForProjects()
	{
	    $req_data = $this->request->data;
	     
	    $this->loadModel('Issues');
	    $issues = $this->Issues->getIssuesForProjectsM($req_data['project_id']);
	    $issues_html = '<option value=\'\'>No Issue allocated to this project</option>';
	    if(count($issues) > 0) {
	        $issues_html = '<option value=\'\'>(Choose Issue)</option>';
	    }
	    foreach($issues as $k => $v) {
	        $issues_html .= '<option value="' . $k . '">' . $v . '</option>';
	    }
	    echo json_encode($issues_html); exit;
	}
	
	public function getTasksForDay()
	{
		$dt = date('Y-m-d');
		if($this->request->is('post')) {
			$dt = $this->request->data('date');
		}
		$post_data = $this->request->data();
		$this->loadModel('TimeLogs');
		$sess = $this->request->session()->read('Auth.Admin');
		
		$timesheet_logs = $this->TimeLogs->getTasksForDate($dt, $sess['id']);
		
		if($this->request->is('post')) {
			echo json_encode($timesheet_logs);exit;
		}
		return $timesheet_logs;
	}
	
	public function getTaskDetail($id)
	{
		$this->loadModel('TimeLogs');
		
		$timesheets = $this->TimeLogs->find()
			->where([
    			'TimeLogs.id' => $id
    		])
	    	->contain(['Projects' => function ($q) {
			                			return $q->autoFields(false)->select(['id', 'name']);
			            			},
            			'ProjectTasks' => function ($q) {
            				return $q->autoFields(false)->select(['id', 'name']);
            			}
			            			
	    	])->first()->toArray();
    	return $timesheets;
		
	}
	
	public function saveTimesheet()
	{
		$req_data = $this->request->data;
		$rtn_data = array('success' => 0, 'message' => 'Could not insert. Please try again.');
		$this->loadModel('TimeLogs');
		$sess = $this->request->session()->read('Auth.Admin');
		
		if(strtotime($req_data['log_date']) < strtotime('-'.TIMESHEET_DAYS_AVAILABLE.' days')) {
			$rtn_data['message'] = 'Timesheet for this day blocked';
			goto a;
		}
		
		if(strtotime($req_data['log_date'])>strtotime(date('Y-m-d'))) {
			$rtn_data['message'] = 'You cannot fill timesheet for future days';
			goto a;
		}
		$query = $this->TimeLogs->find();
		$rslt = $query->select([
				'sum_hrs' => $query->func()->sum('hours')
			])
			->where([
					'log_date' => $req_data['log_date'],
					'user_id' => $sess['id']
			])->first()->toArray();
		
		if(($rslt['sum_hrs'] + $req_data['hours']) > 16) {
			$rtn_data['message'] = 'The Timesheet for this day has reached its maximum limit.';
			goto a;
		}
		
		$conditions['issue'] = $req_data['issue'];
		$conditions['log_date'] = $req_data['log_date'];
		$conditions['user_id'] = $sess['id'];
		
		if($req_data['issue']) {
			$conditions['project_issue_id'] = $req_data['project_issue_id'];
			$msg = 'This Issue already filled for the day.';
		} else {
			$conditions['project_id'] = $req_data['project_id'];
			$conditions['project_task_id'] = $req_data['project_task_id'];
			$msg = 'This Task already filled for the day.';
		}
		
		$rslt1 = $query->select([
				'count_record' => $query->func()->count('hours')
			])
			->where([$conditions])->first()->toArray();
		
		if($rslt1['count_record'] > 0) {
			$rtn_data['message'] = $msg;
			goto a;
		}
		
		$timesheet = $this->TimeLogs->newEntity();
		$timesheet = $this->TimeLogs->patchEntity($timesheet, $req_data);
		
		$timesheet->user_id = $sess['id'];
		
		if ($this->TimeLogs->save($timesheet)) {
			$rtn_data['success'] = 1;
			$rtn_data['message'] = 'Timesheet successfully filled';
			$task = $this->getTaskDetail($timesheet->id);
			$rtn_data['task'] = $task;
		}
		a:
		echo json_encode($rtn_data); exit;
	}
	
	public function delete()
	{
		$success = 0;
		$req_data = $this->request->data;
		$this->loadModel('TimeLogs');
		$timesheet = $this->TimeLogs->get($req_data['id']);
		$rslt = $this->TimeLogs->delete($timesheet);
		if($rslt) {
			$success = 1;
		}
		echo $success;exit;
	}
}
