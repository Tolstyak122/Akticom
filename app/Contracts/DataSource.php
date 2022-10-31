<?php

namespace App\Contracts;

interface DataSource {
    public function folders();
    public function files();
    public function units();
    public function properties();
    public function goods();
    public function set($key, $data);
}