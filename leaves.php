<?php

session_start();
// echo ($_SESSION['student_id']);
include 'partials/dbconnect.php';
    $id=$_SESSION['student_id'];
    $mysql="SELECT roll_no FROM students where id='$id'";
    $result1=mysqli_query($conn,$mysql);
    $row1 = mysqli_fetch_assoc($result1);
    $roll=$row1['roll_no'];
    $mysql1="SELECT * FROM leaves where stdroll=$roll ORDER BY id DESC";
    $result=mysqli_query($conn,$mysql1);
    if(!$result){
        echo mysqli_error($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
    <title>OneGuard | Dashboard</title>
</head>

<body>
    <!-- header include -->
    <?php 
      include './partials/header.php';
    ?>
    <!-- header include -->
    <!-- Main COntent -->

    <main class="mt-3">
        <?php
            if(isset($_SESSION['success'])){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>
            <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Data Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Leave ID</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                    while($row = mysqli_fetch_assoc($result)) {?>
                                        <tr class="my-auto">
                                            <td><?=$i?></td>
                                            <td><?=$row['leave_id']?></td>
                                            <td><?=$row['leavedate']?> || <?=$row['dtime']?></td>
                                            <td><?php if($row['arrival_date']==""){echo $row['leavedate'];}else{echo $row['arrival_date'];}?> || <?=$row['atime']?></td>
                                            <td><?php 
                                                if($row['status']==0){
                                                    echo' <span class="badge bg-warning mt-1">Pending</span>';
                                                }
                                                if($row['status']==2){
                                                    echo' <span class="badge bg-danger mt-1">Rejected</span>';
                                                }
                                                if($row['status']==1){   
                                                    echo' <span class="badge bg-success mt-1">Approved</span>';      
                                                } 
                                                ?></td>
                                           
                                           <td>
                                                <form action="gatepass.php" id='formId' method="post">
                                                        <input type="hidden" class="form-control"value="<?=$row['leave_id']?>" name="leaveid" >

                                                            <button class="btn btn-primary btn-sm" name="leavesearch" type="submit" id="camera"><i class="bi bi-eye"></i> <small>GatePass</small></button>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        $i=$i+1;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Leave ID</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr> 
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        </div>
    </main>
    <!-- Main Content end -->


    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./assets/js/jquery-3.5.1.js"></script>
    <script src="./assets/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>