<?php $billable_status = array('1'=>'Yes','0'=>'No');?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Allocate Resource') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'resource_allocations', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_resource_allocations', 'name' => 'add_resource_allocations']); ?>
      <div class="box-body">
      	 <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'resource_allocation_department_id',
			        'class' => "form-control",
					'options' => $departments,
					'empty' => ' ( Choose One )',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Project')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('project_id', [
					'type' => "select",
			        'id' => 'resource_allocation_project_id',
			        'class' => "form-control",
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputName3"><?= __('Resource')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('user_id', [
					'type' => "select",
			        'id' => 'resource_allocation_user_id',
			        'class' => "form-control",
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Role')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('role_id', [
					'type' => "select",
			        'empty' => ' ( Choose One )',
			        'class' => "form-control",
					'maxlength' => 50,
			        'options' => $roles,
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="start_date"><?= __('Start Date')?></label>
          <div class="col-sm-8">
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
						'tabindex' => '8',
				        'value' => date('Y-m-d')
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="end_date"><?= __('End Date')?></label>
          <div class="col-sm-8">
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
						'tabindex' => '8'
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputAmount3"><?= __('Percentage Allocate')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('allocated_percent', [
						'type' => "number",
				        'class' => "form-control",
						'step' => '0.1',
						'max' => 100,
						'placeholder' => 'Allocate(in %)',
						'label' => false,
						'tabindex' => '3',
						'min' => 0
	        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Hours')?></label>
          <div class="col-sm-8">
            <?php 
    			echo $this->Form->input('hours', [
    					'type' => "text",
    			        'class' => "form-control",
    					'maxlength' => 50,
    					'placeholder' => 'Hours',
    					'label' => false,
    					'tabindex' => '3',
    					'min' => 1
            		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Reporting to')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('reporting_to', [
					'type' => "select",
			        'id' => 'resource_allocation_report_to',
			        'class' => "form-control",
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Billable')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('billable', [
					'type' => "select",
			        'class' => "form-control",
			        'options' => $billable_status,
					'maxlength' => 50,
			        'empty' => ' ( Choose One )',
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Skills')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('skills', [
					'type' => "textarea",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-info pull-right'])?>
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
      var start = new Date();
      var end = new Date(new Date().setYear(start.getFullYear()+1));
    	
      $("#start_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: end
      }).on('changeDate', function(){
          var someDate = new Date($(this).val());
          someDate.setDate(someDate.getDate() + 1); 
      	  $('#end_date').datepicker('setStartDate', someDate);
      	  $('#add_resource_allocations').formValidation('revalidateField', 'start_date');
  	  });
      $("#end_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
	      endDate: end
      }).on('changeDate', function(){
          var someDate = new Date($(this).val());
          someDate.setDate(someDate.getDate() - 1); 
          $('#start_date').datepicker('setEndDate', someDate);
          $('#add_resource_allocations').formValidation('revalidateField', 'end_date');
      });
      $('#add_resource_allocations').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          department_id: {
              validators: {
                  notEmpty: {
                      message: 'The department name is required'
                  }
              }
          },
          project_id: {
              validators: {
                  notEmpty: {
                      message: 'The project name is required'
                  }
              }
          },
          user_id: {
              validators: {
                  notEmpty: {
                      message: 'The resource is required'
                  }
              }
          },
          role_id: {
              validators: {
                  notEmpty: {
                      message: 'The role is required'
                  }
              }
          },
          start_date: {
              validators: {
                  notEmpty: {
                      message: 'The start date is required'
                  }
              }
          },
          end_date: {
              validators: {
                  notEmpty: {
                      message: 'The end date is required'
                  }
              }
          },
          allocated_percent: {
              validators: {
                  notEmpty: {
                      message: 'The allocation percentage is required'
                  },
                  numeric: {
                	  message: 'Allocation percentage should be numeric'
                  }
              }
          },
          hours: {
              validators: {
                  notEmpty: {
                      message: 'Hours is required'
                  }
              }
          },
          reporting_to: {
              validators: {
                  notEmpty: {
                      message: 'Reporting to is required'
                  }
              }
          },
          billable: {
              validators: {
                  notEmpty: {
                      message: 'Billable is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_resource_allocations.submit();
      });
  });
  </script>
