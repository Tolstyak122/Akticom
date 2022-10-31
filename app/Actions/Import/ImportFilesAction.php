<?php

namespace App\Actions\Import;

use App\Contracts\DataSource;

class ImportFilesAction {

    public function __construct(DataSource $source) {
        
        $files = $source->files();

        foreach($files as $path => &$item) {
            $item = $item ?? \App\Models\File::query()->firstOrCreate(['path' => $path]);
        }

        $source->set('files', $files);
    }
}