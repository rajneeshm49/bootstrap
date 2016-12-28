<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo __('Products'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Listings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <?php if(count($products) > 0) {
                  echo $products->first()->category->name . " - ";
              }?>
              <?php echo __('Products Listing');?></h3>
              
              <?php echo $this->Html->link(
                    '<button type="button" class="btn bg-maroon margin pull-right">Add</button>',
                    ['controller' => 'Products', 'action' => 'add'], ['escape' => false]
                );?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Code') ?></th>
                    <th><?= __('slug') ?></th>
                    <th><?= __('View Count') ?></th>
                    <th><?= __('Base Price') ?></th>
                    <th><?= __('Discount Price') ?></th>
                    <th><?= __('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product->product_name) ?></td>
                <td><?= h($product->product_code) ?></td>
                <td><?= h($product->slug) ?></td>
                <td><?= h($product->view_count) ?></td>
                <td><?= h($product->base_price) ?></td>
                <td><?= h($product->discount_price) ?></td>
                <td><?= h($product->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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