<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->sender_name }}</td>
    <td>{{ $item->date_sent }}</td>
    <td>{{ $item->renewal_date_time }}</td>
    <td></td>
    <td><a href="{{ $item->url }}" target="_blank">Document</a></td>
    <td>View / Sign</td>
</tr>