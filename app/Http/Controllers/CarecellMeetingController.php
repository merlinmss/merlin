<?php

namespace App\Http\Controllers;

use App\Actions\CarecellMeetingAction;
use App\Http\Requests\CarecellMeeting\CarecellMeetingRequest;

class CarecellMeetingController extends Controller
{
    public function __construct(
        protected CarecellMeetingAction $action
    ) {
    }

    public function get()
    {
        return $this->action->list();
    }

    public function show($id)
    {
        return $this->action->find($id);
    }

    public function store(CarecellMeetingRequest $request)
    {
        $this->action->execute(
            $request->validated()
        );

        return redirect()
            ->route('carecell_meeting.list')
            ->with(
                'success',
                'Carecell meeting saved successfully.'
            );
    }

    public function getMeetingData($pastorId)
    {
        return $this->action->getLeaderData($pastorId);
    }
}
