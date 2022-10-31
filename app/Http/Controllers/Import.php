<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Import extends Controller {
    
    public function uploadFromCSV(Request $request) {

        $file = $request->file('source');

        if($file->isValid()) {
            $data_source = app()->make(\App\Services\ImportFromCSV::class, ['source' => $file->getContent()]);

            app()->make(\App\Actions\Import\ImportFoldersAction::class, ['source' => $data_source]);
            app()->make(\App\Actions\Import\ImportFilesAction::class, ['source' => $data_source]);
            app()->make(\App\Actions\Import\ImportPropertiesAction::class, ['source' => $data_source]);
            app()->make(\App\Actions\Import\ImportUnitsAction::class, ['source' => $data_source]);
            app()->make(\App\Actions\Import\ImportGoodsAction::class, ['source' => $data_source]);
        }

        return redirect()->route('index');
    }
}
