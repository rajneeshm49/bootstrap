<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Seat Cost') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'seat_costs', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_seatcost', 'name' => 'add_seatcost', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3">Department</label>
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
			        'name' => 'year',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Year',
					'label' => false,
					'tabindex' => '9',
			  		'value' => date('Y')
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
      $("#year").datepicker({
        format: 'yyyy',
        autoclose: true,
        endDate: false,
        viewMode: "years", 
        minViewMode: "years"
      });
     $('#add_seatcost').formValidation({
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
                  },
			      remote: {
			          url: jsBaseURL + '/admin/seat_costs/validate_unique_seatcost/',
			          data: function(validator) {
                          return {
                              department_id: validator.getFieldElements('department_id').val()
                          };
                      },
//                         data: {
//                           department_  
//                         },
			          message: 'Seat Cost already exists for the mentioned year',
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
          document.add_seatcost.submit();
      });
  });
  </script>
