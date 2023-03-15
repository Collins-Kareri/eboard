{{-- body container --}}
<section class="page-theme h-[140vh] relative">
    <x-splade-toggle>
        <x-nav />
        <div class="overflow-hidden flex transition-all ease-linear duration-300 fixed z-10 w-full top-[58px] left-0">
            {{-- sidebar component --}}
            <section v-show="toggled">
                <x-menu />
            </section>
            {{-- main body content --}}
            <main class="relative w-full mx-auto h-screen overflow-y-auto scroll_container px-10 py-4">
                {{$slot}}
            </main>
        </div>
    </x-splade-toggle>
</section>
