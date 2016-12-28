<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <?= $this->element('Admin/cssFiles');?>
	    <?= $this->element('Admin/jsFiles');?>
  
  <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="hold-transition login-page">
    <?= $this->fetch('content') ?>
</body>
<script>
	setTimeout(function(){
		$('.message').hide('slow');
	}, 5000);
</script>