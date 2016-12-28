<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo __('Categories'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Categories</a></li>
        <li class="active">Listings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo __('Categories Listing');?></h3>
              
              <?php echo $this->Html->link(
                    '<button type="button" class="btn bg-maroon margin pull-right">Add</button>',
                    ['controller' => 'Categories', 'action' => 'add'], ['escape' => false]
                );?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Image') ?></th>
                    <th><?= __('slug') ?></th>
                    <th><?= __('category_description') ?></th>
                    <th><?= __('size_chart_type') ?></th>
                    <th><?= __('display_order') ?></th>
                    <th><?= __('created') ?></th>
                    <th><?= __('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= h($category->name) ?></td>
                <td><?= h($category->image) ?></td>
                <td><?= h($category->slug) ?></td>
                <td><?= h($category->category_description) ?></td>
                <td><?= $this->Number->format($category->size_chart_type) ?></td>
                <td><?= $this->Number->format($category->display_order) ?></td>
                <td><?= h($category->created) ?></td>
                <td><?= h($category->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <script>
  $(function () {
    $("#example1").DataTable();
  });
</script>