<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $category_id
 * @property int $category_class_id
 * @property string $product_code
 * @property string $product_name
 * @property string $slug
 * @property int $brand_id
 * @property int $supplier_id
 * @property int $supplier_style_code
 * @property string $description
 * @property string $short_description
 * @property string $ship_description
 * @property string $collection_description
 * @property string $material
 * @property string $care
 * @property string $shipping_info
 * @property int $size_id
 * @property int $color_id
 * @property string $color_image
 * @property string $length
 * @property string $sleeve
 * @property string $neck
 * @property string $fit
 * @property string $style
 * @property float $weight
 * @property int $enabled_backorder
 * @property float $base_price
 * @property float $dollar_price
 * @property float $discount_price
 * @property float $dollar_discount_price
 * @property string $mapped_products
 * @property int $view_count
 * @property int $new
 * @property int $is_active
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\CategoryClass $category_class
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Size $size
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Cart[] $carts
 * @property \App\Model\Entity\OrderDetail[] $order_details
 * @property \App\Model\Entity\ProductAttribute[] $product_attributes
 * @property \App\Model\Entity\ProductImage[] $product_images
 * @property \App\Model\Entity\ProductMapping[] $product_mappings
 * @property \App\Model\Entity\RecommendProduct[] $recommend_products
 * @property \App\Model\Entity\Wishlist[] $wishlists
 */
class Product extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
