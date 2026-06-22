<?php

namespace App\Repositories\Contracts;

use App\Models\CarecellLeader;

interface CarecellLeaderRepositoryInterface
{
    public function fetchList();
    public function find($id);
    public function save(array $data): CarecellLeader;
}
