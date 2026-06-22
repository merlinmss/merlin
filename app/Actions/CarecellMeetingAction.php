<?php

namespace App\Actions;

use App\Models\Pastor;
use App\Models\CarecellLeader;
use App\Models\CarecellArea;
use App\Repositories\Contracts\CarecellMeetingRepositoryInterface;

class CarecellMeetingAction
{
    public function __construct(
        protected CarecellMeetingRepositoryInterface $meetingRepository
    ) {
    }

    public function list()
    {
        $meetings = $this->meetingRepository->fetchList();
        $title = 'Carecell Meeting List';

        return view(
            'pages.carecell_meetings.carecell_meeting_list',
            compact('meetings', 'title')
        );
    }

    public function find($id)
    {
        $meeting = $id ? $this->meetingRepository->find($id) : null;

        $pastors = Pastor::orderBy('fname')->get();

        $title = $id
            ? 'Edit Carecell Meeting'
            : 'Create Carecell Meeting';

        return view(
            'pages.carecell_meetings.carecell_meeting_detail',
            compact(
                'meeting',
                'pastors',
                'title'
            )
        );
    }

    public function execute(array $data)
    {
        return $this->meetingRepository->save($data);
    }


    public function getLeaderData($pastorId)
    {
        $sectionalLeaders = CarecellLeader::query()
            ->where('leader_role', 1)
            ->whereIn('id', function ($query) use ($pastorId) {
                $query->select('leader_id')
                    ->from('pastor_leader_ids')
                    ->where('pastor_id', $pastorId);
            })
            ->get(['id', 'fname']);

        $carecellLeaders = CarecellLeader::query()
            ->where('leader_role', 3)
            ->whereIn('id', function ($query) use ($pastorId) {
                $query->select('leader_id')
                    ->from('pastor_leader_ids')
                    ->where('pastor_id', $pastorId);
            })
            ->get(['id', 'fname']);

        $areas = CarecellArea::query()
            ->whereIn('id', function ($query) use ($pastorId) {
                $query->select('area_id')
                    ->from('pastor_area_ids')
                    ->where('pastor_id', $pastorId);
            })
            ->get(['id', 'area_name']);

        return response()->json([
            'sectional_leaders' => $sectionalLeaders,
            'carecell_leaders' => $carecellLeaders,
            'areas' => $areas,
        ]);
    }
}
