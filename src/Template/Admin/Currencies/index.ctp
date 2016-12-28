<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Currencies') ?></h3>
        <form class="supp-form textgrey margin-top10" role="form" action="#">
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad" for="inputName3" style="width:130px;">Currency</label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('name', [
						'type' => "text",
				        'id' => 'inputName3',
				        'class' => "form-control",
						'maxlength' => 50,
						'placeholder' => 'Currency',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	        </div>
        </form>
    </div>
    <?php
    $class[$this->request->params['paging']['Currencies']['sort']] = $this->request->params['paging']['Currencies']['direction'];
    $currency_name_class = 'sorting';
    $is_active_class = 'sorting';
	switch(key($class)) {
		case 'Currencies.name' : 
			$currency_name_class= 'sorting_' . $class['Currencies.name'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$currency_name_class ?>"><?= $this->Paginator->sort('name', __('Currency')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['Currencies'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($currencies as $currency): 
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($currency->name) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $currency->id], $paginateParams), ['class' => 'fa fa-pencil']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Currencies', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>