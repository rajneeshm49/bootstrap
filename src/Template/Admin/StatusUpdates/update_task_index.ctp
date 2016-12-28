<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?= $this->Html->css('Admin/bootstrap-editable.css'); ?>
<?php
    $paginationParams = 'ProjectTaskDetails';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Update Task Status') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
                <?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'update_task_index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            </div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Department') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('department_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $departments,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Project Tasks') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('project_task_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $project_tasks,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:60px;"><?= __('Status') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('task_status_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $task_statuses,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['ProjectTaskDetails']['sort']] = $this->request->params['paging']['ProjectTaskDetails']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $taskname_class = 'sorting';
    $task_status_class = 'sorting';
    switch(key($class)) {
        case 'ProjectTaskDetails.department_id' :
            $department_class= 'sorting_' . $class['ProjectTaskDetails.department_id'];
            break;
            
		case 'ProjectTaskDetails.project_id' :
			$project_class= 'sorting_' . $class['ProjectTaskDetails.project_id'];
			break;
			
        case 'ProjectTaskDetails.project_task_id' :
		    $taskname_class= 'sorting_' . $class['ProjectTaskDetails.project_task_id'];
		    break;
		    
	    case 'ProjectTaskDetails.task_status_id' :
	        $task_status_class= 'sorting_' . $class['ProjectTaskDetails.task_status_id'];
	        break;
    }
    ?>
    <div class="box-body">
        <table id="task_status_update" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_class ?>"><?= $this->Paginator->sort('department_id', __('Department')); ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$taskname_class ?>"><?= $this->Paginator->sort('project_task_id', __('Task')); ?></th>
                    <th class="<?=$task_status_class ?>"><?= $this->Paginator->sort('task_status_id', __('Task Status')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $pages = $this->Paginator->request->params['paging']['ProjectTaskDetails'];
                    $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                    foreach ($project_task_details as $project_task_detail): 
                    
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h($project_task_detail->project_task->project->department['department_name']) ?></td>
                        <td><?= h($project_task_detail->project_task->project['name']) ?></td>
                        <td><?= h($project_task_detail->project_task['name']) ?></td>
                        <td><a href="#" class="task_status_id" data-name="task_status_id" data-pk="<?= $project_task_detail->project_task['id'] ?>" data-value="<?= $project_task_detail->project_task['task_status_id'] ?>" ><?= id_to_text($project_task_detail->project_task['task_status_id'], $task_statuses) ?></a></td>
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectTaskDetails', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
<?= $this->Html->script('Admin/bootstrap-editable.min') ?>
<script>
$('.task_status_id').editable({
	title: 'Select Task Status',
	type: 'select',
	source: "<?= preg_replace('|"|', "'", json_encode($task_statuses))?>",
	url: jsBaseURL + '/admin/status_updates/changeStatus'
});
</script>