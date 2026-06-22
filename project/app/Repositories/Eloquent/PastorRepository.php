<?php

namespace App\Repositories\Eloquent;


use App\Models\Pastor;
use App\Models\PastorRoleId;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\PastorRepositoryInterface;

class PastorRepository implements PastorRepositoryInterface
{
    public function save(array $data): Pastor
    {
        if(request()->input('id')>0) {
            $pastor = Pastor::find(request()->input('id'));
            foreach($data as $k=>$val){ $pastor->$k = $val; }
            $pastor->save();
        }else{
            $pastor = new Pastor($data);
            $pastor->save();
        }
        if (request()->hasFile('profile_photo')) {
            $dic = config('filesystems.default');
            

            // delete old image from storage
            if (isset($pastor->profile_photo) && Storage::disk($dic)->exists($pastor->profile_photo)) {
                Storage::disk($dic)->delete($pastor->profile_photo);
            }
            // store new image and update user record
            $filename = request()->file('profile_photo')->store("pastors/$pastor->id/profile_photo", $dic);
            $pastor->profile_photo = $filename;
            $pastor->save();
        }
        return $pastor;
    }
    public function savePastorRoleIds($pastor)
    {
        PastorRoleId::where('pastor_id', $pastor->id)->delete();
        $pastor->pastorRoles()->attach(request()->input('roles'));
    }

    public function savePastorAreaIds($pastor)
    {
        // Sync replaces existing rows (delete old, insert new)
        $areaIds = request()->input('area_ids', []);
        $pastor->carecellAreas()->sync($areaIds);
    }

    public function savePastorLeaderIds($pastor)
    {
        // Sync replaces existing rows (delete old, insert new)
        $leaderIds = array_merge(
            request()->input('second_leader_ids', []),
            request()->input('carecell_leader_ids', [])
        );
        $pastor->carecellLeaders()->sync($leaderIds);
    }

    public function fetchPastorList()
    {
        return Pastor::with('pastorRoles')->paginate(10);
    }
    
    public function find($id)
    {
        return Pastor::find($id);
    }
    
}
