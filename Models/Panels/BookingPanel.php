<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels;

//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

/**
 * Class BookingPanel.
 */
class BookingPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Cart\Models\Booking';

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
                //'type' => 'Integer',
                //'name' => 'booking_item_id',

                'type' => 'SelectRelationshipOne',
                'name' => 'bookingItem',

                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'guest_num',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'occasion_id',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'customer_id',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'first_name',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'last_name',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'email',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'telephone',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Text',
                'name' => 'note',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Time',
                'name' => 'reserve_time',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Date',
                'name' => 'reserve_date',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Date',
                'name' => 'date_added',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Date',
                'name' => 'date_modified',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'assignee_id',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Boolean',
                'name' => 'notify',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'ip_address',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'user_agent',
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
