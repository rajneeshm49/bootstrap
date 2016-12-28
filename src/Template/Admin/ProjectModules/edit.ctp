<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Project Module') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($project_module, ['class' => 'form-horizontal', 'id' => 'edit_project_modules', 'name' => 'edit_project_modules', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
      	<div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Department')?></label>
          <div class="col-sm-8">
            <?php 
				echo $this->Form->input('department_id', [
					'type' => "select",
					'id' => 'module_department_id',
			        'class' => "form-control",
					'options' => $departments,
					'empty' => ' ( Choose One )',
					'maxlength' => 50,
					'label' => false,
					'tabindex' => '1'
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
			        'id' => 'module_project_id',
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
          <label class="col-sm-2 control-label" for="inputName3"><?= __('Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'id' => 'inputName3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Project Module Name',
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
          <label class="col-sm-2 control-label" for="joining_date"><?= __('From Date')?></label>
          <div class="col-sm-8">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('from_date', [
					'type' => "text",
			        'id' => 'from_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'From Date',
					'label' => false,
					'tabindex' => '10',
                    'value' => date('Y-m-d', strtotime($project_module->from_date))
        		]);
			?>
            </div>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('To Date')?></label>
          <div class="col-sm-8">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('to_date', [
					'type' => "text",
			        'id' => 'to_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'To Date',
					'label' => false,
					'tabindex' => '9',
                    'value' => (!empty($project_module->to_date))?date('Y-m-d', strtotime($project_module->to_date)):''
        		]);
			?>
            </div>
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
      $("#to_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: false
        });
        $("#from_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
  	      endDate: false
          });
      $('#edit_project_modules').formValidation({
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
          name: {
              validators: {
                  notEmpty: {
                      message: 'The project module name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/project_modules/validate_unique_project_module/',
                      data: {
                    	  id: <?php echo $project_module->id ?>
                      },
                      message: 'Project module already exists',
                  }
              }
          },
          project_id: {
              validators: {
                  notEmpty: {
                      message: 'The project is required'
                  }
              }
          },
          from_date: {
              validators: {
                  notEmpty: {
                      message: 'Please enter from date'
                  }
              }
          },
          to_date: {
              validators: {
                  notEmpty: {
                      message: 'Please enter to date'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_project_modules.submit();
      });
  });
  </script>
       