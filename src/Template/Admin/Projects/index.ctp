<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = $paginationParams = 'Projects';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Projects') ?></h3>
        	
        	<?php echo $this->Form->create(null, ['class' => 'supp-form textgrey margin-top10', 'url' => ['action' => 'index']]); ?>
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputName3"><?= __('Project') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('project_id', [
						'type' => 'select',
						'options' => $project_names,
						'empty' => '(Choose one)',
				        'class' => "form-control",
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Client') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('client_id', [
						'type' => "select",
				        'class' => "form-control",
						'empty' => '(Choose one)',
						'options' => $clients,
						'label' => false,
						'tabindex' => '2'
	        		]);
				?>
	          </div>
	          <?php if(!empty($to_be_approved)) {
	          	?>
	          	<label class="col-sm-1 control-label search-fields-pad"><?= __('Approved') ?></label>
	          	<div class="col-sm-2">
	            <?php 
				echo $this->Form->input('is_approved', [
						'type' => "select",
				        'class' => "form-control",
						'options' => [1 => 'Yes', 0 => 'No'],
						'default' => 0,
						'label' => false,
						'tabindex' => '3'
	        		]);
				?>
	         	</div>
	          	<?php 
	          } else { ?>
	          <label class="col-sm-1 control-label search-fields-pad"><?= __('Status') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('status_id', [
						'type' => "select",
				        'class' => "form-control",
						'empty' => '(Choose one)',
						'options' => $project_status,
						'label' => false,
						'tabindex' => '3'
	        		]);
				?>
	          </div>
	          <?php }?>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['Projects']['sort']] = $this->request->params['paging']['Projects']['direction'];
    $name_class = 'sorting';
    $email_class = 'sorting';
    $phone_class = 'sorting';
    
	switch(key($class)) {
		case 'Projects.name' : 
			$name_class= 'sorting_' . $class['Projects.name'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$name_class ?>"><?= $this->Paginator->sort('name', __('Project')); ?></th>
                    <?php if('general manager' == $role_name) {
                    ?>
                    <th class="actions no-sort"><?= $this->Paginator->sort('Departments.depart_name', __('Department')); ?></th>
                    <?php
                    }
                    ?>
                    <th class="actions no-sort"><?= $this->Paginator->sort('Clients.name', __('Client')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('start_date', __('Start Date')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('end_date', __('End Date')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('Currencies.name', __('Currency')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('amount', __('Value')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('approved', __('Approved')); ?></th>
                    <th class="actions no-sort"><?= $this->Paginator->sort('project_status_id', __('Project Status')); ?></th>
                    <th <?=(!empty($to_be_approved)?'':'colspan=2')?>" class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                if($projects->count() > 0) {
	                $pages = $this->Paginator->request->params['paging']['Projects'];
	                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
	                foreach ($projects as $project): 
	                
	                ?>
	                <tr>
	                    <td><?= $cnt ?></td>
	                    <td><?= h($project->name) ?></td>
	                    <?php if('general manager' == $role_name) {
	                    ?>
	                    <td><?= h($project->department['department_name']) ?></td>
	                    <?php
	                    }?>
	                    <td><?= h($project->client['name']) ?></td>
	                    <td><?= date('Y-m-d', strtotime($project->start_date)) ?></td>
	                    <td><?= (strtotime($project->end_date) != 0) ? date('Y-m-d', strtotime($project->end_date)) : '' ?></td>
	                    <td><?= h($project->currency['name']) ?></td>
	                    <td><?= h($project->amount) ?></td>
	                    <td><?= (!empty($project->approved)) ? 'Yes' : 'No'  ?></td>
	                    <td><?= $project->project_status['status']  ?></td>
	                    <?php if(empty($to_be_approved)){?>
	                    <td class="actions">
	                        <?php 
	                        
                                if($can_edit) {
                                    echo $this->Html->link(null, array_merge(['action' => 'edit', $project->id], $paginateParams), ['class' => 'fa fa-pencil']);
                                } else {
                                    echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                                }
                			
                            ?>
	                    </td>
	                    <?php }?>
	                    <td class="actions">
	                    <?php if('general manager' != $role_name) {
			                    	if('Request for Approval' == id_to_text($project->approval_status, projectApprovalStatus())) {
			                        	echo $this->Html->link(__('Request for Approval'), ['action' => 'reqForApproval', json_encode($project)]); 
			                    	} else {
			                    		echo id_to_text($project->approval_status, projectApprovalStatus());
			                    	}?><br />
			                        <?= $this->Html->link(__('Project Coversheet'), ['controller' => 'ProjectCoversheets', 'action' => 'view', $project->id]);
	                        
	                        } else { ?>
	                       <?= $this->Html->link(__('Project Coversheet'), ['controller' => 'ProjectCoversheets', 'action' => 'view', $project->id, '?' => ['to_be_approved' => 1]]) ?>
	                       <?php } ?>
	                    </td>
	                </tr>
	                <?php
	                $cnt ++;
	                endforeach;
                } else {
                	echo "<tr><td colspan='11' style='text-align:left;'><b>No record found</b></td></tr>";
            	}
                ?>
            </tbody>
        </table>
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Projects', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>