<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'ProjectStatuses';
    $paginationParams = 'ProjectStatuses';
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('ProjectStatuses') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:130px;">Status</label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('status', [
						'type' => "text",
				        'id' => 'inputStatus3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Status',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['ProjectStatuses']['sort']] = $this->request->params['paging']['ProjectStatuses']['direction'];
    $status_class = 'sorting';
    switch(key($class)) {
		case 'ProjectStatuses.status' : 
			$status_class= 'sorting_' . $class['ProjectStatuses.status'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$status_class ?>"><?= $this->Paginator->sort('status', __('Status')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['ProjectStatuses'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($project_statuses as $project_status): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($project_status->status) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $project_status->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $project_status->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'ProjectStatuses', 'paginateParams' => $paginateParams]); ?>
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
