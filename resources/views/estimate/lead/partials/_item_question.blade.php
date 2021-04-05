<td>{{ $question->id }}</td>
<td>{{ $question->subject }}</td>
<td>{{ $question->description }}</td>
<td>{{ $question->status_name }}</td>
<td>{{ Carbon\Carbon::parse($question->created_at)->format('m/d/Y h:i A') }}</td>
<td>{{ $question->author_name }}</td>