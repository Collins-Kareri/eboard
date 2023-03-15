@props(['date','heading'])


<div {{$attributes->merge(['class'=>'flex relative w-full rounded h-[60%] flex-col container-theme md:w-1/2'])}}>
    <x-task-header :heading="$heading" />

    <!--Tasks list-->
    <section class="flex items-start flex-wrap w-full px-4 py-4 h-full overflow-auto scroll_container flex-row">
        <x-splade-defer url='/tasks'>
            <p v-show="processing" class="w-full flex justify-center items-center h-full">
                <x-spinner />
            </p>
            <p class="w-full text-center font-light" v-if="response.length<=0">
                No tasks. You're all caught up.
            </p>

            <div v-else v-for="task in response" :key="task.id" class="w-full">
                {{-- pass a single task to task component for display --}}
                <x-task />
            </div>
        </x-splade-defer>
    </section>
</div>