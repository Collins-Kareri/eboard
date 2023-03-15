{{-- class styling of nav section --}}
@php
$classes="flex justify-between border-t border-metalGun-300 py-4 border-opacity-30 mb-2 opacity-80
capitalize"
@endphp

{{-- nav section container --}}
<section {{$attributes->merge(['class'=>$classes])}}>
    {{$slot}}
</section>