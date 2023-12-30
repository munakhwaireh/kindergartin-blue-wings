<?php
global $conn;
include('connect.php');
session_start();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['getStartedForm'])) {
    $id=$_POST['ID'];
    $name = $_POST['name'];
    $age = $_POST['Age'];
    $healthInfo = $_POST['Health_info'];
    $city = $_POST['City'];
    $tId = $_POST['T-ID'];
    $pId = $_POST['P-ID'];



    // Insert new child into the database
    $sql = "INSERT INTO children (ID,name, age, healthInfo, City, T_ID, P_ID,pic) 
            VALUES ('$id','$name', '$age', '$healthInfo', '$city', '$tId', '$pId','')";

//    mysqli_query($conn, $sql);

    if ($conn->query($sql) === TRUE) {
       // echo "Child added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
elseif(isset($_POST['deleteform'])){
    // Handle delete form submission
    $IdToDelete = $_POST['child_id'];

    // Perform the database deletion with prepared statements
    $deleteSql = "DELETE FROM children WHERE ID = '$IdToDelete'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Status deleted successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
    header('location:child_table.php');
}elseif(isset($_POST['updateform'])){

    // Handle update form submission
    $idToUpdate = $_POST['ID2'];
    $name = $_POST['name1'];
    $age = $_POST['Age2'];
    $healthInfo = $_POST['Health_info2'];
    $city = $_POST['City2'];
    $tId = $_POST['T-ID2'];
    $pId = $_POST['P-ID2'];

    // Update the child in the database
    $updateSql = "UPDATE children SET 
                      name = '$name', 
                      age = '$age', 
                      healthInfo = '$healthInfo', 
                      City = '$city', 
                      T_ID = '$tId', 
                      P_ID = '$pId' 
                      WHERE ID = '$idToUpdate'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Child updated successfully";
    } else {
        echo "Error updating child: " . $conn->error;
    }
    header('location:child_table.php');

}


}

$conn->close();
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
        <a href="child_table.php" class="navbar-brand">
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
                <a href="feedbacks.php" class="nav-item nav-link ">Feedbacks</a>

            </div>
        </div>
        <a href="index.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Log out<i class="fa fa-arrow-right ms-3"></i></a>

    </nav>
    <!-- Navbar End -->

    <!-- Content Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Children Table -->
            <h2 class="mb-4">Children Table</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Health Info</th>
                    <th>City</th>
                    <th>T_ID</th>
                    <th>P_ID</th>
                </tr>
                </thead>
                <tbody>
                <?php
                global $conn;
                include('connect.php');


                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM children";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["healthInfo"] . "</td>";
                    echo "<td>" . $row["City"] . "</td>";
                    echo "<td>" . $row["T_ID"] . "</td>";
                    echo "<td>" . $row["P_ID"] . "</td>";
                    echo "</tr>";
                }
                } else {
                echo "<tr><td colspan='11'>No children found</td></tr>";
                }

                $conn->close();
                ?>
                </tbody>

            </table>
            <!-- Buttons -->
            <div class="mt-4">
                <button type="button" class="btn btn-primary me-2" onclick="showForm()">Add</button>
                <button type="button" class="btn btn-danger me-2" onclick="showForm22()">Delete</button>
                <button type="button" class="btn btn-success" onclick="showForm3()">Update</button>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- forms -->
    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
        <div class="h-100 d-flex flex-column justify-content-center p-5">
            <!-- Your form goes here -->
            <!-- Your form goes here -->
            <form id="getStartedForm"  method="post" style="display: none;">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" class="form-control" id="ID" name="ID" required>
                </div>
                <div class="mb-3">
                    <label for="Age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="Age" name="Age" required>
                </div>
                <div class="mb-3">
                    <label for="Health_info" class="form-label">Health info</label>
                    <input type="text" class="form-control" id="Health_info" name="Health_info" required>
                </div>
                <div class="mb-3">
                    <label for="City" class="form-label">City</label>
                    <input type="text" class="form-control" id="City" name="City" required>
                </div>
                <div class="mb-3">
                    <label for="T-ID" class="form-label">Teacher id</label>
                    <input type="text" class="form-control" id="T-ID" name="T-ID" required>
                </div>
                <div class="mb-3">
                    <label for="P-ID" class="form-label">Parent id</label>
                    <input type="text" class="form-control" id="P-ID"  name="P-ID" required>
                </div>


                <!-- Add other form fields as needed -->

                <button type="submit" class="btn btn-primary" id="getStartedForm2" name="getStartedForm2" onclick="submitForm()">Done</button>
            </form>
            <!-- delete form -->
            <form id="deleteform" method="post" style="display: none;">
                <div class="mb-3">
                    <label for="child_id" class="form-label">Child ID</label>
                    <input type="text" class="form-control" name="child_id" id="child_id" required>
                </div>


                <button type="submit" class="btn btn-primary" id="deleteform" name="deleteform" onclick="submitForm2()">Done</button>
            </form>

            <!--update  -->
            <form id="updateform" method="post" style="display: none;">
                <div class="mb-3">
                    <label for="name1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name1" id="name1" required>
                </div>
                <div class="mb-3">
                    <label for="ID2" class="form-label">ID</label>
                    <input type="text" class="form-control"  name="ID2" id="ID2" required>
                </div>
                <div class="mb-3">
                    <label for="Age2" class="form-label">Age</label>
                    <input type="text" class="form-control" name="Age2" id="Age2" required>
                </div>
                <div class="mb-3">
                    <label for="Health_info2" class="form-label">Health info</label>
                    <input type="text" class="form-control" name="Health_info2" id="Health_info2" required>
                </div>
                <div class="mb-3">
                    <label for="City2" class="form-label">City</label>
                    <input type="text" class="form-control" name="City2" id="City2" required>
                </div>
                <div class="mb-3">
                    <label for="T-ID2" class="form-label">Teacher id</label>
                    <input type="text" class="form-control" name="T-ID2" id="T-ID2" required>
                </div>
                <div class="mb-3">
                    <label for="P-ID2" class="form-label">Parent id</label>
                    <input type="text" class="form-control" name="P-ID2" id="P-ID2" required>
                </div>

                <!-- Add other form fields as needed -->

                <button type="submit" class="btn btn-primary" name="updateform" id="updateform" onclick="submitForm3()">Done</button>
            </form>


        </div>
    </div>


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
                            <a href="index.php">Home</a>
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






<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>
    function showForm() {
        document.getElementById("getStartedForm").style.display = "block";
    }

    function submitForm() {
        // You can add your form submission logic here

        document.getElementById("getStartedForm" ).style.display = "none";
        alert("Form submitted! (Note: This is a placeholder for actual form submission logic)");
    }

    function showForm22() {
        document.getElementById("deleteform").style.display = "block";
    }

    function submitForm2() {
        // You can add your form submission logic here

        document.getElementById("deleteform" ).style.display = "none";
        alert("Form submitted! (Note: This is a placeholder for actual form submission logic)");
    }

    function showForm3() {
        document.getElementById("updateform").style.display = "block";
    }

    function submitForm3() {
        // You can add your form submission logic here

        document.getElementById("updateform" ).style.display = "none";
        alert("Form submitted! (Note: This is a placeholder for actual form submission logic)");
    }
</script>

</body>
</html>