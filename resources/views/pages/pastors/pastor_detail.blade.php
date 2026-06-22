<x-admin-layout>
    @php
        $roleIds            = [];
        $pastorRoles        = [];
        $pastorRegions      = [];
        $selectedAreaIds    = [];
        $selectedSecondLeaderIds   = [];
        $selectedCarecellLeaderIds = [];

        $fname       = isset($pastor) ? $pastor->fname       : '';
        $lname       = isset($pastor) ? $pastor->lname       : '';
        $email       = isset($pastor) ? $pastor->email       : '';
        $phone       = isset($pastor) ? $pastor->phone       : '';
        $status      = isset($pastor) ? $pastor->is_active   : 1;
        $region_id   = isset($pastor) ? $pastor->region_id   : '';
        $profile_pic = isset($pastor) ? $pastor->profile_photo : '';

        // Pastor role IDs (existing)
        if (isset($pastor->pastorRoleIds)) {
            foreach ($pastor->pastorRoleIds as $roleId) {
                $roleIds[] = $roleId->pastor_role_id;
            }
        }

        // Carecell area IDs (existing)
        if (isset($pastor) && $pastor->carecellAreas) {
            foreach ($pastor->carecellAreas as $area) {
                $selectedAreaIds[] = $area->id;
            }
        }

        // Second leader IDs (leader_role = 1, existing)
        if (isset($pastor) && $pastor->carecellLeaders) {
            foreach ($pastor->carecellLeaders as $leader) {
                if ($leader->leader_role == 1) {
                    $selectedSecondLeaderIds[] = $leader->id;
                }
                if ($leader->leader_role == 3) {
                    $selectedCarecellLeaderIds[] = $leader->id;
                }
            }
        }

        // Build option arrays
        if ($roles)   { foreach ($roles   as $role)   { $pastorRoles[$role->id]     = $role->role_name;    } }
        if ($regions) { foreach ($regions as $region) { $pastorRegions[$region->id] = $region->region_name; } }

        $carecellAreaOptions       = [];
        $secondLeaderOptions       = [];
        $carecellLeaderOptions     = [];

        if ($carecellAreas)   { foreach ($carecellAreas   as $a) { $carecellAreaOptions[$a->id]   = $a->area_name; } }
        if ($secondLeaders)   { foreach ($secondLeaders   as $l) { $secondLeaderOptions[$l->id]   = $l->fname . ' ' . $l->lname; } }
        if ($carecellLeaders) { foreach ($carecellLeaders as $l) { $carecellLeaderOptions[$l->id] = $l->fname . ' ' . $l->lname; } }
    @endphp

    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pastor.list') }}">Pastors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="page-title">{{ $title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" name="userForm" method="POST"
                          action="{{ route('pastor.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($pastor) ? $pastor->id : 0 }}">

                        <div class="form-group">
                            <x-input label="First Name" name="fname" :value="$fname" required />
                        </div>

                        <div class="form-group">
                            <x-input label="Last Name" name="lname" :value="$lname" required />
                        </div>

                        <div class="form-group">
                            <x-input label="Phone" name="phone" :value="$phone" required />
                        </div>

                        <div class="form-group">
                            <x-input label="Email" name="email" :value="$email" />
                        </div>

                        <div class="form-group">
                            <x-select label="Region" name="region_id"
                                :options="$pastorRegions"
                                :selected="old('region_id', $region_id)"
                                required />
                        </div>

                        <div class="form-group">
                            <x-multiselect label="Pastor Roles" name="roles"
                                class="chosen-select"
                                :options="$pastorRoles"
                                :selected="old('roles', $roleIds)" />
                        </div>

                        {{-- Carecell Areas --}}
                        <div class="form-group">
                            <x-multiselect label="Carecell Areas" name="area_ids"
                                class="chosen-select"
                                :options="$carecellAreaOptions"
                                :selected="old('area_ids', $selectedAreaIds)" />
                        </div>

                        {{-- Second Leaders (leader_role = 1) --}}
                        <div class="form-group">
                            <x-multiselect label="Second Leaders" name="second_leader_ids"
                                class="chosen-select"
                                :options="$secondLeaderOptions"
                                :selected="old('second_leader_ids', $selectedSecondLeaderIds)" />
                        </div>

                        {{-- Carecell Leaders (leader_role = 3) --}}
                        <div class="form-group">
                            <x-multiselect label="Carecell Leaders" name="carecell_leader_ids"
                                class="chosen-select"
                                :options="$carecellLeaderOptions"
                                :selected="old('carecell_leader_ids', $selectedCarecellLeaderIds)" />
                        </div>

                        <div class="form-group">
                            <label for="profile_photo">Profile Picture</label>
                            @if($profile_pic != '')
                                <div class="mb-2 col-6 col-md-4">
                                    <img src="{{ Storage::disk(config('filesystems.default'))->url($pastor->profile_photo) }}"
                                         alt="Profile Picture" class="img-thumbnail" width="150">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                   placeholder="Profile Picture">
                            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <x-select label="Status" name="is_active"
                                :options="['1' => 'Active', '0' => 'Inactive']"
                                :selected="old('is_active', $status)"
                                required />
                        </div>

                        <button type="submit" class="btn btn-info float-end">Submit</button>
                        <a href="{{ route('pastor.list') }}" class="btn btn-light float-end me-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.chosen-select').chosen({
                width: '100%',
                no_results_text: 'No results matched'
            });
        });
    </script>
</x-admin-layout>
