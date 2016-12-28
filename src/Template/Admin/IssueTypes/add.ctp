<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Issue Type') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'issue_types', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_issue_type', 'name' => 'add_issue_type', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Issue Type</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('type', [
					'type' => "text",
					'id' => 'inputIssueType3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Issue Type',
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
      $('#add_issue_type').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	type: {
              validators: {
                  notEmpty: {
                      message: 'The issue type is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/issue_types/validate_unique_issue_type/',
                      message: 'Issue Type already exists',
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_issue_type.submit();
      });
  });
  </script>