<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Policies;

use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class BookingPolicy.
 */
class BookingPolicy extends XotBasePolicy {
    public function addBooking(UserContract $user, ModelContract $post): bool {
        return true;
    }
}
