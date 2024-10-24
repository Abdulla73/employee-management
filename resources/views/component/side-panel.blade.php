<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Pro - Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #F0F8FF;
        }

        .sidebar {
            width: 250px;
            background-color: #3A6073;
            color: #F9F871;
            padding-top: 20px;
            height: 100%;
        }

        .sidebar a {
            color: #F9F871;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #FFEB3B;
            color: #3A6073;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="#">View Employees</a>
        <a href="#">View Users</a>
        <a href="#">Add Users</a>
        <a href="#">Manage Settings</a>
    </div>


</body>

</html>

