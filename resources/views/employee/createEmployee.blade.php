@extends('layout.app')

@section('styles')
    <style>
        .form-container {
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }

        .form-header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
            border-top: 2px solid #007bff;
            padding-top: 15px;
        }

        .form-section h3 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .half-width-container {
            display: flex;
            justify-content: space-between;
        }

        .half-width {
            width: 48%;
        }

        .btn-add {
            background-color: #28a745;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-remove {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }

        .entry {
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px dashed #ddd;
            position: relative;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="form-container">
            <h2 class="form-header">Add Employee</h2>
            <form action="{{ route('employee-panel.employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-section">
                    <h3>Basic Info</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <span id="email-error" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="half-width-container">
                        <div class="form-group half-width">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                        <div class="form-group half-width">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" required>
                    </div>
                </div>

                <div class="form-section" id="education-section">
                    <h3>Education</h3>
                    <div class="entry" id="education-entry-0">
                        <div class="form-group">
                            <label for="degree_0">Degree</label>
                            <input type="text" id="degree_0" name="degree[]" required>
                        </div>
                        <div class="form-group">
                            <label for="institute_0">Institute</label>
                            <input type="text" id="institute_0" name="institute[]" required>
                        </div>
                        <div class="half-width-container">
                            <div class="form-group half-width">
                                <label for="passing_year_0">Passing Year</label>
                                <input type="number" id="passing_year_0" name="passing_year[]" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="results_0">Results</label>
                                <input type="text" id="results_0" name="results[]" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-add" id="add-education">+ Add Education</button>
                </div>

                <div class="form-section" id="employment-section">
                    <h3>Employment History</h3>
                    <div class="entry" id="employment-entry-0">
                        <div class="form-group">
                            <label for="employment_institute_0">Institute</label>
                            <input type="text" id="employment_institute_0" name="employment_institute[]" required>
                        </div>
                        <div class="half-width-container">
                            <div class="form-group half-width">
                                <label for="serving_year_0">Serving Year</label>
                                <input type="number" id="serving_year_0" name="serving_year[]" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="position_0">Position</label>
                                <input type="text" id="position_0" name="position[]" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="special_award_0">Special Award</label>
                            <input type="text" id="special_award_0" name="special_award[]">
                        </div>
                    </div>
                    <button type="button" class="btn-add" id="add-employment">+ Add Employment</button>
                </div>

                <button type="submit" class="btn-submit .btn-submit">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let educationCount = 1;
        let employmentCount = 1;

        document.getElementById('add-education').addEventListener('click', function() {
            const educationEntry = document.createElement('div');
            educationEntry.className = 'entry';
            educationEntry.innerHTML = `
                <button type="button" class="btn-remove" onclick="this.parentElement.remove()" style="margin-bottom: 10px;">Remove</button>
                <div class="form-group">
                    <label for="degree_${educationCount}">Degree</label>
                    <input type="text" id="degree_${educationCount}" name="degree[]" required>
                </div>
                <div class="form-group">
                    <label for="institute_${educationCount}">Institute</label>
                    <input type="text" id="institute_${educationCount}" name="institute[]" required>
                </div>
                <div class="half-width-container">
                    <div class="form-group half-width">
                        <label for="passing_year_${educationCount}">Passing Year</label>
                        <input type="number" id="passing_year_${educationCount}" name="passing_year[]" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="results_${educationCount}">Results</label>
                        <input type="text" id="results_${educationCount}" name="results[]" required>
                    </div>
                </div>`;

            const educationSection = document.getElementById('education-section');
            educationSection.appendChild(educationEntry);
            educationSection.appendChild(this);

            educationCount++;
        });

        document.getElementById('add-employment').addEventListener('click', function() {
            const employmentEntry = document.createElement('div');
            employmentEntry.className = 'entry';
            employmentEntry.innerHTML = `
                <button type="button" class="btn-remove" onclick="this.parentElement.remove()" style="margin-bottom: 10px;">Remove</button>
                <div class="form-group">
                    <label for="employment_institute_${employmentCount}">Institute</label>
                    <input type="text" id="employment_institute_${employmentCount}" name="employment_institute[]" required>
                </div>
                <div class="half-width-container">
                    <div class="form-group half-width">
                        <label for="serving_year_${employmentCount}">Serving Year</label>
                        <input type="number" id="serving_year_${employmentCount}" name="serving_year[]" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="position_${employmentCount}">Position</label>
                        <input type="text" id="position_${employmentCount}" name="position[]" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="special_award_${employmentCount}">Special Award</label>
                    <input type="text" id="special_award_${employmentCount}" name="special_award[]">
                </div>`;

            const employmentSection = document.getElementById('employment-section');
            employmentSection.appendChild(employmentEntry);
            employmentSection.appendChild(this);

            employmentCount++;
        });


        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const submitButton = document.querySelector('.btn-submit');
            const emailError = document.getElementById('email-error');

            if (email) {
                fetch("{{ route('employee-panel.employees.check.email') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            emailError.textContent = 'Email already exists.';
                            submitButton.disabled = true;
                            submitButton.style.backgroundColor = '#ddd';
                        } else {
                            emailError.textContent = '';
                            submitButton.disabled = false;
                            submitButton.style.backgroundColor = '#007bff';
                        }
                    });
            } else {
                emailError.textContent = '';
                submitButton.disabled = false;
            }
        });
    </script>
@endsection
