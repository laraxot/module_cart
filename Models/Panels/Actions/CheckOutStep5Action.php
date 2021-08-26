<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- models --
use Modules\Cart\Models\Cart;
//-------- services --------
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class CheckOutStep5Action.
 */
class CheckOutStep5Action extends XotBasePanelAction {
    //public $onContainer = false;

    public bool $onItem = true; //onlyContainer
    //mettere freccette su e giù

    public string $icon = '';

    /**
     * Perform the action.
     *
     * @return mixed
     */
    public function handle() {
        $view = 'pub_theme::cart.modal.checkout.5';

        return ThemeService::view($view)
        ->with('row', $this->row);
    }

    /**
     * @return mixed
     */
    public function postHandle() {
        $data = request()->all();
        //dddx(get_defined_vars());

        //non so che status mettere, da decidere
        $this->row->status = Cart::OrdineInviato;
        $this->row->update();

        $view = 'pub_theme::cart.modal.checkout.6';

        return ThemeService::view($view)
        ->with('row', $this->row);
    }
}
