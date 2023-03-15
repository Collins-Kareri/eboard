{{-- @dd(request()) --}}

<x-main-layout>
    <section class="relative flex w-full justify-between mt-8 h-screen flex-col gap-6">
        <!--Tasks-->
        <x-taskscontainer heading="upcoming tasks" />

        <!--employee departments-->
        {{-- <div class="flex relative w-full h-[300px] bg-slateGrey-900 rounded flex-col">
            <!--employee departments header-->
            <section
                class="flex items-center justify-between flex-wrap w-full px-4 py-4 border-b border-slateGrey-200 border-opacity-30 h-fit">
                <h1>Employees</h1>
                <button
                    class="text-sm flex w-fit shrink-0 items-center px-4 py-2 bg-slateGrey-50 ring-2 ring-slateGrey-50 rounded gap-2 hover:text-slateGrey-700 hover:ring-offset-2 hover:ring-offset-slateGrey-700 capitalize h-fit">
                    <p>view all</p>
                </button>
            </section>
            <section
                class="flex items-center justify-between flex-wrap w-full px-4 py-4 h-[90%] overflow-auto scroll_container">
                <!--Department container-->
                <div class="flex items-center justify-between w-full px-4 py-2 bg-slateGrey-800 rounded flex-wrap mb-4">
                    <!--department info-->
                    <section class="h-fit text-sm">
                        <h1>Department</h1>
                        <p class="text-sm font-extralight">Total members:24</p>
                    </section>
                    <!--sample deparment members-->
                    <div class="flex -space-x-2 overflow-hidden h-fit items-center">
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                    </div>
                </div>
                <!--Department container-->
                <div class="flex items-center justify-between w-full px-4 py-2 bg-slateGrey-800 rounded flex-wrap mb-4">
                    <!--department info-->
                    <section class="h-fit">
                        <h1>Department</h1>
                        <p class="text-sm font-extralight">Total members:24</p>
                    </section>
                    <!--sample deparment members-->
                    <div class="flex -space-x-2 overflow-hidden h-fit items-center">
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                    </div>
                </div>
                <!--Department container-->
                <div class="flex items-center justify-between w-full px-4 py-2 bg-slateGrey-800 rounded flex-wrap mb-4">
                    <!--department info-->
                    <section class="h-fit">
                        <h1>Department</h1>
                        <p class="text-sm font-extralight">Total members:24</p>
                    </section>
                    <!--sample deparment members-->
                    <div class="flex -space-x-2 overflow-hidden h-fit items-center">
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                    </div>
                </div>
                <!--Department container-->
                <div class="flex items-center justify-between w-full px-4 py-2 bg-slateGrey-800 rounded flex-wrap mb-4">
                    <!--department info-->
                    <section class="h-fit">
                        <h1>Department</h1>
                        <p class="text-sm font-extralight">Total members:24</p>
                    </section>
                    <!--sample deparment members-->
                    <div class="flex -space-x-2 overflow-hidden h-fit items-center">
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <img class="inline-block h-5 w-5 rounded-full ring-2 ring-white"
                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                    </div>
                </div>
            </section>
        </div> --}}
    </section>
</x-main-layout>
