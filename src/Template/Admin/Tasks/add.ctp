<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Task') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'tasks', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_task', 'name' => 'add_task', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Task Name</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('task_name', [
					'type' => "text",
			        'id' => 'inputTaskName3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Task Name',
					'label' => false,
					'tabindex' => '1',
					'data-fv-remote-validkey' => true
        		]);
			?>
			<p class="help-block with-errors"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('Task.description','Description')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
          	<?php echo $this->Form->textarea('description', array('class'=>'ckeditor form-control','placeholder'=> 'Description')); ?>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
        <button class="btn btn-info pull-right" type="submit">Submit</button>
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
      $('#add_task').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	task_name: {
              validators: {
                  notEmpty: {
                      message: 'The task name is required'
                  },
			      remote: {
			          url: jsBaseURL + '/admin/tasks/validate_unique_task/',
			          message: 'Task already exists',
			      }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_task.submit();
      });
  });
  </script>
