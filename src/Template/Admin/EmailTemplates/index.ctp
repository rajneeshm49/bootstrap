<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<?= $this->Html->css('Admin/plugins/iCheck/all.css'); ?>
<?php $status = status_master();?>
<?php
    $paginationParams = 'EmailTemplates';
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Email Templates') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            </div>
	        <div class="form-group padding-top50">
			  <label class="col-sm-1 control-label search-fields-pad" for="inputLastName3" style="width:60px;">Status</label>
	          <div class="col-sm-2">
	           <?php 
					echo $this->Form->select('is_active',$status,[
							'class' => 'form-control',
							'tabindex' => '6',
							'label' => false,
							'id' => 'inputRole3',
							'default' => '1'
	            		]
	            );?>
	          </div>
	        </div>
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['EmailTemplates']['sort']] = $this->request->params['paging']['EmailTemplates']['direction'];
    $email_type_class = 'sorting';
    $subject_class = 'sorting';
    $message_class = 'sorting';
    $email_from_class = 'sorting';
    $email_from_name_class = 'sorting';
    $is_active_class = 'sorting';
	switch(key($class)) {
		case 'EmailTemplates.email_type' : 
			$email_type_class= 'sorting_' . $class['EmailTemplates.email_type'];
			break;
		case 'EmailTemplates.subject' :
			$subject_class= 'sorting_' . $class['EmailTemplates.subject'];
			break;
		case 'EmailTemplates.message' :
			$message_class= 'sorting_' . $class['EmailTemplates.message'];
			break;
		case 'EmailTemplates.email_from' :
			$email_from_class= 'sorting_' . $class['EmailTemplates.email_from'];
			break;
		case 'EmailTemplates.email_from_name' :
			$email_from_name_class= 'sorting_' . $class['EmailTemplates.email_from_name'];
			break;
		
		case 'EmailTemplates.is_active' :
			$is_active_class= 'sorting_' . $class['EmailTemplates.is_active'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$email_type_class ?>"><?= $this->Paginator->sort('email_type', __('Email Type'),['class'=>$email_type_class]); ?></th>
                    <th class="<?=$subject_class ?>"><?= $this->Paginator->sort('subject', __('Subject'),['class'=>$subject_class]); ?></th>
                    <th class="<?=$message_class ?>"><?= $this->Paginator->sort('message', __('Message'),['class'=>$message_class]); ?></th>
                    <th class="<?=$email_from_class ?>"><?= $this->Paginator->sort('email_from', __('Email From'),['class'=>$email_from_class]); ?></th>
                    <th class="<?=$email_from_name_class ?>"><?= $this->Paginator->sort('email_from_name', __('Email From Name'),['class'=>$email_from_name_class]); ?></th>
                    <th class="<?=$is_active_class ?>"><?= $this->Paginator->sort('is_active', __('Status')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['EmailTemplates'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($email_templates as $email_template): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($email_template->email_type) ?></td>
                    <td><?= h($email_template->subject) ?></td>
                    <td><?= h($email_template->message) ?></td>
                    <td><?= h($email_template->email_from) ?></td>
                    <td><?= h($email_template->email_from_name) ?></td>
                    <td>
                    	<?= ($email_template->is_active == 1) ? __('Active') : __('Inactive')?>
                    </td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $email_template->id], $paginateParams), ['class' => 'fa fa-pencil']);
                            } else {
                                echo $this->Html->link(null, "javascript: void(0);", ['class' => 'fa fa-pencil disabled','title' => 'You are not authorized to perform this action.']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'EmailTemplates', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>