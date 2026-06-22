<?php

namespace App\Actions;

use App\DTOs\CarecellLeader\CarecellLeaderData;
use App\Repositories\Contracts\CarecellLeaderRepositoryInterface;

class CarecellLeaderAction
{
    public function __construct(
        protected CarecellLeaderRepositoryInterface $leaderRepository
    ) {}

    public function list()
    {
        $leaders = $this->leaderRepository->fetchList();
        $title   = 'Carecell Leader List';

        return view('pages.carecell_leaders.carecell_leader_list', compact('leaders', 'title'));
    }

    public function find($id)
    {
        $leader = ($id == 0) ? null : $this->leaderRepository->find($id);
        $title  = ($id == 0) ? 'Create Carecell Leader' : 'Edit Carecell Leader';

        return view('pages.carecell_leaders.carecell_leader_detail', compact('leader', 'title'));
    }

    public function execute(array $data)
    {
        return $this->leaderRepository->save($data);
    }
}
