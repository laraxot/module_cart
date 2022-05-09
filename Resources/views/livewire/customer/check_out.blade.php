<div class="row">
    @include($view.'.edit')





        @foreach($steps as $key => $value)
            @if($key == $actualStep)
                {{-- 
                    <div>
                        step{{ $key }}
                    </div>
                --}}
                <div class="col-lg-7">
                    <h1 class="h2 mb-5">Il tuo Carrello</h1>
                    @foreach ($items as $k => $item)
                        <dt class="col-sm-7 p-0">
                            <button data-toggle="modal" data-target="#{{ $modal_guid }}" wire:click="edit({{ $k }})"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                            {{ $item['title'] }}
                        </dt>
                        <dd class="col-sm-5 text-right p-0">
                            <small>@money($item['price']*100)</small>
                        </dd>
                        @foreach ($item['changes'] as $variation)
                            @if (array_key_exists('subs', $variation))
                                @foreach ($variation['subs'] as $var)
                                    <dt class="col-sm-7 p-0">
                                        <small>
                                            @if ($var['qty'] == 1)
                                                <i class="fas fa-plus" style="color:dodgerblue;"></i>
                                            @else
                                                <i class="fas fa-times" style="color:tomato;"></i>
                                            @endif
                                            {{ $var['name'] }}
                                        </small>
                                    </dt>
                                    <dd class="col-sm-5 text-right p-0">
                                        <small>
                                            @if ($var['qty'] == 1)
                                                @money($var['price']*100)
                                            @endif
                                        </small>
                                    </dd>
                                @endforeach
                            @endif
                        @endforeach
                        {{-- 
                            <dt class="col-sm-9 p-0" style="color: Mediumslateblue;">X {{ $item['qty'] }}</dt>
                        <dd class="col-sm-3 text-right p-0" style="color: Mediumslateblue;">@money($item['tot_price']*100)</dd>
                            --}}
                    @endforeach
                </div>
            @endif
        @endforeach


            {{-- 
        <br>
        <div>
            @if($previousStep)
                <button class="btn btn-primary" wire:click="changeStep({{ $previousStep }})">
                    <i class="fa fa-chevron-left"></i>Previous Step
                </button>
            @else
                <a href="{{ $url }}" class="btn btn-primary" role="button" aria-pressed="true">menu</a>
            @endif
            @if($nextStep)
                <button class="btn btn-primary" wire:click="changeStep({{ $nextStep }})">
                    Next Step<i class="fa fa-chevron-right"></i>
                </button>
            @endif
        </div>


            
            <br>
            [actualStep: {{ $actualStep }}]
            <br>
            [previousStep: {{ $previousStep }}]
            <br>
            [nextStep: {{ $nextStep }}]
            <br>
            [lastkey: {{ array_key_last($steps) }}]
            --}}






</div>