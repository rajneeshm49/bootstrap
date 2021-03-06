<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Client') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create($client, ['class' => 'form-horizontal', 'id' => 'edit_client', 'name' => 'edit_client']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="FirstName3"><?= __('Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('name', [
					'type' => "text",
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Client Name',
					'label' => false,
					'tabindex' => '1'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Address')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->textarea('address', [
					'type' => "textarea",
			        'class' => "form-control",
					'placeholder' => 'Address',
					'label' => false,
					'tabindex' => '2'
        		]);
			?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputCity3"><?= __('City')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('city', [
					'type' => "text",
			        'id' => 'inputCity3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'City',
					'label' => false,
					'tabindex' => '3'
        		]);
			?>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="inputCity3"><?= __('State')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('state', [
					'type' => "text",
			        'id' => 'inputState3',
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'State',
					'label' => false,
					'tabindex' => '4'
        		]);
			?>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="inputCity3"><?= __('Country')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('country_id', [
					'type' => "select",
			        'id' => 'inputClientCountry3',
			        'class' => "form-control",
					'empty' => '(Choose One)',
					'options' => $countries,
					'label' => false,
					'tabindex' => '5'
        		]);
			?>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="inputPhone3"><?= __('Phone')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('phone', [
					'type' => "text",
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Phone',
					'label' => false,
					'tabindex' => '6'
        		]);
			?>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFax3"><?= __('Fax')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('fax', [
					'type' => "text",
			        'class' => "form-control",
					'maxlength' => 100,
					'placeholder' => 'Fax',
					'label' => false,
					'tabindex' => '7'
        		]);
			?>
          </div>
          </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputState3"><?= __('Email')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('email', [
					'type' => "email",
			        'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$',
			        'id' => 'inputEmail3',
			        'class' => "form-control",
					'maxlength' => 50,
					'placeholder' => 'Email',
					'label' => false,
					'tabindex' => '8',
					'data-fv-remote-validkey' => true
        		]);
			?>
            <p class="help-block with-errors">eg: abc@email.com</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputWebsite3"><?= __('Website')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('website_url', [
					'type' => "text",
			        'class' => "form-control",
					'maxlength' => 255,
					'placeholder' => 'Website URL',
					'label' => false,
					'tabindex' => '9'
        		]);
			?>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label"><?= __('Notes')?><span class="opt_label">&nbsp;(Optional)</span></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->textarea('notes', [
					'type' => "textarea",
			        'class' => "form-control",
					'placeholder' => 'Notes',
					'label' => false,
					'tabindex' => '10'
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
  <div class="box">
    <div class="box-header">
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
                <?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'.'Add Contacts'), ['controller'=>'contacts','action' => 'add',$client->id], ['class' => 'btn btn-success pull-right', 'title' => 'Add', 'escape'=>false]) ?>
            </div>
        </form>
    </div>
    <div class="box-body">
    <?php if($client['contacts']){?>
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th><?= __('First Name'); ?></th>
                    <th><?= __('Last Name'); ?></th>
                    <th><?= __('Email'); ?></th>
                    <th><?= __('Phone'); ?></th>
                    <th><?= __('Country') ?></th>
                    <th><?= __('Notes') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
	                $cnt = 1;
	                foreach ($client['contacts'] as $contact): 
	                ?>
	                <tr>
	                    <td><?= $cnt ?></td>
	                    <td><?= h($contact->first_name) ?></td>
	                    <td><?= h($contact->last_name) ?></td>
	                    <td><?= h($contact->email) ?></td>
	                    <td><?= h($contact->phone) ?></td>
	                    <td><?= h($contact->country['country_name']) ?></td>
	                    <td><?= h($contact->notes) ?></td>
	                    <td class="actions">
	                        <?= $this->Html->link(null, array_merge(['controller'=>'contacts','action' => 'edit', $contact->id,$client->id]), ['class' => 'fa fa-pencil']); ?>
                            <?= $this->Html->link(null, array_merge(['controller'=>'contacts','action' => 'delete', $contact->id,$client->id]), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]); ?>   
	                    </td>
	                </tr>
	                <?php
	                $cnt ++;
	                endforeach;
                ?>
            </tbody>
        </table>
        <?php }?>
    </div>
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
      $('#edit_client').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          name: {
              validators: {
                  notEmpty: {
                      message: 'Client\'s name is required'
                  }
              }
          },
          country_id: {
              validators: {
                  notEmpty: {
                      message: 'Please select Country'
                  }
              }
          },
          phone: {
              validators: {
                  notEmpty: {
                      message: 'Phone no. is required'
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
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_client.submit();
      });
  });
  </script>