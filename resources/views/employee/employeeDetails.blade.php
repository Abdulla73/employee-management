@extends('layout.app')

@section('styles')
    <style>
        body {
            background-color: #ffffff;
        }

        .cv-container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fbfbfb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 165px;
            object-fit: cover;
            border: 2px solid #2c3e50;
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .basic {
            width: 100%;
            padding: 10px;
            margin: 10px;
            overflow: auto;
            background-color: #a4d9f2;
            border-radius: 10px;
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

        .education, .history {
            width: 100%;
        }

        .eduhader, .hisheader {
            width: 100%;
            color: #fff;
            text-align: left;
            padding-top: 10px;
            margin-left: 16px;
        }

        .edu-details, .histable {
            width: 100%;
            margin: 2px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
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

        tr:hover {
            background-color: #e0e0e0;
        }

        .pdf {
            width: 100%;
            margin-left: 15px;
            text-align: right;
        }

        .btn-pdf {
            background-color: #4facfe;
            color: #fff;
            border-radius: 20px;
            padding: 10px 10px;
            width: 15%;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="cv-container">
        <div class="pdf">
            <button class="btn-pdf" onclick="download({{ $employee->id }})" data-empid="{{ $employee->id }}">Download pdf</button>
        </div>
        <div class="basic">
            <div class="basicinfo">
                <h1>{{ $employee->name }}</h1>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Date of Birth:</strong> {{ $employee->dob }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                <p><strong>Address:</strong> {{ $employee->address }}</p>
            </div>
            <div class="profileimg">
                <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile Image" class="profile-image">
            </div>
        </div>
        <div class="education">
            <div class="eduhader">
                <h3>Education</h3>
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
            <div class="hisheader">
                <h3>Employment History</h3>
            </div>
            <div class="histable">
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
                                    <td>
                                        @php
                                            $start = Carbon::parse($history->start_date);
                                            $end = $history->end_date ? Carbon::parse($history->end_date) : Carbon::now();
                                            $duration = $start->diffInDays($end);
                                        @endphp
                                        {{ $history->end_date ? $duration . ' Days' : 'Currently Working' }}
                                    </td>
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

@section('scripts')
    <script>
        function download(id) {
            console.log(id);
            const url = "{{ route('employee-panel.employees.download.pdf', ':id') }}".replace(':id', id);
            window.location.href = url;
        }
    </script>
@endsection
@endsection
