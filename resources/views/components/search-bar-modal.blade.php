<x-splade-modal name="searchBar"
    class="h-fit w-fit flex flex-col items-end gap-4 container-theme mx-auto py-6 px-6 relative" :close-button="false"
    position="top">
    <i class="fa-solid fa-xmark fa-xl hover:text-slateGrey-200 cursor-pointer mt-2 mb-4" @@click="modal.close"></i>
    <x-search-bar />
</x-splade-modal>
