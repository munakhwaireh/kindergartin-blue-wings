<?php
global $conn;
global $conn;
global $pic;
global $childCount;
global $user_id;
global $birthdate;
global $name;
global $result;
global $phone;
global $email;
global $location;
include('connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the email, location, and phone if the request is a POST request
    $user_id = $_POST['user_id'];
    $new_email = $_POST['new_email'];
    $new_location = $_POST['new_location'];
    $new_phone = $_POST['new_phone'];

    // Perform the update in the database
    $update_query = "UPDATE parent SET Email = '$new_email', Location = '$new_location', Phone = '$new_phone' WHERE P_ID = $user_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "success";
        // Stop execution after handling the update
    } else {
        echo "error";
        // Stop execution after handling the error
    }
    exit();
}

// If it's not a POST request, proceed with retrieving user information

// Check if the user_id session variable is set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Retrieve user information and count of children from the database using the user ID
    $select = "(
        SELECT p.*, COUNT(c.P_ID) AS child_count, NULL AS Child_ID, NULL AS Child_Name, NULL AS Child_Age
        FROM parent p
        LEFT JOIN children c ON p.P_ID = c.P_ID
        WHERE p.P_ID = $user_id
        GROUP BY p.P_ID
    )
    UNION
    (
        SELECT c.*, c.ID AS Child_ID, c.name AS Child_Name, c.age AS Child_Age
        FROM children c
        WHERE c.P_ID = $user_id
    )";

    $result = mysqli_query($conn, $select);

    if ($row = mysqli_fetch_array($result)) {
        $email = $row['Email'];
        $name = $row['Name'];
        $location = $row['Location'];
        $phone = $row['Phone'];
        $pic = $row['pic'];
        $childCount = $row['child_count'];

        // Output other user information as needed
        echo "<h2 class='card-jobtitle' style='color: black'>Parent of $childCount child" . ($childCount == 1 ? "" : "ren") . "</h2>";


    } else {
        echo "User not found in the database.";
    }
} else {
    // Handle the case when the user_id session variable is not set
    echo "User not logged in.";
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
    <!--  <link href="img/favicon.ico" rel="icon"> -->


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-euSkY2AYLs3h6M8Uf+KJYu78Fvyg4qf6xvqMWd5i0ERiF9zX5qxk+X6tJ6pVzDZE" crossorigin="anonymous">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/guardian.css" rel="stylesheet">
    <link href="css/guardChild.css" rel="stylesheet">



    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>



<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
        <a href="guardian.php" class="navbar-brand">
            <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Blue Wings Kindergarten </h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">

                <a href="guardian.php" class="nav-item nav-link active">Profile</a>
                <a href="activities_parents.html" class="nav-item nav-link ">Activities</a>
                <a href="library_parents.html" class="nav-item nav-link ">library</a>

            </div>
            <a href="index.html" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Log out<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->



    <div class="card" data-state="#about">
        <div class="card-header">
            <div class="card-cover" style="background-image: url('https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80')"></div>
            <img class="card-avatar" src="<?php echo $pic; ?>" alt="avatar" />
            <h1 class="card-fullname">    <?php echo $name; ?>
            </h1>
            <h2 class="card-jobtitle" style="color: black"><?php echo "Parent of $childCount child" . ($childCount == 1 ? "" : "ren"); ?></h2>
        </div>
        <div class="card-main">
            <div class="card-section is-active" id="about">
                <?php
                // Output child information dynamically
                while ($childRow = mysqli_fetch_array($result)) {
                    $childPic = $childRow['pic'];
                    $childName = $childRow['Child_Name'];
                    $childAge = $childRow['Child_Age'];

                    // Use absolute path for the image (replace with an actual URL)
                    $absoluteImagePath = "imgg/i.jpeg"; // Replace with an actual image URL
                    echo "<div class='column'>";
                    echo "<div class='card'>";
                    echo "<img src='$absoluteImagePath' alt='$childName' style='width:100%'>";
                    echo "<div class='container'>";
                    echo "<h2>$childName</h2>";
                    echo "<p class='title'>$childAge years old</p>";
                    echo "<p><button class='button'>More Info</button></p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>


            </div>
            <div class="card-section" id="contact">
                <div class="card-content">
                    <div class="card-subtitle">CONTACT</div>
                    <div class="card-contact-wrapper">
                        <div class="card-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" /></svg>
                            <?php echo $location; ?>
                        </div>
                        <div class="card-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" /></svg><?php echo $phone; ?></div>
                        <div class="card-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <path d="M22 6l-10 7L2 6" /></svg>
                            <?php echo $email; ?>
                        </div>
                        <button id="editContactBtn" class="contact-me">Edit my contact data</button>
                    </div>
                </div>
            </div>
            <div class="card-buttons">
                <button data-section="#about" class="is-active">ABOUT</button>
                <button data-section="#contact">CONTACT</button>
            </div>
        </div>
    </div>
    <!--    <script src="script.js"></script>-->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Rafedia Street, Nablus, Palestine</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+970 59-5678903</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>bluewings@example.com</p>
                    <div class="d-flex pt-2">

                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <a class="btn btn-link text-white-50" href="about.html">About Us</a>
                    <a class="btn btn-link text-white-50" href="contact.html">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="">Our Services</a>
                    <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                    <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Photo Gallery</h3>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-4.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-5.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/classes-6.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Newsletter</h3>
                    <p>Didn't you join us until now !!! hurry up and enjoy :)</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <label>
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        </label>
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">2023 Kindergarten blue Wings</a>,All Right Reserved.

                        <!-- Designed By <a class="border-bottom" >Muna & Lama</a> -->
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="index.html">Home</a>
                            <a href="about.html">about</a>
                            <a href="contact.html">contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>



<script>
    $(document).ready(function () {
        $("#editContactBtn").on("click", function () {
            var newEmail = prompt("Enter new email:");
            var newLocation = prompt("Enter new location:");
            var newPhone = prompt("Enter new phone:");

            if (newEmail !== null || newLocation !== null || newPhone !== null) {
                $.ajax({
                    url: "guardian.php",
                    method: "POST",
                    data: {
                        user_id: <?php echo $user_id; ?>,
                        new_email: newEmail,
                        new_location: newLocation,
                        new_phone: newPhone
                    },
                    success: function (response) {
                        if (response === "success") {
                            alert("Contact information updated successfully.");

                            // Reload the page after updating
                            location.reload();
                        } else {
                            alert("Failed to update contact information.");
                        }
                    }
                });
            }
        });
    });

</script>

<script>
    const buttons = document.querySelectorAll(".card-buttons button");
    const sections = document.querySelectorAll(".card-section");
    const card = document.querySelector(".card");

    const handleButtonClick = e => {
        const targetSection = e.target.getAttribute("data-section");
        const section = document.querySelector(targetSection);
        targetSection !== "#about" ?
            card.classList.add("is-active") :
            card.classList.remove("is-active");
        card.setAttribute("data-state", targetSection);
        sections.forEach(s => s.classList.remove("is-active"));
        buttons.forEach(b => b.classList.remove("is-active"));
        e.target.classList.add("is-active");
        section.classList.add("is-active");
    };

    buttons.forEach(btn => {
        btn.addEventListener("click", handleButtonClick);
    });
</script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>