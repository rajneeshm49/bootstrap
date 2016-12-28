<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Resource Salary Level') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($salary, ['class' => 'form-horizontal', 'id' => 'edit_salary', 'name' => 'edit_salary', 'data-toggle' => 'validator']); ?>
    
      <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">User</label>
          <div class="col-sm-8">
             <?php 
				echo $this->Form->select('user_id',$users,[
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
          <label class="col-sm-2 control-label" for="inputLastName3">Increment Date</label>
          <div class="col-sm-8">
            <div class="input-group">
          	<div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
          	<?php 
			  echo $this->Form->input('increment_date', [
					'type' => "text",
			        'id' => 'increment_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Increment Date',
					'label' => false,
					'tabindex' => '9',
			  		'value' => date('Y-m-d')
        		]);
			?>
		  </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputUserName3">Amount</label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('amount', [
					'type' => "text",
			        'id' => 'inputUserName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Amount',
					'label' => false,
					'tabindex' => '3',
					'min' => 1
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputEmail3">Role</label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->select('role_id',$roles,[
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
          <label class="col-sm-2 control-label" for="inputPassword3">Designation</label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->select('designation_id',$designations,[
						'class' => 'form-control',
						'tabindex' => '6',
						'label' => false,
						'empty' => '(choose one)',
						'id' => 'inputRole3'
            		]
            );?>
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
      $("#increment_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: false
        });
      $('#edit_salary').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	user_id: {
                validators: {
                    notEmpty: {
                        message: 'User is required'
                    }
                }
            },
            increment_date: {
                validators: {
                    notEmpty: {
                        message: 'Increment Date is required'
                    }
                }
            },
            amount: {
                validators: {
                    numeric: {
                  	  message: 'Amount should be numeric'
                    },
                    notEmpty: {
                        message: 'Amount is required'
                    }
                }
            },
            role_id: {
                validators: {
                    notEmpty: {
                        message: 'Role is required'
                    }
                }
            },
            designation_id: {
                validators: {
                    notEmpty: {
                        message: 'Designation is required'
                    }
                }
            }
          }
      }).on('success.form.fv', function(e) {
          document.edit_salary.submit();
      });
  });
  </script>
