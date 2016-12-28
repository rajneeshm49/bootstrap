<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsTo $CategoryClasses
 * @property \Cake\ORM\Association\BelongsTo $Brands
 * @property \Cake\ORM\Association\BelongsTo $Suppliers
 * @property \Cake\ORM\Association\BelongsTo $Sizes
 * @property \Cake\ORM\Association\BelongsTo $Colors
 * @property \Cake\ORM\Association\HasMany $Carts
 * @property \Cake\ORM\Association\HasMany $OrderDetails
 * @property \Cake\ORM\Association\HasMany $ProductAttributes
 * @property \Cake\ORM\Association\HasMany $ProductImages
 * @property \Cake\ORM\Association\HasMany $ProductMappings
 * @property \Cake\ORM\Association\HasMany $RecommendProducts
 * @property \Cake\ORM\Association\HasMany $Wishlists
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('products');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CategoryClasses', [
            'foreignKey' => 'category_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id'
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id'
        ]);
        $this->belongsTo('Sizes', [
            'foreignKey' => 'size_id'
        ]);
        $this->belongsTo('Colors', [
            'foreignKey' => 'color_id'
        ]);
        $this->hasMany('Carts', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('OrderDetails', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('ProductAttributes', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('ProductImages', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('ProductMappings', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('RecommendProducts', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Wishlists', [
            'foreignKey' => 'product_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('product_code', 'create')
            ->notEmpty('product_code');

        $validator
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->integer('supplier_style_code')
            ->allowEmpty('supplier_style_code');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description');

        $validator
            ->requirePresence('ship_description', 'create')
            ->notEmpty('ship_description');

        $validator
            ->allowEmpty('collection_description');

        $validator
            ->allowEmpty('material');

        $validator
            ->requirePresence('care', 'create')
            ->notEmpty('care');

        $validator
            ->requirePresence('shipping_info', 'create')
            ->notEmpty('shipping_info');

        $validator
            ->requirePresence('color_image', 'create')
            ->notEmpty('color_image');

        $validator
            ->allowEmpty('length');

        $validator
            ->allowEmpty('sleeve');

        $validator
            ->allowEmpty('neck');

        $validator
            ->allowEmpty('fit');

        $validator
            ->allowEmpty('style');

        $validator
            ->decimal('weight')
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->integer('enabled_backorder')
            ->requirePresence('enabled_backorder', 'create')
            ->notEmpty('enabled_backorder');

        $validator
            ->decimal('base_price')
            ->allowEmpty('base_price');

        $validator
            ->decimal('dollar_price')
            ->allowEmpty('dollar_price');

        $validator
            ->decimal('discount_price')
            ->allowEmpty('discount_price');

        $validator
            ->decimal('dollar_discount_price')
            ->allowEmpty('dollar_discount_price');

        $validator
            ->requirePresence('mapped_products', 'create')
            ->notEmpty('mapped_products');

        $validator
            ->integer('view_count')
            ->requirePresence('view_count', 'create')
            ->notEmpty('view_count');

        $validator
            ->integer('new')
            ->requirePresence('new', 'create')
            ->notEmpty('new');

        $validator
            ->integer('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->boolean('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmpty('modified_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['category_class_id'], 'CategoryClasses'));
        $rules->add($rules->existsIn(['brand_id'], 'Brands'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));
        $rules->add($rules->existsIn(['size_id'], 'Sizes'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));

        return $rules;
    }
}
