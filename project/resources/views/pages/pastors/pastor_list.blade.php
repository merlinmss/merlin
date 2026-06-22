<x-admin-layout>
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span class="page-title">{{ $title }}</span></li>
                    </ol>
                </nav>
            </div>
             <div class="col-md-4">
                <a href="{{ route('pastor.detail',0) }}" class="btn btn-sm btn-info add-btn">Create Pastor</a>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($pastors as $pastor)
                            <tr>
                                <td> 
                                    <img src="{{ Storage::disk(config('filesystems.default'))->url($pastor->profile_photo) }}" alt="" class="rounded-circle me-2" width="30" height="30">
                                    {{ $pastor->fname }} {{ $pastor->lname }}
                                </td>
                                <td>{{ $pastor->phone }}</td>
                                <td>{{ $pastor->email }}</td>
                                <td>
                                    @foreach($pastor->pastorRoles as $role)
                                        <div class="mb-1">{{ $role->role_name }}</div>
                                    @endforeach
                                </td>
                              <td><label class="badge @if($pastor->is_active == 1) badge-success @else badge-danger @endif ">@if($pastor->is_active == 1) Active @else Inactive @endif</label></td>
                                <td>
                                    @if (auth()->user()->can('edit-users'))
                                    <a href="{{ route('pastor.detail',$pastor->id) }}" class="btn btn-sm btn-info edit-btn">Edit </a>
                                    @endif
                                    @if (auth()->user()->can('delete-users'))
                                    <a href="" class="btn btn-sm btn-danger del-btn">Delete </a>
                                     @endif
                                </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="4">No Pastors found.</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
