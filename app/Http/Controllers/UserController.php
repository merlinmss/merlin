<?php
namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\DTOs\User\CreateUserData;
use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
    public function __construct(CreateUserAction $action){
        $this->action = $action;
    }
    public function get(){
        return $this->action->list();
    }
    public function store(CreateUserRequest $request) {
       
        $userData           =   (array) CreateUserData::fromArray($request->validated());
        $user               =   $this->action->execute($userData);
        return response()->json($user, 201);
    }

    public function show($id){
        return $this->action->find($id);
    }

}
