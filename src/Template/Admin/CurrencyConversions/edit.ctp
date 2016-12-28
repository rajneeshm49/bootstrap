<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Convert currency (Edit)') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div>
    
    <!-- form start -->
    <?php echo $this->Form->create($conversion, ['class' => 'form-horizontal', 'id' => 'edit_currency_conversion', 'name' => 'edit_currency_conversion']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Currency')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('currency_id', [
					'type' => "select",
					'id' => 'conversion_currency_id',
			        'class' => "form-control",
					'options' => $all_currencies,
					'empty' => '( Choose One )',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
			<p class="help-block with-errors"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputinr3"><?= __('To INR') ?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('inr', [
					'type' => "text",
					'id' => 'conversion_to_inr',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '2'
        		]);
			?>
			<p class="help-block with-errors"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('Date')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('update_date', [
					'type' => "text",
			        'id' => 'update_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Date',
					'label' => false,
					'tabindex' => '3',
			  		'value' => date('Y-m-d', strtotime($conversion->update_date))
        		]);
			?>
            </div>
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
      $("#update_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
	      endDate: false
        });
      $('#edit_currency_conversion').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          currency_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select currency'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_currency_conversion.submit();
      });
  });
  </script>