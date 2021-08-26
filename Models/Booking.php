<?php

declare(strict_types=1);

namespace Modules\Cart\Models;

//------ traits

//--- services
//--------- models --------

/**
 * Modules\Cart\Models\Booking.
 *
 * @property int                                   $id
 * @property string|null                           $shop_type
 * @property int|null                              $shop_id
 * @property int|null                              $booking_item_id
 * @property int|null                              $guest_num
 * @property int|null                              $occasion_id
 * @property int|null                              $customer_id
 * @property string|null                           $first_name
 * @property string|null                           $last_name
 * @property string|null                           $email
 * @property string|null                           $telephone
 * @property string|null                           $note
 * @property string|null                           $reserve_time
 * @property string|null                           $reserve_date
 * @property string|null                           $date_added
 * @property string|null                           $date_modified
 * @property int|null                              $assignee_id
 * @property int|null                              $notify
 * @property string|null                           $ip_address
 * @property string|null                           $user_agent
 * @property int|null                              $status
 * @property string|null                           $created_by
 * @property string|null                           $updated_by
 * @property \Illuminate\Support\Carbon|null       $created_at
 * @property \Illuminate\Support\Carbon|null       $updated_at
 * @property \Modules\Cart\Models\BookingItem|null $bookingItem
 * @property mixed                                 $price_complete_currency
 * @property mixed                                 $price_currency
 * @property mixed                                 $subtotal_currency
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereAssigneeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDateModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGuestNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereOccasionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereReserveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereReserveTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereShopType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserAgent($value)
 * @mixin \Eloquent
 */
class Booking extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'shop_type', 'shop_id',
        'booking_item_id',
        'guest_num', 'occasion_id', 'customer_id',
        'first_name', 'last_name', 'email', 'telephone', 'note',
        'reserve_time', 'reserve_date', 'date_added', 'date_modified',
        'assignee_id', 'notify', 'ip_address', 'user_agent', 'status',
    ];

    //--- relationships

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingItem() {
        return $this->belongsTo(BookingItem::class);
    }

    /**
     * @param mixed $value
     */
    public function setReserveDateAttribute($value): void {
        $this->attributes['reserve_date'] = \Carbon\Carbon::parse($value)->format('y-m-d');
    }
}
