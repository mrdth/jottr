<!-- Darkmode Toggler -->
<button x-on:click="darkMode = !darkMode" type="button"
        title="toggle darkmode"
        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700  rounded-lg text-sm p-2.5">
    <x-fbi-outline.weather.moon
        x-show="! darkMode"
        class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
    <x-fbi-outline.weather.sun
        x-show="darkMode"
        class="w-5 h-5 text-gray-500 dark:text-gray-400"/>

</button>
