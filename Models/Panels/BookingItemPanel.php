<?php

namespace Modules\Cart\Models\Panels;

//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

/**
 * Class BookingItemPanel
 * @package Modules\Cart\Models\Panels
 */
class BookingItemPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = 'Modules\Cart\Models\BookingItem';

    /**
     * on select the option label.
     * @param object $row
     * @return string
     */
    public function optionLabel(object $row):string {
        return $row->name.'['.$row->min_capacity.']['.$row->max_capacity.']';
    }

    /**
     * @return object[]
     */
    public function fields(): array {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'shop_type',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'BigInt',
                'name' => 'shop_id',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'name',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'min_capacity',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'max_capacity',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'status',
                'comment' => null,
                'col_bs_size' => 6,
            ],
        ];
    }
}
