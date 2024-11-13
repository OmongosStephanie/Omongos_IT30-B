<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Register</title>
    <style>
        /* Background Image */
        body {
            background-image: url('https://i.pinimg.com/736x/d6/ea/6f/d6ea6f1ecf597cd976fe10519f495f3a.jpg'); /* Update this with your own background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: rgba(0, 0, 0, 0.6);
            border: none;
        }

        .navbar-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        /* Centering the Card */
        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Light transparent white background */
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h4.text-success {
            text-align: center;
            font-size: 28px;
            color: #5cb85c;
            margin-bottom: 20px;
        }

        hr {
            border-top: 2px solid #5cb85c;
            width: 50%;
            margin: 20px auto;
        }

        .form-group label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 8px;
            font-size: 16px;
            padding: 12px;
            margin-top: 8px;
            border: 2px solid #5cb85c;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #4cae4c;
            box-shadow: 0 0 8px rgba(76, 174, 76, 0.5);
            outline: none;
        }

        .btn-primary {
            background-color: #5cb85c;
            border-color: #5cb85c;
            color: #fff;
            font-size: 18px;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #4cae4c;
            border-color: #4cae4c;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #5cb85c;
            text-decoration: none;
            font-size: 16px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        </div>
    </nav>

    <!-- Card Container for Registration Form -->
    <div class="card-container">
        <div class="card">
            <h4 class="text-success">Register here...</h4>
            <hr>

            <!-- Registration Form -->
            <form action="register_query.php" method="POST">
                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="firstname" required />
                </div>

                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" class="form-control" name="lastname" required />
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" required />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required />
                </div>

                <div class="form-group">
                    <button class="btn btn-primary form-control" name="register">Register</button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="register-link">
                <p>Already have an account? <a href="../index.php">Login</a></p>
            </div>
        </div>
    </div>

</body>
</html>
