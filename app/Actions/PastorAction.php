<?php
namespace App\Actions;

use App\DTOs\CreatePastorData;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\PastorRepositoryInterface;
use App\Models\PastorRole;
use App\Models\PastorRoleId;
use App\Models\Region;
use App\Models\CarecellArea;
use App\Models\CarecellLeader;
class PastorAction
{
    public function __construct(
        protected PastorRepositoryInterface $pastorRepository
    ) {}

    public function list(){
        $pastors            =   $this->pastorRepository->fetchPastorList();
        $title              =   "Pastor List";  
        return view("pages.pastors.pastor_list", compact("pastors", "title"));
    }
    public function find($id)
    {
        $pastor  = $this->pastorRepository->find($id);
        $roles   = PastorRole::where('is_active', 1)->get();
        $regions = Region::where('is_active', 1)->get();
        $title   = ($id == 0) ? 'Create Pastor' : 'Edit Pastor';

        // Carecell Areas (all active)
        $carecellAreas = CarecellArea::where('is_active', 1)->orderBy('area_name')->get();

        // Second Leaders (leader_role = 1)
        $secondLeaders = CarecellLeader::where('leader_role', 1)
            ->where('is_active', 1)
            ->orderBy('fname')
            ->get();

        // Carecell Leaders (leader_role = 3)
        $carecellLeaders = CarecellLeader::where('leader_role', 3)
            ->where('is_active', 1)
            ->orderBy('fname')
            ->get();

        return view('pages.pastors.pastor_detail', compact(
            'pastor', 'roles', 'regions', 'title',
            'carecellAreas', 'secondLeaders', 'carecellLeaders'
        ));
    }

    public function execute(array $data)
    {
        $pastor = $this->pastorRepository->save($data);

        if ($pastor) {
            $this->pastorRepository->savePastorRoleIds($pastor);
            $this->pastorRepository->savePastorAreaIds($pastor);
            $this->pastorRepository->savePastorLeaderIds($pastor);
        }

        return $pastor;
    }
    
}
