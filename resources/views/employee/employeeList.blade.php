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
        <button class="addbtn" id="openCreateModal">Add Employee</button>
        <h2 class="header">Employee List</h2>
        @foreach ($employees as $employee)
            <div class="employee-card">
                <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile Photo" class="profile-photo">
                <div class="employee-details">
                    <h3>{{ $employee->name }}</h3>
                    <p><strong>Address:</strong> {{ $employee->address }}</p>
                    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p class="lastp"><strong>Date of Birth:</strong> {{ $employee->dob }}</p>
                    <button class="editbtn">Edit</button>
                    <button class="deletebtn">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal" id="createModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h3>Add Employee</h3>
            <form id="employeeForm">
                @csrf
                {{-- <input type="hidden" value="{{ csrf_token() }}" name="csrfToken"> --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="profile_photo">Profile Photo</label>
                    <input type="file" id="profile_photo" name="profile_photo" required>
                </div>
                <button type="submit" class="editbtn">Submit</button>
            </form>
        </div>
    </div>
@endsection

@include('layout.footer')
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#openCreateModal').click(function() {
            $('#createModal').css('display', 'flex');
        });

        $('#closeModal').click(function() {
            $('#createModal').css('display', 'none');
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#employeeForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '/employee-panel/employees/addemp',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Employee added successfully!');
                    $('#createModal').css('display', 'none');
                    location.reload();
                },
                error: function(error) {
                    alert('Error adding employee!');
                }
            });
        });
    </script>
@endsection
