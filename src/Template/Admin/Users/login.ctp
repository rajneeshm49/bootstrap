<div class="login-box">
    <div class="login-logo">
        <?php echo $this->Html->link("<b>Project Management</b> Admin", '/', ['escape' => false]);?>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo __('Sign in to start your session'); ?></p>

    <?php echo $this->Form->create('', ['data-toggle' => 'validator']);?>
        <div class="form-group has-feedback">
            <?php 
			echo $this->Form->input('username', [
        				'required' => 'required',
			            'type' => "text",
			            'class' => "form-control",
			            'placeholder' => 'Username',
			            'label' => false,
						'tabindex' => '1',
						'data-error' => 'Please enter Username'
        		]
            );?> <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <?php 
			echo $this->Form->input('password', [
        				'required' => 'required',
			            'type' => "password",
			            'class' => "form-control",
			            'placeholder' => 'Password',
			            'label' => false,
						'tabindex' => '2',
						'data-error' => 'Please enter Password'
        		]
            );?> <div class="help-block with-errors"></div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="row">
            <div class="col-xs-4 pull-right">
                <?= $this->Form->button(__('Sign In'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']);?>
            </div>
        </div>
    </form>
    <?= $this->form->end(); ?>
    <a href="#"><?php __('I forgot my password') ?></a><br>
  </div>
</div>