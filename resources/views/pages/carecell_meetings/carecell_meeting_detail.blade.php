<x-admin-layout>

<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('carecell_meeting.store') }}">

            @csrf

            <input type="hidden"
                   name="id"
                   value="{{ $meeting->id ?? 0 }}">

            <div class="row">

                {{-- Pastor --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Pastor <span class="text-danger">*</span>
                    </label>

                    <select name="pastor_id"
                            id="pastor_id"
                            class="form-control">

                        <option value="">
                            Select Pastor
                        </option>

                        @foreach($pastors as $pastor)
                            <option value="{{ $pastor->id }}"
                                @selected(old('pastor_id',$meeting->pastor_id ?? '') == $pastor->id)>
                                {{ $pastor->fname }}
                            </option>
                        @endforeach

                    </select>

                    @error('pastor_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Sectional Leader --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Sectional Leader
                    </label>

                    <select name="sectional_leader_id"
                            id="sectional_leader_id"
                            class="form-control">
                        <option value="">
                            Select Sectional Leader
                        </option>
                    </select>
                </div>

                {{-- Carecell Leader --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Carecell Leader
                    </label>

                    <select name="carecell_leader_id"
                            id="carecell_leader_id"
                            class="form-control">
                        <option value="">
                            Select Carecell Leader
                        </option>
                    </select>
                </div>

                {{-- Area --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Area
                    </label>

                    <select name="area_id"
                            id="area_id"
                            class="form-control">
                        <option value="">
                            Select Area
                        </option>
                    </select>
                </div>

                {{-- Meeting Date --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Meeting Date
                    </label>

                    <input type="date"
                           name="meeting_date"
                           class="form-control"
                           value="{{ old('meeting_date',
                               isset($meeting)
                               ? optional($meeting->meeting_date)->format('Y-m-d')
                               : '') }}">
                </div>

                {{-- Start Time --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Start Time
                    </label>

                    <input type="time"
                           name="start_time"
                           class="form-control"
                           value="{{ old('start_time',$meeting->start_time ?? '') }}">
                </div>

                {{-- End Time --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        End Time
                    </label>

                    <input type="time"
                           name="end_time"
                           class="form-control"
                           value="{{ old('end_time',$meeting->end_time ?? '') }}">
                </div>

                {{-- Members Count --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Total Members
                    </label>

                    <input type="number"
                           min="0"
                           name="members_count"
                           class="form-control"
                           value="{{ old('members_count',$meeting->members_count ?? 0) }}">
                </div>

                {{-- New Members --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Total New Members
                    </label>

                    <input type="number"
                           min="0"
                           name="new_members_count"
                           class="form-control"
                           value="{{ old('new_members_count',$meeting->new_members_count ?? 0) }}">
                </div>

                {{-- Offering --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Offering Amount
                    </label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="offering_amount"
                           class="form-control"
                           value="{{ old('offering_amount',$meeting->offering_amount ?? 0) }}">
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-success">
                    Save
                </button>

                <a href="{{ route('carecell_meeting.list') }}"
                   class="btn btn-secondary">
                    Back
                </a>
            </div>

        </form>

    </div>
</div>

<script>
function loadPastorData(pastorId) {
    const sectionalLeader = document.getElementById('sectional_leader_id');
    const carecellLeader = document.getElementById('carecell_leader_id');
    const area = document.getElementById('area_id');

    if (!pastorId) {
        sectionalLeader.innerHTML =
            '<option value="">Select Sectional Leader</option>';

        carecellLeader.innerHTML =
            '<option value="">Select Carecell Leader</option>';

        area.innerHTML =
            '<option value="">Select Area</option>';

        return;
    }

    fetch("{{url('/pastor/meeting-data')}}/" + pastorId)
        .then(response => response.json())
        .then(response => {

            let sectionalLeaderId =
                "{{ old('sectional_leader_id',$meeting->sectional_leader_id ?? '') }}";

            let carecellLeaderId =
                "{{ old('carecell_leader_id',$meeting->carecell_leader_id ?? '') }}";

            let areaId =
                "{{ old('area_id',$meeting->area_id ?? '') }}";

            let sectionalHtml =
                '<option value="">Select Sectional Leader</option>';

            response.sectional_leaders.forEach(item => {
                let selected =
                    item.id == sectionalLeaderId
                        ? 'selected'
                        : '';

                sectionalHtml += `
                    <option value="${item.id}" ${selected}>
                        ${item.fname}
                    </option>`;
            });

            sectionalLeader.innerHTML = sectionalHtml;

            let carecellHtml =
                '<option value="">Select Carecell Leader</option>';

            response.carecell_leaders.forEach(item => {
                let selected =
                    item.id == carecellLeaderId
                        ? 'selected'
                        : '';

                carecellHtml += `
                    <option value="${item.id}" ${selected}>
                        ${item.fname}
                    </option>`;
            });

            carecellLeader.innerHTML = carecellHtml;

            let areaHtml =
                '<option value="">Select Area</option>';

            response.areas.forEach(item => {
                let selected =
                    item.id == areaId
                        ? 'selected'
                        : '';

                areaHtml += `
                    <option value="${item.id}" ${selected}>
                        ${item.area_name}
                    </option>`;
            });

            area.innerHTML = areaHtml;
        })
        .catch(error => {
            console.error('Error loading pastor data:', error);
        });
}

// pastor change event
document.getElementById('pastor_id').addEventListener('change', function () {
    loadPastorData(this.value);
});

// document ready
document.addEventListener('DOMContentLoaded', function () {
    let pastorId = document.getElementById('pastor_id').value;

    if (pastorId) {
        loadPastorData(pastorId);
    }
});

</script>
</x-admin-layout>
