<?php

global $conn;
include('connect.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID and update the status based on the action
    $id = $_POST['ID'];
    $action = $_POST['action'];

    $status = ($action === 'accept') ? '1' : '0';

    $sql = "UPDATE feedbacks SET puplish = '$status' WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
    exit; // Stop further execution
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
        <a href="feedbacks.php" class="navbar-brand">
            <h1 class="m-0 text-primary"><i class="fas fa-school m-3"></i>Blue Wings Kindergarten </h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">

                <a href="Boss_Profile.html" class="nav-item nav-link ">Profile</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tables</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                        <a href="teach_table.php" class="dropdown-item">Teachers</a>
                        <a href="child_table.php" class="dropdown-item">Children</a>
                    </div>

                </div>
                <a href="appointments-acceptance.php" class="nav-item nav-link ">Appointments</a>
                <a href="feedbacks.php" class="nav-item nav-link active">Feedbacks</a>

            </div>
        </div>
        <a href="index.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Log out<i class="fa fa-arrow-right ms-3"></i></a>

    </nav>
    <!-- Navbar End -->

    <!-- Content Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <h2 class="mb-4">Clients feedbacks</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>puplish</th>
                    <th>Email</th>
                    <th>subject</th>
                    <th>Message</th>
                </tr>
                </thead>
                <tbody>
                <!-- Use PHP or other server-side language to fetch and display data from the database -->
                <?php
                global $conn;
                include('connect.php');


                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM feedbacks";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["puplish"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>" . $row["message"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No feedbacks found</td></tr>";
                }

                $conn->close();
                ?>


                </tbody>
            </table>
            <!-- Buttons -->
            <div class="mt-4">

                <button type="button" class="btn btn-danger me-2" onclick="showForm2()">update</button>
                <!-- forms -->
                <br><br>

                <form id="getStartedForm2" style="display: none;">
                    <div class="mb-3">
                        <label for="ID" class="form-label">ID</label>
                        <input type="text" class="form-control" name="ID" id="ID" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitForm2('accept')">accept</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm2('deny')">deny</button>

                </form>




            </div>

        </div>
    </div>
    <!-- Content End -->




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
                    <a class="btn btn-link text-white-50" href="contact.php">Contact Us</a>
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
                            <a href="index.php">Home</a>
                            <a href="about.html">about</a>
                            <a href="contact.php">contact</a>
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






<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>


    function showForm2() {
        document.getElementById("getStartedForm2").style.display = "block";
    }


    function submitForm2(action) {
        var id = $("#ID").val();


        $.ajax({
            type: "POST",
            url: "feedbacks.php",
            data: { ID: id, action: action },
            success: function (response) {
                // Handle the response, e.g., show a success message
                response="it will puplished in few minutes";
                alert(response);
                document.getElementById("getStartedForm2").style.display = "none";
            },
            error: function (error) {
                // Handle errors, e.g., show an error message
                alert("Error updating status: " + error.responseText);
            }
        });
    }
</script>


</script>

</body>
</html>
