<?php $status = status_master();?>
<div class="box box-info">
    <div class="box-header with-border">
     	<h3 class="box-title"><?= __('Edit Department') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($department, ['url' => ['controller' => 'departments', 'action' => 'edit'], 'class' => 'form-horizontal', 'id' => 'edit_department', 'name' => 'edit_department', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('Department.department_name','Department Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('department_name', [
					'type' => "text",
			        'id' => 'inputDepartmentName3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Department Name',
					'label' => false,
					'tabindex' => '1',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputRole3"><?php 
				echo $this->Form->label('Department.is_active','Status')?></label>
          <div class="col-sm-8">
          	<?php 
				echo $this->Form->select('is_active',$status,[
						'class' => 'form-control',
						'tabindex' => '6',
						'required' => 'required',
						'label' => false,
						'id' => 'inputRole3'
            		]
            );?>
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
  <?= $this->Html->script('Admin/pwstrength-bootstrap.min.js') ?>
<style>
    .progress-bar{
      min-width: 26%;
    }
  </style>
  <script>
    $(document).ready(function() {
      $("[data-mask]").inputmask();
      $('#edit_department').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          department_name: {
              validators: {
                  notEmpty: {
                      message: 'The department name is required'
                  },
			      remote: {
			          url: jsBaseURL + '/admin/departments/validate_unique_department/',
			          data: {
				          	id: <?php echo $department->id ?>
			          },
			          message: 'Department already exists',
			      }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_department.submit();
      });
  });
  </script>
