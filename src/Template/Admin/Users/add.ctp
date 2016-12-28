<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Add User') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div>

	<?php echo $this->Form->create(null, ['url' => ['controller' => 'users', 'action' => 'add'], 'class' => 'form-horizontal', 'id' => 'add_user', 'name' => 'add_user']); ?>
    <div class="box-body">
      	<div class="row">
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputFirstName3"><?= __('First Name')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php 
					echo $this->Form->input('first_name', [
							'type' => "text",
					        'id' => 'inputFirstName3',
					        'class' => "form-control",
							'maxlength' => 100,
							'placeholder' => 'First Name',
							'label' => false,
							'tabindex' => '1'
		        		]);
					?>
		        </div>
        	</div>
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputLastName3"><?= __('Last Name')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php 
					echo $this->Form->input('last_name', [
							'type' => "text",
					        'id' => 'inputLastName3',
					        'class' => "form-control",
							'maxlength' => 50,
							'placeholder' => 'Last Name',
							'label' => false,
							'tabindex' => '2'
		        		]);
					?>
          		</div>
        	</div>
        </div>
        
        <div class="row">
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputUserName3"><?= __('Username')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php 
					echo $this->Form->input('username', [
							'type' => "text",
					        'id' => 'inputUserName3',
					        'class' => "form-control",
							'maxlength' => 50,
							'placeholder' => 'Username',
							'label' => false,
							'tabindex' => '3',
							'data-fv-remote-validkey' => true
		        		]);
					?>
          		</div>
          	</div>
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputEmail3"><?= __('Email')?></label>
          		<div class="col-md-8 col-lg-8">
            		<?php 
						echo $this->Form->input('email', [
								'type' => "email",
						        'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$',
						        'id' => 'inputEmail3',
						        'class' => "form-control",
								'maxlength' => 50,
								'placeholder' => 'Email',
								'label' => false,
								'tabindex' => '4',
								'data-fv-remote-validkey' => true
			        		]);
						?>
            		<p class="help-block with-errors">eg: abc@email.com</p>
          		</div>
        	</div>
        </div>
        <div class="row">
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputPassword3"><?= __('Password')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php 
					echo $this->Form->input('password', [
							'type' => "password",
					        'id' => 'inputPasswordl3',
					        'class' => "form-control",					
							'placeholder' => 'Password',
							'label' => false,
							'tabindex' => '5'
		        		]);
					?>
          		</div>
          	</div>
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputRole3"><?= __('Role')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php echo $this->Form->select(
		                'role_id',
		                $roles, 
		                ['id' => 'inputRole3', 'class' => 'form-control', 'empty' => '(choose one)', 'tabindex' => '6']
		            );?>
          		</div>
          	</div>
        </div>
        <div class="row">
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-4 col-lg-4 control-label" for="joining_date"><?= __('Joining Date')?></label>
          		<div class="col-md-8 col-lg-8">
            		<div class="input-group">
              			<div class="input-group-addon">
                			<i class="fa fa-calendar"></i>
              			</div>
			            <?php 
						  echo $this->Form->input('joining_date', [
								'type' => "text",
						        'id' => 'joining_date',
						        'class' => "form-control",
								'data-provide' => 'datepicker',
						        'data-date-end-date' => '0d',
								'placeholder' => 'Joining Date',
								'label' => false,
								'tabindex' => '8'
			        		]);
						?>
            		</div>
          		</div>
          	</div>
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="inputDesignation3"><?= __('Designation')?></label>
          		<div class="col-md-8 col-lg-8">
		            <?php echo $this->Form->select(
		                'designation_id',
		                $designations,
		                ['id' => 'inputDesignation3', 'class' => 'form-control', 'empty' => '(choose one)', 'tabindex' => '7']
		            );?>
          		</div>
          	</div>
        </div>
        <div class="row">
        	<div class="form-group col-md-6 col-lg-6">
          		<label class="col-md-4 col-lg-4 control-label" for="leaving_date"><?= __('Leaving Date')?><span class="opt_label">&nbsp;(Optional)</span></label>
          		<div class="col-lg-8 col-lg-8">
            		<div class="input-group">
              			<div class="input-group-addon">
                			<i class="fa fa-calendar"></i>
              			</div>
			              <?php 
						  echo $this->Form->input('leaving_date', [
								'type' => "text",
						        'id' => 'leaving_date',
						        'class' => "form-control",
								'data-provide' => 'datepicker',
						        'data-date-end-date' => '0d',
								'placeholder' => 'Leaving Date',
								'label' => false,
								'tabindex' => '9'
			        		]);
						?>
            		</div>
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
<?= $this->Html->script('Admin/pwstrength-bootstrap.min.js') ?>
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
  		
      	$("#joining_date").datepicker({
          	format: 'yyyy-mm-dd',
          	autoclose: true,
          	endDate: end
        }).on('changeDate', function(){
        	var someDate = new Date($(this).val());
      	  	someDate.setDate(someDate.getDate() + 1); 
    	    $('#leaving_date').datepicker('setStartDate', someDate);
    	    $('#add_user').formValidation('revalidateField', 'joining_date');
    	});

        $("#leaving_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
  	      	endDate: end
          }).on('changeDate', function(){

        	  var someDate = new Date($(this).val());
        	  someDate.setDate(someDate.getDate() - 1); 
      	      $('#joining_date').datepicker('setEndDate', someDate);
      	    $('#add_user').formValidation('revalidateField', 'leaving_date');
      	});
      	
        $('#inputPasswordl3').pwstrength({
          ui: { showVerdictsInsideProgressBar: true }
      });
      $(".password-verdict").html("Very Weak");
      $('#add_user').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          first_name: {
              validators: {
                  notEmpty: {
                      message: 'The first name is required'
                  }
              }
          },
          last_name: {
              validators: {
                  notEmpty: {
                      message: 'The last name is required'
                  }
              }
          },
          username: {
              validators: {
                  notEmpty: {
                      message: 'The user name is required'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/users/validate_unique_fields/',
                      data: {
                          type: 'username'
                      },
                      type: 'POST',
                      message: 'Username already exists',
                  }
              }
          },
          email: {
              validators: {
                  notEmpty: {
                      message: 'The email address is required'
                  },
                  emailAddress: {
                      message: 'The input is not a valid email address'
                  },
                  remote: {
                      url: jsBaseURL + '/admin/users/validate_unique_fields/',
                      data: {
                          type: 'email'
                      },
                      type: 'POST',
                      message: 'Email already exists',
                  }
              }
          },
          password: {
              validators: {
                  notEmpty: {
                      message: 'The password is required'
                  }
              }
          },
          joining_date: {
              validators: {
                  notEmpty: {
                      message: 'The joining date is required'
                  }
              }
          },
          leaving_date: {
              validators: {
            	  date: {
                      min: 'joining_date',
                      message: 'The leaving date should be greater than joining date'
                  }
              }
          },
          role_id: {
              validators: {
                  notEmpty: {
                      message: 'The role is required'
                  }
              }
          },
          designation_id: {
              validators: {
                  notEmpty: {
                      message: 'The designation is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.add_user.submit();
      });
  });
</script>
