@extends('layout.app')

@section('styles')
    <style>
        .employee-card {
            border-radius: 12px;
            padding: 60px;
            margin: 30px 0;
            display: flex;
            flex-direction: row-reverse;
            align-items: flex-start;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-left: 20px;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .employee-details {
            flex: 1;
            padding-top: 20px;
        }

        .employee-details h3 {
            margin-top: 0;
            font-size: 1.8em;
            color: #2c3e50;
            font-weight: bold;
        }

        .employee-details p {
            margin: 8px 0;
            color: #2c3e50;
            font-size: 1.1em;
        }

        .employee-card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .lastp {
            padding-bottom: 15px;
        }

        .editbtn {
            background-color: #16e827;
            color: #ebf4ec;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 7px;
        }

        .viewbtn {
            background-color: #117fc9;
            color: #ebf4ec;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 7px;
        }

        .deletebtn {
            background-color: #c40404;
            color: #efecec;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .addbtn {
            background-color: #0babf0;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            right: 30px;
            top: 120px;
        }



        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #ffffff;
            padding: 30px;
            width: 400px;
            border-radius: 8px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            /* border: 1px solid #ccc;  */
            /* border-radius: 4px;  */
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <a href="{{ route('employee-panel.employees.add-employee') }}" class="addbtn">Add Employee</a>
        <h2 class="header">Employee List</h2>
        @foreach ($employees as $employee)
            <div class="employee-card">
                <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile Photo" class="profile-photo">
                <div class="employee-details">
                    <h3>{{ $employee->name }}</h3>
                    <p><strong>Address:</strong> {{ $employee->address }}</p>
                    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p class="lastp"><strong>Date of Birth:</strong> {{ $employee->dob }}</p>
                    <button class="editbtn" id="editbtn" data-empid="{{ $employee->id }}" onclick="editDetails({{ $employee->id }})">Edit</button>
                    <form action="{{ route('employee-panel.employees.delete', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deletebtn">Delete</button>
                    </form>
                    <button class="viewbtn" id="viewbtn-{{ $employee->id }}" data-empid="{{ $employee->id }}"
                        onclick="viewDetails({{ $employee->id }})">View details</button>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        function viewDetails(id) {
            const url = "{{ route('employee-panel.employees.details', ':id') }}".replace(':id', id);
            window.location.href = url;
        }

        function editDetails(id) {
            const url = "{{ route('employee-panel.employees.edit', ':id') }}".replace(':id', id);
            window.location.href = url;
        }

    </script>
@endsection
