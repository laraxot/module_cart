<?php

namespace Modules\Cart\Models;

//------ traits

//--- services
//--------- models --------

/**
 * Modules\Cart\Models\BookingItem
 *
 * @property int $id
 * @property string|null $shop_type
 * @property int|null $shop_id
 * @property string|null $name
 * @property int|null $min_capacity
 * @property int|null $max_capacity
 * @property int|null $status
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $price_complete_currency
 * @property-read mixed $price_currency
 * @property-read mixed $subtotal_currency
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereMaxCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereMinCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereShopType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingItem whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class BookingItem extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable=['id','shop_type','shop_id','name','min_capacity','max_capacity','status','created_by','updated_by','created_at','updated_at'];

}
