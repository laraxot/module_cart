<?php
namespace Modules\Cart\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Cart\Models\CartItem as Post;

use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class CartItemVarPolicy
 * @package Modules\Cart\Models\Policies
 */
class CartItemVarPolicy extends XotBasePolicy
{
}
