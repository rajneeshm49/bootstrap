<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add Milestone') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'milestones', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_milestone', 'name' => 'add_milestone']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <input type="hidden" id="project_start_date">
      	  <input type="hidden" id="project_end_date">
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'milestone_department_id',
			        'class' => "form-control",
					'options' => $departments,
					'empty' => ' ( Choose One )',
					'label' => false,
					'tabindex' => '1',
				    'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Project')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('project_id', [
					'type' => "select",
			        'id' => 'milestone_project_id',
			        'class' => "form-control",
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Client')?></label>
          <div class="col-sm-8">
            <?php 
			   echo $this->Form->input('client_id', [
					'type' => "text",
			        'id' => 'milestone_client_id',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '3',
			   		'disabled' => true,
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputName3"><?= __('Milestone Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'id' => 'inputName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Milestone Name',
					'label' => false,
					'tabindex' => '3',
					'data-fv-remote-validkey' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Description')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->textarea('description', array('class'=>'ckeditor form-control','placeholder'=> 'Description')); ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="start_date"><?= __('Start Date')?></label>
          <div class="col-sm-8">
           <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
				  echo $this->Form->input('start_date', [
						'type' => "text",
				        'id' => 'start_date',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Start Date',
						'label' => false,
						'tabindex' => '8',
				        'value' => date('Y-m-d')
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="end_date"><?= __('End Date')?></label>
          <div class="col-sm-8">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
				  echo $this->Form->input('end_date', [
						'type' => "text",
				        'id' => 'end_date',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'End Date',
						'label' => false,
						'tabindex' => '8'
	        		]);
			  ?>
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputAmount3"><?= __('Milestone Currency')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('currency', [
					'type' => "text",
			        'id' => 'inputAmount3',
			        'class' => "form-control",
			        'id' => 'milestone_currency_id',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '3',
				    'readonly' => true
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputAmount3"><?= __('Milestone Amount')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('amount', [
					'type' => "text",
			        'id' => 'inputAmount3',
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
          <label class="col-sm-2 control-label"><?= __('Status')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('milestone_status_id', [
					'type' => "select",
			        'class' => "form-control",
					'options' => $milestone_statuses,
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1',
				    'default' => id_to_text(1, $milestone_statuses)
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

      var start = new Date();
	  var end = new Date(new Date().setYear(start.getFullYear()+1));
      $("#start_date").datepicker({
        	format: 'yyyy-mm-dd',
        	autoclose: true,
        	endDate: end
      }).on('changeDate', function(){
      		var someDate = new Date($(this).val());
    	  	someDate.setDate(someDate.getDate() + 1); 
  	    	$('#end_date').datepicker('setStartDate', someDate);
  	    	$('#add_user').formValidation('revalidateField', 'start_date');
  	});

      $("#end_date").datepicker({
          	format: 'yyyy-mm-dd',
          	autoclose: true,
	      	endDate: end
        }).on('changeDate', function(){
			var someDate = new Date($(this).val());
      	  	someDate.setDate(someDate.getDate() - 1); 
    	     $('#start_date').datepicker('setEndDate', someDate);
    	});
  	
        $('#add_milestone').formValidation({
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
                     message: 'The department name is required'
                 }
              }
          },
          project_id: {
              validators: {
                  notEmpty: {
                      message: 'The project name is required'
                  }
              }
          },
          name: {
              validators: {
                  notEmpty: {
                      message: 'The milestone name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/milestones/validate_unique_milestone/',
                      message: 'Milestone already exists',
                  }
              }
          },
          start_date: {
              validators: {
                  notEmpty: {
                      message: 'The start date is required'
                  }
              }
          },
          end_date: {
              validators: {
                  notEmpty: {
                      message: 'The end date is required'
                  }
              }
          },
          amount: {
              validators: {
                  notEmpty: {
                      message: 'The amount is required'
                  },
                  numeric: {
                	  message: 'Milestone amount should be numeric'
                  }
              }
          },
          milestone_status_id: {
              validators: {
                  notEmpty: {
                      message: 'The milestone status is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_milestone.submit();
      });
  });
  </script>
