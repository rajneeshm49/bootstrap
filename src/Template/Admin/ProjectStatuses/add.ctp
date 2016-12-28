<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Project Status') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'project_statuses', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_project_status', 'name' => 'add_project_status', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Status</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('status', [
					'type' => "text",
					'id' => 'inputStatus3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Status',
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
      $('#add_project_status').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	status: {
              validators: {
                  notEmpty: {
                      message: 'The project status is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/project_statuses/validate_unique_project_status/',
                      message: 'Project status already exists',
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_project_status.submit();
      });
  });
  </script>
