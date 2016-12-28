<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = $paginationParams = 'Clients';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Clients') ?></h3>
        	<form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success", 'title' => 'Add', 'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	        
	          <label class="col-sm-1 control-label search-fields-pad" for="inputName3"><?= __('Name') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('name', [
						'type' => "text",
				        'id' => 'inputName3',
				        'class' => "form-control",
						'maxlength' => 100,
						'placeholder' => 'Name',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputEmail3"><?= __('Email') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('email', [
						'type' => "email",
				        'id' => 'inputEmail3',
				        'class' => "form-control",
						'placeholder' => 'Email',
						'label' => false,
						'tabindex' => '2'
	        		]);
				?>
	          </div>
	          <label class="col-sm-1 control-label search-fields-pad" for="inputCountry3"><?= __('Country') ?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('country_id', [
						'type' => "select",
				        'id' => 'inputCountry3',
				        'class' => "form-control",
						'empty' => '(Choose One)',
						'options' => $countries,
						'label' => false,
						'tabindex' => '3'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
   <?php     
    $class[$this->request->params['paging']['Clients']['sort']] = $this->request->params['paging']['Clients']['direction'];
    $name_class = 'sorting';
    $email_class = 'sorting';
    $phone_class = 'sorting';
    
	switch(key($class)) {
		case 'Clients.name' : 
			$name_class= 'sorting_' . $class['Clients.name'];
			break;
			
		case 'Clients.email' :
			$email_class= 'sorting_' . $class['Clients.email'];
			break;
			
		case 'Clients.phone' :
			$phone_class= 'sorting_' . $class['Clients.phone'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th><?= __('Sr No.') ?></th>
                    <th class="<?=$name_class ?>"><?= $this->Paginator->sort('name', __('Name')); ?></th>
                    <th class="<?=$email_class ?>"><?= $this->Paginator->sort('email', __('Email')); ?></th>
                    <th class="<?=$phone_class ?>"><?= $this->Paginator->sort('phone', __('Phone')); ?></th>
                    <th class="actions no-sort"><?= __('Country') ?></th>
                    <th class="actions no-sort"><?= __('Notes') ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pages = $this->Paginator->request->params['paging']['Clients'];
                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                foreach ($clients as $client): 
                ?>
                <tr>
                    <td><?= $cnt ?></td>
                    <td><?= h($client->name) ?></td>
                    <td><?= h($client->email) ?></td>
                    <td><?= h($client->phone) ?></td>
                    <td><?= h($client->country['country_name']) ?></td>
                    <td><?= h($client->notes) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $client->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?php
                        	if($can_delete) {
                        		echo $this->Html->link(null, array_merge(['action' => 'delete', $client->id], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete the record')]);
                        	}  else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-times disabled','title' => 'You are not authorized to perform this action.']);
                            }
                        ?>
                        <?= $this->Html->link(null, array_merge(['controller' => 'Contacts', 'action' => 'index', '?' => ['client_id' => $client->id, 'client_name' => $client->name]], $paginateParams), ['class' => 'fa fa-user', 'title' => __('Contacts')]) ?>
                    </td>
                </tr>
                <?php
                $cnt ++;
                endforeach; 
                ?>
            </tbody>
        </table>
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Clients', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>