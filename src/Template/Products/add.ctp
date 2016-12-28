<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colors'), ['controller' => 'Colors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Color'), ['controller' => 'Colors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Carts'), ['controller' => 'Carts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cart'), ['controller' => 'Carts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Details'), ['controller' => 'OrderDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Detail'), ['controller' => 'OrderDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product Attributes'), ['controller' => 'ProductAttributes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product Attribute'), ['controller' => 'ProductAttributes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product Images'), ['controller' => 'ProductImages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product Image'), ['controller' => 'ProductImages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product Mappings'), ['controller' => 'ProductMappings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product Mapping'), ['controller' => 'ProductMappings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recommend Products'), ['controller' => 'RecommendProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recommend Product'), ['controller' => 'RecommendProducts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wishlists'), ['controller' => 'Wishlists', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wishlist'), ['controller' => 'Wishlists', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('category_class_id');
            echo $this->Form->input('product_code');
            echo $this->Form->input('product_name');
            echo $this->Form->input('slug');
            echo $this->Form->input('brand_id');
            echo $this->Form->input('supplier_id');
            echo $this->Form->input('supplier_style_code');
            echo $this->Form->input('description');
            echo $this->Form->input('short_description');
            echo $this->Form->input('ship_description');
            echo $this->Form->input('collection_description');
            echo $this->Form->input('material');
            echo $this->Form->input('care');
            echo $this->Form->input('shipping_info');
            echo $this->Form->input('size_id');
            echo $this->Form->input('color_id', ['options' => $colors, 'empty' => true]);
            echo $this->Form->input('color_image');
            echo $this->Form->input('length');
            echo $this->Form->input('sleeve');
            echo $this->Form->input('neck');
            echo $this->Form->input('fit');
            echo $this->Form->input('style');
            echo $this->Form->input('weight');
            echo $this->Form->input('enabled_backorder');
            echo $this->Form->input('base_price');
            echo $this->Form->input('dollar_price');
            echo $this->Form->input('discount_price');
            echo $this->Form->input('dollar_discount_price');
            echo $this->Form->input('mapped_products');
            echo $this->Form->input('view_count');
            echo $this->Form->input('new');
            echo $this->Form->input('is_active');
            echo $this->Form->input('is_deleted');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
