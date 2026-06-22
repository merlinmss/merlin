<?php

namespace App\Repositories\Eloquent;

use App\Models\CarecellMeeting;
use App\Repositories\Contracts\CarecellMeetingRepositoryInterface;

class CarecellMeetingRepository implements CarecellMeetingRepositoryInterface
{
    public function fetchList()
    {
        return CarecellMeeting::with([
            'pastor',
            'sectionalLeader',
            'carecellLeader',
            'area'
        ])->latest()->paginate(10);
    }

    public function find($id)
    {
        return CarecellMeeting::find($id);
    }

    public function save(array $data)
    {
        $id = request()->input('id', 0);

        if ($id > 0) {
            $meeting = CarecellMeeting::findOrFail($id);
            $meeting->update($data);
        } else {
            $meeting = CarecellMeeting::create($data);
        }

        return $meeting;
    }
}