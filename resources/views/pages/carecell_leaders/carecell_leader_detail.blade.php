<x-admin-layout>
    @php
        $fname       = isset($leader) ? $leader->fname        : '';
        $lname       = isset($leader) ? $leader->lname        : '';
        $phone       = isset($leader) ? $leader->phone        : '';
        $email       = isset($leader) ? $leader->email        : '';
        $leader_role = isset($leader) ? $leader->leader_role  : 3;
        $status      = isset($leader) ? (int) $leader->is_active : 1;
    @endphp

    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('carecell_leader.list') }}">Carecell Leaders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="page-title">{{ $title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
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

                    <form class="forms-sample" method="POST" action="{{ route('carecell_leader.store') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($leader) ? $leader->id : 0 }}">

                        <div class="form-group">
                            <x-input label="First Name" name="fname"
                                :value="old('fname', $fname)" required />
                        </div>

                        <div class="form-group">
                            <x-input label="Last Name" name="lname"
                                :value="old('lname', $lname)" required />
                        </div>

                        <div class="form-group">
                            <x-input label="Phone" name="phone"
                                :value="old('phone', $phone)" />
                        </div>

                        <div class="form-group">
                            <x-input label="Email" name="email"
                                :value="old('email', $email)" />
                        </div>

                        <div class="form-group">
                            <x-select
                                label="Leader Role"
                                name="leader_role"
                                :options="\App\Models\CarecellLeader::ROLES"
                                :selected="old('leader_role', $leader_role)"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <x-select
                                label="Status"
                                name="is_active"
                                :options="['1' => 'Active', '0' => 'Inactive']"
                                :selected="old('is_active', $status)"
                                required
                            />
                        </div>

                        <button type="submit" class="btn btn-info float-end">Submit</button>
                        <a href="{{ route('carecell_leader.list') }}"
                           class="btn btn-light float-end me-2">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
