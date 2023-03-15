<x-main-layout>
    <section class="w-full flex gap-8">
        <!-- profile details container and inputs -->
        <div class="flex-1 flex flex-col gap-4 bg-slateGrey-900 rounded py-5 px-8 h-fit">
            <h1 class="text-lg font-bold">Profile details</h1>
            <!-- profile image container -->
            <section class="inline-flex items-center gap-8">
                <span class="inline-block w-[80px] h-[80px] rounded-full bg-slateGrey-800"></span>
                <div class="inline-flex gap-4 h-fit">
                    <button
                        class="text-sm flex w-fit shrink-0 items-center px-4 py-3 bg-slateGrey-800 ring-2 ring-slateGrey-800 rounded gap-2 capitalize">
                        change
                    </button>
                    <button
                        class="text-sm flex w-fit shrink-0 items-center px-4 py-3 border-2 border-slateGrey-200 rounded gap-2 capitalize">
                        remove
                    </button>
                </div>
            </section>

            <!-- profile details inputs -->
            <section class="flex flex-wrap gap-4">
                <!-- group inputs -->
                <span class="inline-flex gap-4">
                    <!-- input container -->
                    <div class="flex-1">
                        <label for="first_name" class="capitalize">first name</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="text" id="first_name" name="first_name" placeholder="first name"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                    </div>
                    <!-- input container -->
                    <div class="flex-1">
                        <label for="last_name" class="capitalize">last name</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="text" id="last_name" name="last_name" placeholder="last name"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                    </div>
                </span>

                <span class="inline-flex gap-4 flex-col w-full">
                    <div class="flex-1">
                        <label for="email" class="capitalize">email</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="email" id="email" name="email" placeholder="email"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                    </div>
                    <!-- input container -->
                    <div class="flex-1">
                        <label for="phone_number" class="capitalize">phone number</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <span
                                class="block relative px-2 border-r-2 font-extralight h-full border-slateGrey-700">+254</span>
                            <input type="tel" id="phone_number" name="phone_number"
                                pattern="\([0-9]{3}\) [0-9]{2}-[0-9]{4}" placeholder="(712) 34-5678"
                                class="ring-0 border-0 outline-none bg-transparent" />
                        </div>
                    </div>
                </span>

            </section>

            <!-- save changes to profile details -->
            <section>
                <button
                    class="text-sm flex w-fit shrink-0 items-center px-4 py-3 bg-slateGrey-800 ring-2 ring-slateGrey-800 rounded gap-2 capitalize">
                    save
                </button>
            </section>
        </div>

        <!-- password change container and inputs -->
        <div class="flex-1 flex flex-col gap-4 bg-slateGrey-900 rounded py-5 px-8 h-fit">
            <h1 class="text-lg font-bold">Security</h1>

            <!-- password change inputs -->
            <section class="flex flex-wrap gap-4">
                <span class="inline-flex gap-4 flex-col w-full">
                    <!-- input container -->
                    <div class="w-full">
                        <label for="current_password" class="capitalize">current password</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="password" id="current_password" name="current_password"
                                placeholder="current password"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                        <span class="cursor-pointer underline underline-offset-4 text-sm">Forgot password?</span>
                    </div>

                    <!-- input container -->
                    <div class="w-full">
                        <label for="new_password" class="capitalize">new password</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="password" id="new_password" name="new_password" placeholder="new password"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                    </div>

                    <!-- input container -->
                    <div class="w-full">
                        <label for="confirm_new_password" class="capitalize">confirm new password</label>
                        <div
                            class="relative flex border border-slateGrey-200 bg-slateGrey-800 items-center rounded flex-wrap w-full">
                            <input type="password" id="confirm_new_password" name="confirm_new_password"
                                placeholder="confirm new password"
                                class="ring-0 border-0 outline-none bg-transparent w-full" />
                        </div>
                    </div>
                </span>

            </section>

            <!-- save changes to profile details -->
            <section>
                <button
                    class="text-sm flex w-fit shrink-0 items-center px-4 py-3 bg-slateGrey-800 ring-2 ring-slateGrey-800 rounded gap-2 capitalize">
                    change
                </button>
            </section>
        </div>
    </section>
</x-main-layout>