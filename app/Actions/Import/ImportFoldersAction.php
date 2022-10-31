<?php

namespace App\Actions\Import;

use App\Contracts\DataSource;

class ImportFoldersAction {

    public function __construct(DataSource $source) {
        
        $folders = $source->folders();

        foreach($folders as $name0 => &$data0) {
            $data0['item'] = $data0['item'] ?? \App\Models\Folder::query()
                                                                    ->firstOrCreate(['title' => $name0, 'parent' => 0]);
            foreach($data0['children'] as $name1 => &$data1) {
                $data1['item'] = $data1['item'] ?? \App\Models\Folder::query()
                                                                        ->firstOrCreate(['title' => $name1, 'parent' => $data0['item']->id]);
                foreach($data1['children'] as $name2 => &$data2) {
                    $data2['item'] = $data2['item'] ?? \App\Models\Folder::query()
                                                                            ->firstOrCreate(['title' => $name2, 'parent' => $data1['item']->id]);
                }
            }
        }

        $source->set('folders', $folders);
    }
}