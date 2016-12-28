<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Receipt') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['controller' => 'milestones', 'action' => 'invoice_edit',$milestone_id], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'receipts', 'action' => 'add',$milestone_id], 'class' => 'form-horizontal', 'id' => 'add_receipts', 'name' => 'add_receipts']); ?>
      <div class="box-body">
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Receipt Amount')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('receipt_amount', [
					'type' => "text",
			        'class' => "form-control",
					'min' => 1,
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="start_date"><?= __('Receipt Date')?></label>
          <div class="col-sm-8">
           <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
				  echo $this->Form->input('receipt_date', [
						'type' => "text",
				        'id' => 'receipt_date',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Receipt Date',
						'label' => false,
						'tabindex' => '8',
				        'value' => date('Y-m-d')
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Remarks')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->textarea('remarks', array('class'=>'ckeditor form-control')); ?>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-info pull-right'])?>
      </div>
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
      $('#add_receipts').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          receipt_amount: {
              validators: {
                  notEmpty: {
                      message: 'The receipt amount is required'
                  }
              }
          },
          receipt_date: {
              validators: {
                  notEmpty: {
                      message: 'The receipt date is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_receipts.submit();
      });
  });
  </script>
