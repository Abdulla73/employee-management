<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf view</title>

    <style>
        @page {
            margin: 0;
        }

        body {
            background-color: #ffffff;
            font-size: 11pt;
            padding: 50.402pt 56.693pt 99.213pt 53.858pt;
            margin: 0;
        }

        .basic{
            width: 100%;
            overflow: auto;
        }

        .cv-container {
            width: 100%;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        .profile-image {
            width: 130px;
            height: 145px;
            object-fit: cover;
            border: 2px solid #2c3e50;
            margin-bottom: 15px;
            margin-top: 20px;
            float: right;
        }

        .basicinfo {
            width: 70%;
            float: left;
            text-align: left;
        }

        .profileimg {
            width: 30%;
            float: right;
        }

        .eduhader {
            width: 100%;
            color: #333;
            text-align: left;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #20a9e9;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #e1efab;
            color: #333;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #82a9c9;
        }
    </style>
</head>
<body>
    <div class="cv-container">

        <div class="basic">
            <div class="basicinfo">
                <h1>{{ $employee->name }}</h1>
                <div style="line-height: 2">
                    <span><b>Email:</b> {{ $employee->email }}</span><br>
                    <span><b>Date of Birth:</b> {{ $employee->dob }}</span><br>
                    <span><b>Phone:</b> {{ $employee->phone }}</span><br>
                    <span><b>Address:</b> {{ $employee->address }}</span>
                </div>

            </div>
            <div class="profileimg">
                <img src="{{ public_path("storage/" . $employee->profile_image) }}" alt="Profile Image" class="profile-image">
            </div>
        </div>

        <div style="margin: 200px 0px 0px 0px">
            <div class="eduhader">
                <h3 >Education</h3>
            </div>
            <div class="edu-details">
                @if ($employee->educations && $employee->educations->isNotEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institute</th>
                                <th>Passing Year</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee->educations as $edu)
                                <tr>
                                    <td>{{ $edu->degree }}</td>
                                    <td>{{ $edu->institute }}</td>
                                    <td>{{ $edu->passing_year }}</td>
                                    <td>{{ $edu->result }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No education records found.</p>
                @endif
            </div>
        </div>
        <div class="history">
            <div class="eduhader">
                <h3>Employment History</h3>
            </div>
            <div class="edu-details histable">
                @if ($employee->histories && $employee->histories->isNotEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>Institute</th>
                                <th>Position</th>
                                <th>Duration</th>
                                <th>Special Award</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee->histories as $history)
                                <tr>
                                    <td>{{ $history->institute }}</td>
                                    <td>{{ $history->position }}</td>
                                    <td>{{ $history->serving_year }}</td>
                                    <td>{{ $history->special_award ?? 'None' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No employment history records found.</p>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
