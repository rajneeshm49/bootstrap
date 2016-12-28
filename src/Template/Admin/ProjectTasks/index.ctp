<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'ProjectTasks';
    $paginationParams = 'ProjectTasks';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Project Tasks') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Project') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('project_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $projects,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:60px;"><?= __('Name') ?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->input('name',[
					        'type' => 'text',
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
					        'placeholder' => 'Name',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['ProjectTasks']['sort']] = $this->request->params['paging']['ProjectTasks']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $taskname_class = 'sorting';
    $start_date_class = 'sorting';
    $end_date_class = 'sorting';
    $estimated_hours_class = 'sorting';
    $actual_hours_class = 'sorting';
    $status_class = 'sorting';
	switch(key($class)) {
		case 'ProjectTasks.project_id' :
			$project_class= 'sorting_' . $class['ProjectTasks.project_id'];
			break;
			
        case 'ProjectTasks.name' :
		    $taskname_class= 'sorting_' . $class['ProjectTasks.name'];
		    break;
		    
	    case 'ProjectTasks.start_date' :
	        $start_date_class= 'sorting_' . $class['ProjectTasks.start_date'];
	        break;
		        
        case 'ProjectTasks.end_date' :
            $end_date_class= 'sorting_' . $class['ProjectTasks.end_date'];
            break;
            
        case 'ProjectTasks.estimated_hours' :
            $estimated_hours_class= 'sorting_' . $class['ProjectTasks.estimated_hours'];
            break;
            
        case 'ProjectTasks.actual_hours' :
            $actual_hours_class= 'sorting_' . $class['ProjectTasks.actual_hours'];
            break;
            
        case 'ProjectTasks.task_status_id' :
            $status_class= 'sorting_' . $class['ProjectTasks.task_status_id'];
            break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$taskname_class ?>"><?= $this->Paginator->sort('name', __('Task')); ?></th>
                    <th class="<?=$start_date_class ?>"><?= $this->Paginator->sort('start_date', __('Start Date')); ?></th>
                    <th class="<?=$end_date_class ?>"><?= $this->Paginator->sort('end_date', __('End Date')); ?></th>
                    <th class="<?=$estimated_hours_class ?>"><?= $this->Paginator->sort('estimated_hours', __('Estimated Hours')); ?></th>
                    <th class="<?=$actual_hours_class ?>"><?= $this->Paginator->sort('actual_hours', __('Actual Hours')); ?></th>
                    <th class="<?=$status_class ?>"><?= $this->Paginator->sort('task_status_id', __('Task Status')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $pages = $this->Paginator->request->params['paging']['ProjectTasks'];
                    $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                    foreach ($project_tasks as $project_task): 
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h(id_to_text($project_task->project_id, $projects)) ?></td>
                        <td><?= h($project_task->name) ?></td>
                        <td><?= (strtotime($project_task->start_date) != 0) ? date('Y-m-d', strtotime($project_task->start_date)) : '' ?></td>
                        <td><?= (strtotime($project_task->end_date) != 0) ? date('Y-m-d', strtotime($project_task->end_date)) : '' ?></td>
                        <td><?= h($project_task->estimated_hours) ?></td>
                        <td><?= h($project_task->actual_hours) ?></td>
                        <td><?= h(id_to_text($project_task->task_status_id, $task_statuses)) ?></td>
                        <td class="actions">
                            <?php 
                                if($can_edit) {
                                    echo $this->Html->link(null, array_merge(['action' => 'edit', $project_task->id], $paginateParams), ['class' => 'fa fa-pencil']);
                                } else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                                }
                            ?>
                            <?php
                            	if($can_delete) {
                            		echo $this->Html->link(null, array_merge(['action' => 'delete', $project_task->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
                            	}  else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-times disabled','title' => 'You are not authorized to perform this action.']);
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $cnt ++;
                    endforeach; 
                ?>
            </tbody>
        </table>
        <!-- span class="pull-left recordsControl">
            <button type="button" onclick="removeRecords('<?= $model ?>','manage<?= $model ?>-checkbox')" class="btn btn-danger pull-left manage<?= $model ?>-action disabled">Remove</button>
            <div style="clear:both"></div>
        </span-->
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectTasks', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
