<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

    .content {
        flex-grow: 1;
        padding: 20px;
        margin-left: 10px;

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 10px;
            }

        }
    }

    .sidebar {
        width: 250px;
        background-color: #3A6073;
        color: #F9F871;
        padding-top: 20px;
        height: 100%;
        padding: 20px;
    }

    .sidebar a {
        color: #F9F871;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        font: 100;
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

    .navbar {
        background-color: #3A6073;
        border: none;
        padding: 15px 20px;
        min-height: 70px !important;
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
