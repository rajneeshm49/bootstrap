<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Invoice') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'invoice_index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($invoice, ['class' => 'form-horizontal', 'id' => 'edit_invoice', 'name' => 'edit_invoice', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputName3"><?= __('Invoice No')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('invoice_no', [
					'type' => "number",
			        'id' => 'inputName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Invoice Number',
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="start_date"><?= __('Invoice Date')?></label>
          <div class="col-sm-8">
           <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
				  echo $this->Form->input('invoice_date', [
						'type' => "text",
				        'id' => 'invoice_date',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Invoice Date',
						'label' => false,
						'tabindex' => '8',
				        'value' => (!empty($invoice->invoice_date)) ? date('Y-m-d', strtotime($invoice->invoice_date)):''
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputAmount3"><?= __('Invoice Amount')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('invoice_amount', [
					'type' => "text",
			        'id' => 'inputAmount3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Invoice Amount',
					'label' => false,
					'tabindex' => '3',
					'min' => 1
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Remarks')?></label>
          <div class="col-sm-8">
            <?php echo $this->Form->textarea('invoice_remarks', array('class'=>'ckeditor form-control','placeholder'=> 'Remarks')); ?>
          </div>
        </div>
      </div><!-- /.box-footer -->
      <div class="box-footer">
        <?= $this->Form->button(__('Save'), [
                            				'label'=>'Save',
                            				'value'=>'Save',
                                            'class' => "btn btn-info pull-right",
                            				'id' => 'btnSave',
                            				'title' => 'Save',
                            				'div'=> false,
                            				'type' => 'submit'
                            		      ]
                            		  );?>
      </div>
    </form>
  </div>
  <?php if($invoice->invoice_status != 0){?>
   <div class="box">
    <div class="box-header">
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
                <?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'.'Add Receipts'), ['controller'=>'receipts','action' => 'add',$invoice->id], ['class' => 'btn btn-success pull-right', 'title' => 'Add', 'escape'=>false]) ?>
            </div>
        </form>
    </div>
    <div class="box-body">
    <?php if($invoice['receipts']){?>
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th><?= __('Milestone'); ?></th>
                    <th><?= __('Receipt Amount'); ?></th>
                    <th><?= __('Receipt Date'); ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $cnt = 1;
                    foreach($invoice['receipts'] as $receipt){
                ?>
                    <tr>
                        <td><?= $cnt; ?></td>
                        <td><?= h($invoice->name); ?></td>
                        <td><?= h($receipt->receipt_amount); ?></td>
                        <td><?= h(date('Y-m-d', strtotime($receipt->receipt_date))); ?></td>
                        <td class="actions">
                            <?= $this->Html->link(null, array_merge(['controller'=>'receipts','action' => 'edit', $receipt->id,$invoice->id]), ['class' => 'fa fa-pencil']); ?>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
                    }
                ?>
            </tbody>
        </table>
        <?php }?>
    </div>
  </div> 
  <?php }?>
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
      $("#invoice_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
	      endDate: false
        });
      $('#edit_invoice').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          invoice_no: {
              validators: {
                  notEmpty: {
                      message: 'The invoice number is required'
                  }
              }
          },
          invoice_date: {
              validators: {
                  notEmpty: {
                      message: 'The invoice date is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_invoice.submit();
      });
  });
  </script>
 