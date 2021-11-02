<?php

declare(strict_types=1);

namespace Modules\Cart\Models;

//------ traits

//--- services
//--------- models --------

/**
 * Modules\Cart\Models\CartItem.
 *
 * @property int                                                                         $id
 * @property int|null                                                                    $parent_id
 * @property int|null                                                                    $pivot_id
 * @property int|null                                                                    $qty
 * @property string|null                                                                 $note
 * @property string|null                                                                 $created_by
 * @property string|null                                                                 $updated_by
 * @property string|null                                                                 $deleted_by
 * @property string|null                                                                 $created_ip
 * @property string|null                                                                 $updated_ip
 * @property string|null                                                                 $deleted_ip
 * @property \Illuminate\Support\Carbon|null                                             $created_at
 * @property \Illuminate\Support\Carbon|null                                             $updated_at
 * @property string|null                                                                 $deleted_at
 * @property int|null                                                                    $user_id
 * @property string|null                                                                 $title
 * @property string|null                                                                 $subtitle
 * @property string|null                                                                 $sess_id
 * @property int|null                                                                    $cart_id
 * @property string|null                                                                 $price_complete
 * @property string|null                                                                 $shop_type
 * @property int|null                                                                    $shop_id
 * @property string|null                                                                 $shop_title
 * @property string|null                                                                 $item_type
 * @property int|null                                                                    $item_id
 * @property string|null                                                                 $item_title
 * @property string|null                                                                 $price
 * @property mixed                                                                       $price_complete_currency
 * @property mixed                                                                       $price_currency
 * @property mixed                                                                       $sub_total_with_variations
 * @property mixed                                                                       $subtotal_currency
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Cart\Models\CartItemVar[] $variations
 * @property int|null                                                                    $variations_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereAuthUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereDeletedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereItemTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem wherePivotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem wherePriceComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereSessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereShopTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereShopType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedIp($value)
 * @mixin \Eloquent
 *
 * @property string|null $currency
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCurrency($value)
 */
class CartItem extends BaseModel {
    /**
     * @var string[]
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'id', 'cart_id',
        'shop_id', 'shop_type', 'shop_title',
        'item_id', 'item_type', 'item_title',
        'subtitle', 'note', 'price',
        'user_id', 'customer_fullname', 'status', 'qty', ];

    //-------- relationship ------

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations() {
        return $this->hasMany(CartItemVar::class);
    }

    //-------- mutators -----------

    public function getPriceCompleteAttribute(float $old_value): float {
        //$old_value = $value;
        $value = $this->price + $this->variations->sum('price');
        $value *= $this->qty;
        if ($old_value != $value) {
            $this->price_complete = $value;
            $this->save();
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return \Cknow\Money\Money
     */
    public function getSubTotalWithVariationsAttribute($value) {
        $value = (float) $this->price * $this->qty;
        foreach ($this->variations as $var_item) {
            if ($var_item->price > 0) {
                $value += (float) $var_item->price * $this->qty;
            }
        }

        return @money((int) $value * 100, $this->currency);
    }
}
