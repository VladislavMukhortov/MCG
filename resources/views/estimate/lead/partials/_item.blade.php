<td>{{ $estimate->date_sent}}</td>
<td>{{ $estimate->created_by_name }}</td>
<td>{{ $estimate->type_name }}</td>
<td>{{ $estimate->status_name }}</td>
<td>
    <a href="{{ route('estimate-reps.show', $estimate) }}">
        <em class="icon ni ni-eye-alt text-primary fs-17px">View</em>
    </a>
</td>