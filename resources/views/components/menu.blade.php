{{-- todo implement authentication to stop injecting the user from ProfileComposer & ViewServiceProvider --}}

{{-- menu --}}
<div
    class="absolute inline-block h-[300px] p-6 w-full md:w-[300px] scroll_container overflow-y-auto z-10 top-0 menu-theme md:left-8">

    {{-- menu navigation links --}}
    <x-navsection-layout class="flex-col gap-4 !border-0">
        <x-menu-links />
    </x-navsection-layout>

    {{-- menu admin action buttons --}}
    <x-navsection-layout class="flex-col gap-4">
        <x-button priority='menuBtn' textContent='invite employee' icon='paper-plane' />
        <x-button priority='menuBtn' textContent='add admin' icon='person-circle-plus' />
    </x-navsection-layout>
</div>
