@props(['src','size'=>'sm'])

<span @class([ 'block avatar-theme' , 'w-[40px] h-[40px]'=>$size=='sm',
    'w-[60px] h-[60px]'=>$size=='md',
    'w-[80px] h-[80px]'=>$size=='lg'
    ])>
    <img src="{{$src}}" class="w-full h-full rounded-full" />
    {{-- <i class="fa-solid fa-skull fa-lg"></i> --}}
</span>
