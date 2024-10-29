@extends('layout.app')

@section('styles')
    <style>
        body {
            background-color: #f0f4f8;
        }

        .cv-container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #2c3e50;
            margin-bottom: 15px;
        }

        .header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2c3e50;
        }

        .header h1 {
            margin-top: 5px;
            margin-bottom: 0;
        }

        .section {
            margin-bottom: 30px;
            text-align: left;
        }

        .section h2 {
            margin-bottom: 15px;
            font-size: 1.5em;
            color: #2c3e50;
        }

        .section p {
            margin: 5px 0;
            color: #34495e;
        }

        .info-section,
        .education-history-section {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .education-history-section h4 {
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #2c3e50;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #e4e7e6;
            margin: 10px 0;
        }
    </style>
@endsection

@section('content')
    <div class="cv-container">
        <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile Image" class="profile-image">
        <div class="header">
            <h1>{{ $employee->name }}</h1>
        </div>

        <div class="section info-section">
            <h2>Basic Information</h2>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Date of Birth:</strong> {{ $employee->dob }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p><strong>Address:</strong> {{ $employee->address }}</p>
        </div>

        <div class="section education-history-section">
            <h2>Education</h2>
            @if ($employee->educations && $employee->educations->isNotEmpty())
                @foreach ($employee->educations as $edu)
                    <h4>{{ $edu->degree }}</h4>
                    <p><strong>Institute:</strong> {{ $edu->institute }}</p>
                    <p><strong>Passing Year:</strong> {{ $edu->passing_year }}</p>
                    <p><strong>Result:</strong> {{ $edu->result }}</p>
                    <hr>
                @endforeach
            @else
                <p>No education records found.</p>
            @endif
        </div>

        <div class="section education-history-section">
            <h2>Employment History</h2>
            @if ($employee->histories && $employee->histories->isNotEmpty())
                @foreach ($employee->histories as $history)
                    <h4>{{ $history->position }} at {{ $history->institute }}</h4>
                    <p><strong>Duration:</strong> {{ $history->serving_year }}</p>
                    <p><strong>Special Award:</strong> {{ $history->special_award ?? 'None' }}</p>
                    <hr>
                @endforeach
            @else
                <p>No employment history records found.</p>
            @endif
        </div>
    </div>
@endsection
