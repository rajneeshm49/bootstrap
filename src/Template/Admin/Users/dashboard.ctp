
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
			  <h3><?= $usercount['active'] ?> / <?= $usercount['all'] ?></h3>
			  <p>Active Users</p>
			</div>
			<div class="icon">
			  <i class="ion ion-person"></i>
			</div>
			<?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/users/index',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
		</div>
	</div>
	
	
    
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $currencyconv ?></h3>

              <p><?= __('Currency Conversions')?></p>
            </div>
            <div class="icon">
              <i class="ion ion-social-usd"></i>
            </div>
            <?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/currency_conversions/index',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$holidaysCount?></h3>

              <p><?= __('Holidays') ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-happy"></i>
            </div>
            <?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/holidays/index',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
          </div>
        </div>
        
		<div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$clientsCount?></h3>

              <p><?= __('Clients') ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-globe"></i>
            </div>
            <?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/clients/index',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?=$clientsCount?></h3>

              <p><?= __('Projects') ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-globe"></i>
            </div>
            <?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/projects/index',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
          </div>
        </div>
        
        <?php if('General Manager' == $role_name) {?>
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?=1?></h3>

              <p><?= __('Project coversheets for approval') ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-globe"></i>
            </div>
            <?php echo $this->Html->link(
                'More info <i class="fa fa-arrow-circle-right"></i>',
                '/admin/projects/index?to_be_approved=1',
                ['class' => 'small-box-footer', 'escape' => false]
            );?>
          </div>
        </div>
        <?php } ?>
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->