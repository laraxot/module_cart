<?php

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class AddBookingAction
 * @package Modules\Cart\Models\Panels\Actions
 */
class AddBookingAction extends XotBasePanelAction {
    /**
     * @var bool
     */
    public bool $onContainer = true;
    /**
     * @var string
     */
    public string $icon = '<i class="far fa-calendar-plus"></i>';

    /**
     * @return mixed
     */
    public function handle() {
        $view = ThemeService::getView(); //food::admin.restaurant.booking.index
        $view .= '.'.$this->getName(); //food::admin.restaurant.booking.index.add_booking
        $view = 'cart::booking.index.acts.add_booking';

        return  ThemeService::view($view);
    }
}
