<?php

namespace Modules\Cart\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

/**
 * Class CartItemPanelPolicy
 * @package Modules\Cart\Models\Panels\Policies
 */
class CartItemPanelPolicy extends XotBasePanelPolicy {
    /**
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Xot\Contracts\PanelContract $panel
     * @return bool
     */
    public function detach(\Modules\Xot\Contracts\UserContract $user, \Modules\Xot\Contracts\PanelContract $panel):bool {
        return true;
    }
}
