<?php
session_start();
require "classes/Database.php";
require "classes/GdEmployeeData.php";
require "includes/header.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true) {
    header('Location: login.php');
    exit;
}

$database = new Database;
$conn = $database->connectDB();

$employee = new GdEmployee;
$employees = $employee->getAll($conn);

if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete = new GdEmployee;
    $id = $_POST['id'];
    $deleted = $delete->deleteOne($conn , $id);
    header("Location: Gd-Employees.php");
}

?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php require "includes/sidebar.php";?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require "includes/navbar.php";?>
            
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

            

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary h2">Graphic Design 'Employees'</h6>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="float-right  mt-3 mr-4">
                                <a class="btn btn-primary" href="export-gd-employee.php">Download Excel Files</a>
                                <a href="GdAddNew.php" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                        <th>Trash</th>
                                        <th>Edit</th>

                                    </tr>
                                </thead>
                                
                                    
                                <tbody>
                                <?php foreach ($employees as $employee) : ?>
                                    <tr class=" color-dark">
                                        <td><?= $employee['name']?></td>
                                        <td><?= $employee['position']?></td>
                                        <td><?= $employee['office']?></td>
                                        <td><?= $employee['age']?></td>
                                        <td><?= $employee['startdate']?></td>
                                        <td><?= $employee['salary']?>$</td>
                                        <td class="text-center">
                                            <form action="" class="d-inline-block" method="POST">
                                                <input type="text" name="id" hidden value="<?= $employee['id'] ?>" >
                                                <button class="btn btn-danger"> <i class="fa fa-trash"> </i> </button>       
                                            </form>
                                        </td> 
                                        <td>
                                            <form action="Edit-Gd-Employee.php" method="GET">
                                                <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                                                <button class="btn btn-success"> <i class="fa fa-edit"></i> </button>       
                                            </form>
                                        </td> 


                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
                    <span>Copyright &copy; Your Website 2020</span>
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
            <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
    </div>
</div>
</div>
<?php require 'includes/footer.php' ?>


</body>

</html>