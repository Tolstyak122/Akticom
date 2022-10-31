<?php

namespace App\Actions\Import;

use App\Contracts\DataSource;

class ImportUnitsAction {

    public function __construct(DataSource $source) {
        
        $units = $source->units();

        foreach($units as $title => &$item) {
            $item = $item ?? \App\Models\Unit::query()->firstOrCreate(['title' => $title]);
        }

        $source->set('units', $units);
    }
}