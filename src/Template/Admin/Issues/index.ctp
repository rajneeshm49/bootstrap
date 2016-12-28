<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'Departments';
    $statusClass = array('1'=>'check','0'=>'close');
    $paginationParams = 'Departments';
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Departments') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Project')?></label>
	          <div class="col-sm-3">
	            <?php 
					echo $this->Form->input('project_id', [
						'type' => "select",
				    	'options' => $project_names, 
				        'class' => "form-control",
						'empty' => '(Choose one)',					
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Assigned To')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->input('assign_to', [
							'type' => 'select',
							'options' => $assign_to,
							'class' => "form-control",
							'empty' => '(Choose one)',
							'label' => false,
							'tabindex' => '2'							
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Severity')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->input('severity', [
							'class' => 'form-control',
							'tabindex' => '3',
							'options' => $lookup_severity,
							'empty' => '(Choose one)',
							'label' => false
	            		]
	            );?>
	          </div>
	        </div>
	        <div class="form-group padding-top35">
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Priority')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->input('priority', [
							'class' => 'form-control',
							'tabindex' => '4',
							'options' => $lookup_priority,
							'empty' => '(Choose one)',
							'label' => false
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Type')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->input('issue_type', [
							'class' => 'form-control',
							'tabindex' => '5',
							'options' => issueTypes(),
							'empty' => '(Choose one)',
							'label' => false
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Status')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->type('issue_status_id', [
							'type' => 'select',
							'class' => 'form-control',
							'tabindex' => '6',
							'options' => issueStatus(),
							'label' => false,
							'empty' => '(Choose one)'
			
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['Issues']['sort']] = $this->request->params['paging']['Issues']['direction'];
    $department_name_class = 'sorting';
    $is_active_class = 'sorting';
	switch(key($class)) {
		case 'Departments.department_name' : 
			$department_name_class= 'sorting_' . $class['Departments.department_name'];
			break;
		
		case 'Departments.is_active' :
			$is_active_class= 'sorting_' . $class['Departments.is_active'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$department_name_class ?>"><?= $this->Paginator->sort('department_name', __('Issue No.'),['class'=>$department_name_class]); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Project')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Summary')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Reported By')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Reported Date')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Assigned To')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Module')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Type')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Severity')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Priority')); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Status')); ?></th>
                    
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['Issues'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($issues as $issue): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($issue->id) ?></td>
                    <td><?= h($issue->project['name']) ?></td>
                    <td><?= h($issue->summary) ?></td>
                    <td><?= $issue->reported_by_user['first_name'] . ' ' . $issue->reported_by_user['last_name'] ?></td>
                    <td><?= date("Y-m-d", strtotime($issue->reported_date)) ?></td>
                    <td><?= $issue->assigned_to_user['first_name'] . ' ' . $issue->assigned_to_user['last_name'] ?></td>
                    <td><?= h($issue->project_module['name']) ?></td>
                    <td><?= h(id_to_text($issue->issue_type, issueTypes())) ?></td>
                    <td><?= h(id_to_text($issue->severity, $lookup_severity)) ?></td>
                    <td><?= h(id_to_text($issue->priority, $lookup_priority)) ?></td>
                    <td><?= h(id_to_text($issue->issue_status_id, issueStatus())) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $issue->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $issue->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Issues', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>
<script>
  $(function () {
    $('input[type="radio"].flat-red.one').iCheck({
      radioClass: 'iradio_flat-red'
    });
    $('input[type="radio"].flat-red.two').iCheck({
      radioClass: 'iradio_flat-green'
    });
    $("#example1").DataTable({
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
        } ]
      });
  });

</script>
