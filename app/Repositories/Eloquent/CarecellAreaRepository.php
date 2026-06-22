<?php

namespace App\Repositories\Eloquent;

use App\Models\CarecellArea;
use App\Repositories\Contracts\CarecellAreaRepositoryInterface;

class CarecellAreaRepository implements CarecellAreaRepositoryInterface
{
    public function fetchList()
    {
        return CarecellArea::orderBy('area_name')->paginate(10);
    }

    public function find($id)
    {
        return CarecellArea::find($id);
    }

    public function save(array $data): CarecellArea
    {
        $id = request()->input('id', 0);

        if ($id > 0) {
            $area = CarecellArea::findOrFail($id);
            foreach ($data as $key => $value) {
                $area->$key = $value;
            }
            $area->save();
        } else {
            $area = new CarecellArea($data);
            $area->save();
        }

        return $area;
    }
}
