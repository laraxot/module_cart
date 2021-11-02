<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels;

//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

/**
 * Class CartItemVarPanel.
 */
class CartItemVarPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Cart\Models\CartItemVar';

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
                'type' => 'Integer',
                'name' => 'cart_item_id',
                'rules' => 'required',
                'comment' => null,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'status',
                'comment' => null,
            ],
            (object) [
                'type' => 'BigInt',
                'name' => 'var_cat_id',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'var_cat_type',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'var_cat_title',
                'comment' => null,
            ],
            (object) [
                'type' => 'BigInt',
                'name' => 'var_item_id',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'var_item_type',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'var_item_title',
                'comment' => null,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'qty',
                'comment' => null,
            ],
            (object) [
                'type' => 'Decimal',
                'name' => 'price',
                'comment' => null,
            ],
            (object) [
                'type' => 'Text',
                'name' => 'note',
                'comment' => null,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'user_id',
                'comment' => null,
            ],
            (object) [
                'type' => 'Text',
                'name' => 'customer_fullname',
                'comment' => 'not in Doctrine',
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'status',
                'comment' => null,
            ],
        ];
    }
}
