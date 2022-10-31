<?php

namespace App\Actions\Import;

use App\Contracts\DataSource;

class ImportGoodsAction {

    public function __construct(DataSource $source) {
        
        $goods      = $source->goods();
        $folders    = $source->folders();
        $files      = $source->files();
        $units      = $source->units();
        $properties = $source->properties();
        $fields     = array_diff(array_keys(reset($goods)), ['code']);
        $fields     = array_intersect($fields, (new \App\Models\Good())->getFillable());

        foreach($goods as $code => &$props) {
            $data = array_intersect_key($props, array_fill_keys($fields, 1));

            if($units[$props['unit_title']] ?? null) {
                $good = \App\Models\Good::query()->firstOrNew(['code' => $code]);
                $good->fill($data);//wasRecentlyCreated
                $good->unit()->associate($units[$props['unit_title']]);

                if($files[$props['file_path']] ?? null) {
                    $good->file()->associate($files[$props['file_path']]);
                }

                $path   = $props['folder_path'];
                $folder = $folders[array_shift($path)] ?? null;
                foreach($path as $level) {
                    if(!$level || !$folder) {
                        break;
                    }
                    $folder = $folder['children'][$level] ?? null;
                }

                if($folder) {
                    $good->folder()->associate($folder['item']);
                }

                $good->save();

                if($properties[$props['properties']] ?? null) {
                    $good->properties()->sync([$properties[$props['properties']]->id]);
                }

                $props['item'] = $good;
            }
        }
        $source->set('goods', $goods);
    }
}