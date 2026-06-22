<?php
namespace App\Http\Controllers;

use App\Actions\UserAction;
use App\DTOs\User\CreateUserData;
use App\Http\Requests\User\CreateUserRequest;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(UserAction $action){
        $this->action = $action;
    }
    public function get(){
        return $this->action->list();
    }
    public function userList()
    {
        return $this->action->getUserList();
    }
    public function userData()
    {
        return $this->action->getUserData();
    }
    public function store(CreateUserRequest $request) {
        $userData           =   (array) CreateUserData::fromArray($request->validated());
        $user               =   $this->action->execute($userData);
        return redirect()->back()->with('success', 'User saved successfully.')    ;
    }

    public function show($id){
        return $this->action->find($id);
    }

}
