<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Technology') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($technology, ['url' => ['controller' => 'technologies', 'action' => 'edit'], 'class' => 'form-horizontal', 'id' => 'edit_technology', 'name' => 'edit_technology', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Technology Name</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('technology_name', [
					'type' => "text",
			        'id' => 'inputTechnologyName3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Technology Name',
					'label' => false,
					'tabindex' => '1',
					'data-fv-remote-validkey' => true
        		]);
			?>
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
      $('#edit_technology').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	technology_name: {
              validators: {
                  notEmpty: {
                      message: 'The technology name is required'
                  },
			      remote: {
			          url: jsBaseURL + '/admin/technologies/validate_unique_technology/',
			          data: {
			        	  id: <?php echo $technology->id ?>
			          },
			          message: 'Technology already exists',
			      }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_technology.submit();
      });
  });
  </script>
