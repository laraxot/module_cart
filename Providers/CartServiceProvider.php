<?php

declare(strict_types=1);

namespace Modules\Cart\Providers;

//---- bases ----
//use Livewire\Livewire;
//use Modules\Cart\Http\Livewire\Calendar;
//use Modules\FormX\Http\Livewire\Numberer;
use Modules\Xot\Providers\XotBaseServiceProvider;

/**
 * Class CartServiceProvider.
 */
class CartServiceProvider extends XotBaseServiceProvider {
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'cart';

    /*
    public function bootCallback():void {
        $this->registerLivewireComponents();
    }

    public function registerCallback():void {
    }
    */
    /*
    public function registerLivewireComponents() {
        if (class_exists("Livewire\Livewire")) {
            Livewire::component($this->module_name.'::calendar', Calendar::class);
            //Livewire::component($this->module_name.'::numberer', Numberer::class);
        }
    }
    */
}
