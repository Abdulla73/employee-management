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

    .user-table th, .user-table td {
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
</style>
@endsection

@section('content')
    <div class="content">
       <div class="header">
        <h1>User List</h1>
       </div>
       <div class="user-table">
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       </div>
    </div>
@endsection
