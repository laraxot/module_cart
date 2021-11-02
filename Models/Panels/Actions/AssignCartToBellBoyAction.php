<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Food\Models\BellBoy;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class AssignCartToBellBoyAction.
 */
class AssignCartToBellBoyAction extends XotBasePanelAction {
    public bool $onContainer = false;

    public bool $onItem = true;

    //onlyContainer
    //mettere freccette su e giù

    public string $icon = '<i class="far fa-handshake"></i>';

    /**
     * Undocumented variable.
     *
     * @var int|string|null
     */
    protected $user_id;

    /**
     * AssignCartToBellBoyAction constructor.
     *
     * @param int|string|null $user_id
     */
    public function __construct($user_id) {
        $this->user_id = $user_id;
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

        //return $view;
        /*
        return ThemeService::view($view);
        */
        return ThemeService::view($view)
        ->with('row', $this->row);
        //ddd($this->row);
    }

    /**
     * @return mixed
     */
    public function postHandle() {
        $data = request()->all();
        extract($data);
        [$containers,$items] = params2ContainerItem();

        $bellboy = BellBoy::query()->where('user_id', $this->user_id)->first();
        if (null == $bellboy) {
            throw new \Exception('bellboy not found');
        }

        $cart = $items[0];

        $cart->bell_boy_id = $bellboy->id;
        $cart->bell_boy_full_name = $bellboy->full_name;
        $cart->status = $cart::OrdinePresoInConsegna;

        $cart->save();
        /*
        dddx($cart);
        $bellboy_panel = Panel::get($bellboy);
        $url = $bellboy_panel->relatedUrl(['related_name' => 'profile', 'act' => 'index_edit']);
        dddx($url);
        */

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
        return $this->handle();
    }
}
