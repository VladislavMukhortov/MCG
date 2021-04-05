<tr class="parent-canvas">
    <td>{{ Carbon\Carbon::parse($list->notes->created_at)->format('Y-m-d H:i:s') }}</td>

    <td class="text-break custom__long__text">
        <span>
            {{ \Illuminate\Support\Str::limit(optional($list->notes)->notes, 70) }}
        </span>
        <em class="ni ni-eye-alt show__note" data-note_id="{{ $item->id }}"></em>
    </td>
</tr>
<div class="modal fade show__note__modal" tabindex="-1" data-note_id="{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-break">{{ Carbon\Carbon::parse($list->notes->created_at)->format('Y-m-d H:i:s') }}</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                {{ optional($list->notes)->notes }}
            </div>
        </div>
    </div>
</div>