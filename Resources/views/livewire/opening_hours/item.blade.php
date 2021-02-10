<div>
    <button wire:click="edit()" data-toggle="modal" data-target="#openinghoursModal">
    @if($row->is_closed)
        @lang('food::txt.closed')
    @else
        {{ substr($row->open_at,0,-3) }} - {{ substr($row->close_at,0,-3) }}
    @endif
    </button>
</div>
