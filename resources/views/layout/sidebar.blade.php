<div class="sidebar">
    <a href="{{ route('employee-panel.employees.index') }}" class="employee-view" data-method="GET">Employees</a>
    <a href="{{ route('employee-panel.users.index') }}" class="user-view" data-method="GET">Users</a>
    {{-- <a href="{{ route('user/view') }}" class="user-view" data-method="GET">View Users</a> --}}
    {{-- <a href="{{ route('user/add') }}" class="add-user" data-method="POST">Add Users</a> --}}
    {{-- <a href="{{ route('user/employee') }}" class="add-employee" data-method="POST">Add Employee</a> --}}

</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

{{-- <script>
    $(document).ready(function() {
        $('.employee-view').click(function(event) {
            event.preventDefault();

            var url = $(this).attr('href');
            var method = $(this).data('method');

            if (method === 'GET') {

                $.ajax({
                    url: 'employee/view',
                    method: 'GET',
                    success: function(response) {
                        $('#content-area').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });
            } else if (method === 'POST') {

                var postData = {};
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: postData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#content-area').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });
            }
        });
    });
</script> --}}
