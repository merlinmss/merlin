<?php

namespace App\Repositories\Contracts;

use App\Models\CarecellArea;

interface CarecellAreaRepositoryInterface
{
    public function fetchList();
    public function find($id);
    public function save(array $data): CarecellArea;
}
