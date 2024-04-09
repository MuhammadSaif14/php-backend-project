<?php 
$showAlert = false;
$showError = false;
$userError = '';
$passError = '';
$emailError = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require "classes/Database.php";
    $database = new Database;
    $conn = $database->connectDB();

    if ( $_POST['username'] != '' ) {
        $username = $_POST['username'];
    }else {
        $userError = "Username must not be empty";
    }

    if ( $_POST['password'] != '' ) {
        $password = $_POST['password'];
    }else {
        $passError = "Password must not be empty";
    }

    if ( $_POST['email'] != '' ) {
        $email = $_POST['email'];
    }else {
        $emailError = "Email must not be empty";
    }
    
    $cpassword = $_POST['cpassword'];

    if ( $userError == "" && $passError == "" ){
        $existSql = "SELECT * FROM users WHERE username = '$username'";
        $stmt = mysqli_query($conn , $existSql);
        $numExistRow = mysqli_num_rows($stmt);

        if($numExistRow > 0) {
            $showError = "Username already exists";
        }
        else {
            if($password == $cpassword) {
                // Use prepared statements to prevent SQL injection
                $sql = "INSERT INTO users (`username`, `email`, `password`) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $password);
        
                if ($stmt->execute()) {
                    $showAlert = true;
                }
                else {
                    $showError = "Error: " . $stmt->error;
                }
        
                $stmt->close();
            }
            else {
                $showError = "Passwords do not match.";
            }
        }

    }
    $conn->close(); // Close the database connection after use
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RBP - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <?php
                            if($showAlert) {
                                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> Your account has been successfully Created and you may login now.
                                    </div>';
                            }
                            if($showError) {
                                echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> '. $showError .'
                                    </div>';
                            }
                            

                            ?>
                            
                            
                            <form class="user" action="" method="POST">
                                <div class="form-group row" style="">
                                    <!-- User-name -->
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" name="username" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="User Name">
                                    </div>
                                    <?php if($userError) {
                                        echo '<label class="text-danger mx-3 "> <strong>Error!</strong> '.$userError.' </label>';
                                        } 
                                    ?>
                                </div>
                                <!-- Email-address -->
                                <div class="form-group mb-0">
                                    <input type="email" name="email" class="form-control form-control-user " id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div> 
                                <?php if($emailError) {
                                        echo '<label class="text-danger mx-1 "> <strong>Error!</strong> '.$emailError.' </label>';
                                        } 
                                    ?>
                                <!-- Password -->
                                <div class="form-group row mt-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <!-- Repeat-Password -->
                                    <div class="col-sm-6">
                                        <input type="password" name="cpassword" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Confirm Password ">                                                                                                            
                                    </div>

                                    <?php if($passError) { 
                                        echo '<label class=" text-danger mx-3"> <strong>Error!</strong> '.$passError.' </label>';
                                        } 
                                    ?>
                                    
                                </div> 
                                <!-- Register-button -->
                                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                               
                                <hr>
                                <!-- Register-with-google  -->
                                <a href="#" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <!-- Register-with-facebiook  -->
                                <a href="#" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>