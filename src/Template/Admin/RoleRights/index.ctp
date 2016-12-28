<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?php
    $model = 'RoleRights';
    $paginationParams = 'Users';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('RoleRights') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3"><?= __('Role Name') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('role_name', [
						'type' => "text",
				        'id' => 'inputFirstName3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Role Name',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['RoleRights']['sort']] = $this->request->params['paging']['RoleRights']['direction'];
    $role_name_class = 'sorting';
    switch(key($class)) {
		case 'RoleRights.role_name' : 
			$role_name_class= 'sorting_' . $class['RoleRights.role_name'];
			break;
	}
    ?>
    <div class="box-body">
        <table class="table table-bordered table-striped dataTable" role="grid">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$role_name_class ?>"><?= $this->Paginator->sort('role_name', __('Role Name')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['RoleRights'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                
                foreach ($role_rights as $role_right): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h($role_right->role['role_name']) ?></td>
                    
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $role_right->role_id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $role_right->role_id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'RoleRights', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>