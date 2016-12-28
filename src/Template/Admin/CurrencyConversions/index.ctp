<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Currency Conversions') ?></h3>
        <?php echo $this->Form->create('', ['class' => 'upp-form textgrey margin-top10', 'id' => 'index_form', 'name' => 'index_form', 'role' => 'form']); ?>
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">
	          <label class="col-sm-1 control-label search-fields-pad" for="inputName3" style="width:130px;"><?= __('Currency')?></label>
	          <div class="col-sm-2">
	            <?php 
				echo $this->Form->input('currency_id', [
						'type' => "select",
				        'class' => "form-control",
						'options' => $all_currencies,
						'empty' => ' ( Choose One )',
						'maxlength' => 50,
						'placeholder' => 'Currency',
						'label' => false,
						'tabindex' => '1'
	        		]);
				?>
	          </div>
	          
	          <label class="col-sm-2 control-label search-fields-pad" for="joining_date" style="width:100px;"><?= __('Date From')?></label>
	          <div class="col-sm-2">
	            <div class="input-group">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <?php 
				  echo $this->Form->input('date_from', [
						'type' => "text",
				        'id' => 'date_from',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Date From',
						'label' => false,
						'tabindex' => '2'
	        		]);
				?>
	            </div>
	          </div>
	          
	          <label class="col-sm-2 control-label search-fields-pad" for="joining_date" style="width:100px;"><?= __('Date To')?></label>
          <div class="col-sm-2">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			  echo $this->Form->input('date_to', [
					'type' => "text",
			        'id' => 'date_to',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Date To',
					'label' => false,
					'tabindex' => '3'
        		]);
			?>
            </div>
          </div>
	        </div>
	        
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['CurrencyConversions']['sort']] = $this->request->params['paging']['CurrencyConversions']['direction'];
    $conversion_name_class = 'sorting';
    $is_active_class = 'sorting';
    
	switch(key($class)) {
		case 'CurrencyConversions.name' : 
			$currency_name_class= 'sorting_' . $class['CurrencyConversions.name'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$conversion_name_class ?>"><?= $this->Paginator->sort('name', __('Currency')); ?></th>
                    <th><?= __('To INR'); ?></th>
                    <th><?= $this->Paginator->sort('update_date', __('Update Date')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['CurrencyConversions'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($currency_conversions as $conversion):
//                 	pjs($conversion);exit;
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= h($conversion->currency['name']) ?></td>
                    <td><?= h($conversion->inr) ?></td>
                    <td><?= date('Y-m-d', strtotime($conversion->update_date)); ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $conversion->id], $paginateParams), ['class' => 'fa fa-pencil']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'CurrencyConversions', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>
 <?= $this->Html->script('Admin/jquery.inputmask.js') ?>
 <script>
    $(document).ready(function() {
      $("[data-mask]").inputmask();
      $("#date_from").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
	      endDate: false
        });
      $("#date_to").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
	      endDate: false
        });
     
  });
  </script>