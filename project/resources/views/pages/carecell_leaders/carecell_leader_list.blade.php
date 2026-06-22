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
                    <a href="{{ route('carecell_leader.detail', 0) }}" class="btn btn-sm btn-info add-btn">
                        Create Carecell Leader
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
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leaders as $leader)
                                <tr>
                                    <td>{{ $leaders->firstItem() + $loop->index }}</td>
                                    <td>{{ $leader->fname }} {{ $leader->lname }}</td>
                                    <td>{{ $leader->phone ?? '—' }}</td>
                                    <td>{{ $leader->email ?? '—' }}</td>
                                    <td>
                                        @php
                                            $roleBadge = [1 => 'badge-warning', 2 => 'badge-primary', 3 => 'badge-info'];
                                        @endphp
                                        <label class="badge {{ $roleBadge[$leader->leader_role] ?? 'badge-secondary' }}">
                                            {{ $leader->role_name }}
                                        </label>
                                    </td>
                                    <td>
                                        <label class="badge {{ $leader->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $leader->is_active ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        @if(auth()->user()->can('edit-users'))
                                            <a href="{{ route('carecell_leader.detail', $leader->id) }}"
                                               class="btn btn-sm btn-info edit-btn">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No carecell leaders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $leaders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
