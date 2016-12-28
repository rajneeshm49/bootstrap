<?= $this->Html->css('Admin/plugins/timepicker/bootstrap-timepicker.min.css') ?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Holiday') ?></h3>
      	<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php //pjs($holiday); ?>
    <?php echo $this->Form->create($holiday, ['class' => 'form-horizontal', 'id' => 'edit_holiday', 'name' => 'edit_holiday']); ?>
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="joining_date"><?= __('Holiday Date')?></label>
          <div class="col-sm-8">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?php 
			     echo $this->Form->input('holiday_date', [
					'type' => "text",
			        'id' => 'holiday_date',
			        'class' => "form-control",
					'data-provide' => 'datepicker',
			        'data-date-end-date' => '0d',
					'placeholder' => 'Holiday Date',
					'label' => false,
					'tabindex' => '1',
			  		'value' => date('Y-m-d', strtotime($holiday->holiday_date))
        		]);
			?>
            </div>
          </div>
          </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputDescription3"><?= __('Description')?></label>
          <div class="col-sm-8">
            <?php 
    			echo $this->Form->input('description', [
					'type' => "textarea",
			        'id' => 'inputDescription3',
			        'class' => "form-control",
					'placeholder' => 'Description',
					'label' => false,
					'tabindex' => '2'
        		]);
    		?>
          </div>
        </div>
      </div>    
      <div class="box-footer">
            <?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-info pull-right'])?>
      </div>
    </form>
  </div>
  <?= $this->Html->script('Admin/form-validation.js') ?>
  <?= $this->Html->script('Admin/plugins/timepicker/bootstrap-timepicker.min.js') ?>
  <style>
    .progress-bar{
      min-width: 26%;
    }
  </style>
  <script>
  $(document).ready(function() {
	  $("#holiday_date").datepicker({
	        format: 'yyyy-mm-dd',
	        autoclose: true,
	        endDate: false
	      });
  });
  $(".timepicker").timepicker({
	  showMeridian: false,
      showInputs: false,
      defaultTime: false,
      explicitMode: false,
      maxHours: "05"
    });
  </script>