<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

/**
 * Class CartItemPanelPolicy.
 */
class CartItemPanelPolicy extends XotBasePanelPolicy {
    public function detach(\Modules\Xot\Contracts\UserContract $user, \Modules\Xot\Contracts\PanelContract $panel): bool {
        return true;
    }
}
