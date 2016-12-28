<div class="box box-info">
    <div class="box-header with-border">
     	<h3 class="box-title"><?= __('Project Coversheet') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['controller' => 'Projects', 'action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div>
    
    <!-- form start -->
      <div class="box-body">
      <?php echo $this->Form->create($project, ['class' => 'form-horizontal', 'id' => 'add_project', 'name' => 'add_project']); ?>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Project Name')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'class' => "form-control",
					'label' => false,
					'disabled' => true
        		]);
			?>
          </div>
          <label class="col-sm-2 control-label"><?= __('Client')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('client_id', [
					'type' => "select",
					'id' => 'project_client_id',
					'options' => $clients,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'disabled' => true
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Type')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('project_type_id', [
					'type' => "select",
					'options' => $project_types,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'disabled' => true
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'project_dept_id',
					'options' => $departments,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'disabled' => true
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('Start Date')?></label>
          <div class="col-sm-4">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('start_date', [
					'type' => "text",
			        'id' => 'start_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Start Date',
					'label' => false,
					'disabled' => true,
			  		'value' => date('Y-m-d', strtotime($project->start_date))
        		]);
			?>
            </div>
          </div>
          
          <label class="col-sm-2 control-label" for="joining_date"><?= __('End Date')?></label>
          <div class="col-sm-4">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('end_date', [
					'type' => "text",
			        'id' => 'end_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'End Date',
					'label' => false,
					'disabled' => true,
			  		'value' => (strtotime($project->end_date) != 0)?date('Y-m-d', strtotime($project->end_date)):''
        		]);
			?>
            </div>
          </div>
          </div>
          
          
          <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Size in man months')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('size_in_man_months', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
           <label class="col-sm-2 control-label"><?= __('Effort in hours')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('effort_hrs', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('No of Resources')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('no_of_resources', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label"><?= __('Estimated Cost')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('estimated_cost', [
					'type' => "text",
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
         <label class="col-sm-2 control-label"><?= __('Value')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('amount', [
					'type' => "number",
					'step' => '0.1',
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
          <label class="col-sm-2 control-label"><?= __('Currency')?></label>
          <div class="col-sm-4">
            <?php 
			echo $this->Form->input('currency_id', [
					'type' => "select",
					'options' => $currencies,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'disabled' => true,
        		]);
			?>
          </div>
        </div>
        
        </form>
        
		<div class="box-body">
		<h3>Resource Allocation</h3>
        	<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            	<thead>
                	<tr>
                    	<th><?= __('Sr No.') ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('user_id', __('Resource Name')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('role_id', __('Role')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('start_date', __('Start Date')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('end_date', __('End Date')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('allocated_percent', __('% Allocation')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('hours', __('Hours')); ?></th>
	                </tr>
	            </thead>
            	<tbody>
                	<?php
                    	$cnt = 1;
                        if($resource_allocations){
                        	foreach ($resource_allocations as $resource_allocation):
                	?>
		                <tr>
		                    <td><?= $cnt ?></td>
		                    <td><?= $resource_allocation->user['first_name'].' '.$resource_allocation->user['last_name']; ?></td>
		                    <td><?= $resource_allocation->role['role_name']; ?></td>
		                    <td><?= (strtotime($resource_allocation->start_date) != 0) ? date('Y-m-d', strtotime($resource_allocation->start_date)):'' ?></td>
		                    <td><?= (strtotime($resource_allocation->end_date) != 0) ? date('Y-m-d', strtotime($resource_allocation->end_date)):'' ?></td>
		                    <td><?= h($resource_allocation->allocated_percent) ?></td>
		                    <td><?= h($resource_allocation->hours) ?></td>
		                </tr>
	                <?php
        	                $cnt ++;
        	                endforeach;
                    	} else {
                    	    echo '<tr><td colspan="7">';
                    	    echo 'No Resources Found.';
                    	    echo '</td></tr>';
                    	}
                	?>
            	</tbody>
        	</table>        
    	</div>
    	
    	<div class="box-body">
    	<h3>Milestones</h3>
        	<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            	<thead>
                	<tr>
                    	<th><?= __('Sr No.') ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('name', __('Milestone Name')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('amount', __('Amount')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('start_date', __('Start Date')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('end_date', __('End Date')); ?></th>
	                </tr>
	            </thead>
            	<tbody>
                	<?php
                    	$cnt = 1;
                        	if($milestones){
                        	foreach ($milestones as $milestone):
                	?>
		                <tr>
		                    <td><?= $cnt ?></td>
		                    <td><?= $milestone->name; ?></td>
		                    <td><?= h($milestone->amount) ?></td>
		                    <td><?= (strtotime($milestone->start_date) != 0) ? date('Y-m-d', strtotime($milestone->start_date)):'' ?></td>
		                    <td><?= (strtotime($milestone->end_date) != 0) ? date('Y-m-d', strtotime($milestone->end_date)):'' ?></td>
		                </tr>
	                <?php
        	                $cnt ++;
        	                endforeach;
                    	} else {
                    	    echo '<tr><td colspan="5">';
                    	    echo 'No Milestones Found.';
                    	    echo '</td></tr>';
                    	}
                	?>
            	</tbody>
        	</table>        
    	</div>
    	
    	<div class="box-body">
    	<h3>Comments</h3>
        	<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            	<thead>
                	<tr>
                    	<th><?= __('Sr No.') ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('name', __('User Name')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('Clients.name', __('Date')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('start_date', __('Comments')); ?></th>
	                    <th class="actions no-sort"><?= $this->Paginator->sort('end_date', __('Coversheet Status')); ?></th>
	                </tr>
	            </thead>
            	<tbody>
                	<?php
                	$cnt = 1;
                	foreach ($comments as $comment):
                	?>
                		                <tr>
                		                    <td><?= $cnt ?></td>
                		                    <td><?= $comment->user['first_name'] . ' ' . $comment->user['last_name'] ?></td>
                		                    <td><?= (strtotime($comment->approval_request_date) != 0) ? date('Y-m-d', strtotime($comment->approval_request_date)):'' ?></td>
                		                    <td><?= h($comment->comment) ?></td>
                		                    <td><?= id_to_text($comment->status, projectCoversheetStatus())  ?></td>
                		                </tr>
                		                <?php
                		                $cnt ++;
                		                endforeach;
                	?>
            	</tbody>
        	</table>        
    	</div>
    	<?php //pr($to_be_approved);exit;?>
    	<?php echo $this->Form->create(NULL, ['class' => 'form-horizontal', 'id' => 'add_comment', 'name' => 'add_comment']); ?>
    	<div class="box-body">
          <h4><?= __('Comment')?></h4>
          <div class="col-sm-8" style="padding-left:0px;">
            <?php 
			echo $this->Form->textarea('comment', [
			        'class' => "form-control",
					'label' => false
        		]);
			?>
          </div>
           <?php if(empty($to_be_approved)) {
     	echo $this->Form->submit('Request for Approval', ['class' => 'btn btn-info']);
     } else {
     	echo '<div class="btn-group">';
     	echo $this->Form->button('Save', ['type' => 'submit', 'class' => 'btn btn-info', 'div' => false, 'name' => 'save']);
     	
     	echo $this->Form->button('Confirm', ['type' => 'submit', 'class' => 'btn btn-info', 'div' => false, 'name' => 'confirm']);
     	echo '</div>';
     }?>
        </div>
	</div>
    
      
    </form>
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
    	$("[data-mask]").inputmask();
        $("#start_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: false
        });
        $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
  	      	endDate: false
          });
      $('#add_project').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          name: {
              validators: {
                  notEmpty: {
                      message: 'The Project name is required'
                  }
              }
          },
          project_type_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Project type'
                  }
              }
          },
          department_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Department'
                  }
              }
          },
          sm_responsible: {
              validators: {
                  notEmpty: {
                      message: 'Please select Responsible Senior Manager'
                  }
              }
          },
          technology_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Technology'
                  }
              }
          },
          client_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Client'
                  }
              }
          },
          contact_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Contact'
                  }
              }
          },
          end_date: {
              validators: {
                  notEmpty: {
                      message: 'Please enter end date'
                  }
              }
          },
          size_in_man_months: {
              validators: {
                  notEmpty: {
                      message: 'Please enter size in man months'
                  }
              }
          },
          size_in_man_months: {
              validators: {
                  notEmpty: {
                      message: 'Please enter size in man months'
                  }
              }
          },
          effort_hrs: {
              validators: {
                  notEmpty: {
                      message: 'Please enter effort in hours'
                  }
              }
          },
          no_of_resources: {
              validators: {
                  notEmpty: {
                      message: 'Please enter no of resources'
                  }
              }
          },
          estimated_cost: {
              validators: {
                  notEmpty: {
                      message: 'Please enter estimated cost'
                  }
              }
          },
          currency_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select currency'
                  }
              }
          },
          amount: {
              validators: {
                  notEmpty: {
                      message: 'Please enter the cost amount'
                  }
              }
          },
          project_status_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select status'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_project.submit();
      });
  });
  </script>