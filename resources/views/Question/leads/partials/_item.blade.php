<td>
    <a href="javascript:void(0)">
        <span class="show__question" data-question_id="{{ $item->id }}">
            <em class="ni ni-eye-alt"></em> {{ \Illuminate\Support\Str::limit($item->subject, 15) }}
        </span>
    </a>
</td>
<td>{{ $item->created_at }}</td>
<td class="text-break text-center">
    <a href="javascript:void(0)">
        <span class="show__question" data-question_id="{{ $item->id }}">
            <em class="ni ni-eye-alt"></em> {{ \Illuminate\Support\Str::limit($item->description, 20) }}
        </span>
    </a>
</td>
<td>{{ $item->author_name }}</td>
<td>{{ $item->status_title }}</td>
<td class="text-center">
    @if(!$item->is_closed)
        <a href="javascript:void(0)"
           class="mark__closed"
           data-question_id="{{ $item->id }}"
           data-url="{{ route('questions.close', $item) }}"
        >Mark Closed</a>
    @else
        <a href="javascript:void(0)">
            <em class="ni ni-check-circle question__closed"
                data-question_id="{{ $item->id }}"
                data-url="{{ route('questions.reopen', $item) }}"
                title="Click to change back status and make 'In Progress'"
            ></em>
        </a>
    @endif
</td>
<td>
    <a href="{{ route('questions.show', $item) }}">View / Edit</a>
</td>
<div class="modal fade show__question__modal" tabindex="-1" data-question_id="{{ $item->id }}">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-break">{{ $item->subject }}</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                {{ $item->description }}
            </div>
        </div>
    </div>
</div>
