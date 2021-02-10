<?php
namespace Modules\Cart\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Cart\Models\BookingItem as Post;

use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class BookingItemPolicy
 * @package Modules\Cart\Models\Policies
 */
class BookingItemPolicy extends XotBasePolicy {
}
