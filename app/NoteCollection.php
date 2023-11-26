<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class NoteCollection extends Collection
{
    /**
     * Thread the comment tree.
     *
     * @return $this
     */
    public function threaded($parent_id = null)
    {
        $notes = parent::groupBy('parent_id');

        if (count($notes)) {
            // Give top level notes a cleaner index in our collection
            $keys = array_keys($notes->toArray());
            sort($keys);
            $notes['root'] = $notes[$keys[0]];
            unset($notes[$keys[0]]);


            if ($parent_id) {
                $notes['root'] = $notes[$parent_id] ?? collect();
                unset($notes[$parent_id]);
            }
        }

        return $notes;
    }
}
