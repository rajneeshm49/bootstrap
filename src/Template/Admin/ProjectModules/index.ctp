<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'ProjectModules';
    $paginationParams = 'ProjectModules';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Project Modules') ?></h3>
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
    $class[$this->request->params['paging']['ProjectModules']['sort']] = $this->request->params['paging']['ProjectModules']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $modulename_class = 'sorting';
    $to_date_class = 'sorting';
    $from_date_class = 'sorting';
	switch(key($class)) {
		case 'ProjectModules.department_id' : 
			$department_class= 'sorting_' . $class['ProjectModules.department_id'];
			break;
			
		case 'ProjectModules.project_id' :
			$project_class= 'sorting_' . $class['ProjectModules.project_id'];
			break;
			
        case 'ProjectModules.name' :
		    $modulename_class= 'sorting_' . $class['ProjectModules.name'];
		    break;
		    
	    case 'ProjectModules.to_date' :
	        $to_date_class= 'sorting_' . $class['ProjectModules.to_date'];
	        break;
	        
        case 'ProjectModules.from_date' :
            $from_date_class= 'sorting_' . $class['ProjectModules.from_date'];
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
                    <th class="<?=$modulename_class ?>"><?= $this->Paginator->sort('name', __('Module')); ?></th>
                    <th class="<?=$from_date_class ?>"><?= $this->Paginator->sort('from_date', __('From Date')); ?></th>
                    <th class="<?=$to_date_class ?>"><?= $this->Paginator->sort('to_date', __('To Date')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $pages = $this->Paginator->request->params['paging']['ProjectModules'];
                    $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                    foreach ($project_modules as $project_module): 
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h(id_to_text($project_module->department_id, $departments)) ?></td>
                        <td><?= h(id_to_text($project_module->project_id, $projects)) ?></td>
                        <td><?= h($project_module->name) ?></td>
                        <td><?= (strtotime($project_module->from_date) != 0) ? date('Y-m-d', strtotime($project_module->from_date)) : '' ?></td>
                        <td><?= (strtotime($project_module->to_date) != 0) ? date('Y-m-d', strtotime($project_module->to_date)) : '' ?></td>
                        <td class="actions">
                             <?php 
                                if($can_edit) {
                                    echo $this->Html->link(null, array_merge(['action' => 'edit', $project_module->id], $paginateParams), ['class' => 'fa fa-pencil']);
                                } else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectModules', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>