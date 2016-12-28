<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?= $this->Html->css('Admin/bootstrap-editable.css'); ?>
<?php
    $paginationParams = 'Issues';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Update Issue Status') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
                <?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'update_issue_index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Issues') ?></label>
	          <div class="col-sm-2">
	           <?php 
	           		echo $this->Form->input('issue_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $issues,
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
	           		echo $this->Form->input('issue_status_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $issue_statuses,
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
    $class[$this->request->params['paging']['Issues']['sort']] = $this->request->params['paging']['Issues']['direction'];
    $department_class = 'sorting';
    $project_class = 'sorting';
    $issuenumber_class = 'sorting';
    $issue_status_class = 'sorting';
    $assign_to_class = 'sorting';
    switch(key($class)) {
        case 'Issues.department_id' :
            $department_class= 'sorting_' . $class['Issues.department_id'];
            break;
            
		case 'Issues.project_id' :
			$project_class= 'sorting_' . $class['Issues.project_id'];
			break;
			
        case 'Issues.issue_id' :
		    $issuenumber_class= 'sorting_' . $class['Issues.issue_id'];
		    break;
		    
	    case 'Issues.issue_status_id' :
	        $issue_status_class= 'sorting_' . $class['Issues.issue_status_id'];
	        break;
	        
        case 'Issues.assign_to' :
            $assign_to_class= 'sorting_' . $class['Issues.assign_to'];
            break;
    }
    ?>
    <div class="box-body">
        <table id="issue_status_update" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_class ?>"><?= $this->Paginator->sort('department_id', __('Department')); ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$issuenumber_class ?>"><?= $this->Paginator->sort('issue_id', __('Issue')); ?></th>
                    <th class="<?=$issue_status_class ?>"><?= $this->Paginator->sort('issue_status_id', __('Status')); ?></th>
                    <th class="<?=$assign_to_class ?>"><?= $this->Paginator->sort('assign_to', __('Assigned To')); ?></th>
         
                </tr>
            </thead>
            <tbody>
            
                <?php 
                    $pages = $this->Paginator->request->params['paging']['Issues'];
                    $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                    foreach ($issue_details as $issue_detail): 
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h($issue_detail->project->department['department_name']) ?></td>
                        <td><?= h($issue_detail->project->name) ?></td>
                        <td><?= '#'.$issue_detail->id ?></td>
                        <td><a href="#" class="issue_status_id" data-name="issue_status_id" data-pk="<?= $issue_detail->id ?>" data-value="<?= $issue_detail->issue_status_id ?>" ><?= id_to_text($issue_detail->issue_status_id, $issue_statuses)?></a>
                        </td>
                        <td><?= h(id_to_text($issue_detail->assign_to, $users)) ?></td>
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Issues', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
<?= $this->Html->script('Admin/bootstrap-editable.min') ?>
<script>
$('.issue_status_id').editable({
	title: 'Select Issue Status',
	type: 'select',
	source: "<?= preg_replace('|"|', "'", json_encode($issue_statuses))?>",
	url: jsBaseURL + '/admin/status_updates/changeStatus'
});
</script>