<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-card-header">
                <h1 class="title">Welcome Back!</h1>
            </div>

            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                    <?php echo $_SESSION['message']['text'] ?>
                </div>
                <script>
                    (function() {
                        setTimeout(function(){
                            document.querySelector('.msg').remove();
                        }, 3000)
                    })();
                </script>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <form action="login/login_query.php" method="POST">  
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required />
                </div>
                <button class="btn btn-primary form-control" name="login">Login</button>
                <p class="register-link">Don't have an account? <a href="login/register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>
