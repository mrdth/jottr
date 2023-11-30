<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<aside id="separator-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-slate-100 dark:bg-slate-800">

        <div class="flex justify-between mb-6">
            <x-user-settings-dropdown/>
            <x-darkmode/>
        </div>

        <ul class="space-y-2 font-medium">

            <x-notes.note-filter/>
            <li wire:click="resetNotes()">
                <span
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <x-fbi-outline.general.home
                        class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span class="ms-3">Home</span>
                </span>
            </li>
        </ul>


        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
<span class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
<x-fbi-outline.general.map-pin
    class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
<span class="ms-3">Pinned</span>
</span>
            </li>

            @foreach($this->pinned_notes as $pinned)
                <li wire:click="$dispatch('set-pinned-note', {id: {{ $pinned->id }} })">
                    <x-notes.sidebar-link :item="$pinned"/>

                </li>
            @endforeach
        </ul>
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
<span class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
<x-fbi-outline.file-folders.folder
    class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
<span class="ms-3">Collections</span>
</span>
            </li>
            @foreach($this->collections as $collection)
                <li wire:click.prevent="setParent({{ $collection->id }})">
                    <x-notes.sidebar-link :item="$collection"/>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

