<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Role') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'roles', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_role', 'name' => 'add_role', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Role Name</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('role_name', [
					'type' => "text",
					'id' => 'inputRoleName3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Role Name',
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
      $('#add_role').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	role_name: {
              validators: {
                  notEmpty: {
                      message: 'The role name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/roles/validate_unique_role/',
                      message: 'Role already exists',
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_role.submit();
      });
  });
  </script>
