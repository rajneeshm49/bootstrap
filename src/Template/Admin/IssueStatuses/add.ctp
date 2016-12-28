<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Issue Status') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'issue_statuses', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_issue_status', 'name' => 'add_issue_status', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Issue Status</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('status', [
					'type' => "text",
					'id' => 'inputIssueStatus3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Issue Status',
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
      $('#add_issue_status').formValidation({
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
                      message: 'The issue status is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/issue_statuses/validate_unique_issue_status/',
                      message: 'Issue Status already exists',
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_issue_status.submit();
      });
  });
  </script>