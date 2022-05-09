{{-- uguale a Cart\Resources\views\livewire\customer\cart\edit.blade.php --}}
@component('theme::components.modal.simple', [
    'guid' => $modal_guid,
    'title' => $modal_title,
    'class' => $modal_class,
    ])
    @slot('content')
        {{ $product_subtitle }}
        <button type="button" wire:click.prevent="delete({{ $key }})" class="btn btn-primary btn-block" data-dismiss="modal">
            Elimina dal carrello
        </button>
        <div class="row">
            <div class="col-lg-3">
                <label class="form-label">Quantità</label>
                <div class="d-flex align-items-center">
                    <div class="btn btn-items btn-items-decrease" wire:click.prevent="decrement('qty')">-</div>
                    <input type="integer" wire:model="qty" name="qty" id="qty"
                        class="form-control input-items {{-- input-items-greaterthan --}}">
                    <div class="btn btn-items btn-items-increase" wire:click.prevent="increment('qty')">+</div>
                </div>
            </div>
            <div class="col-lg-9">
                <label class="form-label">Note</label>
                <textarea wire:model="note" name="note" id="note" class="form-control"></textarea>
            </div>
        </div>
        @foreach ($change_cats as $change_cat)
            @component('theme::components.accordition_item')
                @slot('title'){{ $change_cat->title }}@endslot
                @slot('subtitle'){{ $change_cat->subtitle }}@endslot
                @slot('id'){{ $change_cat->id }}@endslot
                @slot('content')
                    @foreach ($change_cat->changes as $change)
                        @component('theme::components.card_price')
                            @slot('id'){{ $change->id }}@endslot
                            @slot('title'){{ $change->title }} @endslot
                            @slot('subtitle'){{ $change->subtitle }}@endslot
                            @slot('price')@money($change->pivot->price*100,$change->pivot->currency)@endslot
                            @slot('btn')
                                <div class="btn-group btn-group-toggle">
                                    <label class="btn btn-danger">
                                        <input type="radio" wire:model="changes.{{ $change_cat->id }}.{{ $change->id }}"
                                            name="changes[{{ $change_cat->id }}][{{ $change->id }}]" autocomplete="off" value="-1">
                                        @if (isset($changes[$change_cat->id][$change->id]) && $changes[$change_cat->id][$change->id] == -1)
                                            [-]
                                        @else
                                            -
                                        @endif
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" wire:model="changes.{{ $change_cat->id }}.{{ $change->id }}"
                                            name="changes[{{ $change_cat->id }}][{{ $change->id }}]" autocomplete="off" checked value="0">
                                        @if (isset($changes[$change_cat->id][$change->id]) && $changes[$change_cat->id][$change->id] == 0)
                                            [&nbsp;]
                                        @else
                                            &nbsp;
                                        @endif
                                    </label>
                                    <label class="btn btn-success">
                                        <input type="radio" wire:model="changes.{{ $change_cat->id }}.{{ $change->id }}"
                                            name="changes[{{ $change_cat->id }}][{{ $change->id }}]" autocomplete="off" value="1">
                                        @if (isset($changes[$change_cat->id][$change->id]) && $changes[$change_cat->id][$change->id] == 1)
                                            [+]
                                        @else
                                            +
                                        @endif
                                    </label>
                                </div>
                            @endslot
                        @endcomponent
                    @endforeach
                @endslot
            @endcomponent
        @endforeach

    @endslot
    @slot('btns')
        <button type="button" {{-- wire:click.prevent="cancel()" --}} class="btn btn-secondary" data-dismiss="modal">
            Chiudi
        </button>
        <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">
            Modifica
        </button>
    @endslot
@endcomponent
