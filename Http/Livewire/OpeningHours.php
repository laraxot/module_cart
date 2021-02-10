<?php

declare(strict_types=1);

namespace Modules\Cart\Http\Livewire;

//use Illuminate\Session\SessionManager;
//use Illuminate\Support\Carbon;
//use Livewire\Component;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Food\Models\OpeningHour;
use Modules\FormX\Http\Livewire\XotBaseFormComponent;
use Modules\FormX\Services\FieldService;

//use Modules\Cart\Models\BookingItem;

/**
 * full calendar
 * https://github.com/asantibanez/livewire-calendar
 * https://github.com/stijnvanouplines/livewire-calendar/blob/master/app/Http/Livewire/Calendar.php.
 */
class OpeningHours extends XotBaseFormComponent {
    public int $model_id;

    public string $status = 'create';

    //$week = [1=>'mon', 2=>'tue', 3=>'wed', 4=>'thu', 5=>'fri', 6=>'sat', 7=>'sun'];

    /**
     * @var string[]
     */
    public array $week = [0 => 'sun', 1 => 'mon', 2 => 'tue', 3 => 'wed', 4 => 'thu', 5 => 'fri', 6 => 'sat'];

    /*
    public function mount($model) {
        $this->model = $model;
    }
    */

    //protected $listeners = ['edit'];//se uso il nested item

    public function edit(int $id): void {
        $data = optional(OpeningHour::find($id))->toArray();
        $this->model_id = $id;
        $this->form_data = $data;
        $this->status = 'edit';
    }

    public function create(): void {
        $this->status = 'create';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {
        $view = $this->getView();
        $view_params = [
            'view' => $view,
            'modal_guid' => 'openinghoursModal',
            'modal_title' => 'Orari Apertura',
            'row' => $this->model,
            'fields' => $this->fields(),
        ];

        return view($view, $view_params);
    }

    public function fields(): array {
        return [
            FieldService::make('day_of_week')->type('select_day'),
            FieldService::make('open_at')->type('time'),
            FieldService::make('close_at')->type('time'),
        ];
    }

    /**
     * @return string
     */
    public function getView() {
        $class = get_class($this);
        $module_name = Str::between($class, 'Modules\\', '\Http\\');
        $module_name_low = Str::lower($module_name);
        $comp_name = Str::after($class, '\Http\Livewire\\');
        $comp_name = str_replace('\\', '.', $comp_name);
        $comp_name = Str::snake($comp_name);
        $view = $module_name_low.'::livewire.'.$comp_name;
        //fare distinzione fra inAdmin o no ?
        if (! view()->exists($view)) {
            dddx([
                'err' => 'View not Exists',
                'view' => $view,
            ]);
        }

        return $view;
    }

    public function store(): void {
        $data = collect($this->form_data)
            ->only(['day_of_week', 'open_at', 'close_at'])
            ->all();
        $this->model->openingHours()->create($data);
        session()->flash('message', 'Opening Hour Create Successfully.');
    }

    public function update(): void {
        $row = OpeningHour::find($this->model_id);
        $data = collect($this->form_data)
            ->only(['day_of_week', 'open_at', 'close_at'])
            ->all();
        $row->update($data);
        session()->flash('message', 'Opening Hour Update Successfully.');
    }

    public function cancel(): void {
        //$this->status = null;
        //$this->resetInputFields();
    }
}
