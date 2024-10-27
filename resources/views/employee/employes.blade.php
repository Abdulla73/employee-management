<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>

    @include('layout.header')
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            justify-content: left;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .content {
            max-width: 800px;
            width: 100%;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-family: Arial, sans-serif;
            margin-bottom: 40px;
        }

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
    </style>
</head>
<body>
    @include('layout.navbar')

    <div class="main">
        @include('layout.sidebar')
        <div class="content">
            <button class="addbtn">Add Employee</button>
            <h1>Employee List</h1>
            @foreach($employees as $employee)
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
    </div>

    @include('layout.footer')
</body>
</html>
