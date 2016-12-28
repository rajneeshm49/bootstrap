<?= $this->Html->css('Admin/plugins/datatables/dataTables.bootstrap.css'); ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= __('Add Holiday') ?></h3>
        <?php echo $this->Form->create('', ['class' => 'upp-form textgrey margin-top10', 'role' => 'form']); ?>
        	<div class="btn-group pull-right padding-right15">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-search"></i>'), ['type' => 'submit', 'class' => 'btn btn-success']); ?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-refresh"></i>'), ['action' => 'index'], ['class' => 'btn btn-success','escape'=>false]) ?>
            	<?php $disabled = ($can_add)?'':'disabled'?>
            	<?= $this->Html->link(__('<i class="fa fa-fw fa-plus"></i>'), ['action' => 'add'], ['class' => "$disabled btn btn-success",'escape'=>false]) ?>
			</div>
	        <div class="form-group padding-top50">          
	          <label class="col-sm-2 control-label search-fields-pad" for="holiday_date" style="width:100px;"><?= __('Year')?></label>
	          <div class="col-sm-2">
	            <div class="input-group">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <?php 
				  echo $this->Form->input('year', [
						'type' => "text",
				        'id' => 'year',
				        'class' => "form-control",
						'data-provide' => 'datepicker',
				        'data-date-end-date' => '0d',
						'placeholder' => 'Year',
						'label' => false,
						'tabindex' => '2'
	        		]);
				?>
	            </div>
	          </div>
	        </div>
	        
        </form>
    </div>
    <?php     
    $class[$this->request->params['paging']['Holidays']['sort']] = $this->request->params['paging']['Holidays']['direction'];
    $date_class = 'sorting';
    $desc_class = 'sorting';
	switch(key($class)) {
		case 'Holidays.holiday_date' : 
			$date_class= 'sorting_' . $class['Holidays.holiday_date'];
			break;
			
		case 'Holidays.description' :
			$desc_class= 'sorting_' . $class['Holidays.description'];
			break;
	}
    ?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr>
                    <th class="no-sort"><?= __('Sr No.') ?></th>
                    <th class="<?=$date_class ?>"><?= $this->Paginator->sort('holiday_date', __('Holiday Date')); ?></th>
                    <th class="<?=$desc_class ?>"><?= $this->Paginator->sort('description', __('Description')); ?></th>
                    <th class="actions no-sort"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$pages = $this->Paginator->request->params['paging']['Holidays'];
                	$cnt = (($pages['page'] - 1) * $pages['perPage']) + 1;
                	foreach ($holidays as $holiday):
                ?>
                <tr>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td><?= date('Y-m-d', strtotime($holiday->holiday_date)); ?></td>
                    <td><?= h($holiday->description) ?></td>
                    <td class="actions">
                        <?php 
                            if($can_edit) {
                                echo $this->Html->link(null, array_merge(['action' => 'edit', $holiday->id], $paginateParams), ['class' => 'fa fa-pencil']);
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
        <?= $this->element('Admin' . DS . 'pagination', ['module' => 'Holidays', 'paginateParams' => $paginateParams]); ?>
    </div>
</div>
 <?= $this->Html->script('Admin/jquery.inputmask.js') ?>
 <script>
    $(document).ready(function() {
      $("[data-mask]").inputmask();
      $("#year").datepicker({
          format: 'yyyy',
	      autoclose: true,
	      endDate: false,
          viewMode: "years", 
          minViewMode: "years"
        });
     
  });
  </script>