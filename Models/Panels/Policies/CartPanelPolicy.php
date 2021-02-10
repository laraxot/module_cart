<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Policies;

use Modules\Cart\Contracts\CartPanelContract;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

/**
 * Class CartPanelPolicy.
 */
class CartPanelPolicy extends XotBasePanelPolicy {
    public function bellboyTakeCart(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function checkOutStep1(UserContract $user, CartPanelContract $cart): bool { //da cancellare
        $cart_row = $cart->row;

        return optional($cart_row->shop)->checkout_enable;
    }

    public function checkOutStep2(UserContract $user, PanelContract $panel): bool {//da cancellare
        return true;
    }

    public function checkOutStep3(UserContract $user, PanelContract $panel): bool {//da cancellare
        return true;
    }

    public function checkOutStep4(UserContract $user, PanelContract $panel): bool {//da cancellare
        return true;
    }

    public function checkOutStep5(UserContract $user, PanelContract $panel): bool {//da cancellare
        return true; //da cancellare
    }

    public function assignCartToBellBoy(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function takeCartBellBoy(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function attach(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
