<?php
// Check if user Logged in with unique id session check
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

    <!-- CSS -->
    <?php include '../include/css.php'; ?>
    <link rel="stylesheet" href="../include/css/login.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../controller/user_create.php" method="post">
                <h1>Create Account</h1>
                <input type="text" placeholder="FirstName" name="firstName" />
                <input type="text" placeholder="LastName" name="lastName" />
                <input type="text" placeholder="Username" name="username" />
                <input type="email" placeholder="Email" name="email" />
                <input type="date" placeholder="Tanggal Lahir" name="tanggalLahir" id="">
                <input type="password" placeholder="Password" name="password" />
                <input type="text" placeholder="Gender" name="jenisKelamin" />
                <div class="g-recaptcha" data-sitekey="6Le0Z4AaAAAAAK5tCo3GDnuJKsj38rJ_FmlqE5F-"></div>
                <button class="mt-2">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../controller/user_login.php" method="post">
                <h1>Sign in</h1>
                <input type="text" placeholder="Email/Username" name="username" required/>
                <input type="password" placeholder="Password" name="password" required/>
                <div class="g-recaptcha" data-sitekey="6Le0Z4AaAAAAAK5tCo3GDnuJKsj38rJ_FmlqE5F-"></div>
                <button type="submit" class="mt-2">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello!</h1>
                    <p>Enter your personal details and start your food journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <?php include '../include/js.php'; ?>
    <?php if (isset($_SESSION['restoran.uts.error_msg_login'])) { ?>
    <script type="module">
        $(document).ready(function () {
            swal("Error", "<?= $_SESSION['restoran.uts.error_msg_login'] ?>", "error");

            // Swal.fire({
            //     icon: 'error',
            //     title: 'Oops...',
            //     text: 'Invalid credentials!',
            // });
        });
    </script>
    <?php unset($_SESSION['restoran.uts.error_msg_login']);} ?>
</body>
</html>
