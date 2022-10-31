<?php

namespace App\Actions\Import;

use App\Contracts\DataSource;

class ImportPropertiesAction {

    public function __construct(DataSource $source) {
        
        $props = $source->properties();

        foreach($props as $title => &$item) {
            $item = $item ?? \App\Models\Property::query()->firstOrCreate(['title' => $title]);
        }

        $source->set('properties', $props);
    }
}