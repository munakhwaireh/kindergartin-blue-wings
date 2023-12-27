

<?php

var_dump($_POST);
include('connect.php');
global $conn;
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['signup-form'])) {
            // Handle sign-up form submission
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email-signup']);
            $password = ($_POST['password-signup']);

            $select = " SELECT * FROM  parent WHERE Email = '$email' && password = '$password' ";

            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {

                $error[] = 'user already exist!';

            } else {
                $insert = "INSERT INTO parent (Name, Email, password,Location, Phone,  pic) VALUES('$name','$email','$password','','','')";
                mysqli_query($conn, $insert);
//                header('location:index.html');
            }


        };

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Blue Wings Kindergarten</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
<!--    <link href="img/favicon.ico" rel="icon">-->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

    <!-- Bootstrap Styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Your Custom Styles -->
    <link href="css/signup.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="border rounded p-4 bg-white" id="signin-form">
                <h2 class="text-center mb-4">Sign In</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                <p class="text-center mt-3">
                    <a href="#" class="text-decoration-none" id="forgot-link">Forgot password?</a>
                </p>
                <p class="text-center mt-3">
                    <a href="#" class="text-primary" id="signup-link">Don't have an account? Sign Up</a>
                </p>
            </form>

            <!-- Sign Up Form (Initially Hidden) -->
            <form class="border rounded p-4 bg-white d-none" name="signup-form" id="signup-form" method="post" action="signup.php">
                <h2 class="text-center mb-4">Sign Up</h2>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email-signup" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email-signup" name="email-signup" required>
                </div>
                <div class="mb-3">
                    <label for="password-signup" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password-signup" name="password-signup" required>
                </div>
                <button type="submit" class="btn btn-pink w-100" name="signup-form" id="signup-form" href="#" >Sign Up</button>

                <p class="text-center mt-3">
                    <a href="#" class="text-primary" id="signin-link">Already have an account? Sign in</a>
                </p>
            </form>


            <!-- Forgot Password Form (Initially Hidden) -->
            <form class="border rounded p-4 bg-white d-none" id="forgot-form">
                <h2 class="text-center mb-4">Forgot Password</h2>
                <div class="mb-3">
                    <label for="email-forgot" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email-forgot" required>
                </div>
                <button type="submit" class="btn btn-info w-100" id="reset-password-btn">Reset Password</button>
                <p id="reset-password-message" class="text-success mt-3"></p>
                <button class="btn btn-secondary w-100 d-none" id="return-to-signin-btn">Return to Sign In</button>
            </form>
        </div>
    </div>
</div>

<script src="js/main.js"></script>
<script>


    document.getElementById('signup-link').addEventListener('click', function () {
        document.getElementById('signin-form').classList.toggle('d-none');
        document.getElementById('signup-form').classList.toggle('d-none');
        document.getElementById('forgot-form').classList.add('d-none'); // Hide forgot form
    });

    document.getElementById('signin-link').addEventListener('click', function () {
        document.getElementById('signin-form').classList.toggle('d-none');
        document.getElementById('signup-form').classList.add('d-none'); // Hide sign up form
        document.getElementById('forgot-form').classList.add('d-none'); // Hide forgot form
    });

    document.getElementById('forgot-link').addEventListener('click', function () {
        document.getElementById('signin-form').classList.add('d-none'); // Hide sign in form
        document.getElementById('signup-form').classList.add('d-none'); // Hide sign up form
        document.getElementById('forgot-form').classList.toggle('d-none'); // Toggle visibility of forgot form
    });

    // Additional code for handling the "Reset Password" button
    document.getElementById('reset-password-btn').addEventListener('click', function (event) {
        event.preventDefault();

        // Assuming some validation logic before showing the message
        var email = document.getElementById('email-forgot').value;
        if (emailIsValid(email)) {
            var messageElement = document.getElementById('reset-password-message');
            messageElement.textContent = "An email has been sent. Please check your email to reset your password.";
            messageElement.classList.remove('text-danger'); // Optional: Remove any previous error styling
            messageElement.classList.add('text-success'); // Optional: Add success styling

            // Show the "Return to Sign In" button
            document.getElementById('return-to-signin-btn').classList.remove('d-none');
        } else {
            var messageElement = document.getElementById('reset-password-message');
            messageElement.textContent = "Invalid email. Please enter a valid email address.";
            messageElement.classList.remove('text-success'); // Optional: Remove any previous success styling
            messageElement.classList.add('text-danger'); // Optional: Add error styling

            // Hide the "Return to Sign In" button
            document.getElementById('return-to-signin-btn').classList.add('d-none');
        }
    });

    // Function to validate email format (a simple example)
    function emailIsValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Handling the "Return to Sign In" button
    document.getElementById('return-to-signin-btn').addEventListener('click', function () {
        document.getElementById('signin-form').classList.remove('d-none');
        document.getElementById('forgot-form').classList.add('d-none');
        document.getElementById('reset-password-message').textContent = ""; // Clear the message
    });
</script>
</body>

</html>
