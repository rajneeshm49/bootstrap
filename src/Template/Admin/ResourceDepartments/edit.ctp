<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><?= __('Edit Resource Department') ?></h3>
      <div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($resource_department, ['method' => 'POST', 'class' => 'form-horizontal', 'id' => 'edit_resource_department', 'name' => 'edit_resource_department']); ?>
      <div class="box-body">
        <div class="form-group">
          <input type="hidden" id="user_id" name="user_id" value="<?=$resource_department->user_id?>"></input>
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('User')?></label>
          <div class="col-sm-8">
           	<?php 
				echo $this->Form->input('user_name', [
						'type' =>'text',
						'class' => 'form-control',
						'tabindex' => '1',
						'label' => false,
						'id' => 'inputUserDpt3',
						'placeholder' => 'Please enter User\'s name',
						'value' => $resource_department->user['first_name'] . ' ' . $resource_department->user['last_name']
            		]
            );?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputDepartmentName3"><?= __('Department Name')?></label>
          <div class="col-sm-8">
           	<?php 
				echo $this->Form->input('department_id', [
						'type' => 'select',
						'class' => 'form-control',
						'tabindex' => '2',
						'options' => $departments,
						'label' => false,
						'empty' => '(choose one)',
						'id' => 'inputDepartment3'
            		]
            );?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Allocate (in %)')?></label>
          <div class="col-sm-8">
           	<?php 
				echo $this->Form->input('percentage_allocate', [
						'type' => "number",
				        'id' => 'inputUserName3',
				        'class' => "form-control",
						'maxlength' => 50,
						'step' => '0.1',
						'max' => 100,
						'placeholder' => 'Allocate(in %)',
						'label' => false,
						'tabindex' => '3',
						'min' => 1,
						'max' =>100
	        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Department Head')?></label>
          <div class="col-sm-8">
           	<?php 
				echo $this->Form->input('department_head', [
      				'type' => "checkbox",
      				'class' => 'no-margin-left',
      				'div' => false, 
      				'label' =>false
      		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Default Department')?></label>
          <div class="col-sm-8">
           	<?php 
				echo $this->Form->input('default_department', [
      				'type' => "checkbox",
					'id' => 'default_department',
      				'class' => 'no-margin-left',
      				'div' => false, 
      				'label' =>false
      		]);
			?>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
      <?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-info pull-right'])?>
      </div>
    <?= $this->Form->end();?>
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
      $('#edit_resource_department').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          user_name: {
              validators: {
                  notEmpty: {
                      message: 'The User name is required'
                  }
              }
          },

          department_id: {
              validators: {
                  notEmpty: {
                      message: 'The Department name is required'
                  }
              }
          },

          percentage_allocate: {
              validators: {
                  notEmpty: {
                      message: 'Please assign allocation between 0(greater than) and 100(inclusive) '
                  }
              }
          }
        
      }
      }).on('success.form.fv', function(e) {
          document.edit_resource_department.submit();
      });
  });
  </script>