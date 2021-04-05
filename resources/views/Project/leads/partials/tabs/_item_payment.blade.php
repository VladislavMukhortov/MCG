<tr>
    <td>{{ $item->status_name }}</td>
    <td>{{ $item->amount }}</td>
    <td>{{ date('m/d/Y h:i A', strtotime($item->due_date)) }}</td>
    <td></td>
    <td></td>
</tr>