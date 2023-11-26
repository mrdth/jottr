<li>
    <ul class="hidden text-xs font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full" wire:click.prevent="$set('note_type', 'notes')">
            <a href="#"
               @class([
               'inline-block w-full p-2 border-r border-gray-200 dark:border-gray-700
                hover:text-gray-700 hover:bg-gray-50 rounded-s-lg focus:outline-none  dark:hover:text-white dark:hover:bg-gray-700',
               'bg-white dark:bg-gray-700' => $this->note_type === 'notes',
               'bg-gray-100 dark:bg-gray-800' => $this->note_type !== 'notes',
               'dark:text-white' => $this->note_type === 'notes',
               ])
               aria-current="page">
                Notes
            </a>
        </li>
        <li class="w-full" wire:click.prevent="$set('note_type', 'todos')">
            <a href="#"
                @class([
                     'inline-block w-full p-2 border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50  focus:outline-none dark:hover:text-white dark:hover:bg-gray-700',
                     'bg-white dark:bg-gray-700' => $this->note_type === 'todos',
                     'bg-gray-100 dark:bg-gray-800' => $this->note_type !== 'todos',
                     'dark:text-white' => $this->note_type === 'todos',
                ])
            >
                Todos
            </a>
        </li>
        <li class="w-full" wire:click.prevent="$set('note_type', 'all')">
            <a href="#"
                @class([
                     'inline-block w-full p-2 border-gray-200 dark:border-gray-700 hover:text-gray-700 rounded-e-lg hover:bg-gray-50  focus:outline-none dark:hover:text-white dark:hover:bg-gray-700',
                     'bg-white dark:bg-gray-700' => $this->note_type === 'all',
                     'bg-gray-100 dark:bg-gray-800' => $this->note_type !== 'all',
                     'dark:text-white' => $this->note_type === 'all',
                ])
            >
                All
            </a>
        </li>
    </ul>
</li>
