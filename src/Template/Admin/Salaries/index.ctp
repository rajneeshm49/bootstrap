<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'Salaries';
    $statusClass = array('1'=>'check','0'=>'close');
    $paginationParams = 'Salaries';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Resource Salary Level') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3">User</label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->select('user_id',$users,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3">Increment Date</label>
	          <div class="col-sm-2">
	          <div class="input-group">
	          	<div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	            </div>
	          	<?php 
				  echo $this->Form->input('increment_date', [
						'type' => "text",
				        'id' => 'increment_date',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Increment Date',
						'label' => false,
						'tabindex' => '9'
	        		]);
				?>
			  </div>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3">Role</label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->select('role_id',$roles,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputEmail3">Designation</label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->select('designation_id',$designations,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['Salaries']['sort']] = $this->request->params['paging']['Salaries']['direction'];
    $user_id_class = 'sorting';
    $increment_date_class = 'sorting';
    $amount_class = 'sorting';
    $role_id_class = 'sorting';
    $designation_id_class = 'sorting';
	switch(key($class)) {
		case 'Salaries.user_id' : 
			$user_id_class= 'sorting_' . $class['Salaries.user_id'];
			break;
			
		case 'Salaries.increment_date' :
			$increment_date_class= 'sorting_' . $class['Salaries.increment_date'];
			break;
			
		case 'Salaries.amount' :
			$amount_class= 'sorting_' . $class['Salaries.amount'];
			break;
			
		case 'Salaries.role_id' :
			$role_id_class= 'sorting_' . $class['Salaries.role_id'];
			break;
			
		case 'Salaries.designation_id' :
			$designation_id_class= 'sorting_' . $class['Salaries.designation_id'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$user_id_class ?>"><?= $this->Paginator->sort('user_id', __('User')); ?></th>
                    <th class="<?=$increment_date_class ?>"><?= $this->Paginator->sort('increment_date', __('Increment Date')); ?></th>
                    <th class="<?=$amount_class ?>"><?= $this->Paginator->sort('amount', __('Amount')); ?></th>
                    <th class="<?=$role_id_class ?>"><?= $this->Paginator->sort('role_id', __('Role')) ?></th>
                    <th class="<?=$designation_id_class ?>"><?= $this->Paginator->sort('designation_id', __('Designation')) ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['Salaries'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($salaries as $salary): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($salary->user_id, $users)) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($salary->increment_date))) ?></td>
                    <td><?= h($salary->amount) ?></td>
                    <td><?= h(id_to_text($salary->role_id, $roles)) ?></td>
                    <td><?= h(id_to_text($salary->designation_id, $designations)) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $salary->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $salary->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Salaries', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
<?= $this->Html->script('Admin/form-validation.js') ?>
<?= $this->Html->script('Admin/jquery.inputmask.js') ?>
<style>
  .progress-bar{
		min-width: 26%;
  }
</style>
<script>
    $(document).ready(function() {
      $("#increment_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: false
        });
	});
</script>
