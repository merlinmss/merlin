<?php
namespace App\Repositories\Contracts;

use App\Models\Pastor;

interface PastorRepositoryInterface
{
    public function fetchPastorList();
    public function find($id);
    public function save(array $data): Pastor;
    public function savePastorRoleIds(array $data);
    public function savePastorAreaIds($pastor);
    public function savePastorLeaderIds($pastor);
}
