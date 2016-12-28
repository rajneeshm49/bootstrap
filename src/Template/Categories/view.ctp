<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($category->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Category') ?></th>
            <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->name, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($category->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($category->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Description') ?></th>
            <td><?= h($category->category_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Chart Type') ?></th>
            <td><?= $this->Number->format($category->size_chart_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Display Order') ?></th>
            <td><?= $this->Number->format($category->display_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published') ?></th>
            <td><?= $this->Number->format($category->published) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($category->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($category->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($category->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($category->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $category->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Size Chart') ?></h4>
        <?= $this->Text->autoParagraph(h($category->size_chart)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Categories') ?></h4>
        <?php if (!empty($category->child_categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Path') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Category Description') ?></th>
                <th scope="col"><?= __('Size Chart') ?></th>
                <th scope="col"><?= __('Size Chart Type') ?></th>
                <th scope="col"><?= __('Display Order') ?></th>
                <th scope="col"><?= __('Published') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->child_categories as $childCategories): ?>
            <tr>
                <td><?= h($childCategories->id) ?></td>
                <td><?= h($childCategories->path) ?></td>
                <td><?= h($childCategories->parent_id) ?></td>
                <td><?= h($childCategories->name) ?></td>
                <td><?= h($childCategories->image) ?></td>
                <td><?= h($childCategories->slug) ?></td>
                <td><?= h($childCategories->category_description) ?></td>
                <td><?= h($childCategories->size_chart) ?></td>
                <td><?= h($childCategories->size_chart_type) ?></td>
                <td><?= h($childCategories->display_order) ?></td>
                <td><?= h($childCategories->published) ?></td>
                <td><?= h($childCategories->is_active) ?></td>
                <td><?= h($childCategories->is_deleted) ?></td>
                <td><?= h($childCategories->created_by) ?></td>
                <td><?= h($childCategories->modified_by) ?></td>
                <td><?= h($childCategories->created) ?></td>
                <td><?= h($childCategories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $childCategories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $childCategories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $childCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childCategories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($category->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Category Class Id') ?></th>
                <th scope="col"><?= __('Product Code') ?></th>
                <th scope="col"><?= __('Product Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Brand Id') ?></th>
                <th scope="col"><?= __('Supplier Id') ?></th>
                <th scope="col"><?= __('Supplier Style Code') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Short Description') ?></th>
                <th scope="col"><?= __('Ship Description') ?></th>
                <th scope="col"><?= __('Collection Description') ?></th>
                <th scope="col"><?= __('Material') ?></th>
                <th scope="col"><?= __('Care') ?></th>
                <th scope="col"><?= __('Shipping Info') ?></th>
                <th scope="col"><?= __('Size Id') ?></th>
                <th scope="col"><?= __('Color Id') ?></th>
                <th scope="col"><?= __('Color Image') ?></th>
                <th scope="col"><?= __('Length') ?></th>
                <th scope="col"><?= __('Sleeve') ?></th>
                <th scope="col"><?= __('Neck') ?></th>
                <th scope="col"><?= __('Fit') ?></th>
                <th scope="col"><?= __('Style') ?></th>
                <th scope="col"><?= __('Weight') ?></th>
                <th scope="col"><?= __('Enabled Backorder') ?></th>
                <th scope="col"><?= __('Base Price') ?></th>
                <th scope="col"><?= __('Dollar Price') ?></th>
                <th scope="col"><?= __('Discount Price') ?></th>
                <th scope="col"><?= __('Dollar Discount Price') ?></th>
                <th scope="col"><?= __('Mapped Products') ?></th>
                <th scope="col"><?= __('View Count') ?></th>
                <th scope="col"><?= __('New') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->category_id) ?></td>
                <td><?= h($products->category_class_id) ?></td>
                <td><?= h($products->product_code) ?></td>
                <td><?= h($products->product_name) ?></td>
                <td><?= h($products->slug) ?></td>
                <td><?= h($products->brand_id) ?></td>
                <td><?= h($products->supplier_id) ?></td>
                <td><?= h($products->supplier_style_code) ?></td>
                <td><?= h($products->description) ?></td>
                <td><?= h($products->short_description) ?></td>
                <td><?= h($products->ship_description) ?></td>
                <td><?= h($products->collection_description) ?></td>
                <td><?= h($products->material) ?></td>
                <td><?= h($products->care) ?></td>
                <td><?= h($products->shipping_info) ?></td>
                <td><?= h($products->size_id) ?></td>
                <td><?= h($products->color_id) ?></td>
                <td><?= h($products->color_image) ?></td>
                <td><?= h($products->length) ?></td>
                <td><?= h($products->sleeve) ?></td>
                <td><?= h($products->neck) ?></td>
                <td><?= h($products->fit) ?></td>
                <td><?= h($products->style) ?></td>
                <td><?= h($products->weight) ?></td>
                <td><?= h($products->enabled_backorder) ?></td>
                <td><?= h($products->base_price) ?></td>
                <td><?= h($products->dollar_price) ?></td>
                <td><?= h($products->discount_price) ?></td>
                <td><?= h($products->dollar_discount_price) ?></td>
                <td><?= h($products->mapped_products) ?></td>
                <td><?= h($products->view_count) ?></td>
                <td><?= h($products->new) ?></td>
                <td><?= h($products->is_active) ?></td>
                <td><?= h($products->is_deleted) ?></td>
                <td><?= h($products->created) ?></td>
                <td><?= h($products->created_by) ?></td>
                <td><?= h($products->modified) ?></td>
                <td><?= h($products->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
