<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class CheckOutStep3Action.
 */
class CheckOutStep3Action extends XotBasePanelAction {
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
        $view = 'pub_theme::cart.modal.checkout.3';

        return ThemeService::view($view)
        ->with('row', $this->row);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postHandle() {
        $data = request()->all();
        //dddx($data);

        $this->row->update($data);

        $url = $this->panel->itemAction('check_out_step4')->url();

        return redirect($url);
    }
}
