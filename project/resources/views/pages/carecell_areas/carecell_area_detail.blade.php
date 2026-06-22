<x-admin-layout>
    @php
        $area_name        = isset($area) ? $area->area_name        : '';
        $area_description = isset($area) ? $area->area_description : '';
        $status           = isset($area) ? (int) $area->is_active  : 1;
    @endphp

    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('carecell_area.list') }}">Carecell Areas</a>
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

                    <form class="forms-sample" method="POST" action="{{ route('carecell_area.store') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($area) ? $area->id : 0 }}">

                        <div class="form-group">
                            <x-input label="Area Name" name="area_name"
                                :value="old('area_name', $area_name)" required />
                        </div>

                        <div class="form-group">
                            <label for="area_description">Description</label>
                            <textarea
                                id="area_description"
                                name="area_description"
                                class="form-control @error('area_description') is-invalid @enderror"
                                rows="3"
                                placeholder="Area description (optional)"
                            >{{ old('area_description', $area_description) }}</textarea>
                            <x-input-error :messages="$errors->get('area_description')" class="mt-2" />
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
                        <a href="{{ route('carecell_area.list') }}"
                           class="btn btn-light float-end me-2">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
