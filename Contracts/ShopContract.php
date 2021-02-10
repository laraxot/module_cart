<?php

declare(strict_types=1);

namespace Modules\Cart\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Food\Models\BellBoy;
use Modules\Food\Models\OpeningHour;

/**
 * Modules\Cart\Contracts\ShopContract.
 *
 * @property Collection|ProductCatContract[] $productCats
 * @property string|null                     $title
 * @property Collection|OpeningHour[]        $openingHours
 * @property Collection|BellBoy[]            $bellBoys
 *
 * @method mixed openingHours()
 */
interface ShopContract {
}
