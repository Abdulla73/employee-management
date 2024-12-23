@extends('layout.app')

@section('styles')
    <style>
        .form-container {
            width: 100%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }

        .form-header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 2px solid #007bff;
        }

        .form-section h3 {
            color: #007bff;
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
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
            gap: 2%;
        }

        .half-width {
            flex: 1;
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
            margin-bottom: 10px;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .entry {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px dashed #ddd;
            position: relative;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .drop-zone {
            width: 100%;
            padding: 20px;
            border: 2px dashed #0dacdc;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            color: #333;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        .drop-zone:hover {
            background-color: #f0f0f0;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="form-container">
            <h2 class="form-header">Add Employee</h2>
            <form action="{{ route('employee-panel.employees.update', $employee->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-section">
                    <h3>Basic Info</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ $employee->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $employee->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ $employee->address }}" required>
                    </div>
                    <div class="half-width-container">
                        <div class="form-group half-width">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ $employee->dob }}" required>
                        </div>
                        <div class="form-group half-width">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ $employee->phone }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <div id="drop-zone" class="drop-zone">
                            <p>Drag & Drop your profile picture here, or click to upload</p>
                            <img id="image-preview"
                                style="display: none; max-width: 100%; max-height: 150px; margin-top: 10px;" />
                        </div>
                        <input type="file" id="profile_image" name="profile_image"
                            accept="image/*" style="display: none;">
                    </div>
                </div>

                <div class="form-section" id="education-section">
                    <h3>Education</h3>
                    @foreach ($employee->educations ?? [] as $education)
                        <div class="entry">
                            <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
                            <div class="form-group">
                                <label for="degree_{{ $loop->index }}">Degree</label>
                                <input type="text" name="degree[]" value="{{ $education->degree }}" required>
                            </div>
                            <div class="form-group">
                                <label for="institute_{{ $loop->index }}">Institute</label>
                                <input type="text" name="institute[]" value="{{ $education->institute }}" required>
                            </div>
                            <div class="half-width-container">
                                <div class="form-group half-width">
                                    <label for="passing_year_{{ $loop->index }}">Passing Year</label>
                                    <input type="number" name="passing_year[]" value="{{ $education->passing_year }}"
                                        required>
                                </div>
                                <div class="form-group half-width">
                                    <label for="results_{{ $loop->index }}">Results</label>
                                    <input type="text" name="results[]" value="{{ $education->result }}" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" class="btn-add" id="add-education">+ Add Education</button>
                </div>

                <div class="form-section" id="employment-section">
                    <h3>Employment History</h3>
                    @foreach ($employee->histories ?? [] as $history)
                        <div class="entry">
                            <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
                            <div class="form-group">
                                <label for="employment_institute_{{ $loop->index }}">Institute</label>
                                <input type="text" name="employment_institute[]" value="{{ $history->institute }}"
                                    required>
                            </div>
                            <div class="half-width-container">
                                <div class="form-group half-width">
                                    <label for="start_date_{{ $loop->index }}">Start Date</label>
                                    <input type="date" name="start_date[]" value="{{ $history->start_date }}"
                                        required>
                                </div>
                                <div class="form-group half-width">
                                    <label for="end_date_{{ $loop->index }}">End Date</label>
                                    <input type="date" name="end_date[]" id="end_date_"
                                        value="{{ $history->end_date }}" style="margin-bottom: 5px;">
                                    <div class="checkbox-container">
                                        <input type="checkbox" style="margin-right: 5px;"
                                            onclick="toggleEndDate(this, 'end_date_{{ $loop->index }}')">
                                        <label for="currently_working_{{ $loop->index }}">Currently Working</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_{{ $loop->index }}">Position</label>
                                <input type="text" name="position[]" value="{{ $history->position }}" required>
                            </div>
                            <div class="form-group">
                                <label for="special_award_{{ $loop->index }}">Special Award</label>
                                <input type="text" name="special_award[]" value="{{ $history->special_award }}">
                            </div>
                        </div>
                    @endforeach
                    <button type="button" class="btn-add" id="add-employment">+ Add Employment</button>
                </div>

                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let educationCount = {{ count($employee->educations ?? []) }};
        let employmentCount = {{ count($employee->histories ?? []) }};

        document.getElementById('add-education').addEventListener('click', function() {
            const educationEntry = document.createElement('div');
            educationEntry.className = 'entry';
            educationEntry.innerHTML = `
            <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
            <div class="form-group">
                <label>Degree</label>
                <input type="text" name="degree[]" required>
            </div>
            <div class="form-group">
                <label>Institute</label>
                <input type="text" name="institute[]" required>
            </div>
            <div class="half-width-container">
                <div class="form-group half-width">
                    <label>Passing Year</label>
                    <input type="number" name="passing_year[]" required>
                </div>
                <div class="form-group half-width">
                    <label>Results</label>
                    <input type="text" name="results[]" required>
                </div>
            </div>`;
            document.getElementById('education-section').appendChild(educationEntry);
        });

        document.getElementById('add-employment').addEventListener('click', function() {
            const employmentEntry = document.createElement('div');
            employmentEntry.className = 'entry';
            employmentEntry.innerHTML = `
            <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
            <div class="form-group">
                <label>Institute</label>
                <input type="text" name="employment_institute[]" required>
            </div>
            <div class="half-width-container">
                <div class="form-group half-width">
                    <label>Start Date</label>
                    <input type="date" name="start_date[]" required>
                </div>
            <div class="form-group half-width">
            <label>End Date</label>
            <input type="date" id="end_date_${employmentCount}" name="end_date[]" style="margin-bottom: 5px;">
            <div class="checkbox-container">
                <input type="checkbox" style="margin-right: 5px;"
                    onclick="toggleEndDate(this, 'end_date_${employmentCount}')">
                <label>Currently Working</label>
            </div>
        </div>
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position[]" required>
            </div>
            <div class="form-group">
                <label>Special Award</label>
                <input type="text" name="special_award[]">
            </div>`;
            document.getElementById('employment-section').appendChild(employmentEntry);
            employmentCount++;
        });

        function toggleEndDate(checkbox, endDateId) {
            const endDateField = document.getElementById(endDateId);
            if (checkbox.checked) {
                endDateField.value = '';
                endDateField.disabled = true;
                endDateField.style.backgroundColor = '#020203';
            } else {
                endDateField.disabled = false;
            }
        }


        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('profile_image');
        const imagePreview = document.getElementById('image-preview');


        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', handleFilePreview);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.backgroundColor = '#e0e0e0';
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.style.backgroundColor = '#f9f9f9';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.backgroundColor = '#f9f9f9';

            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                handleFilePreview();
            }
        });

        function handleFilePreview() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
