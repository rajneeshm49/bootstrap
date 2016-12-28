<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Create Issue') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create(null, ['class' => 'form-horizontal', 'id' => 'create_issue', 'name' => 'create_issue', 'enctype' => 'multipart/form-data']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Project Name')?></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('project_id', [
					'type' => "select",
					'id' => 'issue_project_id',
			        'class' => "form-control",
					'label' => false,
					'empty' => '(Choose one)',
					'options' => $project_names,
					'tabindex' => '1'
        		]);
			?>
          </div>
          </div>
          <hr>
          <div class="form-group">          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Reported Date')?></label>
          <div class="col-sm-2 div-238px">
          <div class="input-group">
          <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            <?php 
			echo $this->Form->input('reported_date', [
					'type' => "text",
					'id' => 'issue_reported_date',
			        'class' => "form-control",
					'placeholder' => 'Reported Date',
					'label' => false,
					'tabindex' => '2'
        		]);
			?>
          </div>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Severity')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('severity', [
					'type' => "select",
					'options' => $lookup_severity,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '3'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Platform')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('platform', [
					'type' => "text",
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Platform',
					'label' => false,
					'tabindex' => '4'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
        <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Issue Type')?></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('issue_type', [
					'type' => "select",
					'empty' => '(Choose one)',
					'options' => issueTypes(),
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '5'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('OS')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('os', [
					'type' => "select",
			        'class' => "form-control",
					'options' => operatingSystem(),
					'empty' => '(Choose one)',
					'label' => false,
					'tabindex' => '6'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('OS Version')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
          
            <?php 
			echo $this->Form->input('os_version', [
					'type' => "text",
					'maxlength' => 100,
					'placeholder' => 'Operating System version',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '7'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
        <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Module')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			     echo $this->Form->input('module', [
					'type' => "select",
					'empty' => '(Choose one)',
					'options' => $modules,
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '5'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Priority')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('priority', [
					'type' => "select",
					'options' => $lookup_priority,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '9'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Reproducability')?></label>
          <div class="col-sm-2 div-238px">
          
            <?php 
			echo $this->Form->input('reproducibility', [
					'type' => "select",
					'options' => $lookup_reproducibility,
					'empty' => '(Choose one)',
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '10'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
        <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Public visiblity')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('public_visibility', [
					'type' => "select",
			        'class' => "form-control",
					'empty' => '(Choose one)',
					'options' => [1 => 'Yes', 0 => 'No'],
					'label' => false,
					'tabindex' => '11'
        		]);
			?>
          </div>
          
          <label class="col-sm-2 control-label label-125px" for="inputFirstName3"><?= __('Estimated time')?></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('estimated_hours', [
					'type' => "number",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '12'
        		]);
			?>
          </div>
        </div>
        <hr>
        
        <div class="form-group">
          <label class="col-sm-2 control-label label-125px"><?= __('Assign To')?></label>
          <div class="col-sm-2 div-238px">
            <?php 
			echo $this->Form->input('assign_to', [
					'type' => "select",
			        'class' => "form-control",
					'empty' => '(Empty)',
					'id' => 'issue_assign_to',
					'label' => false,
					'tabindex' => '14'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label label-125px"><?= __('Summary')?></label>
          <div class="col-sm-6">
            <?php 
			echo $this->Form->input('summary', [
					'type' => "text",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '15'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label label-125px"><?= __('Description')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-6">
            <?php 
			echo $this->Form->input('description', [
					'type' => "textarea",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '16'
        		]);
			?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label label-125px"><?= __('Steps to reproduce')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-6">
            <?php 
			echo $this->Form->input('steps', [
					'type' => "textarea",
			        'class' => "form-control",
					'label' => false,
					'tabindex' => '17'
        		]);
			?>
          </div>
        </div>
        
       <div class="container form-group">
    	<div class="row">
		    <label class="col-sm-2 control-label label-125px"><?= __('Upload File')?><span class="opt_label">&nbsp;(Optional)</span></label>
		        <div class="col-sm-6">  
		            <!-- image-preview-filename input [CUT FROM HERE]-->
		            
		            <div class="input-group image-preview">
		                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
		                <span class="input-group-btn">
		                    <!-- image-preview-clear button -->
		                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
		                        <span class="glyphicon glyphicon-remove"></span> Clear
		                    </button>
		                    <!-- image-preview-input -->
		                    <div class="btn btn-default image-preview-input">
		                        <span class="glyphicon glyphicon-folder-open"></span>
		                        <span class="image-preview-input-title">Browse</span>
		                        <input type="file" accept="image/png, image/jpeg, image/gif" name="upload_file"/> <!-- rename it -->
		                    </div>
		                </span>
		            </div><!-- /input-group image-preview [TO HERE]--> 
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
      $("#issue_reported_date").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          endDate: false
      }).on('changeDate', function(e) {
            $('#create_issue').formValidation('revalidateField', 'reported_date');
      });
      
      $('#create_issue').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          project_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Project name'
                  }
              }
          },
          reported_date: {
              validators: {
                  notEmpty: {
                      message: 'Please enter Reported date'
                  }
              }
          },
          issue_type: {
              validators: {
                  notEmpty: {
                      message: 'Please select Issue type'
                  }
              }
          },
          reproducibility: {
              validators: {
                  notEmpty: {
                      message: 'Please enter reproducability'
                  }
              }
          },
          estimated_hours: {
              validators: {
                  notEmpty: {
                      message: 'Please enter estimated hours'
                  }
              }
          },
          assign_to: {
              validators: {
                  notEmpty: {
                      message: 'Please assign the issue to someone'
                  }
              }
          },
          summary: {
              validators: {
                  notEmpty: {
                      message: 'Please enter summary'
                  }
              }
          },
          issue_status_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Issue status'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.create_issue.submit();
      });
  });
  </script>