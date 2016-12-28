<?php $priority_status = priorityStatus(); ?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Project Task') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($project_task, ['class' => 'form-horizontal', 'id' => 'edit_project_task', 'name' => 'edit_project_task', 'data-toggle' => 'validator']); ?>
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
			        'options' => $project_phases,
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
			        'options' => $milestones,
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
				        'value' => date('Y-m-d', strtotime($project_task->start_date))
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
						'tabindex' => '8',
                        'value' => (!empty($project_task->end_date))?date('Y-m-d', strtotime($project_task->end_date)):''
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
				    'options' => $project_modules,
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
  <div class="box">
    <div class="box-header">
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
                <?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'.'Add Resources'), ['controller'=>'project_task_details','action' => 'add',$project_task->id], ['class' => 'btn btn-success pull-right', 'title' => 'Add', 'escape'=>false]) ?>
            </div>
        </form>
    </div>
    <div class="box-body">
    <?php if($project_task['project_task_details']){?>
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th><?= __('Resource'); ?></th>
                    <th><?= __('Estimated Hours'); ?></th>
                    <th><?= __('Actual Hours'); ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $cnt = 1;
                    foreach ($project_task['project_task_details'] as $project_task_resource): 
                ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= h(id_to_text($project_task_resource->user_id, $users))?></td>
                        <td><?= h($project_task_resource->estimated_hours) ?></td>
                        <td><?= h($project_task_resource->actual_hours) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(null, array_merge(['controller'=>'project_task_details','action' => 'edit', $project_task_resource->id,$project_task->id]), ['class' => 'fa fa-pencil']) ?>
                            <?= $this->Html->link(null, array_merge(['controller'=>'project_task_details','action' => 'delete', $project_task_resource->id,$project_task->id]), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete # {0}?', $project_task_resource->id)]) ?>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
                   endforeach; 
                ?>
            </tbody>
        </table>
        <?php }?>
    </div>
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
      $('#edit_project_task').formValidation({
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
                      data: {
				          	id: <?php echo $project_task->id ?>
			          },
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
          document.edit_project_task.submit();
      });
  });
  </script>
       