<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Department Task') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($department_task, ['class' => 'form-horizontal', 'id' => 'edit_department_task', 'name' => 'edit_department_task', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-8">
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
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Task')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('task_id', [
					'type' => "select",
			        'class' => "form-control",
			        'options' => $tasks,
			        'empty' => ' ( Choose One )',
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
					'placeholder' => 'Department Task Name',
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Description')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->textarea('description', array('class'=>'ckeditor form-control','placeholder'=> 'Description')); ?>
          </div>
        </div><!-- /.box-footer -->
      <div class="box-footer">
        <?= $this->Form->button(__('Save'), [
                            				'label'=>'Save',
                            				'value'=>'Save',
                                            'class' => "btn btn-info pull-right",
                            				'id' => 'btnSave',
                            				'title' => 'Save',
                            				'div'=> false,
                            				'type' => 'submit'
                            		      ]
                            		  );?>
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
      $('#edit_department_tasks').formValidation({
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
          name: {
              validators: {
                  notEmpty: {
                      message: 'The department task name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/department_tasks/validate_unique_department_task/',
                      message: 'Department task already exists',
                  }
              }
          },
          task_id: {
              validators: {
                  notEmpty: {
                      message: 'The task is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_department_tasks.submit();
      });
  });
  </script>
        