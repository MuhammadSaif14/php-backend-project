<?php
session_start();
require 'classes/Database.php';
require 'classes/GdEmployeeData.php';
require 'includes/header.php'; 

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: login.php');
    exit;
}

$database = new Database;
$conn = $database->connectDB();

$id = $_GET['id'];

$employeeData = GdEmployee::getById($conn, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $office = $_POST['office'];
    $age = $_POST['age'];
    $startdate = $_POST['startdate'];
    $salary = $_POST['salary']; 
    
    $sql = "UPDATE gdemployeedata SET `name` = ?, age = ?, startdate = ?, salary = ?, office = ?, position = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $name, $age, $startdate, $salary, $office, $position, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: Gd-Employees.php");
    };
}
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <?php require 'includes/sidebar.php' ?>
    <!-- End of Sidebar -->
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require 'includes/navbar.php' ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Update Record of <?= $employeeData['name'] ?></h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Pending Requests Card Example -->
                    <div class="col-md-8">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" value="<?= $employeeData['name']?>" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="position" value="<?= $employeeData['position'] ?>" placeholder="Enter Position">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="office" value="<?= $employeeData['office'] ?>" placeholder="Enter Office">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="age" value="<?= $employeeData['age'] ?>" placeholder="Enter Age">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="startdate" value="<?= $employeeData['startdate'] ?>" placeholder="Enter Start Date">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="salary" value="<?= $employeeData['salary'] ?>" placeholder="Enter Salary">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
