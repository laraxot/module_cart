<div>
    @include($view.'.edit')
    <div style="top: 100px;" class="p-4 shadow ml-lg-4 rounded sticky-top">
        <dl class="row">
            <dt class="col-sm-9 p-0">Totale</dt>
            <dd class="col-sm-3 text-right p-0">@money($total_price*100)</dd>
            @foreach ($items as $k => $item)
                <dt class="col-sm-9 p-0">
                    <button data-toggle="modal" data-target="#{{ $modal_guid }}" wire:click="edit({{ $k }})"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </button>
                    {{ $item['title'] }}
                </dt>
                <dd class="col-sm-3 text-right p-0">
                    <small>@money($item['price']*100)</small>
                </dd>
                @foreach ($item['changes'] as $variation)
                    @if (array_key_exists('subs', $variation))
                        @foreach ($variation['subs'] as $var)
                            <dt class="col-sm-9 p-0">
                                <small>
                                    @if ($var['qty'] == 1)
                                        <i class="fas fa-plus" style="color:dodgerblue;"></i>
                                    @else
                                        <i class="fas fa-times" style="color:tomato;"></i>
                                    @endif
                                    {{ $var['name'] }}
                                </small>
                            </dt>
                            <dd class="col-sm-3 text-right p-0">
                                <small>
                                    @if ($var['qty'] == 1)
                                        @money($var['price']*100)
                                    @endif
                                </small>
                            </dd>
                        @endforeach
                    @endif
                @endforeach
                <dt class="col-sm-9 p-0" style="color: Mediumslateblue;">X {{ $item['qty'] }}</dt>
                <dd class="col-sm-3 text-right p-0" style="color: Mediumslateblue;">@money($item['tot_price']*100)</dd>
            @endforeach
        </dl>
        

        @if($checkout_btn)
            <div class="text-center">
                <a href="{{ $url }}" class="btn btn-primary" role="button" aria-pressed="true">Prenota</a>
            </div>
        @endif
    </div>
</div>