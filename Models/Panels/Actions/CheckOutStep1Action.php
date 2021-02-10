<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Cart\Models\CartItem;
use Modules\Cart\Models\CartItemVar;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class CheckOutStep1Action.
 */
class CheckOutStep1Action extends XotBasePanelAction {
    public bool $onItem = true;

    public string $icon = '';

    /**
     * Perform the action.
     *
     * @return mixed
     */
    public function handle() {
        $view = 'pub_theme::cart.modal.checkout.1';

        return ThemeService::view($view)
        ->with('row', $this->row);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postHandle() {
        //dddx(request()->all());
        /*
        $request->validate([
            '*.*.qty' => 'required',
            ]);

            $validator = Validator::make($input, [
                '*.*.qty' => 'required',
                ]);
                */

        $data = request()->all();
        //dddx($data);
        foreach ($data['item'] as $k => $up) {
            CartItem::where('id', $k)->update($up);
        }

        if (isset($data['var_item'])) {
            foreach ($data['var_item'] as $k => $up) {
                CartItemVar::where('id', $k)->update($up);
            }
        }

        $url = $this->panel->itemAction('check_out_step2')->url();

        return redirect($url);
    }
}
