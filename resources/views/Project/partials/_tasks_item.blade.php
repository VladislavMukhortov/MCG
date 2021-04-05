<tr>
    <td>{{ $task->name }}</td>
    <td>{{ date('m/d/Y', strtotime($task->created_at)) }}</td>
    <td>{{ $task->created_by_name }}</td>
    <th>{{ $task->status_name }}</th>
    <th>{{ date('m/d/Y', strtotime($task->due_date)) }}</th>
    <th>{{ $task->assigned_representative_name }}</th>
    <td>
        <a href="{{ route('projects.tasks.show', [$project, $task]) }}">
            <em class="icon ni ni-eye-alt text-primary fs-17px"></em> View  / Edit
        </a>
    </td>
</tr>
