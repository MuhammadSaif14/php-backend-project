<?php
require 'classes/Database.php';
require 'classes/WdEmployeeData.php';
require 'includes/header.php'; 

$database = new Database;
$conn = $database->connectDB();

$employeeData = WdEmployee::createone();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $office = $_POST['office'];
    $age = $_POST['age'];
    $startdate = $_POST['startdate'];
    $salary = $_POST['salary'];
    
    // Insert data into the database
    $sql = "INSERT INTO wdemployeedata (name, position, office, age, startdate, salary) VALUES ('$name', '$position', '$office', '$age', '$startdate', '$salary')";
    
    if ($conn->query($sql) === TRUE) {
        header ("location: Wd-Employees.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
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
                    <h1 class="h3 mb-0 text-gray-800">Add new Employee of Web-Development.    </h1>
                    
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Pending Requests Card Example -->
                    <div class="col-md-8">
                        <form action="" method="POST" encypte="multipart/from-data">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" value=""  placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="position" value=""   placeholder="Enter Position">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="office" value=""   placeholder="Enter Office">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="age" value=""  placeholder="Enter Age">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="startdate" value=""  placeholder="Enter Start Date">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="salary"  value=""  placeholder="Enter Salary">
                            </div>

                            <button action="" type="submit" class="btn btn-primary" >Add New</button>
                        </form>
                    </div>
                    
                </div>
                <!-- Edit ka button -->
                

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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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