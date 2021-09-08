<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

/**
 * Class BookingPanelPolicy.
 */
class BookingPanelPolicy extends XotBasePanelPolicy {
    public function addBooking(UserContract $user, Model $post): bool {
        return true;
    }
}
