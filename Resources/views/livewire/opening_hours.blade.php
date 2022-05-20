<div>
    @component('theme::components.modal.simple', ['guid' => $modal_guid, 'title' => $modal_title])
        @slot('content')
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            [{{ $status }}]
            @foreach ($fields as $field)
                @if ($field->view)
                    @include($field->view)
                @else
                    {!! $field->html() !!}
                @endif
            @endforeach
        @endslot
        @slot('btns')
            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
            @if ($status == 'create')
                <button class="btn btn-primary" wire:click.prevent="store()">{{ __('Create') }}</button>
            @endif
            @if ($status == 'edit')
                <button class="btn btn-primary" wire:click.prevent="update()">{{ __('Update') }}</button>
            @endif
        @endslot
    @endcomponent
    <div class="card border-0 shadow mb-5">
        <div class="card-header bg-gray-100 py-4 border-0">
            <div class="media align-items-center">
                <div class="media-body">
                    <h4 class="mb-0">@lang('food::txt.Opening Hours')</h4>
                </div>
                <button type="button" class="btn btn-secondary mb-2" data-toggle="modal"
                    data-target="#{{ $modal_guid }}" wire:click="create()">
                    <i class="fa fa-edit"></i>
                </button>
                {{-- <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ml-3 text-muted">
				<use xlink:href="#wall-clock-1"> </use>
            </svg> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table text-sm">
                @for ($day = 0; $day <= 6; $day++)
                    <tr>
                        <th class="pl-0 border-0">
                            @lang('food::txt.day_names_short.' . $week[$day])
                        </th>
                        @php
                            $orari = $row->openingHours->where('day_of_week', $day);
                        @endphp
                        @if (count($orari) == 0)
                            <td class="pr-0 text-left border-0" style="padding-left: 0px;">
                                ND
                            </td>
                        @else
                            @foreach ($orari as $v)
                                <td class="pr-0 text-left border-0" style="padding-left: 0px;">
                                    <button wire:click="edit({{ $v->id }})" data-toggle="modal"
                                        data-target="#{{ $modal_guid }}">
                                        @if ($v->is_closed)
                                            @lang('food::txt.closed')
                                        @else
                                            {{ substr($v->open_at, 0, -3) }} - {{ substr($v->close_at, 0, -3) }}
                                        @endif
                                    </button>
                                    {{-- Nested da degli errori
                        @livewire('opening_hours.item',['model'=>$v]) --}}
                                </td>
                            @endforeach
                        @endif
                    </tr>
                @endfor
            </table>
        </div>
    </div>
</div>
