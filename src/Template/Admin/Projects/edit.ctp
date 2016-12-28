<div class="box box-info">
    <div class="box-header with-border">
     	<h3 class="box-title"><?= __('Edit Project') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div>
    
    <!-- form start -->
    <?php echo $this->Form->create($project, ['class' => 'form-horizontal', 'id' => 'edit_project', 'name' => 'edit_project']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Project')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Type')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('project_type_id', [
					'type' => "select",
					'options' => $project_types,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '2'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Description')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('description', [
					'type' => "textarea",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '3'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'project_dept_id',
					'options' => $departments,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '4'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('SM Responsible')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('sm_responsible', [
					'type' => "select",
					'id' => 'project_sm_resp',
					'options' => $sm_responsibles,
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '5'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Technology')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('technology_id', [
					'type' => "select",
					'options' => $technologies,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '6'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Client')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('client_id', [
					'type' => "select",
					'id' => 'project_client_id',
					'options' => $clients,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '7'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Contact')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('contact_id', [
					'type' => "select",
					'id' => 'project_contact_id',
					'options' => $contacts,
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '8'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('Start Date')?></label>
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
					'tabindex' => '9',
			  		'value' => date('Y-m-d', strtotime($project->start_date))
        		]);
			?>
            </div>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('End Date')?></label>
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
					'tabindex' => '10',
			  		'value' => date('Y-m-d', strtotime($project->end_date))
        		]);
			?>
            </div>
          </div>
          </div>
          
          <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Size in man months')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('size_in_man_months', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '11'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Effort in hours')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('effort_hrs', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '12'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('No of Resources')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('no_of_resources', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '13'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Estimated Cost')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('estimated_cost', [
					'type' => "text",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '14'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Currency')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('currency_id', [
					'type' => "select",
					'options' => $currencies,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '15'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Value')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('amount', [
					'type' => "number",
					'step' => '0.1',
			        'class' => "form-control",
					
					'label' => false,
					'tabindex' => '16'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Status')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('project_status_id', [
					'type' => "select",
					'options' => $project_status,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '17'
        		]);
			?>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
        <?= $this->Form->submit('Submit', ['class' => 'btn btn-info pull-right']);?>
      </div><!-- /.box-footer -->
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
        }).on('changeDate', function(){
        	var someDate = new Date($(this).val());
      	  	someDate.setDate(someDate.getDate() + 1); 
    	    $('#end_date').datepicker('setStartDate', someDate);
    	    $('#edit_project').formValidation('revalidateField', 'start_date');
    	});
    	
        $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
  	      	endDate: false
          }).on('changeDate', function(){
			  var someDate = new Date($(this).val());
        	  someDate.setDate(someDate.getDate() - 1); 
      	      $('#start_date').datepicker('setEndDate', someDate);
      	      $('#edit_project').formValidation('revalidateField', 'end_date');
      	});
      	
      $('#edit_project').formValidation({
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
          start_date: {
              validators: {
                  notEmpty: {
                      message: 'Please enter project start date'
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
          document.edit_project.submit();
      });
  });
  </script>