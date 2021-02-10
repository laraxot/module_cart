<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Policies;

use Modules\Cart\Contracts\CartContract;
use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Policies\XotBasePolicy;

/**
 * Class CartPolicy.
 */
class CartPolicy extends XotBasePolicy {
    public function bellboyTakeCart(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function checkOutStep1(UserContract $user, CartContract $cart): bool { //perche' ->shop ?
        return optional($cart->shop)->checkout_enable;
    }

    public function checkOutStep2(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function checkOutStep3(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function checkOutStep4(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function checkOutStep5(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function assignCartToBellBoy(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function takeCartBellBoy(UserContract $user, ModelContract $post): bool {
        return true;
    }

    public function attach(UserContract $user, ModelContract $post): bool {
        return true;
    }
}
