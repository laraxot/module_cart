<div>
    @include($view.'.create')
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">x
            {{ session('message') }}
        </div>
    @endif
    <div id="accordion" role="tablist">
        @foreach ($product_cats as $product_cat)
            @component('theme::components.accordition_item')
                @slot('title'){{ $product_cat->title }}@endslot
                @slot('subtitle'){{ $product_cat->subtitle }}@endslot
                @slot('id'){{ $product_cat->id }}@endslot
                @slot('content')
                    @foreach ($product_cat->products as $product)
                        @component('theme::components.card_price')
                            @slot('id'){{ $product->id }}@endslot
                            @slot('title'){{ $product->title }} @endslot
                            @slot('subtitle'){{ $product->subtitle }}@endslot
                            @slot('price')@money($product->pivot->price * 100)@endslot
                            @slot('btn')
                                <button data-toggle="modal" data-target="#{{ $modal_guid }}"
                                    wire:click="create({{ $product_cat->id }},{{ $product->id }})" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endslot
                        @endcomponent
                    @endforeach

                @endslot
            @endcomponent
        @endforeach
    </div>
</div>
