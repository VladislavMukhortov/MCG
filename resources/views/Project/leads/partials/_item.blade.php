<tr>
    <td>{{ date('m/d/Y h:i A', strtotime($item->created_at)) }}</td>
    <td>{{ $item->author_name }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <a href="{{ route('projects.show', $item) }}"><em class="icon ni ni-eye-alt text-primary fs-17px">View</em></a>
    </td>
</tr>