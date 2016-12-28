<?php $priority_status = priorityStatus(); ?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Project Tasks') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'project_tasks', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_project_tasks', 'name' => 'add_project_tasks']); ?>
      <div class="box-body">
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'proj_task_department_id',
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
			        'id' => 'proj_task_project_id',
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
          <label class="col-sm-2 control-label"><?= __('Phase')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('phase_id', [
					'type' => "select",
			        'id' => 'proj_task_phase_id',
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
          <label class="col-sm-2 control-label"><?= __('Milestone')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('milestone_id', [
					'type' => "select",
			        'id' => 'proj_task_milestone_id',
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
          <label class="col-sm-2 control-label" for="inputName3"><?= __('Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'id' => 'inputName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Project Task Name',
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department Task')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('department_task_id', [
					'type' => "select",
					'id' => 'proj_task_department_task_id',
			        'class' => "form-control",
					'options' => $department_tasks,
					'empty' => ' ( Choose One )',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
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
          <label class="col-sm-2 control-label"><?= __('Priority')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('priority_id', [
					'type' => "select",
			        'class' => "form-control",
					'options' => $priority_status,
					'empty' => ' ( Choose One )',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Module')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('module_id', [
					'type' => "select",
			        'class' => "form-control",
				    'id' => 'proj_task_module_id',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Estimated Hours')?></label>
          <div class="col-sm-8">
            <?php 
    			echo $this->Form->input('estimated_hours', [
    					'type' => "number",
    			        'class' => "form-control",
    					'maxlength' => 50,
    					'placeholder' => 'Estimated Hours',
    					'label' => false,
    					'tabindex' => '3',
    					'min' => 1
            		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Task Status')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('task_status_id', [
					'type' => "select",
			        'class' => "form-control",
					'options' => $task_statuses,
					'empty' => ' ( Choose One )',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Notes')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->textarea('notes', array('class'=>'ckeditor form-control','placeholder'=> 'Notes')); ?>
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
      $('#add_project_tasks').formValidation({
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
                      message: 'The project is required'
                  }
              }
          },
          name: {
              validators: {
                  notEmpty: {
                      message: 'The project task name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/project_tasks/validate_unique_project_task/',
                      message: 'Project task already exists',
                  }
              }
          },
          department_task_id: {
              validators: {
                  notEmpty: {
                      message: 'The department task is required'
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
          estimated_hours: {
              validators: {
                  notEmpty: {
                      message: 'The estimated hours is required'
                  }
              }
          },
          project_status_id: {
              validators: {
                  notEmpty: {
                      message: 'The project status is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_project_tasks.submit();
      });
  });
  </script>
