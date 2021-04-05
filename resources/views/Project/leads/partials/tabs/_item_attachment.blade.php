<tr>
    <td>{{ $item->attachment_description }}</td>
    <td>
        @if($item->file)
            <a href="{{ \Storage::url($item->file) }}" download="">File</a>
        @endif
    </td>
    <td>{{ $item->subcontractor_name }}</td>
    <td>{{ $item->general_contractor_name }}</td>
    <td>{{ $item->uploaded }}</td>
</tr>