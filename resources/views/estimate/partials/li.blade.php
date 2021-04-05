@foreach($data as $items)
    <li id="{{ $items->id }}" 
        data-href="{{ URL::route('estimates.get-line-items',['id'=>$items->id,'type'=>$type]) }}">
        {{ $items->full_name }}
    </li>
@endforeach