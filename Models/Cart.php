<?php

declare(strict_types=1);

namespace Modules\Cart\Models;

//--------- models --------
use Modules\Blog\Models\Label;
use Modules\Cart\Contracts\CartContract;
use Modules\Food\Models\BellBoy;
use Modules\Geo\Models\Traits\GeoTrait;
//--- services

//---------- traits
use Modules\LU\Models\Traits\HasProfileTrait;
use Modules\LU\Models\User;

/**
 * Modules\Cart\Models\Cart.
 *
 * @property int                                                                      $id
 * @property string|null                                                              $note
 * @property string|null                                                              $created_by
 * @property string|null                                                              $updated_by
 * @property string|null                                                              $deleted_by
 * @property string|null                                                              $created_ip
 * @property string|null                                                              $updated_ip
 * @property string|null                                                              $deleted_ip
 * @property \Illuminate\Support\Carbon|null                                          $created_at
 * @property \Illuminate\Support\Carbon|null                                          $updated_at
 * @property string|null                                                              $deleted_at
 * @property int|null                                                                 $auth_user_id
 * @property int|null                                                                 $shop_id
 * @property string|null                                                              $shop_type
 * @property string|null                                                              $shop_title
 * @property int|null                                                                 $status_id
 * @property string|null                                                              $price_complete
 * @property string|null                                                              $premise
 * @property string|null                                                              $premise_short
 * @property string|null                                                              $locality
 * @property string|null                                                              $locality_short
 * @property string|null                                                              $postal_town
 * @property string|null                                                              $postal_town_short
 * @property string|null                                                              $administrative_area_level_3
 * @property string|null                                                              $administrative_area_level_3_short
 * @property string|null                                                              $administrative_area_level_2
 * @property string|null                                                              $administrative_area_level_2_short
 * @property string|null                                                              $administrative_area_level_1
 * @property string|null                                                              $administrative_area_level_1_short
 * @property string|null                                                              $country
 * @property string|null                                                              $country_short
 * @property string|null                                                              $street_number
 * @property string|null                                                              $street_number_short
 * @property string|null                                                              $route
 * @property string|null                                                              $route_short
 * @property string|null                                                              $postal_code
 * @property string|null                                                              $postal_code_short
 * @property string|null                                                              $googleplace_url
 * @property string|null                                                              $googleplace_url_short
 * @property string|null                                                              $point_of_interest
 * @property string|null                                                              $point_of_interest_short
 * @property string|null                                                              $political
 * @property string|null                                                              $political_short
 * @property string|null                                                              $campground
 * @property string|null                                                              $campground_short
 * @property string|null                                                              $address
 * @property string|null                                                              $latitude
 * @property string|null                                                              $longitude
 * @property int|null                                                                 $bell_boy_id
 * @property string|null                                                              $bell_boy_note
 * @property string|null                                                              $bell_boy_full_name
 * @property int|null                                                                 $delivery_method
 * @property int|null                                                                 $payment_method
 * @property string                                                                   $customer_fullname
 * @property BellBoy|null                                                             $bellBoy
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Cart\Models\CartItem[] $cartItems
 * @property int|null                                                                 $cart_items_count
 * @property mixed                                                                    $elements_number
 * @property mixed                                                                    $email
 * @property mixed                                                                    $first_name
 * @property mixed                                                                    $full_address
 * @property mixed                                                                    $full_name
 * @property mixed                                                                    $price_complete_currency
 * @property mixed                                                                    $price_currency
 * @property mixed                                                                    $status
 * @property mixed                                                                    $subtotal_currency
 * @property mixed                                                                    $sur_name
 * @property mixed                                                                    $tot
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Cart\Models\CartItem[] $items
 * @property int|null                                                                 $items_count
 * @property \Modules\Blog\Models\Profile|null                                        $profile
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent                            $shop
 * @property User|null                                                                $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel1Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel2Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAdministrativeAreaLevel3Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereAuthUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereBellBoyFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereBellBoyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereBellBoyNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCampground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCampgroundShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCountryShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCustomerFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeletedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeliveryMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereGoogleplaceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereGoogleplaceUrlShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereLocalityShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePointOfInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePointOfInterestShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePolitical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePoliticalShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostalCodeShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostalTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostalTownShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePremise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePremiseShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePriceComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereRouteShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereShopTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereShopType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereStreetNumberShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart withDistance($lat, $lng)
 * @mixin \Eloquent
 *
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Cart\Models\CartItem[] $checkouts
 * @property int|null                                                                 $checkouts_count
 * @property int|null                                                                 $post_id
 * @property string|null                                                              $post_type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePostType($value)
 */
class Cart extends BaseModel implements CartContract {
    //-----modalita consegna---

    use GeoTrait;
    use HasProfileTrait;
    /**
     * @var string[]
     */
    protected $casts = [
        'price' => 'float',
    ];

    //-----stato ordine-----

    public const OrdineInviato = 1;

    public const OrdineAccettato = 2; //dal ristorante

    public const OrdineRifiutato = 3;

    public const OrdinePresoInConsegna = 4; //il fattorino prende in consegna l'ordine

    public const OrdineInViaggio = 5;

    public const OrdineConcluso = 6;

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id', 'post_id', 'post_type', 'note', 'auth_user_id',
        'customer_fullname', 'status', 'price_complete', 'delivery_method',
        'payment_method',
        'shop_id', 'shop_type', 'shop_title',
        'bell_boy_id', 'bell_boy_note',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['lang'];

    //-------- relationship ------

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(CartItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile() {
        $profile_class = config('xra.model.profile');

        return $this->hasOne($profile_class, 'auth_user_id', 'auth_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkouts() {
        return $this->items();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bellBoy() {
        return $this->hasOne(BellBoy::class, 'id', 'bell_boy_id');
    }

    //must be an instance of Modules\Cart\Contracts\ShopContract, instance of Illuminate\Database\Eloquent\Relations\MorphTo returned

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function shop() { //attività che ha ricevuto l'ordinazione (il carrello)
        return $this->morphTo('shop');
    }

    //-------------- mutators ----------------------

    /**
     * @param mixed $value
     *
     * @return float|int
     */
    public function getTotAttribute($value) {
        $tot = 0;
        foreach ($this->items as $item) {
            $tot += (float) $item->price * $item->qty;
        }

        return $tot;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getCustomerFullnameAttribute($value) {
        if (strlen($value) > 4) {
            return $value;
        }
        $user = $this->user;
        if (! is_object($user)) {
            return 'Sconosciuto';
        }

        $value = $user->first_name.' '.$user->last_name;

        if (strlen($value) < 4) {
            $value .= ' '.$user->handle;
        }
        $value = trim($value);
        $this->customer_fullname = $value;
        unset($this->lang);
        $this->save();

        return $value;
    }

    public function getPriceCompleteAttribute(float $old_value): float {
        //dddx($old_value);
        $value = $this->items->sum('price_complete');
        //dddx($value);
        if ($value != $old_value && 0 != $value) {
            $this->price_complete = $value;
            unset($this->lang);
            $this->save();
        } else {
            $value = $old_value;
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getFullAddressAttribute($value) {
        $value = '';
        $value .= $this->route.', '.$this->locality.'('.$this->administrative_area_level_2_short.')';
        //mancherebbe il numero civico
        //dddx($value);

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function getBellBoyFullNameAttribute($value) {
        //dddx($this->bellBoy);
        if ('' != $value) {
            return $value;
        }

        $value = optional($this->bellBoy)->full_name;
        $this->bell_boy_full_name = $value;
        $this->save();

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed|null
     */
    public function getShopTitleAttribute($value) {
        if ('' != $value) {
            return $value;
        }
        $value = optional($this->shop)->title;

        $this->shop_title = $value;
        $this->save();

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getPaymentMethodAttribute($value) {
        return 'payment da fare';
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getDeliveryMethodAttribute($value) {
        return 'delivery da fare';
    }

    /**
     * @param mixed $value
     *
     * @return int|null
     */
    public function getElementsNumberAttribute($value) {
        $items = $this->cartItems;
        //dddx($items);
        foreach ($items as $item) {
            $value += $item->qty;
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getStatusAttribute($value) {
        switch ($value) {
            case $this::OrdineInviato:
                $class = 'warning';
                break;
            case $this::OrdineAccettato:
                 $class = 'info';
                break;
            case $this::OrdineRifiutato:
                 $class = 'danger';
                break;
            case $this::OrdinePresoInConsegna:
                 $class = 'primary';
                break;
            case $this::OrdineInViaggio:
                 $class = 'secondary';
                break;
            case $this::OrdineConcluso:
                 $class = 'success';
                break;
            default:
                //$this->status = $this::OrdineInviato;
                //$this->save();
                $class = 'warning';
                break;
        }

        return '<span class="badge badge-pillp-2 badge-'.$class.'">'.__('cart::cart.status.'.$class).'</span>';
    }

    //---- funzione tampone ---
    //per ora non utilizzato, sostituito da getStatusAttribute

    public function label(string $str): string {
        $row = Label::query()
            ->where('label_id', $this->$str)
            ->where('label_type', $str)
            ->first();
        if (is_object($row)) {
            return '<span class="badge badge-pillp-2 badge-'.$row->class.'">'.$row->title.'</span>';
        }

        return 'sconosciuto ['.$str.']['.$this->$str.']';
    }
}
