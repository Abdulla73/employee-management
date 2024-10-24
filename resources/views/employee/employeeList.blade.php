<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #343f42;
        }

        .hero {
            background: linear-gradient(45deg, #61a4e3, #bac8e0);
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            color: #333;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #fff;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
        }

        .hero-buttons .btn {
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 30px;
        }

        .btn-add {
            background-color: #4facfe;
            color: white;
        }

        .btn-add:hover {
            background-color: #00f2fe;
        }

        .btn-logout {
            background-color: #ff7676;
            color: white;
        }

        .btn-logout:hover {
            background-color: #ff5f5f;
        }

        .employee-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            padding: 50px;
        }

        .employee-card {
            background-color: #d1e8ff;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            text-align: center;
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .employee-card:hover {
            transform: translateY(-10px);
        }

        .employee-photo {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .employee-description {
            margin-top: 15px;
            font-size: 18px;
            color: #333;
        }

        .employee-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-edit {
            background-color: #4facfe;
            color: white;
            padding: 12px;
            border-radius: 30px;
            width: 100%;
        }

        .btn-edit:hover {
            background-color: #00f2fe;
        }

        .btn-delete {
            background-color: #ff7676;
            color: white;
            padding: 12px;
            border-radius: 30px;
            width: 100%;
        }

        .btn-delete:hover {
            background-color: #ff5f5f;
        }

        @media (max-width: 768px) {
            .employee-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 576px) {
            .employee-grid {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .hero h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="hero">
        <h1>Welcome to the Employee Management</h1>
        <div class="hero-buttons">
            <button class="btn btn-add">Add Employee</button>
            <button class="btn btn-logout">Logout</button>
        </div>
    </div>

    <div class="employee-grid">
        <div class="employee-card">
            <img src="https://via.placeholder.com/250" alt="Employee Photo" class="employee-photo">
            <div>
                <p></p>
            </div>
            <div class="employee-name">
                John Doe
            </div>
            <div class="employee-description">
                 Software Engineer
            </div>
            <div class="employee-buttons">
                <button class="btn btn-edit">Edit</button>
                <button class="btn btn-delete">Delete</button>
            </div>
        </div>

        <div class="employee-card">
            <img src="https://via.placeholder.com/250" alt="Employee Photo" class="employee-photo">
            <div>
                <p></p>
            </div>

            <div class="employee-name">
                Jane Smith
            </div>
            <div class="employee-description">
                 UX Designer
            </div>
            <div class="employee-buttons">
                <button class="btn btn-edit">Edit</button>
                <button class="btn btn-delete">Delete</button>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
