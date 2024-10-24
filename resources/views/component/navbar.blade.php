<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Pro Navbar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #F0F8FF;
        }

        .navbar {
            background-color: #3A6073;
            border: none;
            padding: 15px 20px;
        }

        .navbar-brand {
            color: #F9F871;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .navbar-form {
            width: 50%;
            float: none;
            display: inline-block;
        }

        .form-control {
            border-radius: 20px;
            border: 2px solid #FFEB3B;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-control::placeholder {
            color: #A9A9A9;
        }

        .btn-logout {
            background-color: #FF5733;
            color: white;
            border: none;
            border-radius: 20px;
            margin-left: 20px;
        }

        .btn-logout:hover {
            background-color: #C70039;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                float: none;
                display: block;
                text-align: center;
                margin: 10px 0;
            }

            .navbar-form {
                width: 100%;
                text-align: center;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Employee Pro</a>
            </div>
            <form class="navbar-form" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search here..." name="search">
                </div>
            </form>
            <button type="button" class="btn btn-logout navbar-btn pull-right">Logout</button>
        </div>
    </nav>

</body>

</html>
