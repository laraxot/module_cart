<?php

declare(strict_types=1);

namespace Modules\Cart\Models\Panels\Actions;

//-------- services --------
use Modules\Cart\Models\Cart;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

/**
 * Class BellBoyTakeCartAction.
 */
class BellBoyTakeCartAction extends XotBasePanelAction {
    public bool $onContainer = false;

    public bool $onItem = true;

    public string $icon = '<i class="far fa-handshake"></i>';

    /**
     * @var string
     */
    public ?string $related = 'cart';

    /**
     * Perform the action.
     *
     * @return mixed
     */
    public function handle() {
        //$view = 'pub_theme::cart.modal.'.$this->getName();
        $view = ThemeService::getView().'.'.$this->getName();

        return ThemeService::view($view)
            ->with('row', $this->row);
        //ddd($this->row);
    }

    /**
     * @return string|void
     */
    public function postHandle() {
        $data = request()->all();
        //dddx($data);
        extract($data);
        if (! isset($cart_id)) {
            dddx(['err' => 'cart_id not defined']);

            return;
        }

        $cart = Cart::where('id', $cart_id)->first();
        if (null == $cart) {
            throw new \Exception('cart not found');
        }

        [$containers,$items] = params2ContainerItem();
        $bellboy = collect($items)->firstWhere('post_type', 'bell_boy');
        if (null == $bellboy) {
            throw new \Exception('bellboy not found');
        }
        $cart->bell_boy_id = $bellboy->id;
        $cart->bell_boy_note = $note ?? '';
        $cart->bell_boy_full_name = $bellboy->full_name;
        $cart->status = $cart::OrdinePresoInConsegna; //bellboy ha accettato ordine e si impegna a portarlo a casa
        $cart->save();

        return 'fatto';
        /*
        $up = $this->updateRow();
        $this->setRow($up->row);

        return $this->handle();
        */
    }
}
