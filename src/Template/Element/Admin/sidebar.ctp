<?php
use App\Controller\Admin\RolesController;
$roles = new RolesController();
$rights = $roles->getRoleRights();

////////////////////For Dashboard/////////////////////////////////////////////////////////
$modules['Dashboard']['icon'] = 'fa fa-dashboard';
$modules['Dashboard']['url'] = '/admin';

//////////////////////For Masters menu/////////////////////////////////////////////////////////
$modules['Masters']['icon'] = 'fa fa-object-group';

$modules['Masters']['children']['Access']['icon'] = 'fa fa-circle-o';

if(array_key_exists('Roles', $rights)) {
	$modules['Masters']['children']['Access']['children']['Roles']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Access']['children']['Roles']['url'] = '/admin/roles/index';
}

if(array_key_exists('RoleRights', $rights)) {
	$modules['Masters']['children']['Access']['children']['RoleRights']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Access']['children']['RoleRights']['url'] = '/admin/RoleRights/index';
}


$modules['Masters']['children']['Additionals']['icon'] = 'fa fa-circle-o';

if(array_key_exists('EmailTemplates', $rights)) {
	$modules['Masters']['children']['Additionals']['children']['Email Templates']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Additionals']['children']['Email Templates']['url'] = '/admin/email_templates/index';
}

if(array_key_exists('Designations', $rights)) {
	$modules['Masters']['children']['Additionals']['children']['Designations']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Additionals']['children']['Designations']['url'] = '/admin/designations/index';
}

if(array_key_exists('Technologies', $rights)) {
	$modules['Masters']['children']['Additionals']['children']['Technologies']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Additionals']['children']['Technologies']['url'] = '/admin/technologies/index';
}
if(array_key_exists('Tasks', $rights)) {
	$modules['Masters']['children']['Additionals']['children']['Org. Tasks']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Additionals']['children']['Org. Tasks']['url'] = '/admin/tasks/index';
}

if(array_key_exists('Currencies', $rights)) {
	$modules['Masters']['children']['Additionals']['children']['Currencies']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Additionals']['children']['Currencies']['url'] = '/admin/currencies/index';
}


$modules['Masters']['children']['Types']['icon'] = 'fa fa-circle-o';

if(array_key_exists('IssueTypes', $rights)) {
	$modules['Masters']['children']['Types']['children']['Issue Types']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Types']['children']['Issue Types']['url'] = '/admin/issue_types/index';
}

if(array_key_exists('ProjectTypes', $rights)) {
	$modules['Masters']['children']['Types']['children']['Project Types']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Types']['children']['Project Types']['url'] = '/admin/project_types/index';
}


$modules['Masters']['children']['Statuses']['icon'] = 'fa fa-circle-o';

if(array_key_exists('ProjectStatuses', $rights)) {
	$modules['Masters']['children']['Statuses']['children']['Project Statuses']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Statuses']['children']['Project Statuses']['url'] = '/admin/project_statuses/index';
}

if(array_key_exists('MilestoneStatuses', $rights)) {
	$modules['Masters']['children']['Statuses']['children']['Milestone Statuses']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Statuses']['children']['Milestone Statuses']['url'] = '/admin/milestone_statuses/index';
}

if(array_key_exists('TaskStatuses', $rights)) {
	$modules['Masters']['children']['Statuses']['children']['Task Statuses']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Statuses']['children']['Task Statuses']['url'] = '/admin/task_statuses/index';
}

if(array_key_exists('IssueStatuses', $rights)) {
	$modules['Masters']['children']['Statuses']['children']['Issue Statuses']['icon'] = 'fa fa-circle-o';
	$modules['Masters']['children']['Statuses']['children']['Issue Statuses']['url'] = '/admin/issue_statuses/index';
}

//////////////////////For Op Masters menu/////////////////////////////////////////////////////////
$modules['Op Masters']['icon'] = 'fa fa-tasks';

if(array_key_exists('Users', $rights)) {
	$modules['Op Masters']['children']['Users']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Users']['url'] = '/admin/users/index';
}

if(array_key_exists('Departments', $rights)) {
	$modules['Op Masters']['children']['Departments']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Departments']['url'] = '/admin/departments/index';
}

if(array_key_exists('ResourceDepartments', $rights)) {
	$modules['Op Masters']['children']['Resource Departments']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Resource Departments']['url'] = '/admin/resource_departments/index';
}

if(array_key_exists('Salaries', $rights)) {
	$modules['Op Masters']['children']['Salary Level']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Salary Level']['url'] = '/admin/salaries/index';
}

if(array_key_exists('SeatCosts', $rights)) {
	$modules['Op Masters']['children']['Seat Costs']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Seat Costs']['url'] = '/admin/seat_costs/index';
}

if(array_key_exists('CurrencyConversions', $rights)) {
	$modules['Op Masters']['children']['Currency Conversions']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Currency Conversions']['url'] = '/admin/currency_conversions/index';
}

if(array_key_exists('Clients', $rights)) {
	$modules['Op Masters']['children']['Clients']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Clients']['url'] = '/admin/clients/index';
}

if(array_key_exists('Holidays', $rights)) {
	$modules['Op Masters']['children']['Holidays']['icon'] = 'fa fa-circle-o';
	$modules['Op Masters']['children']['Holidays']['url'] = '/admin/holidays/index';
}

/////////////////////////For Projects menu/////////////////////////////////////////////////////////
$modules['Projects']['icon'] = 'fa fa-file';

if(array_key_exists('Projects', $rights)) {
	$modules['Projects']['children']['Projects']['icon'] = 'fa fa-circle-o';
	$modules['Projects']['children']['Projects']['url'] = '/admin/projects/index';
}

if(array_key_exists('ResourceAllocations', $rights)) {
	$modules['Projects']['children']['Allocate Resources']['icon'] = 'fa fa-circle-o';
// 	$modules['Projects']['children']['Allocate Resources']['url'] = '/admin/allocate_resources/index';
	$modules['Projects']['children']['Allocate Resources']['url'] = '/admin/resource_allocations/index';
}

if(array_key_exists('DepartmentTasks', $rights)) {
    $modules['Projects']['children']['Department Tasks']['icon'] = 'fa fa-circle-o';
    $modules['Projects']['children']['Department Tasks']['url'] = '/admin/department_tasks/index';
}

if(array_key_exists('Milestones', $rights)) {
	$modules['Projects']['children']['Milestones']['icon'] = 'fa fa-circle-o';
	$modules['Projects']['children']['Milestones']['url'] = '/admin/milestones/index';
}

if(array_key_exists('ProjectsCoversheet', $rights)) {
	$modules['Projects']['children']['Projects Coversheet']['icon'] = 'fa fa-circle-o';
	$modules['Projects']['children']['Projects Coversheet']['url'] = '/admin/projects/toBeApproved';
}

if(array_key_exists('ProjectPhases', $rights)) {
	$modules['Projects']['children']['Phases']['icon'] = 'fa fa-circle-o';
// 	$modules['Projects']['children']['Phases']['url'] = '/admin/phases/index';
	$modules['Projects']['children']['Phases']['url'] = '/admin/project_phases/index';
}

if(array_key_exists('ProjectModules', $rights)) {
	$modules['Projects']['children']['Modules']['icon'] = 'fa fa-circle-o';
// 	$modules['Projects']['children']['Modules']['url'] = '/admin/modules/index';
	$modules['Projects']['children']['Modules']['url'] = '/admin/project_modules/index';
}

if(array_key_exists('ProjectTasks', $rights)) {
	$modules['Projects']['children']['Project Tasks']['icon'] = 'fa fa-circle-o';
// 	$modules['Projects']['children']['Assign Tasks']['url'] = '/admin/assign_tasks/index';
	$modules['Projects']['children']['Project Tasks']['url'] = '/admin/project_tasks/index';
}

if(array_key_exists('Issues', $rights)) {
	$modules['Projects']['children']['Issues']['icon'] = 'fa fa-circle-o';
	$modules['Projects']['children']['Issues']['url'] = '/admin/issues/index';
}

if(array_key_exists('ProjectClosures', $rights)) {
	$modules['Projects']['children']['Project Closures']['icon'] = 'fa fa-circle-o';
// 	$modules['Projects']['children']['Project Closures']['url'] = '/admin/project_closures/index';
	$modules['Projects']['children']['Project Closures']['url'] = 'javascript: void(0);';
}

/////////////////////////For Status Update menu/////////////////////////////////////////////////////////
$modules['Status Updates']['icon'] = 'fa fa-list';

if(array_key_exists('StatusUpdates', $rights)) {
	$modules['Status Updates']['children']['Task Update']['icon'] = 'fa fa-circle-o';
	$modules['Status Updates']['children']['Task Update']['url'] = '/admin/status_updates/update_task_index';
}

if(array_key_exists('StatusUpdates', $rights)) {
    $modules['Status Updates']['children']['Issue Update']['icon'] = 'fa fa-circle-o';
    $modules['Status Updates']['children']['Issue Update']['url'] = '/admin/status_updates/update_issue_index';
}

/////////////////////////For Timesheets menu/////////////////////////////////////////////////////////
$modules['Timesheets']['icon'] = 'fa fa-calendar-times-o';

if(array_key_exists('Timesheets', $rights)) {
	$modules['Timesheets']['children']['Entries']['icon'] = 'fa fa-circle-o';
// 	$modules['Timesheets']['children']['Entries']['url'] = '/admin/timesheet_entries/index';
	$modules['Timesheets']['children']['Entries']['url'] = '/admin/timesheets/timesheet_entry';
}

/////////////////////////For Accounts menu/////////////////////////////////////////////////////////
$modules['Accounts']['icon'] = 'fa fa-map';

if(array_key_exists('UpdateInvoices', $rights)) {
	$modules['Accounts']['children']['Update Invoices']['icon'] = 'fa fa-circle-o';
// 	$modules['Accounts']['children']['Update Invoices']['url'] = '/admin/update_invoices/index';
	$modules['Accounts']['children']['Update Invoices']['url'] = '/admin/milestones/invoice_index';
}

$controllerSlashAction = $this->request->params['controller'].'/'.$this->request->params['action'];
switch($controllerSlashAction) {

	case 'Masters/dashboard':
		$modules['Dashboard']['class'] = 'active';
		break;
			
	case 'Roles/index':
	case 'Roles/add':
	case 'Roles/edit':
	case 'Roles/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Access']['class'] = 'Active';
		$modules['Masters']['children']['Access']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Access']['children']['Roles']['class'] = 'Active';
		break;

	case 'RoleRights/index':
	case 'RoleRights/add':
	case 'RoleRights/edit':
	case 'RoleRights/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Access']['class'] = 'Active';
		$modules['Masters']['children']['Access']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Access']['children']['RoleRights']['class'] = 'Active';
		break;

	case 'EmailTemplates/index':
	case 'EmailTemplates/add':
	case 'EmailTemplates/edit':
	case 'EmailTemplates/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Additionals']['class'] = 'Active';
		$modules['Masters']['children']['Additionals']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Additionals']['children']['Email Templates']['class'] = 'Active';
		break;

	case 'Designations/index':
	case 'Designations/add':
	case 'Designations/edit':
	case 'Designations/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Additionals']['class'] = 'Active';
		$modules['Masters']['children']['Additionals']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Additionals']['children']['Designations']['class'] = 'Active';
		break;
		

	case 'Technologies/index':
	case 'Technologies/add':
	case 'Technologies/edit':
	case 'Technologies/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Additionals']['class'] = 'Active';
		$modules['Masters']['children']['Additionals']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Additionals']['children']['Technologies']['class'] = 'Active';
		break;

	case 'Tasks/index':
	case 'Tasks/add':
	case 'Tasks/edit':
	case 'Tasks/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Additionals']['class'] = 'Active';
		$modules['Masters']['children']['Additionals']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Additionals']['children']['Org. Tasks']['class'] = 'Active';
		break;
		
	case 'Currencies/index':
	case 'Currencies/add':
	case 'Currencies/edit':
	case 'Currencies/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Additionals']['class'] = 'Active';
		$modules['Masters']['children']['Additionals']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Additionals']['children']['Currencies']['class'] = 'Active';
		break;
		
	case 'IssueTypes/index':
	case 'IssueTypes/add':
	case 'IssueTypes/edit':
	case 'IssueTypes/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Types']['class'] = 'Active';
		$modules['Masters']['children']['Types']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Types']['children']['Issue Types']['class'] = 'Active';
		break;
			
	case 'ProjectTypes/index':
	case 'ProjectTypes/add':
	case 'ProjectTypes/edit':
	case 'ProjectTypes/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Types']['class'] = 'Active';
		$modules['Masters']['children']['Types']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Types']['children']['Project Types']['class'] = 'Active';
		break;
		
	case 'ProjectStatuses/index':
	case 'ProjectStatuses/add':
	case 'ProjectStatuses/edit':
	case 'ProjectStatuses/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Statuses']['class'] = 'Active';
		$modules['Masters']['children']['Statuses']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Statuses']['children']['Project Statuses']['class'] = 'Active';
		break;
			
	case 'MilestoneStatuses/index':
	case 'MilestoneStatuses/add':
	case 'MilestoneStatuses/edit':
	case 'MilestoneStatuses/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Statuses']['class'] = 'Active';
		$modules['Masters']['children']['Statuses']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Statuses']['children']['Milestone Statuses']['class'] = 'Active';
		break;
		
	case 'TaskStatuses/index':
	case 'TaskStatuses/add':
	case 'TaskStatuses/edit':
	case 'TaskStatuses/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Statuses']['class'] = 'Active';
		$modules['Masters']['children']['Statuses']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Statuses']['children']['Task Statuses']['class'] = 'Active';
		break;
			
	case 'IssueStatuses/index':
	case 'IssueStatuses/add':
	case 'IssueStatuses/edit':
	case 'IssueStatuses/delete':
		$modules['Masters']['class'] = 'active';
		$modules['Masters']['children']['Statuses']['class'] = 'Active';
		$modules['Masters']['children']['Statuses']['style'] = 'style="display:block;"';
		$modules['Masters']['children']['Statuses']['children']['Issue Statuses']['class'] = 'Active';
		break;
		
	case 'Users/index':
	case 'Users/add':
	case 'Users/edit':
	case 'Users/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Users']['class'] = 'Active';
		break;
		
	case 'Departments/index':
	case 'Departments/add':
	case 'Departments/edit':
	case 'Departments/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Departments']['class'] = 'Active';
		break;
		
	case 'DepartmentTasks/index':
	case 'DepartmentTasks/add':
	case 'DepartmentTasks/edit':
	case 'DepartmentTasks/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Department Tasks']['class'] = 'Active';
		break;
		
	case 'ResourceDepartments/index':
	case 'ResourceDepartments/add':
	case 'ResourceDepartments/edit':
	case 'ResourceDepartments/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Resource Departments']['class'] = 'Active';
		break;
			
	case 'Salaries/index':
	case 'Salaries/add':
	case 'Salaries/edit':
	case 'Salaries/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Salary Level']['class'] = 'Active';
		break;
				
	case 'SeatCosts/index':
	case 'SeatCosts/add':
	case 'SeatCosts/edit':
	case 'SeatCosts/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Seat Costs']['class'] = 'Active';
		break;
					
	case 'CurrencyConversions/index':
	case 'CurrencyConversions/add':
	case 'CurrencyConversions/edit':
	case 'CurrencyConversions/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Currency Conversions']['class'] = 'Active';
		break;
						
	case 'Clients/index':
	case 'Clients/add':
	case 'Clients/edit':
	case 'Clients/delete':
    case 'Contacts/index':
    case 'Contacts/add':
    case 'Contacts/edit':
    case 'Contacts/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Clients']['class'] = 'Active';
		break;
							
	case 'Holidays/index':
	case 'Holidays/add':
	case 'Holidays/edit':
	case 'Holidays/delete':
		$modules['Op Masters']['class'] = 'active';
		$modules['Op Masters']['children']['Holidays']['class'] = 'Active';
		break;
		
	
	case 'Projects/index':
	case 'Projects/add':
	case 'Projects/edit':
	case 'Projects/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Projects']['class'] = 'Active';
		break;
			
	case 'ResourceAllocations/index':
	case 'ResourceAllocations/add':
	case 'ResourceAllocations/edit':
	case 'ResourceAllocations/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Allocate Resources']['class'] = 'Active';
		break;
				
	case 'Milestones/index':
	case 'Milestones/add':
	case 'Milestones/edit':
	case 'Milestones/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Milestones']['class'] = 'Active';
		break;
					
	case 'Projects/toBeApproved':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Projects Coversheet']['class'] = 'Active';
		break;
						
	case 'ProjectPhases/index':
	case 'ProjectPhases/add':
	case 'ProjectPhases/edit':
	case 'ProjectPhases/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Phases']['class'] = 'Active';
		break;
							
	case 'ProjectModules/index':
	case 'ProjectModules/add':
	case 'ProjectModules/edit':
	case 'ProjectModules/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Modules']['class'] = 'Active';
		break;
								
	case 'ProjectTasks/index':
	case 'ProjectTasks/add':
	case 'ProjectTasks/edit':
	case 'ProjectTasks/delete':
    case 'ProjectTaskDetails/index':
    case 'ProjectTaskDetails/delete':
    case 'ProjectTaskDetails/add':
    case 'ProjectTaskDetails/edit':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Project Tasks']['class'] = 'Active';
		break;
									
	case 'Issues/index':
	case 'Issues/add':
	case 'Issues/edit':
	case 'Issues/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Issues']['class'] = 'Active';
		break;
										
	case 'ProjectClosures/index':
	case 'ProjectClosures/add':
	case 'ProjectClosures/edit':
	case 'ProjectClosures/delete':
		$modules['Projects']['class'] = 'active';
		$modules['Projects']['children']['Project Closures']['class'] = 'Active';
		break;
		
	case 'StatusUpdates/update_task_index':
	    $modules['Status Updates']['class'] = 'active';
	    $modules['Status Updates']['children']['Task Update']['class'] = 'Active';
	    break;
	    
    case 'StatusUpdates/update_issue_index':
        $modules['Status Updates']['class'] = 'active';
        $modules['Status Updates']['children']['Issue Update']['class'] = 'Active';
        break;
		
	case 'Timesheets/timesheet_entry':
		$modules['Timesheets']['class'] = 'active';
		$modules['Timesheets']['children']['Entries']['class'] = 'Active';
		break;
		
	case 'Milestones/invoice_index':
	case 'Milestones/invoice_edit':
    case 'Receipts/add':
    case 'Receipts/edit':
		$modules['Accounts']['class'] = 'active';
		$modules['Accounts']['children']['Update Invoices']['class'] = 'Active';
		break;
}
// pr($rights);	
// pr($modules); exit;
	$show_masters = false;
	foreach($modules['Masters']['children'] as $k => $master_child) {
		if(array_key_exists('children', $master_child)) {
			$show_masters = true;
			break;
		}
	}
	
	if(!$show_masters) {
		unset($modules['Masters']);
	}
?>
<aside class="main-sidebar"> 
	<section class="sidebar">
    	<div class="user-panel">
        	<div class="pull-left image">
				<a href="#"><?php echo $this->Html->image('noavatar.png', array("class"=>"img-circle", "alt"=>"user image")) ?></a>
            </div>
            <div class="pull-left info">
            	<p><?= __('Admin') ?></p>
              	<a href="#"><i class="fa fa-circle text-success"></i> <?= __('Online')?></a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" onkeyup="searchMenu(this.value)" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header"><?= __('MAIN NAVIGATION') ?></li>
            <?php
            foreach($modules as $module_name => $module) {
                $class = (isset($module['class']))?'active':'';
                if(isset($module['children'])) {
            ?>
            <li class="<?= $class?> treeview <?= strtolower($module_name)?>">
            <?php
            echo $this->Html->link(
                            '<i class="' . $module['icon'] . '"></i> <span>' . __($module_name) . '</span><i class="fa fa-angle-left pull-right"></i>',
                            '#',
                            ['escape' => false]
                        );?>
				<ul class="treeview-menu">
                <?php
                foreach($module['children'] as $child_name => $child_module) {
                	$class = (isset($child_module['class']))?'active':'';
                    if(isset($child_module['children'])) {
                ?>
                	<li class="<?= $class?> to-search <?= str_replace(' ', '-', strtolower($child_name)) ?> <?= strtolower($child_name) ?>" >
                    <?php
                    echo $this->Html->link(
                            '<i class="' . $child_module['icon'] . '"></i> <span>' . __($child_name) . '</span><i class="fa fa-angle-left pull-right"></i>',
                            '#',
                            ['escape' => false]
                        );
                    ?>
                                     
                	<?php
                	$style = (isset($child_module['style']))?$child_module['style']:'';
                	?>
                		<ul class="treeview-menu" <?= $style?>>
                		<?php
                		foreach($child_module['children'] as $subchild_name => $subchild_module) {
                			$sub_class = (isset($subchild_module['class']))?'active':'';
                		?>
                			<li class="<?= $sub_class?> to-search <?= str_replace(' ', '-', strtolower($subchild_name)) ?> <?= strtolower($subchild_name) ?>" >
                			<?php
                			echo $this->Html->link(
                            	'<i class="' . $subchild_module['icon'] . '"></i> <span>' . __($subchild_name) . '</span>',
                            	$subchild_module['url'],
                            	['escape' => false]
                        	);
                			?>
                       		</li>
                		<?php 
                		}
                		?>
                		</ul>
                   	</li>
                    <?php
                    } else {
                    	if(!empty($child_module['url']) && !empty($child_module['icon'])) {
                    ?>
		                    <li class="<?= $class?> to-search <?= strtolower($child_name)?>">
		    			    	<?php
		    			    	echo $this->Html->link(
		                            '<i class="' . $child_module['icon'] . '"></i> <span>' . __($child_name) . '</span>',
		                            $child_module['url'],
		                            ['escape' => false]
		                        );
		    			    	?>
		                    </li>
                    <?php }
                    }
                } 
                ?>
                </ul>  
            </li>
            <?php
            } else {
            	if(!empty($module['url']) && !empty($module['icon'])) {
            ?>
		            <li class="<?= $class?> to-search <?= strtolower($module_name)?>">
		    		<?php
		    		echo $this->Html->link(
		                 	'<i class="' . $module['icon'] . '"></i> <span>' . __($module_name) . '</span>',
		                    $module['url'],
		                    ['escape' => false]
		                 );?>
					</li>
            <?php
            	}
            }
        }
        ?>
        </ul>
    </section>
</aside>

<script>
function searchMenu(value){
	value = value.replace(/\s\s*/g,'-').toLowerCase();
	console.log(value);
	$('.sidebar-menu li').hide();
	var searchItems = $(".sidebar-menu li[class^='"+value+"'],.sidebar-menu li[class*=' "+value+"']");
	searchItems.show();
	searchItems.parent('ul').show();
	searchItems.parent('ul').parent('li').show();
	searchItems.find('.treeview-menu, li').show();
	
	if(value.replace(/\s\s*/g,'') == ''){
		$('.sidebar-menu li.treeview').show();
		$('.sidebar-menu li.treeview .treeview-menu').hide();
		$('.sidebar-menu li.treeview.active .treeview-menu').show();
	}
}
</script>