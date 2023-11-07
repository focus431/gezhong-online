@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">List of Mentor</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                        <li class="breadcrumb-item active">Mentor</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Avatar</th> <!-- 新增 Avatar 列 -->
                                        <th data-field="last_name">Mentor Name</th>
                                        <th data-field="gender">Gender</th>
                                        <th data-field="mobile">Mobile</th>
                                        <th data-field="email">Email</th>
                                        <th data-field="activated">Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- 這裡會動態填充數據 -->
                                </tbody>
                            </table>







                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ($.fn.DataTable.isDataTable('.datatable')) {
            $('.datatable').DataTable().destroy();
            $('.datatable tbody').empty(); // empty in case the columns change
        }

        var table = $('.datatable').DataTable({ // Change: Assign DataTable to a variable
            serverSide: true,
            ajax: function(data, callback, settings) {
                const sortField = data.columns[data.order[0].column].data;
                const sortDirection = data.order[0].dir;
                const perPage = data.length;
                const currentPage = (data.start / perPage) + 1;

                // Change: Include search term in the fetch request
                fetch(`/get-users/mentor?sortField=${sortField}&sortDirection=${sortDirection}&page=${currentPage}&perPage=${perPage}&search=${data.search.value}`)

                    .then(response => response.json())
                    .then(json => {
                        callback({
                            recordsTotal: json.total,
                            recordsFiltered: json.total,
                            data: json.data
                        });
                    });
            },
            columns: [{
                    data: 'avatar_path',
                    render: function(data, type, row) {
                        return `<img src="/storage/${data}" alt="Avatar" class="avatar-img rounded-circle responsive-avatar">`;
                    },
                    className: "text-center"
                },
                {
                    data: 'last_name',
                    render: function(data, type, row) {
                        return `${row.last_name} ${row.first_name}`;
                    }
                },
                {
                    data: 'gender'
                },
                {
                    data: 'mobile'
                },
                {
                    data: 'email'
                },
                {
                    data: 'activated',
                    render: function(data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `<div class="text-center"> 
                   <input type="checkbox" id="status_${row.id}" class="check" ${checked}>
                   <label for="status_${row.id}" class="checktoggle">checkbox</label>
               </div>`;
                    },
                    className: "text-center"
                }
            ]
        });

        document.addEventListener('change', function(event) {
            if (event.target.matches('.check')) {
                let checkbox = event.target;
                let id = checkbox.id.replace('status_', '');
                let newValue = checkbox.checked ? 1 : 0;

                fetch(`/toggle-activation/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            activated: newValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Activation status toggled successfully');
                        }
                    })
                    .catch(error => console.error('Error toggling activation status:', error));
            }
        });
    });
</script>
@endsection