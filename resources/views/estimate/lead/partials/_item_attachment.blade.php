<td>{{ $attachment->attachment_description }}</td>
<td>
    @if($attachment->file)
    <a href="{{ Storage::url($attachment->file) }}" download="">File</a>
    @endif
</td>
<td>{{ $attachment->uploaded }}</td>
<td>{{ $attachment->uploaded_by_name }}</td>
<td>
    @can('delete', $attachment)
            @include('partials._destroy', [
                'url'       => route('attachments.destroy', $attachment),
                'method'    => 'DELETE',
                'btnClass'  => 'btn btn-dim d-none d-sm-inline-flex',
                'btnText'   => '<em class="icon ni ni-cross"></em><span class="d-none d-md-inline">Delete</span>'
                ])
    @endcan
</td>