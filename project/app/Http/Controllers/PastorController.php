<?php
namespace App\Http\Controllers;

use App\Actions\PastorAction;
use App\DTOs\CreatePastorData;
use App\Http\Requests\CreatePastorRequest;

use Illuminate\Support\Facades\Storage;

class PastorController extends Controller
{
    public function __construct(PastorAction $action){
        $this->action = $action;
    }
    public function get(){
        return $this->action->list();
    }
    public function store(CreatePastorRequest $request) {
        $pastorData         =   (array) CreatePastorData::fromArray($request->validated());
        $user               =   $this->action->execute($pastorData);
        return redirect()->route('pastor.list')->with('success', 'Pastor data saved successfully.')    ;
    }

    public function show($id){
        return $this->action->find($id);
    }

}
