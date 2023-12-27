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
