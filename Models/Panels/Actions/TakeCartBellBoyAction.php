<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Cart\Models\Cart;
use Modules\Food\Models\BellBoy;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;
use Modules\Xot\Services\PanelService as Panel;

//-------- bases -----------

/**
 * Class TakeCartBellBoyAction.
 */
class TakeCartBellBoyAction extends XotBasePanelAction {
    public bool $onContainer = true;

    public bool $onItem = false; //onlyContainer

    public string $icon = '<i class="far fa-handshake"></i>';

    /**
     * Undocumented variable.
     *
     * @var int|string|null
     */
    protected $auth_user_id;

    /**
     * TakeCartBellBoyAction constructor.
     *
     * @param int|string|null $auth_user_id
     */
    public function __construct($auth_user_id) {
        $this->auth_user_id = $auth_user_id;
    }

    /**
     * Perform the action.
     *
     * @return mixed
     */
    public function handle() {
        //return 'preso';
        //dddx(get_defined_vars());

        $view = 'pub_theme::cart.modal.'.$this->getName();
        $cart = Cart::query()->find(\Request::input('cart_id'));
        //return $view;
        /*
        return ThemeService::view($view);
        */
        return ThemeService::view($view)->with('row', $cart);
        //ddd($this->row);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function postHandle() {
        $data = request()->all();
        extract($data);
        //dddx(get_defined_vars());
        [$containers,$items] = params2ContainerItem();
        if (! isset($id)) {
            dddx(['err' => 'migging id']);

            return;
        }

        $bellboy = BellBoy::query()->where('auth_user_id', $this->auth_user_id)->first();
        if (null == $bellboy) {
            throw new \Exception('not found belboy');
        }
        $bellboy_panel = Panel::get($bellboy);
        $cart = Cart::query()->find($id);
        if (null == $cart) {
            throw new \Exception('not found cart');
        }
        $cart->bell_boy_id = $bellboy->id;
        $cart->bell_boy_full_name = $bellboy->full_name;
        $cart->status = $cart::OrdinePresoInConsegna;

        $cart->save();
        /*
        dddx($cart);
        */
        $profile = $bellboy->profile;
        $profile_panel = Panel::get($profile);
        $url = $profile_panel->relatedUrl(['related_name' => 'bell_boy', 'act' => 'index_edit']);
        \Session::flash('status', 'aggiornato! ');

        return redirect($url);
        //$url1 = $bellboy_panel->setParent($profile_panel)->url(['act' => 'index_edit']);
        //dddx([$url, $url1]);

        /*
        $cart = Cart::where('id', $cart_id)->first();
        $bellboy = collect($items)->firstWhere('post_type', 'bell_boy');
        $cart->bell_boy_id = $bellboy->id;
        $cart->bell_boy_note = $note;
        $cart->status = 5; //bellboy ha accettato ordine e si impegana a portarlo a casa
        $cart->save();
        */

        /*
        $up = $this->updateRow();
        $this->setRow($up->row);

        */
        //return $this->handle();
    }
}
