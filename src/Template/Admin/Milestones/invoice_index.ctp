<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'Milestones';
    $paginationParams = 'Milestones';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Update Invoices') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'invoice_index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Milestones') ?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->input('id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $milestones,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Invoice Status') ?></label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->input('invoice_status', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $invoice_status,
					    'default' => 0,
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
        $class[$this->request->params['paging']['Milestones']['sort']] = $this->request->params['paging']['Milestones']['direction'];
        $department_class = 'sorting';
        $project_class = 'sorting';
        $milestone_class = 'sorting';
        $start_date_class = 'sorting';
        $end_date_class = 'sorting';
        $amount_class = 'sorting';
        $invoice_status_class = 'sorting';
    	switch(key($class)) {
    	    case 'Milestones.department_id' :
    	        $department_class= 'sorting_' . $class['Milestones.department_id'];
    	        break;
    	        
    		case 'Milestones.project_id' : 
    			$project_class= 'sorting_' . $class['Milestones.project_id'];
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
    			
    		case 'Milestones.amount' :
    			$amount_class= 'sorting_' . $class['Milestones.amount'];
    			break;
    
    		case 'Milestones.invoice_status' :
    			$invoice_status_class= 'sorting_' . $class['Milestones.invoice_status'];
    			break;
    	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$department_class ?>"><?= $this->Paginator->sort('Milestones.department_id', __('Department')); ?></th>
                    <th class="<?=$project_class ?>"><?= $this->Paginator->sort('project_id', __('Project')); ?></th>
                    <th class="<?=$milestone_class ?>"><?= $this->Paginator->sort('name', __('Milestone')); ?></th>
                    <th class="<?=$start_date_class ?>"><?= $this->Paginator->sort('start_date', __('Start Date')) ?></th>
                    <th class="<?=$end_date_class ?>"><?= $this->Paginator->sort('end_date', __('End Date')) ?></th>
                    <th class="<?=$amount_class ?>"><?= $this->Paginator->sort('amount', __('Amount')) ?></th>
                    <th class="<?=$invoice_status_class ?>"><?= $this->Paginator->sort('invoice_status', __('Invoice Status')) ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['Milestones'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($invoice_lists as $invoice_list): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h(id_to_text($invoice_list->department_id, $departments)) ?></td>
                    <td><?= h(id_to_text($invoice_list->project_id, $projects)) ?></td>
                    <td><?= h($invoice_list->name) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($invoice_list->start_date))) ?></td>
                    <td><?= h(date('Y-m-d', strtotime($invoice_list->end_date))) ?></td>
                    <td><?= ($invoice_list->invoice_amount == 0.00) ? '0.00' : $invoice_list->invoice_amount; ?></td>
                    <td><?= h(id_to_text($invoice_list->invoice_status, invoice_status())) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'invoice_edit', $invoice_list->id], $paginateParams), ['class' => 'fa fa-pencil']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Milestones', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
