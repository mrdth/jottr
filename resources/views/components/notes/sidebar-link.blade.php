@props(['item'])


<span
    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer"
>
        <span class="flex-1 ms-3 whitespace-nowrap truncate">
            {{ $item->content }}
        </span>
</span>

