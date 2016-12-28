<?php 
use Cake\Utility\Hash;
use Cake\Collection\Collection;
?>
<div class="box box-info">
    <div class="box-header with-border">
      	<h3 class="box-title"><?= __('Edit Role Rights') ?></h3>
		<div class="back-btn-div">
			<div class="pull-right padding-right15">
				<?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-success glyphicon glyphicon-arrow-left', 'title' => 'Back', 'escape'=>false]) ?>
			</div>
		</div>
    </div><!-- /.box-header -->
   
    <!-- form start -->
    <?php echo $this->Form->create($role, ['class' => 'form-horizontal', 'id' => 'add_role_rights', 'name' => 'add_role_rights']); ?>
    <input type="hidden" name="role_id" value="<?=$role->id?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="inputFirstName3"><?= __('Role Name')?></label>
          <div class="col-sm-8">
            <?php 
			echo $this->Form->input('role_id', [
					'type' => "select",
			        'id' => 'roleName3',
					'options' => $roles,
					'default' => $role->id,
			        'class' => "form-control",
					'label' => false,
					'disabled' => true
        		]);
			?>
          </div>
        </div>
        <div class="col-sm-10">
        <table class="table">
  <thead>
    <tr>
      <th>Sr. No.</th>
      <th>Module</th>
      <th>Add</th>
      <th>Edit</th>
      <th>View</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $cnt = 1;

    foreach($rights as $k => $right_arr) {
    	
    	$dd = Hash::extract($right_arr, '{n}.rights_child');
    	$dd1 = Hash::extract($dd, '{n}.{n}.id');

    	$intrs = array_intersect($rights_id, $dd1);
    	$chkd = (count($intrs) == count($dd1))?'checked':'';
   	?>

   	<tr>
	    <th scope="row"><h4><?=$k?>&nbsp;&nbsp;<input type="checkbox" <?=$chkd ?> class="rights_chkbox" id="<?=str_replace(' ', '', $k).'_chkbox' ?>"></h4>
    	</th><th>&nbsp;</th>
    </tr>
    	<?php 
    	foreach($right_arr as $right) {
    	$child = $right->rights_child;    	 
    	$rr = Hash::combine($child, '{n}.display_order', '{n}');
    	

    ?>
    <tr>
      <th scope="row"><?= $cnt?></th>
      <td><?=$right->menu?></td>
      <?php for($chld_count = 1; $chld_count <= 4; $chld_count++) {
      	
      	if(!empty($rr[$chld_count])) {
      		
      		echo '<td>';
      		echo $this->Form->input('Child.' . $rr[$chld_count]->id, [
      				'type' => "checkbox",
      				'class' => "no-margin-left " . str_replace(' ', '', $k) . '_chkbox_class',
      				'div' => false, 
      				'label' => false,
      				'checked' => (in_array($rr[$chld_count]->id, $rights_id))?1:0
      		]);
      		echo '</td>';
      	} else {
      		echo '<td>&nbsp;</td>';
      	}
      	 
      ?>
      <?php
      }?>
      
    </tr>
    <?php
    $cnt++;}
    }?>
  </tbody>
</table>
</div>
      </div>
      <div class="box-footer">
        <?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-info pull-right'])?>
      </div>
    </form>
  </div>
  <?= $this->Html->script('Admin/form-validation.js') ?>
  <?= $this->Html->script('Admin/jquery.inputmask.js') ?>
  <?= $this->Html->script('Admin/pwstrength-bootstrap.min.js') ?>
  <style>
    .progress-bar{
      min-width: 26%;
    }
  </style>
  <script>


    $(document).ready(function() {
      $('#edit_role_rights').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          role_id: {
              validators: {
                  notEmpty: {
                      message: 'The role is required'
                  }
              }
          }
        }
      }).on('success.form.fv', function(e) {
          document.edit_role_rights.submit();
      });
  });
  </script>
