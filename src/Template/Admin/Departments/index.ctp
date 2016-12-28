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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:130px;"><?= __('Department Name')?></label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->input('department_name', [
						'type' => "text",
				        'id' => 'inputDepartmentName3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Department Name',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:60px;">Status</label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->select('is_active',$status,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'id' => 'inputRole3',
							'default' => '1'
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['Departments']['sort']] = $this->request->params['paging']['Departments']['direction'];
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
                    <th class="<?=$department_name_class ?>"><?= $this->Paginator->sort('department_name', __('Department Name'),['class'=>$department_name_class]); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Status')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['Departments'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($departments as $department): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($department->department_name) ?></td>
                    <td>
                    	<?= h($department->is_active == 1) ? __('Active') : __('Inactive')?>
                    </td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $department->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $department->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Departments', 'paginateParams' => $paginateParams]); ?>
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
