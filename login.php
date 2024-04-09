<?php
require 'includes/header.php';


$login = false;
$showsError = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'classes/Database.php';
    $database = new Database;
    $conn = $database->connectDB();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    $sql = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password' AND `email` = '$email'";
    $result = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($result);

    if($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header ('Location: index.php');
    }
    
    else {
        $showsError = "Invalid Credentials";
    }
}


?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <?php
                                    if($login) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> You are logged in successfully.
                                    </div>';
                                    }
                                    if($showsError) {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> '. $showsError .'
                                    </div>';
                                    }

                                    ?>

                                    <form class="user" action="login.php" method="POST">
                                        
                                        <!-- User-name -->
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username">
                                        </div>
                                        <!-- Email -->
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <!-- Remember Me -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <!-- Login button  -->
                                       <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                        <hr>
                                        <!-- Login with google  -->
                                        <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <!-- Login with facebook -->
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

 <?php require 'includes/footer.php' ?>
</body>

</html>