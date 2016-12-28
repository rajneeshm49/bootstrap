<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = 'Users';
    $statusClass = array('1'=>'check','0'=>'close');
    $paginationParams = 'Users';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Users') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('First Name') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('first_name', [
						'type' => "text",
				        'id' => 'inputFirstName3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'First Name',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Last Name') ?></label>
	          <div class="col-sm-2">
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
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Username') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('username', [
						'type' => "text",
				        'id' => 'inputUsername3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Username',
						'label' => false,
						'tabindex' => '3'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputEmail3"><?= __('Email') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('email', [
						'type' => "text",
				        'id' => 'inputEmail3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Email',
						'label' => false,
						'tabindex' => '4'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['Users']['sort']] = $this->request->params['paging']['Users']['direction'];
    $first_name_class = 'sorting';
    $last_name_class = 'sorting';
    $username_class = 'sorting';
    $role_class = 'sorting';
    $email_class = 'sorting';
    $is_active_class = 'sorting';
	switch(key($class)) {
		case 'Users.first_name' : 
			$first_name_class= 'sorting_' . $class['Users.first_name'];
			break;
			
		case 'Users.last_name' :
			$last_name_class= 'sorting_' . $class['Users.last_name'];
			break;
			
		case 'Users.username' :
			$username_class= 'sorting_' . $class['Users.username'];
			break;
		
		case 'Users.username' :
			$username_class= 'sorting_' . $class['Users.username'];
			break;
			
		case 'Users.email' :
			$email_class= 'sorting_' . $class['Users.email'];
			break;
			
		case 'Users.is_active' :
			$is_active_class= 'sorting_' . $class['Users.is_active'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$first_name_class ?>"><?= $this->Paginator->sort('first_name', __('First Name')); ?></th>
                    <th class="<?=$last_name_class ?>"><?= $this->Paginator->sort('last_name', __('Last Name')); ?></th>
                    <th class="<?=$username_class ?>"><?= $this->Paginator->sort('username', __('Username')); ?></th>
                    <th class="<?=$username_class ?>"><?= $this->Paginator->sort('Role.role_name', __('Role')); ?></th>
                    <th class="<?=$email_class ?>"><?= $this->Paginator->sort('email', __('Email')) ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Status')) ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['Users'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($users as $user): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->role['role_name']) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td>
                        <?= ($user->is_active) ? __('Active') : __('Inactive')?>
                    </td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $user->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $user->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
                        	}  else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-times disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                   </td>
                </tr>
                <?php
                $cnt ++;
                endforeach; 
                ?>
            </tbody>
        </table>
        <!-- span class="pull-left recordsControl">
            <button type="button" onclick="removeRecords('<?= $model ?>','manage<?= $model ?>-checkbox')" class="btn btn-danger pull-left manage<?= $model ?>-action disabled">Remove</button>
            <div style="clear:both"></div>
        </span-->
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Users', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>
