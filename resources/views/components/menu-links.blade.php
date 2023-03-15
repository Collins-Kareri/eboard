{{-- links assoc array from MenuLinksListComposer --}}
@foreach ($links as $link)
    @php
        $active=Request::is(''.$link['route']);
    @endphp

    <Link href="{{$link['route']}}" @class(['flex shrink-0 items-center w-full gap-2 rounded-md p-2
        menu-link-theme','active-menu-link-theme'=>$active])>
        <i class="fa-solid fa-{{$link['icon']}}"></i>
        <p>{{$link['textContent']}}</p>
    </Link>
@endforeach
