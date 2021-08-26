<?php

declare(strict_types=1);

namespace Modules\Cart\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Modules\Cart\Contracts\ProductCatContract.
 *
 * @property string|null                    $title
 * @property string|null                    $subtitle
 * @property Collection|ProductContract[]   $products
 * @property Collection|ChangeCatContract[] $changeCats
 */
interface ProductCatContract {
}
