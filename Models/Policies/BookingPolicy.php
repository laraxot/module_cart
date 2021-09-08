<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Policies;


use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class BookingPolicy.
 */
class BookingPolicy extends XotBasePolicy {
    public function addBooking(UserContract $user, Model $post): bool {
        return true;
    }
}
