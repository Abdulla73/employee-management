@extends('layout.app')

@section('styles')
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header {
            color: #444;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .user-table {
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            border-radius: 8px;
            width: 90%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .user-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            text-align: center;
        }

        .user-table th {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        .user-table th:hover {
            background-color: #0056b3;
        }

        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .user-table tr:hover {
            background-color: #e9ecef;
        }

        @media (max-width: 768px) {
            .user-table {
                width: 100%;
            }
        }

        .add-user {
            margin-bottom: 10px;
            text-align: right;
            width: 100%;
        }

        .btn-add-user {
            background-color: #4facfe;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            margin-bottom: 10px;
            margin-right: 10px;
            float: right;
        }

        .btn-edit,
        .btn-delete {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="add-user">
            <button class="btn-add-user" onclick="add_user()">+Add user</button>
        </div>
        <div class="header">
            <h1>User List</h1>
        </div>
        <div class="user-table">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn-edit" data-id="{{ $user->id }}"
                                    onclick="edit_user({{ $user->id }})">Edit</button>
                                <form action="{{ route('employee-panel.users.delete.user', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" data-id="{{ $user->id }}"
                                        onclick="del_user({{ $user->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        function add_user() {
            const url = "{{ route('employee-panel.users.add-user') }}";
            window.location.href = url;
        }

        function edit_user(id) {
            const url = "{{ route('employee-panel.users.edit.user', ':id') }}".replace(':id', id);
            window.location.href = url;
        }
    </script>
@endsection
@endsection
