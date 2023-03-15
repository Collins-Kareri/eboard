@props(['priority','textContent','icon','iconSize'=>''])

@php
    $classes=[
        'root'=>'py-3 px-4 rounded cursor-pointer capitalize h-fit w-fit text-sm flex-row-reverse',
        'primary'=>'primary-btn-theme',
        'secondary'=>'secondary-btn-theme',
        'menuBtn'=>'flex shrink-0 items-center w-full gap-2 p-2 capitalize flex
        shrink-0 items-center gap-2 menu-btn-theme'
    ];
@endphp

<button
    {{$attributes->merge(['class'=>$priority=='menuBtn'?$classes["{$priority}"]:$classes['root'].' '.$classes["{$priority}"]])}}>

    @isset($icon)
        <i class='fa-solid fa-{{$icon}} {{$iconSize}}'></i>
    @endisset

    @isset($textContent)
        <p>{{$textContent}}</p>
    @endisset
</button>
