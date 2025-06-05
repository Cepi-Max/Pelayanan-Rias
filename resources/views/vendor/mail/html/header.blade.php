@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Bangka Selatan')
<img src="{{ asset('logo/Lambang_Kabupaten_Bangka_Selatan.png') }}" class="logo" alt="Bangka Selatan Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
