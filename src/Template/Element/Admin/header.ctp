<header class="main-header">
    
    <?php echo $this->Html->link('<span class="logo-mini"><b>A</b>LT</span><span class="logo-lg"><b>' . __('Admin') . '</b></span>', ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'logo', 'escape' => false]);?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php $sess = $this->request->session()->read('Auth.Admin');?>
              <span class="hidden-xs"><?php echo $sess['first_name'] . ' ' . $sess['last_name'];?><small> (<?= $sess['role_name']?>)</small></span>
            </a>
            <ul class="dropdown-menu" style="width:160px;">
            
              <li class="user-footer"><div class="pull-right "><?php echo __('Member since ') . date('M.Y', strtotime($sess['created']));?>
              </div></li>
              
              <li class="user-footer">
                <div class="pull-right">
                  <?php echo $this->Html->link(__('Sign out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-default btn-flat', 'escape' => false]);?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>