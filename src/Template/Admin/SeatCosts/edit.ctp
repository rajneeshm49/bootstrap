<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Seat Cost') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($seatcost, ['class' => 'form-horizontal', 'id' => 'edit_seatcost', 'name' => 'edit_seatcost', 'data-toggle' => 'validator']); ?>
    
      <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">User</label>
          <div class="col-sm-8">
             <?php 
				echo $this->Form->select('department_id',$departments,[
						'class' => 'form-control',
						'tabindex' => '6',
						'label' => false,
						'empty' => '(choose one)',
						'id' => 'inputRole3'
            		]
            );?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputLastName3">Year</label>
          <div class="col-sm-8">
            <div class="input-group">
          	<div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
          	<?php 
			  echo $this->Form->input('year', [
					'type' => "text",
			        'id' => 'year',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Year',
					'label' => false,
					'tabindex' => '9'
        		]);
			?>
		  </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputUserName3">Cost</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('cost', [
					'type' => "text",
			        'id' => 'inputUserName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Cost',
					'label' => false,
					'tabindex' => '3',
					'min' => 1
        		]);
			?>
          </div>
        </div><!-- /.box-body -->
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
      $("#year").datepicker({
          format: 'yyyy',
          autoclose: true,
          endDate: false,
          viewMode: "years", 
          minViewMode: "years"
        });
      $('#edit_seatcost').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	department_id: {
                validators: {
                    notEmpty: {
                        message: 'Department is required'
                    }
                }
            },
            year: {
                validators: {
                    notEmpty: {
                        message: 'Year is required'
                    }
                }
            },
            cost: {
                validators: {
                    numeric: {
                  	  message: 'Cost should be numeric'
                    },
                    notEmpty: {
                        message: 'Cost is required'
                    }
                }
            }
          }
      }).on('success.form.fv', function(e) {
          document.edit_seatcost.submit();
      });
  });
  </script>
