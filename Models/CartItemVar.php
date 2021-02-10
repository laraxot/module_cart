<?php

namespace Modules\Cart\Models;

/**
 * Modules\Cart\Models\CartItemVar
 *
 * @property int $id
 * @property int $cart_item_id
 * @property int|null $status
 * @property int|null $auth_user_id
 * @property int|null $qty
 * @property string|null $price
 * @property int|null $pivot_id
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $var_cat_type
 * @property int|null $var_cat_id
 * @property string|null $var_cat_title
 * @property string|null $var_item_type
 * @property int|null $var_item_id
 * @property string|null $var_item_title
 * @property-read mixed $price_complete_currency
 * @property-read mixed $price_currency
 * @property-read mixed $qty_simbol
 * @property-read mixed $subtotal_currency
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereAuthUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereCartItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar wherePivotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarCatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarCatTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarCatType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarItemTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItemVar whereVarItemType($value)
 * @mixin \Eloquent
 */
class CartItemVar extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'cart_item_id', 'status', 'var_cat_id', 'var_cat_type', 'var_cat_title',
        'var_item_id', 'var_item_type', 'var_item_title',
        'qty', 'price', 'note', 'auth_user_id', 'customer_fullname', 'status', ];

    //--------- Mutators----------

    /**
     * @return string
     */
    public function getQtySimbolAttribute() {
        if ($this->qty > 0) {
            return '<i class="fas fa-plus"></i>';
        } else {
            return '<i class="fas fa-minus"></i>';
        }
    }
}
