<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'ResourceAllocations';
    $paginationParams = 'ResourceAllocations';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Resource Allocations') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Resource') ?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->input('user_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $users,
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
    $class[$this->request->params['paging']['ResourceAllocations']['sort']] = $this->request->params['paging']['ResourceAllocations']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $user_class = 'sorting';
    $start_date_class = 'sorting';
    $end_date_class = 'sorting';
    $role_class = 'sorting';
    $allocated_percent_class = 'sorting';
    $hours_class = 'sorting';
    switch(key($class)) {
        case 'ResourceAllocations.department_id' :
            $department_class= 'sorting_' . $class['ResourceAllocations.department_id'];
            break;
        
		case 'ResourceAllocations.project_id' : 
			$project_class= 'sorting_' . $class['ResourceAllocations.project_id'];
			break;
			
	    case 'ResourceAllocations.user_id' :
		    $user_class= 'sorting_' . $class['ResourceAllocations.user_id'];
		    break;
			
		case 'ResourceAllocations.start_date' :
			$start_date_class= 'sorting_' . $class['ResourceAllocations.start_date'];
			break;
			
		case 'ResourceAllocations.end_date' :
			$end_date_class= 'sorting_' . $class['ResourceAllocations.end_date'];
			break;
			
		case 'ResourceAllocations.role_id' :
			$role_class= 'sorting_' . $class['ResourceAllocations.role_id'];
			break;

		case 'ResourceAllocations.allocated_percent' :
			$allocated_percent_class= 'sorting_' . $class['ResourceAllocations.allocated_percent'];
			break;

		case 'ResourceAllocations.hours' :
			$hours_class= 'sorting_' . $class['ResourceAllocations.hours'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_class ?>"><?= $this->Paginator->sort('department_id', __('Department')); ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$user_class ?>"><?= $this->Paginator->sort('user_id', __('User')); ?></th>
                    <th class="<?=$role_class ?>"><?= $this->Paginator->sort('role_id', __('Role')); ?></th>
                    <th class="<?=$start_date_class ?>"><?= $this->Paginator->sort('start_date', __('Start Date')) ?></th>
                    <th class="<?=$end_date_class ?>"><?= $this->Paginator->sort('end_date', __('End Date')) ?></th>
                    <th class="<?=$allocated_percent_class ?>"><?= $this->Paginator->sort('allocated_percent', __('Allocated Percent')) ?></th>
                    <th class="<?=$hours_class ?>"><?= $this->Paginator->sort('hours', __('Hours')) ?></th>
                    <th colspan="2" class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['ResourceAllocations'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($resource_allocations as $resource_allocation): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($resource_allocation->department_id, $departments)) ?></td>
                    <td><?= h(id_to_text($resource_allocation->project_id, $projects)) ?></td>
                    <td><?= h(id_to_text($resource_allocation->user_id, $users)) ?></td>
                    <td><?= h(id_to_text($resource_allocation->role_id, $roles)) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($resource_allocation->start_date))) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($resource_allocation->end_date))) ?></td>
                    <td><?= h($resource_allocation->allocated_percent) ?></td>
                    <td><?= h($resource_allocation->hours) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $resource_allocation->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                    </td>
                    <?php if($resource_allocation->release_user == 0){?>
                        <td class="actions">
                            <?= $this->Html->link(__('Release'), ['action' => 'release_user', $resource_allocation->id],['confirm' => __('Are you sure you want to release # {0}?', $resource_allocation->id)]) ?>
                        </td>
                    <?php } else if($resource_allocation->release_user == 1){?>
                        <td class="actions">
                             <?= $this->Html->link(__('Recall'), ['action' => 'recall_user', $resource_allocation->id],['confirm' => __('Are you sure you want to recall # {0}?', $resource_allocation->id)]) ?>
                        </td>
                    <?php }?>
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ResourceAllocations', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
