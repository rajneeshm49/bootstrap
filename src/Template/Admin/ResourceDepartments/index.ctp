<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'ResourceDepartments';
    $statusClass = array('1'=>'check','0'=>'close');
    $paginationParams = 'ResourceDepartments';
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Resource Departments') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        <input type="hidden" id="user_id" name="user_id" value = <?= !empty($paginateParams['user_id']) ? $paginateParams['user_id'] : '';?>></input>
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('User')?></label>
	          <div class="col-sm-3">
	            <?php 
				echo $this->Form->input('user_name', [
						'type' =>'text',
						'class' => 'form-control',
						'tabindex' => '1',
						'label' => false,
						'id' => 'inputUserDpt3',
						'placeholder' => '(First Name or Last Name)'
            		]
            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Department')?></label>
	          <div class="col-sm-3">
	           <?php 
					echo $this->Form->select('department_id',$departments,[
							'class' => 'form-control',
							'tabindex' => '2',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	          <!--label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:60px;"><?= __('Department Head')?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->select('department_head',$head_of_departments,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div-->
	          
	          <?php 
	          $chk_all = '';
	          $chk_yes = '';
	          $chk_no = '';
	          if(0 == $paginateParams['department_head']) {
	          	$chk_no = 'checked';
	          } elseif(1 == $paginateParams['department_head']) {
	          	$chk_yes = 'checked';
	          } else {
	          	$chk_all = 'checked';
	          }
	          ?>
	          	<label class="col-sm-2 control-label search-fields-pad"><?= __('Department Head')?></label>
                <label style="padding-top:5px;">
                  <input type="radio" name="department_head" class="flat-red" value=1 <?=$chk_yes?>>
                  <?= __('Yes') ?>
                </label>
                <label>
                  <input type="radio" name="department_head" class="flat-red" value=0 <?=$chk_no?>>
                  <?= __('No') ?>
                </label>
                <label>
                  <input type="radio" name="department_head" class="flat-red" value=2 <?=$chk_all?>>
                  <?= __('All') ?>
                </label>
              
              
	        </div>
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['ResourceDepartments']['sort']] = $this->request->params['paging']['ResourceDepartments']['direction'];
    $user_id_class = 'sorting';
    $department_id_class = 'sorting';
    $percentage_allocate_class = 'sorting';
    $department_head_class = 'sorting';
	switch(key($class)) {
		case 'ResourceDepartments.user_id' : 
			$user_id_class= 'sorting_' . $class['ResourceDepartments.user_id'];
			break;
			
		case 'ResourceDepartments.department_id' :
			$department_id_class= 'sorting_' . $class['ResourceDepartments.department_id'];
			break;
				
		case 'ResourceDepartments.percentage_allocate' :
			$percentage_allocate_class= 'sorting_' . $class['ResourceDepartments.percentage_allocate'];
			break;
		
		case 'ResourceDepartments.department_head' :
			$department_head_class= 'sorting_' . $class['ResourceDepartments.department_head'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$user_id_class ?>"><?= $this->Paginator->sort('user_id', __('User'),['class'=>$user_id_class]); ?></th>
                    <th class="<?=$department_id_class ?>"><?= $this->Paginator->sort('department_id', __('Department Name'),['class'=>$department_id_class]); ?></th>
                    <th class="<?=$percentage_allocate_class ?>"><?= $this->Paginator->sort('percentage_allocate', __('% Allocate'),['class'=>$percentage_allocate_class]); ?></th>
                    <th class="<?=$department_head_class ?>"><?= $this->Paginator->sort('department_head', __('Department Head'),['class'=>$department_head_class]); ?></th>
                    <th class="no-sort"><?= __('Default Department'); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['ResourceDepartments'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($resource_departments as $resource_department): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= ($resource_department->user['first_name'] . ' ' . $resource_department->user['last_name']) ?></td>
                    <td>
                    	<?= h($resource_department->department['department_name']) ?>
                    </td>
                    <td><?= h($resource_department->percentage_allocate) . ' %' ?></td>
                    <td><?= h(($resource_department->department_head)? 'Yes' : 'No') ?></td>
                    <td><?= h(($resource_department->default_department)? 'Yes' : 'No') ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $resource_department->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $resource_department->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ResourceDepartments', 'paginateParams' => $paginateParams]); ?>
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
