<?php

namespace App\Actions;

use App\DTOs\CarecellArea\CarecellAreaData;
use App\Repositories\Contracts\CarecellAreaRepositoryInterface;

class CarecellAreaAction
{
    public function __construct(
        protected CarecellAreaRepositoryInterface $areaRepository
    ) {}

    public function list()
    {
        $areas = $this->areaRepository->fetchList();
        $title = 'Carecell Area List';

        return view('pages.carecell_areas.carecell_area_list', compact('areas', 'title'));
    }

    public function find($id)
    {
        $area  = ($id == 0) ? null : $this->areaRepository->find($id);
        $title = ($id == 0) ? 'Create Carecell Area' : 'Edit Carecell Area';

        return view('pages.carecell_areas.carecell_area_detail', compact('area', 'title'));
    }

    public function execute(array $data)
    {
        return $this->areaRepository->save($data);
    }
}
