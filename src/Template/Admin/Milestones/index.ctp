<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $model = 'Milestones';
    $paginationParams = 'Milestones';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Milestones') ?></h3>
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Milestones') ?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->input('name', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $milestones_list,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Clients') ?></label>
	          <div class="col-sm-2">
	            <?php 
					echo $this->Form->input('client_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $clients,
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
					echo $this->Form->select('milestone_status_id',$milestone_statuses,[
							'class' => 'form-control',
							'tabindex' => '6',
							'empty' => ' ( Choose One )',
							'label' => false,
							'id' => 'inputRole3'
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['Milestones']['sort']] = $this->request->params['paging']['Milestones']['direction'];
    $project_class = 'sorting';
    $client_class = 'sorting';
    $milestone_class = 'sorting';
    $start_date_class = 'sorting';
    $end_date_class = 'sorting';
    $currency_class = 'sorting';
    $amount_class = 'sorting';
    $invoice_no_class = 'sorting';
    $amount_recd_class = 'sorting';
    $status_class = 'sorting';
	switch(key($class)) {
		case 'Milestones.project_id' : 
			$project_class= 'sorting_' . $class['Milestones.project_id'];
			break;
			
		case 'Clients.id' :
			$client_class= 'sorting_' . $class['Clients.id'];
			break;
			
		case 'Milestones.name' :
			$milestone_class= 'sorting_' . $class['Milestones.name'];
			break;
			
		case 'Milestones.start_date' :
			$start_date_class= 'sorting_' . $class['Milestones.start_date'];
			break;
			
		case 'Milestones.end_date' :
			$end_date_class= 'sorting_' . $class['Milestones.end_date'];
			break;
			
		case 'Milestones.currency' :
		    $currency_class= 'sorting_' . $class['Milestones.currency'];
		    break;
			
		case 'Milestones.amount' :
			$amount_class= 'sorting_' . $class['Milestones.amount'];
			break;

		case 'Milestones.invoice_no' :
			$invoice_no_class= 'sorting_' . $class['Milestones.invoice_no'];
			break;

		case 'Milestones.amount_recd' :
			$amount_recd_class= 'sorting_' . $class['Milestones.amount_recd'];
			break;
				
		case 'Milestones.milestone_status_id' :
			$status_class= 'sorting_' . $class['Milestones.milestone_status_id'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$client_class ?>"><?= $this->Paginator->sort('Clients.id', __('Client')); ?></th>
                    <th class="<?=$milestone_class ?>"><?= $this->Paginator->sort('name', __('Milestone')); ?></th>
                    <th class="<?=$start_date_class ?>"><?= $this->Paginator->sort('start_date', __('Start Date')) ?></th>
                    <th class="<?=$end_date_class ?>"><?= $this->Paginator->sort('end_date', __('End Date')) ?></th>
                    <th class="<?=$currency_class ?>"><?= $this->Paginator->sort('currency', __('Currency')) ?></th>
                    <th class="<?=$amount_class ?>"><?= $this->Paginator->sort('amount', __('Amount')) ?></th>
                    <th class="<?=$invoice_no_class ?>"><?= $this->Paginator->sort('invoice_no', __('Invoice No.')) ?></th>
                    <th class="<?=$amount_recd_class ?>"><?= $this->Paginator->sort('amount_recd', __('Amount Recd.')) ?></th>
                    <th class="<?=$status_class ?>"><?= $this->Paginator->sort('milestone_status_id', __('Status')) ?></th>
                    <th colspan="2" class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['Milestones'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($milestones as $milestone): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($milestone->project_id, $projects)) ?></td>
                    <td><?= h(id_to_text($milestone->project['client_id'], $clients)) ?></td>
                    <td><?= h($milestone->name) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($milestone->start_date))) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($milestone->end_date))) ?></td>
                    <td><?= h($milestone->project->currency['name']) ?></td>
                    <td><?= h($milestone->amount) ?></td>
                    <td><?= ($milestone->invoice_no) ? $milestone->invoice_no : 'Not Generated'; ?></td>
                    <td><?= ($milestone->amount_recd) ? $milestone->amount_recd : 'None'; ?></td>
                    <td><?= h(($milestone->milestone_status_id) ? id_to_text($milestone->milestone_status_id, $milestone_statuses) : id_to_text(1, $milestone_statuses)) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $milestone->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                            if($milestone->invoice_requested == 0){
                            	if($can_delete) {
                            		echo $this->Html->link(null, array_merge(['action' => 'delete', $milestone->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
                            	}  else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-times disabled','title' => 'You are not authorized to perform this action.']);
                                }
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-times disabled','title' => 'This Milestone is already requested for Invoice']);
                            }
                        ?>
                    </td>
                    <?php if($milestone->invoice_requested == 0){?>
                        <td class="actions">
                            <?= $this->Html->link(__('Request Invoice'), ['action' => 'reqInvoice', $milestone->name,$milestone->id]) ?>
                        </td>
                    <?php } else {?>
                        <td class="actions">
                            <?= __('Invoice Requested'); ?>
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Milestones', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
