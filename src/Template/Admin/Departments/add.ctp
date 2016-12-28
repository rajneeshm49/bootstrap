<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Department') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'departments', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_department', 'name' => 'add_department', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Department Name</label>
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
			<p class="help-block with-errors"></p>
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
      $('#add_department').formValidation({
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
			          message: 'Department already exists',
			      }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_department.submit();
      });
  });
  </script>
