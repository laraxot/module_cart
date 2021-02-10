<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Policies;

use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class CartItemPolicy.
 */
class CartItemPolicy extends XotBasePolicy {
    public function detach(UserContract $user, ModelContract $post): bool {
        return true;
    }
}
