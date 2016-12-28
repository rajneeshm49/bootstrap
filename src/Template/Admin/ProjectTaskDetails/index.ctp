<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'ProjectTaskDetails';
    $paginationParams = 'ProjectTaskDetails';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Project Task Details') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['ProjectTaskDetails']['sort']] = $this->request->params['paging']['ProjectTaskDetails']['direction'];
    $user_class = 'sorting';
    $estimated_hours_class = 'sorting';
    $actual_hours_class= 'sorting';
    switch(key($class)) {
		case 'ProjectTaskDetails.user_id' :
		    $user_class= 'sorting_' . $class['ProjectTaskDetails.user_id'];
		    break;
		
		case 'ProjectTaskDetails.estimated_hours' :
            $estimated_hours_class= 'sorting_' . $class['ProjectTaskDetails.estimated_hours'];
            break;
            
        case 'ProjectTaskDetails.actual_hours' :
            $actual_hours_class= 'sorting_' . $class['ProjectTaskDetails.actual_hours'];
            break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$user_class ?>"><?= $this->Paginator->sort('user_id', __('Resource')); ?></th>
                    <th class="<?=$estimated_hours_class ?>"><?= $this->Paginator->sort('estimated_hours', __('Estimated Hours')); ?></th>
                    <th class="<?=$actual_hours_class ?>"><?= $this->Paginator->sort('actual_hours', __('Actual Hours')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
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
                        <td><?= h(id_to_text($project_task_detail->user_id, $users)) ?></td>
                        <td><?= h($project_task_detail->estimated_hours) ?></td>
                        <td><?= h($project_task_detail->actual_hours) ?></td>
                        <td class="actions">
                            <?php 
                                if($can_edit) {
                                    echo $this->Html->link(null, array_merge(['action' => 'edit', $project_task_detail->id], $paginateParams), ['class' => 'fa fa-pencil']);
                                } else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                                }
                            ?>
                            <?php
                            	if($can_delete) {
                            		echo $this->Html->link(null, array_merge(['action' => 'delete', $project_task_detail->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectTaskDetails', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>
