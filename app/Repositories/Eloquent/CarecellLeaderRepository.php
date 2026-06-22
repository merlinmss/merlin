<?php

namespace App\Repositories\Eloquent;

use App\Models\CarecellLeader;
use App\Repositories\Contracts\CarecellLeaderRepositoryInterface;

class CarecellLeaderRepository implements CarecellLeaderRepositoryInterface
{
    public function fetchList()
    {
        return CarecellLeader::orderBy('fname')->paginate(10);
    }

    public function find($id)
    {
        return CarecellLeader::find($id);
    }

    public function save(array $data): CarecellLeader
    {
        $id = request()->input('id', 0);

        if ($id > 0) {
            $leader = CarecellLeader::findOrFail($id);
            foreach ($data as $key => $value) {
                $leader->$key = $value;
            }
            $leader->save();
        } else {
            $leader = new CarecellLeader($data);
            $leader->save();
        }

        return $leader;
    }
}
