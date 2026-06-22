<?php

namespace App\Repositories\Contracts;

interface CarecellMeetingRepositoryInterface
{
    public function fetchList();

    public function find($id);

    public function save(array $data);
}
