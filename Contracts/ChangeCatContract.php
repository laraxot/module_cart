<?php

declare(strict_types=1);

namespace Modules\Cart\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Modules\Cart\Contracts\ChangeCatContract.
 *
 * @property string|null                     $title
 * @property string|null                     $subtitle
 * @property Collection|PivotContract[]      $pivot
 * @property Collection|ProductCatContract[] $productCats
 */
interface ChangeCatContract {
}
