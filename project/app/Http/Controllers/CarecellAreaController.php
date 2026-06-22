<?php

namespace App\Http\Controllers;

use App\Actions\CarecellAreaAction;
use App\DTOs\CarecellArea\CarecellAreaData;
use App\Http\Requests\CarecellArea\CarecellAreaRequest;

class CarecellAreaController extends Controller
{
    public function __construct(
        protected CarecellAreaAction $action
    ) {}

    public function get()
    {
        return $this->action->list();
    }

    public function show($id)
    {
        return $this->action->find($id);
    }

    public function store(CarecellAreaRequest $request)
    {
        $areaData = (array) CarecellAreaData::fromArray($request->validated());

        $this->action->execute($areaData);

        return redirect()->route('carecell_area.list')
            ->with('success', 'Carecell area saved successfully.');
    }
}
