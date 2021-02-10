<?php

declare(strict_types=1);

namespace Modules\Cart\Http\Livewire\Customer;

use Illuminate\Session\SessionManager;
//--- contracts
use Modules\Cart\Contracts\ProductCatContract;
use Modules\Cart\Contracts\ProductContract;
use Modules\Cart\Contracts\ShopContract;

/**
 * Modules\Cart\Http\Livewire\Customer\ShopProducts.
 *
 * @property ShopContract       $shop
 * @property ProductContract    $product
 * @property ProductCatContract $product_cat
 */
class Checkout extends Cart {
    public array $steps = ['1' => true, '2' => false, '3' => false, '4' => false];

    public int $actualStep = 1;

    public ?int $previousStep = null;

    public ?int $nextStep = 2;

    public int $shop_id;

    public string $shop_type;

    public string $url;

    public function mount(SessionManager $session, int $shop_id, string $shop_type, string $url): void {
        //$this->session = $session;
        $this->shop_id = $shop_id;
        $this->shop_type = $shop_type;
        $this->url = $url;
        //session()->flush();

        if ($session->has('cart::items_'.$this->shop_id.'_'.$this->shop_type)) {
            $this->items = $session->get('cart::items_'.$this->shop_id.'_'.$this->shop_type);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {
        $view = 'cart::livewire.customer.check_out';
        $view_params = [
            'product_cats' => $this->shop->productCats,
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function changeStep(int $step): void {
        foreach ($this->steps as $key => $value) {
            if ($key == $step) {
                $value = true;
            } else {
                $value = false;
            }
        }
        $this->actualStep = $step;
        $this->btnStep();
    }

    public function btnStep(): void {
        switch ($this->actualStep) {
            case 1:
                $this->previousStep = null;
                $this->nextStep = $this->actualStep + 1;
                break;
            case array_key_last($this->steps):
                $this->previousStep = $this->actualStep - 1;
                $this->nextStep = null;
                break;
            default:
                $this->previousStep = $this->actualStep - 1;
                $this->nextStep = $this->actualStep + 1;
        }
    }
}
