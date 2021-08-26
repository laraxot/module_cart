<?php

declare(strict_types=1);

namespace Modules\Cart\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Modules\Cart\Contracts\ProductContract.
 *
 * @property string|null                     $title
 * @property string|null                     $subtitle
 * @property PivotContract|null              $pivot
 * @property Collection|ProductCatContract[] $productCats
 */
interface ProductContract {
}
