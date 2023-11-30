<div class="" x-on:refresh="$refresh">
    <div class="bg-white dark:bg-gray-950 overflow-y-auto w-full xl:m-auto">
        <ul class="">
            @foreach ($notes as $note)
                <x-notes.note :note="$note"/>
            @endforeach
        </ul>
    </div>
</div>
