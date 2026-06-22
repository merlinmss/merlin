<?php

namespace App\Http\Controllers;

use App\Actions\CarecellLeaderAction;
use App\DTOs\CarecellLeader\CarecellLeaderData;
use App\Http\Requests\CarecellLeader\CarecellLeaderRequest;

class CarecellLeaderController extends Controller
{
    public function __construct(
        protected CarecellLeaderAction $action
    ) {}

    public function get()
    {
        return $this->action->list();
    }

    public function show($id)
    {
        return $this->action->find($id);
    }

    public function store(CarecellLeaderRequest $request)
    {
        $leaderData = (array) CarecellLeaderData::fromArray($request->validated());

        $this->action->execute($leaderData);

        return redirect()->route('carecell_leader.list')
            ->with('success', 'Carecell leader saved successfully.');
    }
}
