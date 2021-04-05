Hi {{ $data['name'] }} ( {{ $data['email'] }} ).

<p>Here is a link to upload the necessary information to create new request.</p>

{{  URL::route('lead-form.show', $data['link']) }}