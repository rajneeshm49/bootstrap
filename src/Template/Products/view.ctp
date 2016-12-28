<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colors'), ['controller' => 'Colors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Color'), ['controller' => 'Colors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Carts'), ['controller' => 'Carts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart'), ['controller' => 'Carts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Details'), ['controller' => 'OrderDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Detail'), ['controller' => 'OrderDetails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product Attributes'), ['controller' => 'ProductAttributes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Attribute'), ['controller' => 'ProductAttributes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product Images'), ['controller' => 'ProductImages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Image'), ['controller' => 'ProductImages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product Mappings'), ['controller' => 'ProductMappings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Mapping'), ['controller' => 'ProductMappings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recommend Products'), ['controller' => 'RecommendProducts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recommend Product'), ['controller' => 'RecommendProducts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wishlists'), ['controller' => 'Wishlists', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wishlist'), ['controller' => 'Wishlists', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Code') ?></th>
            <td><?= h($product->product_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($product->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($product->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= $product->has('color') ? $this->Html->link($product->color->id, ['controller' => 'Colors', 'action' => 'view', $product->color->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Image') ?></th>
            <td><?= h($product->color_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Length') ?></th>
            <td><?= h($product->length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sleeve') ?></th>
            <td><?= h($product->sleeve) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Neck') ?></th>
            <td><?= h($product->neck) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fit') ?></th>
            <td><?= h($product->fit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Style') ?></th>
            <td><?= h($product->style) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mapped Products') ?></th>
            <td><?= h($product->mapped_products) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Class Id') ?></th>
            <td><?= $this->Number->format($product->category_class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand Id') ?></th>
            <td><?= $this->Number->format($product->brand_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier Id') ?></th>
            <td><?= $this->Number->format($product->supplier_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier Style Code') ?></th>
            <td><?= $this->Number->format($product->supplier_style_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Id') ?></th>
            <td><?= $this->Number->format($product->size_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= $this->Number->format($product->weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enabled Backorder') ?></th>
            <td><?= $this->Number->format($product->enabled_backorder) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Base Price') ?></th>
            <td><?= $this->Number->format($product->base_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dollar Price') ?></th>
            <td><?= $this->Number->format($product->dollar_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Price') ?></th>
            <td><?= $this->Number->format($product->discount_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dollar Discount Price') ?></th>
            <td><?= $this->Number->format($product->dollar_discount_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('View Count') ?></th>
            <td><?= $this->Number->format($product->view_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('New') ?></th>
            <td><?= $this->Number->format($product->new) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($product->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($product->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($product->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $product->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Short Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->short_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Ship Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->ship_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Collection Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->collection_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Material') ?></h4>
        <?= $this->Text->autoParagraph(h($product->material)); ?>
    </div>
    <div class="row">
        <h4><?= __('Care') ?></h4>
        <?= $this->Text->autoParagraph(h($product->care)); ?>
    </div>
    <div class="row">
        <h4><?= __('Shipping Info') ?></h4>
        <?= $this->Text->autoParagraph(h($product->shipping_info)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Carts') ?></h4>
        <?php if (!empty($product->carts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Cart Session') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Model Code') ?></th>
                <th scope="col"><?= __('Product Quantity') ?></th>
                <th scope="col"><?= __('Product Price') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Voucher Code') ?></th>
                <th scope="col"><?= __('Promotional Code') ?></th>
                <th scope="col"><?= __('Product Attributes') ?></th>
                <th scope="col"><?= __('Order Type') ?></th>
                <th scope="col"><?= __('Billing Country') ?></th>
                <th scope="col"><?= __('Reminder Mail Sent') ?></th>
                <th scope="col"><?= __('Mail Sent Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->carts as $carts): ?>
            <tr>
                <td><?= h($carts->id) ?></td>
                <td><?= h($carts->cart_session) ?></td>
                <td><?= h($carts->customer_id) ?></td>
                <td><?= h($carts->product_id) ?></td>
                <td><?= h($carts->model_code) ?></td>
                <td><?= h($carts->product_quantity) ?></td>
                <td><?= h($carts->product_price) ?></td>
                <td><?= h($carts->discount) ?></td>
                <td><?= h($carts->voucher_code) ?></td>
                <td><?= h($carts->promotional_code) ?></td>
                <td><?= h($carts->product_attributes) ?></td>
                <td><?= h($carts->order_type) ?></td>
                <td><?= h($carts->billing_country) ?></td>
                <td><?= h($carts->reminder_mail_sent) ?></td>
                <td><?= h($carts->mail_sent_date) ?></td>
                <td><?= h($carts->created) ?></td>
                <td><?= h($carts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Carts', 'action' => 'view', $carts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Carts', 'action' => 'edit', $carts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Carts', 'action' => 'delete', $carts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Order Details') ?></h4>
        <?php if (!empty($product->order_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order No') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Model Code') ?></th>
                <th scope="col"><?= __('Product Name') ?></th>
                <th scope="col"><?= __('Photo Id') ?></th>
                <th scope="col"><?= __('Photo Ref') ?></th>
                <th scope="col"><?= __('Product Price') ?></th>
                <th scope="col"><?= __('Product Quantity') ?></th>
                <th scope="col"><?= __('Product Attributes') ?></th>
                <th scope="col"><?= __('Product Discount') ?></th>
                <th scope="col"><?= __('Amount Net') ?></th>
                <th scope="col"><?= __('Amount Discount') ?></th>
                <th scope="col"><?= __('Amount Gross') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->order_details as $orderDetails): ?>
            <tr>
                <td><?= h($orderDetails->id) ?></td>
                <td><?= h($orderDetails->order_no) ?></td>
                <td><?= h($orderDetails->product_id) ?></td>
                <td><?= h($orderDetails->model_code) ?></td>
                <td><?= h($orderDetails->product_name) ?></td>
                <td><?= h($orderDetails->photo_id) ?></td>
                <td><?= h($orderDetails->photo_ref) ?></td>
                <td><?= h($orderDetails->product_price) ?></td>
                <td><?= h($orderDetails->product_quantity) ?></td>
                <td><?= h($orderDetails->product_attributes) ?></td>
                <td><?= h($orderDetails->product_discount) ?></td>
                <td><?= h($orderDetails->amount_net) ?></td>
                <td><?= h($orderDetails->amount_discount) ?></td>
                <td><?= h($orderDetails->amount_gross) ?></td>
                <td><?= h($orderDetails->created) ?></td>
                <td><?= h($orderDetails->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderDetails', 'action' => 'view', $orderDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderDetails', 'action' => 'edit', $orderDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderDetails', 'action' => 'delete', $orderDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Product Attributes') ?></h4>
        <?php if (!empty($product->product_attributes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Product Option Id') ?></th>
                <th scope="col"><?= __('Product Option Value Id') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_attributes as $productAttributes): ?>
            <tr>
                <td><?= h($productAttributes->id) ?></td>
                <td><?= h($productAttributes->product_id) ?></td>
                <td><?= h($productAttributes->product_option_id) ?></td>
                <td><?= h($productAttributes->product_option_value_id) ?></td>
                <td><?= h($productAttributes->is_active) ?></td>
                <td><?= h($productAttributes->is_deleted) ?></td>
                <td><?= h($productAttributes->created) ?></td>
                <td><?= h($productAttributes->created_by) ?></td>
                <td><?= h($productAttributes->modified) ?></td>
                <td><?= h($productAttributes->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProductAttributes', 'action' => 'view', $productAttributes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductAttributes', 'action' => 'edit', $productAttributes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductAttributes', 'action' => 'delete', $productAttributes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productAttributes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Product Images') ?></h4>
        <?php if (!empty($product->product_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Product Image') ?></th>
                <th scope="col"><?= __('Default Image') ?></th>
                <th scope="col"><?= __('Display Order') ?></th>
                <th scope="col"><?= __('Color Option Id') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_images as $productImages): ?>
            <tr>
                <td><?= h($productImages->id) ?></td>
                <td><?= h($productImages->product_id) ?></td>
                <td><?= h($productImages->product_image) ?></td>
                <td><?= h($productImages->default_image) ?></td>
                <td><?= h($productImages->display_order) ?></td>
                <td><?= h($productImages->color_option_id) ?></td>
                <td><?= h($productImages->is_active) ?></td>
                <td><?= h($productImages->is_deleted) ?></td>
                <td><?= h($productImages->created_by) ?></td>
                <td><?= h($productImages->modified_by) ?></td>
                <td><?= h($productImages->created) ?></td>
                <td><?= h($productImages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProductImages', 'action' => 'view', $productImages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductImages', 'action' => 'edit', $productImages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductImages', 'action' => 'delete', $productImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productImages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Product Mappings') ?></h4>
        <?php if (!empty($product->product_mappings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Product Option Id1') ?></th>
                <th scope="col"><?= __('Product Option Value Id1') ?></th>
                <th scope="col"><?= __('Product Option Id2') ?></th>
                <th scope="col"><?= __('Product Option Value Id2') ?></th>
                <th scope="col"><?= __('Model Code') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Delivery Detail') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_mappings as $productMappings): ?>
            <tr>
                <td><?= h($productMappings->id) ?></td>
                <td><?= h($productMappings->product_id) ?></td>
                <td><?= h($productMappings->product_option_id1) ?></td>
                <td><?= h($productMappings->product_option_value_id1) ?></td>
                <td><?= h($productMappings->product_option_id2) ?></td>
                <td><?= h($productMappings->product_option_value_id2) ?></td>
                <td><?= h($productMappings->model_code) ?></td>
                <td><?= h($productMappings->quantity) ?></td>
                <td><?= h($productMappings->delivery_detail) ?></td>
                <td><?= h($productMappings->is_active) ?></td>
                <td><?= h($productMappings->is_deleted) ?></td>
                <td><?= h($productMappings->created) ?></td>
                <td><?= h($productMappings->created_by) ?></td>
                <td><?= h($productMappings->modified) ?></td>
                <td><?= h($productMappings->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProductMappings', 'action' => 'view', $productMappings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductMappings', 'action' => 'edit', $productMappings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductMappings', 'action' => 'delete', $productMappings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productMappings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Recommend Products') ?></h4>
        <?php if (!empty($product->recommend_products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Json Content') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->recommend_products as $recommendProducts): ?>
            <tr>
                <td><?= h($recommendProducts->id) ?></td>
                <td><?= h($recommendProducts->product_id) ?></td>
                <td><?= h($recommendProducts->json_content) ?></td>
                <td><?= h($recommendProducts->is_active) ?></td>
                <td><?= h($recommendProducts->is_deleted) ?></td>
                <td><?= h($recommendProducts->created_by) ?></td>
                <td><?= h($recommendProducts->modified_by) ?></td>
                <td><?= h($recommendProducts->created) ?></td>
                <td><?= h($recommendProducts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RecommendProducts', 'action' => 'view', $recommendProducts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RecommendProducts', 'action' => 'edit', $recommendProducts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RecommendProducts', 'action' => 'delete', $recommendProducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recommendProducts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wishlists') ?></h4>
        <?php if (!empty($product->wishlists)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Model Code') ?></th>
                <th scope="col"><?= __('Product Attributes') ?></th>
                <th scope="col"><?= __('Ip Address') ?></th>
                <th scope="col"><?= __('Incomplete Mail Sent') ?></th>
                <th scope="col"><?= __('Mail Sent Date') ?></th>
                <th scope="col"><?= __('Browser Version') ?></th>
                <th scope="col"><?= __('Platform') ?></th>
                <th scope="col"><?= __('User Agent') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->wishlists as $wishlists): ?>
            <tr>
                <td><?= h($wishlists->id) ?></td>
                <td><?= h($wishlists->customer_id) ?></td>
                <td><?= h($wishlists->product_id) ?></td>
                <td><?= h($wishlists->model_code) ?></td>
                <td><?= h($wishlists->product_attributes) ?></td>
                <td><?= h($wishlists->ip_address) ?></td>
                <td><?= h($wishlists->incomplete_mail_sent) ?></td>
                <td><?= h($wishlists->mail_sent_date) ?></td>
                <td><?= h($wishlists->browser_version) ?></td>
                <td><?= h($wishlists->platform) ?></td>
                <td><?= h($wishlists->user_agent) ?></td>
                <td><?= h($wishlists->created) ?></td>
                <td><?= h($wishlists->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wishlists', 'action' => 'view', $wishlists->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wishlists', 'action' => 'edit', $wishlists->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wishlists', 'action' => 'delete', $wishlists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wishlists->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
