<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels;

use Illuminate\Http\Request;
//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

/**
 * Class CartPanel.
 */
class CartPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Cart\Models\Cart';

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
                'type' => 'BigInt',
                'name' => 'post_id',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'post_type',
                'comment' => null,
            ],
            (object) [
                'type' => 'Text',
                'name' => 'customer_fullname',
                'comment' => null,
                'rules' => 'required',
            ],
            (object) [
                'type' => 'Address',
                'name' => 'destination',
                'comment' => null,
                'rules' => 'required',
            ],
            (object) [
                'type' => 'Text',
                'name' => 'note',
                'comment' => null,
                'rules' => 'required',
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'price_complete',
                'comment' => null,
                'rules' => 'required',
            ],
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(Request $request = null) {
        $auth_user_id = \Auth::id();

        return [
            new Actions\CheckOutStep1Action(), //da rinominare old o cancellare
            new Actions\CheckOutStep2Action(), //da rinominare old o cancellare
            new Actions\CheckOutStep3Action(), //da rinominare old o cancellare
            new Actions\CheckOutStep4Action(), //da rinominare old o cancellare
            new Actions\CheckOutStep5Action(), //da rinominare old o cancellare
            new Actions\AssignCartToBellBoyAction($auth_user_id), //creato come prova/alternativa di TakeCartBellBoyAction
            new Actions\BellBoyTakeCartAction(),
            new Actions\TakeCartBellBoyAction($auth_user_id),
        ];
    }

    /**
     * @return string
     */
    public function swiperItem() {
        return 'pub_theme::cart.swiper.item';
    }
}
