<?php

declare(strict_types=1);

namespace Modules\Cart\Contracts;

use Illuminate\Database\Eloquent\Collection;

//* @property Collection|ProductContract[]   $products

/**
 * Modules\Cart\Contracts\PivotContract.
 *
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $price
 * @property string|null $price_currency
 * @property int|null    $status
 */
interface PivotContract {
}
