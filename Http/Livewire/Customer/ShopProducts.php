<?php

declare(strict_types=1);

namespace Modules\Cart\Http\Livewire\Customer;

use Illuminate\Database\Eloquent\Collection;
//--- contracts
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Modules\Cart\Contracts\ChangeCatContract;
//--- services
use Modules\Cart\Contracts\ProductCatContract;
use Modules\Cart\Contracts\ProductContract;
use Modules\Cart\Contracts\ShopContract;
use Modules\Tenant\Services\TenantService;

/**
 * Modules\Cart\Http\Livewire\Customer\ShopProducts.
 *
 * @property ShopContract       $shop
 * @property ProductContract    $product
 * @property ProductCatContract $product_cat
 */

 // passare a form_data
class ShopProducts extends Component {
    public int $shop_id;

    public string $shop_type;

    public int $product_cat_id;

    public string $product_cat_title;

    public string $modal_title;

    public string $modal_guid = 'createShopProducts';

    public string $modal_class = 'modal-lg';

    public int $product_id;

    public string $product_title;

    public string $product_subtitle;

    public ?float $product_price;

    public ?int $qty;

    public ?string $note = null;

    /**
     * @var Collection|ChangeCatContract[]
     */
    public $change_cats;

    public array $changes = [];

    /*
    public function fix($arr) {
        return collect($arr)->map(
            function ($item) {
                return (object) $item;
            }
        ); //->all();
    }
    */

    public function mount(int $shop_id, string $shop_type): void {
        $this->shop_id = $shop_id;
        $this->shop_type = $shop_type;
    }

    /**
     * @return mixed
     */
    public function getShopProperty() {
        $builder = TenantService::modelEager($this->shop_type);

        return $builder->find($this->shop_id);
    }

    //return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|ProductCatContract[]|null

    /**
     * Undocumented function.
     *
     * @return Model|\Modules\Cart\Contracts\ProductCatContract|null
     */
    public function getProductCatProperty() {
        return $this->shop->productCats->find($this->product_cat_id);
    }

    // @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|ProductContract[]|null

    /**
     * Undocumented function.
     *
     * @return Model|\Modules\Cart\Contracts\ProductContract|null
     */
    public function getProductProperty() {
        return $this->product_cat->products->find($this->product_id);
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
        $view = 'cart::livewire.customer.shop_products';
        $view_params = [
            'product_cats' => $this->shop->productCats,
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function create(int $product_cat_id, int $product_id): void {
        $this->product_cat_id = $product_cat_id;
        $this->product_id = $product_id;
        $this->product_cat_title = optional($this->product_cat)->title;
        $this->product_title = optional($this->product)->title;
        $this->product_subtitle = optional($this->product)->subtitle;
        /*
        if (0) {
            $this->modal_title = $this->product_cat_title.' - '.$this->product_title;
        } else {
            $this->modal_title = $this->product_title.' <small>('.$this->product_cat_title.')</small>';
        }
        */
        $this->modal_title = $this->product_title.' <small>('.$this->product_cat_title.')</small>';
        $this->qty = 1;
        $this->product_price = (float) $this->product->pivot->price;
        $this->change_cats = $this->product_cat->changeCats;
    }

    public function store(): void {
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

        $this->emit('cart::customer.add',
            [
                'cat_id' => $this->product_cat_id,
                'id' => $this->product_id,
                'cat_title' => $this->product_cat_title,
                'title' => $this->product_title,
                'sub_title' => $this->product_subtitle,
                'qty' => $this->qty,
                'price' => $this->product_price,
                'changes' => $changes_eff,
                'note' => $this->note,
            ]
        );
        session()->flash('message', 'Store Successfully.');
        $this->resetInputFields();
    }

    public function cancel(): void {
        //$this->updateMode = false;
        $this->resetInputFields();
    }

    public function resetInputFields(): void {
        $this->qty = 1;
        $this->note = null;
        $this->change_cats = collect([]);
        $this->changes = [];
    }
}
