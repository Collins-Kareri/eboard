<x-main-layout>
    <!--Search bar container-->
    <section class="flex w-full justify-center">
        <!--search bar-->
        <div class="flex items-center border-slateGrey-900 w-[465px] border rounded bg-slateGrey-900 gap-2">
            <!--search icon-->
            <i class="fa-solid fa-magnifying-glass fa-lg ml-4"></i>
            <input type="text" placeholder="Search..." id="search" name="search" autocomplete="off"
                class="bg-transparent outline-none border-none py-4" />
            <!--clear search bar icon-->
            <i class="fa-solid fa-circle-xmark cursor-pointer"></i>
            <!--select where to search for the term-->
            <div
                class="relative cursor-pointer w-fit px-4 py-2 border-slateGrey-200 capitalize flex items-center gap-4 border-l-[3px] rounded ml-2">
                Name
                <i class="fa-solid fa-angle-down"></i>
                <!--Options for search-->
                <!-- <section
    							class="absolute bg-slateGrey-800 w-full rounded py-4 top-14 left-0 text-left z-10 border border-slateGrey-800 px-2 flex flex-col gap-2 text-sm">
    							<p
    								class="hover:bg-slateGrey-900 px-4 py-2 font-medium bg-slateGrey-900 rounded">
    								Name
    							</p>
    							<p class="px-4 py-2 hover:bg-slateGrey-900 rounded">Email</p>
    						</section> -->
            </div>
        </div>
    </section>

    <!--filter elements and sort elements-->
    <div class="relative text-sm flex justify-between w-full border mx-auto my-4 bg-black border-x-0">
        <!--Filter element-->
        <div class="flex w-fit items-center h-fit">
            <button class="flex w-fit shrink-0 items-center px-4 py-3 ring-slateGrey-50 rounded gap-1 capitalize h-fit">
                <i class="fa-solid fa-filter"></i>
                <p>0 filters</p>
            </button>
            <button class="underline underline-offset-4 cursor-pointer px-4 border-l-2 border-slateGrey-400 rounded">
                clear all
            </button>
        </div>
        <!--sort element-->
        <button class="relative cursor-pointer w-fit px-4 py-3 capitalize flex items-center gap-2">
            <p>sort by</p>
            <i class="fa-solid fa-angle-down"></i>
            <!--Options for sort-->
            <!-- <section
    						class="absolute bg-slateGrey-800 w-[180px] rounded top-10 right-0 text-left cursor-text z-20">
    						sort by hire date element
    						<div
    							class="px-4 py-2 border-t border-slateGrey-200 lowercase">
    							<h1 class="capitalize">hire date</h1>
    							<section class="py-2 text-slateGrey-700">
    								<p
    									class="hover:bg-slateGrey-900 px-4 py-2 bg-slateGrey-900 mb-2 cursor-pointer rounded">
    									latest - oldest
    								</p>
    								<p
    									class="hover:bg-slateGrey-900 px-4 py-2 font-light cursor-pointer rounded">
    									oldest - latest
    								</p>
    							</section>
    						</div>

    						sort alphabetically element
    						<div
    							class="px-4 py-1 border-t border-slateGrey-200 lowercase">
    							<h1 class="capitalize text-medium">alphabetical</h1>
    							<section class="py-2">
    								<p
    									class="hover:bg-slateGrey-900 px-4 py-2 font-light cursor-pointer rounded">
    									a - z
    								</p>
    								<p
    									class="hover:bg-slateGrey-900 px-4 py-2 font-light cursor-pointer rounded">
    									z - a
    								</p>
    							</section>
    						</div>
    					</section> -->
        </button>
    </div>

    <section
        class="relative flex flex-wrap items-center py-2 pb-6 w-full justify-between h-fit px-4 text-sm font-light">
        <p>42 employees</p>

        <!--pagination element-->
        <div class="inline-flex h-fit items-center gap-2 text-slateGrey-700 opacity-90">
            <span class="bg-slateGrey-800 px-3 py-1 rounded border border-slateGrey-200 cursor-pointer">
                <i class="fa-solid fa-backward-step fa-lg"></i>
            </span>

            <span class="bg-slateGrey-800 px-3 py-1 rounded border border-slateGrey-200 cursor-pointer">
                <i class="fa-solid fa-forward-step fa-lg"></i>
            </span>
        </div>
    </section>

    <!--employee container-->
    <!--only justify center if employees are zero or equal to or greater than 3-->
    <div class="overflow-y-auto scroll_container h-[350px] flex flex-wrap gap-8 px-1">
        <!--employee card-->
        <section class="w-[280px] flex flex-col bg-slateGrey-900 py-4 px-4 items-center rounded">
            <!--employee edit and delete actions-->
            <div class="flex w-full justify-end relative mb-2">
                <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                <!--options for employee card-->
                <!-- <section
    							class="absolute bg-slateGrey-800 w-fit rounded py-4 px-2 top-5 right-0 flex flex-col items-start shadow shadow-slateGrey-700 border border-slateGrey-800 text-sm">
    							<button
    								class="hover:bg-slateGrey-900 px-4 py-2 w-full inline-flex gap-2 items-center h-fit rounded">
    								<i class="fa-solid fa-pen-to-square"></i>
    								<p>edit</p>
    							</button>
    							<button
    								class="hover:bg-slateGrey-900 px-4 py-2 w-full inline-flex gap-2 items-center rounded">
    								<i class="fa-solid fa-trash"></i>
    								<p>delete</p>
    							</button>
    						</section> -->
            </div>

            <!--avatar container-->
            <div class="flex flex-col items-center w-full pb-4">
                <!-- https://source.boringavatars.com/marble/ -->
                <img src=" https://source.boringavatars.com/marble/" alt="employee avatar"
                    class="w-[80px] h-[80px] rounded-full bg-slateGrey-200" />
            </div>

            <!--employee details container-->
            <section class="w-full bg-slateGrey-800 rounded px-4 py-2">
                <!--Employee name, title and contact information-->
                <div class="flex flex-col items-center gap-1 py-2 w-full">
                    <section class="text-center mb-2">
                        <h1 class="capitalize text-lg">full name</h1>
                        <p class="font-extralight">position</p>
                    </section>
                    <section class="flex flex-col items-start gap-1 w-fit">
                        <span class="inline-flex items-center gap-2 font-light text-left">
                            <i class="fa-solid fa-envelope"></i>
                            <p>mail@mail.com</p>
                        </span>
                        <span class="inline-flex items-center text-left gap-2 font-light">
                            <i class="fa-solid fa-phone"></i>
                            <p>+254-712-345-678</p>
                        </span>
                    </section>
                </div>

                <!--Employee department and hire date-->
                <div
                    class="flex flex-row items-center gap-1 border-t border-slateGrey-100 pt-2 w-full text-sm justify-between opacity-90">
                    <section class="text-center mb-2">
                        <h1 class="capitalize">department</h1>
                        <p class="font-extralight">department name</p>
                    </section>
                    <section class="text-center mb-2">
                        <h1 class="capitalize">hire date</h1>
                        <p class="font-extralight">March 3 2018</p>
                    </section>
                </div>
            </section>
        </section>
    </div>
</x-main-layout>