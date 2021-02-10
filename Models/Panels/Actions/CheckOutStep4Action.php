<?php

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class CheckOutStep4Action
 * @package Modules\Cart\Models\Panels\Actions
 */
class CheckOutStep4Action extends XotBasePanelAction {
    //public $onContainer = false;
    /**
     * @var bool
     */
    public bool $onItem = true; //onlyContainer
    //mettere freccette su e giù
    /**
     * @var string
     */
    public string $icon = '';

        /**
    * Perform the action
* @return mixed
     */
    public function handle() {
        $view = 'pub_theme::cart.modal.checkout.4';

        return ThemeService::view($view)
        ->with('row', $this->row);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postHandle() {
        $data = request()->all();

        $this->row->update($data);

        $url = $this->panel->itemAction('check_out_step5')->url();

        return redirect($url);
    }
}
