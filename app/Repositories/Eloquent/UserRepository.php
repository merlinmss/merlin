<?php

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Models\UserRoleId;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\UserRepositoryInterface;
use Yajra\DataTables\DataTables;

class UserRepository implements UserRepositoryInterface
{
    public function save(array $data): User
    {
        if(request()->input('id')>0) {
            $user = User::find(request()->input('id'));
            foreach($data as $k=>$val){ $user->$k = $val; }
            $user->save();
        }else{
            $user = new User($data);
            $user->save();
        }
        if (request()->hasFile('profile_pic')) {
            $storageDevice = config('filesystems.default');
            // delete old image from storage
         //   if (Storage::disk($storageDevice)->exists($user->profile_pic)) {
         //       Storage::disk($storageDevice)->delete($user->profile_pic);
          //  }
            // store new image and update user record
            $filename = request()->file('profile_pic')->store("users/$user->id/profile_pic", $storageDevice);
            $user->profile_pic = $filename;
            $user->save();
        }
        return $user;
    }
    public function saveUserRoleIds($user)
    {
        UserRoleId::where('user_id', $user->id)->delete();
        $user->roles()->attach(request()->input('roles'));
    }

    public function fetchUserList()
    {
        return User::with('roles')->paginate(10);
    }

    public function fetchUserData()
    {
        $users = User::with('roles')->get();
  /*      foreach ($users as $user) {
            $roleNames  = $user->roles->pluck('role_name')->toArray();
            $rNames = '';
            if($roleNames){ foreach($roleNames as $roleName){ $rNames .= '<div>'.$roleName.'</div>'; }}
            else{ $rNames = false;}
            $user->role_names = $rNames ?? '';
        } */
     //   return DataTables::of($users)->make(true);


            return  DataTables::of($users)
            ->addColumn('roles', function ($row) {
                $html = '';
                // Loop through each related model dynamically
                foreach ($row->roles as $role) {
                    // Map dynamic data variables like $role->name
                    $html .= '<div>' . $role->role_name . '</div>';
                }

                return $html ?: '<span class="text-muted">No Roles</span>';
            })
            ->rawColumns(['roles']) // Crucial: tells Yajra not to escape this HTML
            ->make(true);
    }
    
    public function find($id)
    {
        return User::find($id);
    }
    
}
