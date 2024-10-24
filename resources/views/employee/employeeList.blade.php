<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List - Employee Pro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #F0F8FF;
        }

        .main {
            display: flex;
            flex-grow: 1;
            margin-top: -15px;
        }


        /* .sidebar {
            width: 250px;
            background-color: #3A6073;
            color: #F9F871;
            padding-top: 20px;
            height: calc(100vh - 60px);
            position: fixed;
            overflow-y: auto;
        } */

        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;

            @media (max-width: 768px) {
                .sidebar {
                    width: 200px;
                }

                .content {
                    margin-left: 200px;
                }

            }
        }
    </style>
</head>

<body>

    @include('component.navbar')

    <div class="main">
        @include('component.side-panel')


        <div class="content">
            <h1>Welcome to Employee Pro</h1>
            <p>This is where you can manage all your managing tasks.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
