
<tr>
<td width="100%" colspan="2" style="padding-left: {{ $padding}}">{{ $child_items['name'] }}</td>
</tr>
@foreach($child_items['children'] as $child)
    @if(!empty($child['children']))
        @include('estimate.line-items-table',['child_items'=>$child, 'padding'=>'50px'])
        @else
        <tr>
            <td width="100%" style="padding-left: {{$padding}}">{{ $child['name'] }}</td>
            <td>
                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('delete_{{ $child['id'] }}').submit();"><em class="icon ni ni-trash"></em></a>
                <form action="{{ route('remove-template-line-item', $child['id']) }}" id="delete_{{ $child['id'] }}">
                    <input type="hidden" name="estimate_template_id" value="{{ $reads->id }}">
                    <input type="hidden" name="folder_item_id" value="{{ $child_items['id'] }}">
                    <input type="hidden" name="item_id" value="{{ $child['id'] }}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endif
@endforeach
