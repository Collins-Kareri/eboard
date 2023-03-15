<nav class="px-6 py-4 sticky top-0 left-0 z-20 w-full border-b flex items-center justify-between nav-theme">
    <div class="flex h-fit items-center gap-4">
        <span>
            <span v-if="toggled" @@click="setToggle(false)" class="w-fit h-fi
             inline-block">
                <x-button priority='secondary' icon='xmark' iconSize='fa-lg' />
            </span>
            <span @@click="toggle" v-else class="w-fit h-fi
             inline-block">
                <x-button priority='secondary' icon='bars-staggered' iconSize='fa-lg' />
            </span>
        </span>
        <span class="border-l pl-4">
            <x-logo />
        </span>
    </div>
    <div class="flex h-fit items-center gap-4">
        <Link href="#searchBar">
        <x-button priority='secondary' icon='magnifying-glass' iconSize='fa-lg' />
        </Link>

        <x-button priority='secondary' icon='bell' iconSize='fa-lg' />
        <span class="cursor-pointer">
            <x-avatar :src="$user->avatar_url" size="sm" />
        </span>
    </div>

    <x-search-bar-modal />
</nav>
