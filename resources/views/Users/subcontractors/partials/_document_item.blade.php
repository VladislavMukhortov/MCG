<tr class="justify-between" style="{{ !$loop->last ? 'border-bottom: 1px solid #9faec2; padding-bottom:-5px;' : '' }} ">
    <td style="border-top:none!important;">{{ $item->name }}</td>
    <td style="border-top:none!important;">{{ \Str::title($item->status_name) }}</td>
</tr>