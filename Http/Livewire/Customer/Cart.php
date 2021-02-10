<?php

declare(strict_types=1);

namespace Modules\Cart\Http\Livewire\Customer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Session\SessionManager;
use Livewire\Component;
//--- contracts
use Modules\Cart\Contracts\ChangeCatContract;
use Modules\Cart\Contracts\ProductCatContract;
use Modules\Cart\Contracts\ProductContract;
use Modules\Cart\Contracts\ShopContract;
use Modules\Xot\Services\TenantService;

//use Modules\Cart\Models\BookingItem;

//
 // Cart.
 // https://lightit.io/blog/laravel-livewire-shopping-cart-demo/.
 // https://stackoverflow.com/questions/57562640/quantity-of-shopping-cart-is-not-updating.
 //

/**
 * Modules\Cart\Http\Livewire\Customer\Cart.
 *
 * @property ShopContract                   $shop
 * @property ProductContract                $product
 * @property ProductCatContract             $product_cat
 * @property Collection|ChangeCatContract[] $changeCats
 */
class Cart extends Component {
    public int $shop_id;

    public string $shop_type;

    public int $product_cat_id;

    //protected $session;

    public array $items = [];

    public int $total_qty = 0;

    public float $total_price = 0;

    public bool $checkout_enable;

    /**
     * @var Collection|ChangeCatContract[]
     */
    public $change_cats;

    public int $key;

    public string $product_subtitle;

    public int $qty;

    public string $note;

    public array $changes = [];

    public string $modal_guid = 'cartModal';

    public string $modal_title = 'cartModal';

    public string $modal_class = 'modal-lg';

    public bool $checkout_btn = false;

    public string $url;

    /**
     * @var string[]
     */
    protected $listeners = [
        'cart::customer.add' => 'add',
    ];

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
     * @return mixed
     */
    public function getShopProperty() {
        return TenantService::modelEager($this->shop_type)->find($this->shop_id);
    }

    //return Collection|\Illuminate\Database\Eloquent\Model|ProductCatContract[]|null

    public function getProductCatProperty(): ProductCatContract {
        return $this->shop->productCats->find($this->product_cat_id);
    }

    public function increment(string $name): void {
        ++$this->{$name};
    }

    public function decrement(string $name): void {
        if ($this->{$name} > 1) {
            --$this->{$name};
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {
        $view = 'cart::livewire.customer.cart';
        $view_params = [
            'view' => $view,
        ];
        $this->total_price = collect($this->items)->sum('tot_price');

        if (count($this->items) > 0) {
            $this->checkout_btn = true;
        } else {
            $this->checkout_btn = false;
        }

        return view($view, $view_params);
    }

    /**
     * @param mixed $item
     *
     * @return void
     */
    public function add($item) {
        ++$this->total_qty;

        $subprice = $item['price'];
        foreach ($item['changes'] as $variation) {
            foreach ($variation['subs'] as $var) {
                if (1 == $var['qty']) {
                    $subprice += $var['price'];
                }
            }
        }
        $item['tot_price'] = $subprice * $item['qty'];

        $this->items[] = $item;

        session()->put('cart::items_'.$this->shop_id.'_'.$this->shop_type, $this->items); //per mantenere i dati in sessione
    }

    public function edit(int $k): void {
        $item = $this->items[$k];
        $this->key = $k;
        $this->changes = [];

        $this->product_subtitle = $item['sub_title'];
        /*
        if (0) {
            $this->modal_title = $item['cat_title'].' - '.$item['title'];
        } else {
            $this->modal_title = $item['title'].' <small>('.$item['cat_title'].')</small>';
        }
        */
        $this->modal_title = $item['title'].' <small>('.$item['cat_title'].')</small>';

        $this->qty = $item['qty'];
        $this->note = $item['note'];
        $this->change_cats = $this->shop->productCats->find($item['cat_id'])->changeCats;

        foreach ($item['changes'] as $change) {
            if (array_key_exists('subs', $change)) {
                foreach ($change['subs'] as $sub) {
                    $this->changes[$change['cat_id']][$sub['id']] = $sub['qty'];
                }
            }
        }

        //dddx($this->changes);
    }

    public function update(): void {
        $changes_eff = collect($this->changes)->map(
            function ($item, $key) {
                $tmp = [];
                $cat = $this->change_cats->firstWhere('id', $key);
                $variations = $cat->changes;
                $tmp['cat_id'] = $cat->id;
                $tmp['cat_name'] = $cat->title;
                foreach ($item as $k => $qty) {
                    $var = $variations->firstWhere('id', $k);
                    if (0 != $qty) {
                        $tmp['subs'][$k]['id'] = $k;
                        $tmp['subs'][$k]['qty'] = $qty;
                        $tmp['subs'][$k]['name'] = $var->title;
                        $tmp['subs'][$k]['price'] = $var->pivot->price;
                    }
                }

                return $tmp;
            }
        )->all();

        $this->items[$this->key]['qty'] = $this->qty;
        $this->items[$this->key]['note'] = $this->note;
        $this->items[$this->key]['changes'] = $changes_eff;

        $subprice = $this->items[$this->key]['price'];

        foreach ($this->items[$this->key]['changes'] as $variation) {
            if (array_key_exists('subs', $variation)) {
                foreach ($variation['subs'] as $var) {
                    if (1 == $var['qty']) {
                        $subprice += $var['price'];
                    }
                }
            }
        }

        $this->items[$this->key]['tot_price'] = $subprice * $this->items[$this->key]['qty'];

        session()->put('cart::items_'.$this->shop_id.'_'.$this->shop_type, $this->items); //per mantenere i dati in sessione
    }

    public function delete(int $k): void {
        unset($this->items[$k]);

        session()->put('cart::items_'.$this->shop_id.'_'.$this->shop_type, $this->items); //per mantenere i dati in sessione
    }
}
