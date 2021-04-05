<tr>
    <td>
        {!! \Str::length($item->attachment_description) > 70
            ? "<em class='ni ni-info-fill' title='$item->attachment_description' style='cursor: pointer;'></em>" . \Str::limit($item->attachment_description, 70)
            : $item->attachment_description
        !!}
    </td>
    <td>
        @if($item->file)
            <a href="{{ $item->file_url }}" download="">{{ $item->file_name }}</a>
        @endif
    </td>
    <td>{{ $item->uploaded }}</td>
    <td>{{ $item->uploaded_by_name }}</td>
</tr>