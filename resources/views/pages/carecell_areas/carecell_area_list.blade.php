<x-admin-layout>
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="page-title">{{ $title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4">
                @if(auth()->user()->can('edit-users'))
                    <a href="{{ route('carecell_area.detail', 0) }}" class="btn btn-sm btn-info add-btn">
                        Create Carecell Area
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Area Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($areas as $area)
                                <tr>
                                    <td>{{ $areas->firstItem() + $loop->index }}</td>
                                    <td>{{ $area->area_name }}</td>
                                    <td>{{ $area->area_description ?? '—' }}</td>
                                    <td>
                                        <label class="badge {{ $area->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $area->is_active ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        @if(auth()->user()->can('edit-users'))
                                            <a href="{{ route('carecell_area.detail', $area->id) }}"
                                               class="btn btn-sm btn-info edit-btn">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No carecell areas found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $areas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
