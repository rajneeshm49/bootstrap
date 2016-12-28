<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
	<head>
	    <?= $this->Html->charset() ?>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    
	    <title><?= 'Project Management System' ?></title>
	    
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <?= $this->element('Admin/cssFiles');?>
	    <?= $this->element('Admin/jsFiles');?>
	    <?= $this->element('jsBaseUrl'); ?>
	    <?= $this->fetch('meta') ?>
	    <?= $this->fetch('css') ?>
	    <?= $this->fetch('script') ?>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
    	<div class="wrapper">
    		<?= $this->element('Admin/header');?>
    		<?= $this->element('Admin/sidebar');?>
    		<div class="content-wrapper">
        		<section class="content-header">
					<h1>
						<?php echo $this->fetch('title'); ?>
						<small><?php echo $this->fetch('small_title'); ?></small>
				  	</h1>
				</section>
				
				<!-- Main content -->
				<section class="content">
					<?= $this->Flash->render() ?>
            		<?= $this->fetch('content') ?>
        		</section>
    		</div>
    		<?= $this->element('Admin/footer');?>
		</div>
    	<script>
			setTimeout(function(){
				$('.message, .error-message').hide('slow');
			}, 5000);
			setTimeout(function(){
				$('.error, .form-error').removeClass('error').removeClass('form-error');
			}, 5000);
		</script>
	</body>
</html>