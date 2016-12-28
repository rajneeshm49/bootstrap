<?php $status = status_master();?>
<div class="box box-info">
    <div class="box-header with-border">
     	<h3 class="box-title"><?= __('Edit Email Template') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php echo $this->Form->create($emailTemplate, ['url' => ['controller' => 'email_templates', 'action' => 'edit'], 'class' => 'form-horizontal', 'id' => 'edit_email_template', 'name' => 'edit_email_template', 'data-toggle' => 'validator']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.email_type','Email Type')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email_type', [
					'type' => "text",
			        'id' => 'inputEmailType3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Email Type',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.subject','Subject')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('subject', [
					'type' => "text",
			        'id' => 'inputSubject3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Subject',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.message','Message')?></label>
          <div class="col-sm-8">
          	<?php echo $this->Form->textarea('message', array('class'=>'ckeditor form-control','placeholder'=> 'Message')); ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.email_from','Email From')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email_from', [
					'type' => "text",
			        'id' => 'inputEmailFrom3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Email From',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.email_from_name','Email From Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email_from_name', [
					'type' => "text",
			        'id' => 'inputEmailFromName3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Email From Name',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.email_bcc','Email Bcc')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email_bcc', [
					'type' => "text",
			        'id' => 'inputEmailBcc3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Email Bcc',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?php 
				echo $this->Form->label('EmailTemplate.email_cc','Email Cc')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email_cc', [
					'type' => "text",
			        'id' => 'inputEmailCc3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Email Cc',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputRole3"><?php 
				echo $this->Form->label('EmailTemplate.is_active','Status')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
          	<?php 
				echo $this->Form->select('is_active',$status,[
						'class' => 'form-control',
						'tabindex' => '6',
						'required' => 'required',
						'label' => false,
						'id' => 'inputRole3'
            		]
            );?>
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
  <?= $this->Html->script('Admin/pwstrength-bootstrap.min.js') ?>
<style>
    .progress-bar{
      min-width: 26%;
    }
  </style>
  <script>
    $(document).ready(function() {
      $("[data-mask]").inputmask();
      $('#edit_email_template').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          email_type: {
              validators: {
                  notEmpty: {
                      message: 'Email type is required'
                  }
              }
          }
          subject: {
              validators: {
                  notEmpty: {
                      message: 'Subject is required'
                  }
              }
          }
          message: {
              validators: {
                  notEmpty: {
                      message: 'Message is required'
                  }
              }
          }
          email_from: {
              validators: {
                  notEmpty: {
                      message: 'Email from is required'
                  }
              }
          }
          email_from_name: {
              validators: {
                  notEmpty: {
                      message: 'Email from name is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_email_template.submit();
      });
  });
  </script>