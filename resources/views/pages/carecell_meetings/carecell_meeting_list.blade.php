<x-admin-layout>

<div class="card">
    <div class="card-body">

        <a href="{{ route('carecell_meeting.detail',0) }}"
           class="btn btn-primary mb-3">
            Add Meeting
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Pastor</th>
                    <th>Sectional Leader</th>
                    <th>Carecell Leader</th>
                    <th>Area</th>
                    <th>Members</th>
                    <th>Offering</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            @foreach($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->meeting_date }}</td>
                    <td>{{ $meeting->pastor?->fname }}</td>
                    <td>{{ $meeting->sectionalLeader?->fname }}</td>
                    <td>{{ $meeting->carecellLeader?->fname }}</td>
                    <td>{{ $meeting->area?->area_name }}</td>
                    <td>{{ $meeting->members_count }}</td>
                    <td>{{ $meeting->offering_amount }}</td>
                    <td>
                        <a href="{{ route('carecell_meeting.detail',$meeting->id) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        {{ $meetings->links() }}

    </div>
</div>

</x-admin-layout>
