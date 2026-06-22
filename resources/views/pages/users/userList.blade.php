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
                <a href="{{ route('user.detail',0) }}" class="btn btn-sm btn-info add-btn">Create User</a>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="user-table" class="table table-striped table-hover table-bordered w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Roles</th>
                            </tr>
                            <tr class="bg-light search-row">
                                <th class="p-2"></th>
                                <th class="p-2"></th>
                                <th class="p-2"></th>
                                <th class="p-2"></th>
                                <th class="p-2"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let table = new DataTable('#user-table', {
                layout: {
                    topEnd: null // Removes the default search bar position
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}", // Ensure this endpoint returns Yajra JSON
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'status', name: 'status' },
                    { data: 'roles', name: 'roles' }
                ],
                // Directly style core elements with Tailwind wrapper configurations
                // dom: '<"flex flex-col md:flex-row justify-between items-center mb-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            
                initComplete: function () {
                    let api = this.api();

                    // Target the cells in our dedicated secondary search row
                    api.columns().every(function (index) {
                        let column = this;
                        let headerCell = $('.search-row th').eq(index);
                        let title = $(column.header()).text();

                        // Skip adding a search box if the column contains the 'no-search' class
                        if ($(column.header()).hasClass('no-search')) {
                            headerCell.html('');
                            return;
                        }

                        // Create a Tailwind-styled input element
                        let input = $(`
                            <input type="text" 
                                placeholder="Search ${title}..." 
                                class="form-control"
                            />
                        `);

                        // Inject the element into the header row cell
                        headerCell.html(input);

                        // Listen for structural keyboard changes to trigger the backend request
                        input.on('keyup change clear', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    });
                },
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records...",
                    lengthMenu: "Show _MENU_ entries",
                }

            });

            // Add design flourishes to generated inputs
            $('.dataTables_filter input').addClass('form-control');
            $('.dataTables_length select').addClass('form-control');
        });
    </script>
</x-admin-layout>
