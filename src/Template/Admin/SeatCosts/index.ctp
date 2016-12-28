<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'SeatCosts';
    $statusClass = array('1'=>'check','0'=>'close');
    $paginationParams = 'SeatCosts';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('SeatCosts') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3">Department</label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->select('department_id',$departments,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'empty' => '(choose one)',
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3">Year</label>
	          <div class="col-sm-2">
	          <div class="input-group">
	          	<div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	            </div>
	          	<?php 
				  echo $this->Form->input('year', [
						'type' => "text",
				        'id' => 'year',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Year',
						'label' => false,
						'tabindex' => '9'
	        		]);
				?>
			  </div>
	          </div>
	        </div>
        	</form>
    </div>
   <?php     
    $class[$this->request->params['paging']['SeatCosts']['sort']] = $this->request->params['paging']['SeatCosts']['direction'];
    $department_id_class = 'sorting';
    $year_class = 'sorting';
    $cost_class = 'sorting';
    switch(key($class)) {
		case 'SeatCosts.department_id' : 
			$department_id_class= 'sorting_' . $class['SeatCosts.department_id'];
			break;
			
		case 'SeatCosts.year' :
			$year_class= 'sorting_' . $class['SeatCosts.year'];
			break;
			
		case 'SeatCosts.cost' :
			$cost_class= 'sorting_' . $class['SeatCosts.cost'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_id_class ?>"><?= $this->Paginator->sort('department_id', __('Department')); ?></th>
                    <th class="<?=$year_class ?>"><?= $this->Paginator->sort('year', __('Year')); ?></th>
                    <th class="<?=$cost_class ?>"><?= $this->Paginator->sort('cost', __('Cost')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['SeatCosts'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
//                 pjs($seatcosts);exit;
                foreach ($seatcosts as $seatcost): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($seatcost->department_id, $departments)) ?></td>
                    <td><?= $seatcost->year ?></td>
                    <td><?= h($seatcost->cost) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $seatcost->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $seatcost->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'SeatCosts', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
<?= $this->Html->script('Admin/jquery.inputmask.js') ?>
<script>
    $(document).ready(function() {
      $("[data-mask]").inputmask();
      $("#year").datepicker({
          format: 'yyyy-mm-dd',
	      autoclose: true,
	      endDate: false
        });
  	});
</script>
