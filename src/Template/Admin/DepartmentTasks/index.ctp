<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'DepartmentTasks';
    $paginationParams = 'DepartmentTasks';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Department Tasks') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Task') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('task_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $tasks,
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
    $class[$this->request->params['paging']['DepartmentTasks']['sort']] = $this->request->params['paging']['DepartmentTasks']['direction'];
    $department_class = 'sorting';
    $task_class = 'sorting';
    $taskname_class = 'sorting';
	switch(key($class)) {
		case 'DepartmentTasks.department_id' : 
			$department_class= 'sorting_' . $class['DepartmentTasks.department_id'];
			break;
			
		case 'DepartmentTasks.task_id' :
			$task_class= 'sorting_' . $class['DepartmentTasks.task_id'];
			break;
			
        case 'DepartmentTasks.name' :
		    $taskname_class= 'sorting_' . $class['DepartmentTasks.name'];
		    break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_class ?>"><?= $this->Paginator->sort('department_id', __('Department')); ?></th>
                    <th class="<?=$task_class ?>"><?= $this->Paginator->sort('task_id', __('Task')); ?></th>
                    <th class="<?=$taskname_class ?>"><?= $this->Paginator->sort('name', __('Department Task')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['DepartmentTasks'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($department_tasks as $department_task): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($department_task->department_id, $departments)) ?></td>
                    <td><?= h(id_to_text($department_task->task_id, $tasks)) ?></td>
                    <td><?= h($department_task->name) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $department_task->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $department_task->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'DepartmentTasks', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
