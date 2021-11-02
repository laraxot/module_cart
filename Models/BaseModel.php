<?php

declare(strict_types=1);

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
/*
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations as ImageManipulations;
use Spatie\MediaLibrary\File;
*/
//---------- traits

//confermare che non serve, perchè cart/cart_item/cart_item_vars non sono cose traducibili, quindi non devono andare in posts
use Modules\Xot\Models\Traits\HasPriceTrait;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends Model /*implements HasMedia*/
{
    use HasPriceTrait;

    /**
     * @var string
     */
    protected $primaryKey = 'id';
    //protected $fillable = ['id', 'post_id', 'post_type', 'note', 'user_id', 'customer_fullname', 'status'];
    /**
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at'];
    /**
     * @var bool
     */
    public $incrementing = true;

    /*
    public function registerMediaConversions(Media $media = null)
    { //spatie

        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);

        $this->addMediaConversion('old-picture')
              ->sepia()
              ->border(10, 'black', Manipulations::BORDER_OVERLAY);
    }
    */
}
