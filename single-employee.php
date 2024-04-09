<?php

require 'classes/database.php';
require 'classes/employee.php';
require 'includes/header.php';

$database = new Database;
$conn = $database->connectDB();

$id = $_GET['id'];
$employeeData = Employee::getById($conn, $id);


?>


<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php require('includes/sidebar.php'); ?> 
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
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current = "true">Name :<?=$employeeData['name']?></li>
                        <li class="list-group-item">Postition :<?=$employeeData['position']?></li>
                        <li class="list-group-item">Office :<?=$employeeData['office']?></li>
                        <li class="list-group-item">Age :<?=$employeeData['age']?></li>
                        <li class="list-group-item">Start Date :<?=$employeeData['startdate']?></li>
                        <li class="list-group-item">Salary :<?=$employeeData['salary']?></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <img src="" alt="" class="border border-secondary rounded" width="200" height="200">
                </div>
            </div>
            <!-- Edit button  -->
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" href="edit-employee.php?id=<?=$employeedData['id']?>" >Edit</a>
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
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer.php' ?>