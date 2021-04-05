<tr>
    <td>{{ date('m/d/Y', strtotime($note->created_at)) }}</td>
    <td>{{ $note->created_by_name }}</td>
    <td>{{ $note->notes }}</td>
{{--    <th>{{ $note->contact_name }}</th>--}}
{{--    <th>{{ $note->task_name }}</th>--}}
{{--    <th>{{ $note->general_contractor_name }}</th>--}}
</tr>
