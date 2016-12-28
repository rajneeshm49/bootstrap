<?php $priority_status = priorityStatus(); ?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Project Task Detail') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['controller' => 'project_tasks', 'action' => 'edit',$task_id], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($project_task_detail, ['class' => 'form-horizontal', 'id' => 'edit_project_task_details', 'name' => 'edit_project_task_details', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Resource')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('user_id', [
					'type' => "select",
			        'class' => "form-control",
					'options' => $resource_users_arr,
					'empty' => ' ( Choose One )',
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
      $('#edit_project_task_details').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	user_id: {
                validators: {
                    notEmpty: {
                        message: 'The user name is required'
                    }
                }
            },
            estimated_hours: {
                validators: {
                    notEmpty: {
                        message: 'The estimated hours is required'
                    }
                }
            }
        }
      }).on('success.form.fv', function(e) {
          document.edit_project_task_details.submit();
      });
  });
  </script>
       