<?php
global $conn;
include('connect.php');
session_start();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['getStartedForm'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $hiringDate = mysqli_real_escape_string($conn, $_POST['hiringDate']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $childNumber = mysqli_real_escape_string($conn, $_POST['childNumber']);
        $teacherId = mysqli_real_escape_string($conn, $_POST['teacherId']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = ($_POST['password']);

        // Perform the database insertion with prepared statements
        $sql = "INSERT INTO teacher (name, birthdate, hiringDate, salary, childNum, ID, pic, email, Phone, password) 
                VALUES ('$name', '$birthdate', '$hiringDate', '$salary', '$childNumber', '$teacherId', '', '$email', '$phone', '$password')";
        mysqli_query($conn, $sql);
         header('location:teach_table.php');

        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }


    }
    else if (isset($_POST['getStartedForm2'])) {
        // Handle delete form submission
        $teacherIdToDelete = mysqli_real_escape_string($conn, $_POST['teacher_id']);

        // Perform the database deletion with prepared statements
        $deleteSql = "DELETE FROM teacher WHERE ID = '$teacherIdToDelete'";
        mysqli_query($conn, $deleteSql);
        if ($conn->query($deleteSql) === TRUE) {
            echo "Status deleted successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }
        header('location:teach_table.php');
    }

}
?>
<?php
 global $conn;
include('connect.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['getStartedForm13'])){


    // Handle update form submission
    $teacherIdToUpdate = mysqli_real_escape_string($conn, $_POST['teacherIdToUpdate']);
    $name = mysqli_real_escape_string($conn, $_POST['name2']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate2']);
    $hiringDate = mysqli_real_escape_string($conn, $_POST['hiringDate2']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary2']);
    $childNumber = mysqli_real_escape_string($conn, $_POST['childNumber2']);
    $email = mysqli_real_escape_string($conn, $_POST['email2']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone2']);
    $password = ($_POST['password2']);

    // Perform the database update with prepared statements
    $updateSql = "UPDATE teacher SET
                  name = '$name',
                  birthdate = '$birthdate',
                  hiringDate = '$hiringDate',
                  salary = '$salary',
                  childNum = '$childNumber',
                  ID = '$teacherIdToUpdate',
                  pic= '',
                  email = '$email',
                  Phone = '$phone',
                  password = '$password'
                  WHERE ID = '$teacherIdToUpdate'";

        mysqli_query($conn, $updateSql);
        if ($conn->query($updateSql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }
}}
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>


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
        <a href="appointments-acceptance.php" class="navbar-brand">
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
            <!-- Teacher Table -->
            <h2 class="mb-4">Teacher Table</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Hiring Date</th>
                    <th>Salary</th>
                    <th>Child Number</th>
                    <th>T ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
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

                $sql = "SELECT * FROM teacher";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["birthdate"] . "</td>";
                    echo "<td>" . $row["hiringDate"] . "</td>";
                    echo "<td>" . $row["salary"] . "</td>";
                    echo "<td>" . $row["childNum"] . "</td>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["Phone"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "</tr>";
                }
                } else {
                echo "<tr><td colspan='11'>No teachers found</td></tr>";
                }

                $conn->close();
                ?>
                </tbody>
            </table>
            <!-- Buttons -->
            <div class="mt-4">
                <button type="button" class="btn btn-primary me-2" onclick="showForm()">Add</button>
                <button type="button" class="btn btn-danger me-2" onclick="showForm2()">Delete</button>
                <button type="button" class="btn btn-success" onclick="showForm3()">Update</button>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- Add Teacher Modal -->
    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
        <div class="h-100 d-flex flex-column justify-content-center p-5">
            <!-- Your form goes here -->
            <!-- Your form goes here -->
            <form id="getStartedForm" name="getStartedForm" method= "post" action="teach_table.php" style="display: none;">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                </div>
                <div class="mb-3">
                    <label for="hiringDate" class="form-label">Hiring Date</label>
                    <input type="date" class="form-control" name="hiringDate" id="hiringDate" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" name="salary" id="salary" required>
                </div>
                <div class="mb-3">
                    <label for="childNumber" class="form-label">Child Number</label>
                    <input type="number" class="form-control" name="childNumber" id="childNumber" required>
                </div>
                <div class="mb-3">
                    <label for="teacherId" class="form-label">Teacher ID (T ID)</label>
                    <input type="text" class="form-control" name="teacherId" id="teacherId" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <!-- Add other form fields as needed -->

                <button type="submit" class="btn btn-primary" name="getStartedForm" id="getStartedForm1" >Done</button>
            </form>

            <!-- Delete Teacher Form -->
            <form id="getStartedForm2" method="post" style="display: none;">
                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Teacher ID</label>
                    <input type="text" class="form-control" name="teacher_id" id="teacher_id" required>
                </div>

                <button type="submit" class="btn btn-primary" id="getStartedForm2" name="getStartedForm2" >Done</button>
            </form>

            <!--update  -->
            <form id="getStartedForm13" name="getStartedForm13" style="display: none;" method="post" action="teach_table.php">
                <div class="mb-3">
                    <label for="teacherIdToUpdate" class="form-label">Teacher ID to Update</label>
                    <input type="text" class="form-control" name="teacherIdToUpdate" id="teacherIdToUpdate" required>
                </div>
                <div class="mb-3">
                    <label for="name2" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name2" name="name2" required>
                </div>
                <div class="mb-3">
                    <label for="birthdate2" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate2" name="birthdate2" required>
                </div>
                <div class="mb-3">
                    <label for="hiringDate2" class="form-label">Hiring Date</label>
                    <input type="date" class="form-control" name="hiringDate2" id="hiringDate2" required>
                </div>
                <div class="mb-3">
                    <label for="salary2" class="form-label">Salary</label>
                    <input type="number" class="form-control" name="salary2" id="salary2" required>
                </div>
                <div class="mb-3">
                    <label for="childNumber2" class="form-label">Child Number</label>
                    <input type="number" class="form-control" name="childNumber2" id="childNumber2" required>
                </div>
                <div class="mb-3">
                    <label for="email2" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email2" id="email2" required>
                </div>
                <div class="mb-3">
                    <label for="phone2" class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="phone2" id="phone2" required>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" required>
                </div>
                <!-- Add other form fields as needed -->
                <button type="submit" class="btn btn-primary"  id="getStartedForm13" name="getStartedForm13" onclick="submitForm3()">Done</button>
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
    function showForm() {
        document.getElementById("getStartedForm").style.display = "block";
    }


    function submitForm(event) {

        document.getElementById("getStartedForm").style.display = "none";
        alert("Form submitted! ");
    }





    function showForm2() {
        document.getElementById("getStartedForm2").style.display = "block";
    }

    function submitForm2() {
        // You can add your form submission logic here

        document.getElementById("getStartedForm2" ).style.display = "none";
        alert("Form submitted! (Note: This is a placeholder for actual form submission logic)");
    }

    function showForm3() {
        document.getElementById("getStartedForm13").style.display = "block";
    }

    function submitForm3() {
        // You can add your form submission logic here

        document.getElementById("getStartedForm13" ).style.display = "none";
        alert("Form submitted! (Note: This is a placeholder for actual form submission logic)");
    }
</script>

</body>
</html>