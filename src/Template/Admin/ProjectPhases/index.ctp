<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'ProjectPhases';
    $paginationParams = 'ProjectPhases';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Project Phases') ?></h3>
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
    $class[$this->request->params['paging']['ProjectPhases']['sort']] = $this->request->params['paging']['ProjectPhases']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $phasename_class = 'sorting';
	switch(key($class)) {
		case 'ProjectPhases.department_id' : 
			$department_class= 'sorting_' . $class['ProjectPhases.department_id'];
			break;
			
		case 'ProjectPhases.project_id' :
			$project_class= 'sorting_' . $class['ProjectPhases.project_id'];
			break;
			
        case 'ProjectPhases.name' :
		    $phasename_class= 'sorting_' . $class['ProjectPhases.name'];
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
                    <th class="<?=$phasename_class ?>"><?= $this->Paginator->sort('name', __('Phase')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $pages = $this->Paginator->request->params['paging']['ProjectPhases'];
                    $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                    foreach ($project_phases as $project_phase): 
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h(id_to_text($project_phase->department_id, $departments)) ?></td>
                        <td><?= h(id_to_text($project_phase->project_id, $projects)) ?></td>
                        <td><?= h($project_phase->name) ?></td>
                        <td class="actions">
                            <?php 
                                if($can_edit) {
                                    echo $this->Html->link(null, array_merge(['action' => 'edit', $project_phase->id], $paginateParams), ['class' => 'fa fa-pencil']);
                                } else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                                }
                            ?>
                            <?php
                            	if($can_delete) {
                            		echo $this->Html->link(null, array_merge(['action' => 'delete', $project_phase->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectPhases', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
