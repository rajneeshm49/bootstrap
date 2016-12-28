<div class="box box-info">
    <div class="box-header with-border">
     	<h3 class="box-title"><?= __('Edit Currency') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div>
    
    <!-- form start -->
    <?php echo $this->Form->create($currency, ['class' => 'form-horizontal', 'id' => 'edit_currency', 'name' => 'edit_currency']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Currency')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'id' => 'inputName3',
			        'class' => "form-control",
					'maxlength' => 3,
					'placeholder' => ' 3 digit currency code',
					'label' => false,
					'tabindex' => '1'
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
      $('#edit_currency').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          name: {
              validators: {
                  notEmpty: {
                      message: 'The currency is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/currencies/validate_unique_currency/',
                      data: {
                    	  id: <?php echo $currency->id ?>
                      },
                      message: 'Currency already exists',
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_currency.submit();
      });
  });
  </script>