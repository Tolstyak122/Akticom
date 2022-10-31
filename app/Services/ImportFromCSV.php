<?php

namespace App\Services;

use \App\Contracts\DataSource;

class ImportFromCSV implements DataSource {

    private $data = [
        'folders' => [],
        'files' => [],
        'units' => [],
        'properties' => [],
        'goods' => [],
    ];

    public function __construct(string $source) {

        $rows = explode("\n", $source);
        array_shift($rows);

        foreach($rows as $row) {
            $cols = explode(';', $row);

            $this->data['folders'][$cols[2]] = $this->data['folders'][$cols[2]] ?? ['item' => null, 'children' => []];

            if($cols[3]) {
                $this->data['folders'][$cols[2]]['children'][$cols[3]] = $this->data['folders'][$cols[2]]['children'][$cols[3]]
                                                                            ?? ['item' => null, 'children' => []];
                if($cols[4]) {
                    $this->data['folders'][$cols[2]]['children'][$cols[3]]['children'][$cols[4]] = ['item' => null, 'children' => []];
                }
            }

            if(trim($cols[8])) {
                $this->data['properties'][trim($cols[8], '"')] = null;
            }
            if(trim($cols[11])) {
                $this->data['files'][trim($cols[11], '"')] = null;
            }
            $this->data['units'][trim($cols[10], '"')] = null;

            $this->data['goods'][trim($cols[0], '"')] = [
                'title' => trim($cols[1], '"'),
                'folder_path' => array_slice($cols, 2, 3),
                'price' => str_replace([',', '"', ' '], ['.', '', ''], $cols[5]) ?:'0',
                'price_sp' => str_replace([',', '"', ' '], ['.', '', ''], $cols[6]) ?:'0',
                'quantity' => str_replace([',', '"', ' '], ['.', '', ''], $cols[7]) ?:'0',
                'group_buy' => (int)trim($cols[9]) ?:'0',
                'main_page' => (int)trim($cols[12]) ?:'0',
                'file_path' => trim($cols[11], '"'),
                'properties' => trim($cols[8], '"'),
                'unit_title' => trim($cols[10], '"'),
                'desc' => trim($cols[13]),
                'item' => null,
            ];
        }
    }

    public function folders() {
        return $this->data['folders'];
    }

    public function files() {
        return $this->data['files'];
    }

    public function units() {
        return $this->data['units'];
    }

    public function properties() {
        return $this->data['properties'];
    }

    public function goods() {
        return $this->data['goods'];
    }

    public function set($key, $data) {
        $this->data[$key] = $data;
    }
}