<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php
    $model = $paginationParams = 'Contacts';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= $this->Html->link(__($client_name), ['controller' => 'Clients','action' => 'edit', $client_id])  .' -  '. __('Contacts') ?></h3>
        	
        	<?php echo $this->Form->create(null, ['class' => 'supp-form textgrey margin-top10', 'url' => ['action' => 'index', '?' => ['client_id' => $client_id]]]); ?>
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success', 'title' => 'Search']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index', '?' => ['client_id' => $client_id]], ['class' => 'btn btn-success', 'title' => 'Refresh', 'escape'=>false]) ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add', '?' => ['client_id' => $client_id]], ['class' => 'btn btn-success', 'title' => 'Add', 'escape'=>false]) ?>
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
    $class[$this->request->params['paging']['Contacts']['sort']] = $this->request->params['paging']['Contacts']['direction'];
    $name_class = 'sorting';
    $email_class = 'sorting';
    $phone_class = 'sorting';
    
	switch(key($class)) {
		case 'Clients.first_name' : 
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
                    <th class="<?=$name_class ?>"><?= $this->Paginator->sort('first_name', __('First Name')); ?></th>
                    <th class="<?=$name_class ?>"><?= $this->Paginator->sort('last_name', __('Last Name')); ?></th>
                    <th class="<?=$email_class ?>"><?= $this->Paginator->sort('email', __('Email')); ?></th>
                    <th class="<?=$phone_class ?>"><?= $this->Paginator->sort('phone', __('Phone')); ?></th>
                    <th class="actions no-sort"><?= __('Country') ?></th>
                    <th class="actions no-sort"><?= __('Notes') ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                if($contacts->count() > 0) {
	                $pages = $this->Paginator->request->params['paging']['Contacts'];
	                $cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
	                foreach ($contacts as $contact): 
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
	                        <?= $this->Html->link(null, array_merge(['action' => 'edit', $contact->id, '?' => ['client_id' => $client_id]], $paginateParams), ['class' => 'fa fa-pencil']) ?>
	                        
	                       <?= $this->Html->link(null, array_merge(['action' => 'delete', $contact->id, '?' => ['client_id' => $client_id]], $paginateParams), ['class' => 'fa fa-times', 'confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
	                      
	                </li>
	                    </td>
	                </tr>
	                <?php
	                $cnt ++;
	                endforeach;
                } else {
                	echo "<tr><td colspan='8' style='text-align:left;'><b>No record found</b></td></tr>";
            	}
                ?>
            </tbody>
        </table>
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Contacts', 'paginateParams' => $paginateParams]); ?>
        
    </div>
    
</div>