<?php
include 'partials/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <title>OneGuard | Dashboard</title>
</head>

<body>
    <!-- header include -->
    <?php 
      include './partials/header.php';
      
      if(isset($_GET['approve_id'])){
        $approve_id=$_GET['approve_id'];
        // echo "approve11".$approve_id;
        $approver=$_SESSION['admin_id'];
        // $approver=0;
        $sql="UPDATE leaves SET status = 1 , approvedby = '$approver' where id='$approve_id'";
        $approve=mysqli_query($conn,$sql);
        if(!$approve){
            echo mysqli_error($conn);
        }else{
        $_SESSION['success']="Leave Approved";
        }
    }
    if(isset($_GET['reject_id'])){
        $reject_id=$_GET['reject_id'];
        // echo "approve11".$approve_id;
        $rejecter=$_SESSION['admin_id'];
        // $approver=0;
        $sql="UPDATE leaves SET status = 2 , approvedby = '$rejecter' where id='$reject_id'";
        $approve=mysqli_query($conn,$sql);
        if(!$approve){
            echo mysqli_error($conn);
        }else{
        $_SESSION['success']="Leave Rejected";
        }
    }
    ?>
    <!-- header include -->
    <!-- Main COntent -->
    <main class="mt-5 pt-3">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-1 text-center ms-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Profile"><i
                                                class="la la-home me-2"></i> Pending</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Availability"><i
                                                class="la la-user me-2"></i>Approved</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Bookings"><i
                                                class="la la-phone me-2"></i> Rejected</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Reviews"><i
                                                class="la la-envelope me-2"></i>All</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Profile" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    $mysql1="SELECT * FROM leaves where status=0";
                                                    $result=mysqli_query($conn,$mysql1);
                                                    if(!$result){
                                                        echo mysqli_error($conn);
                                                    }
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $roll=$row['stdroll'];
                                                        $mysql="SELECT * FROM students where roll_no='$roll'";
                                                        $result2=mysqli_query($conn,$mysql);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        ?>
                                                    <tr class="my-auto">
                                                        <td><?=$row['leave_id']?></td>
                                                        <td><?=$row['stdroll'] ?></td>
                                                        <td><?=$row2['fullname'] ?></td>
                                                        <td><?=$row['leavedate']?> || <?=$row['dtime']?></td>
                                                        <td><?php if($row['arrival_date']==""){echo $row['leavedate'];}else{echo $row['arrival_date'];}?> || <?=$row['atime']?></td>
                                                       
                                                    
                                                        <td ><a href="leaves.php?approve_id=<?=$row['id']?>" class="btn btn-primary btn-sm"><small>Approve</small> </a>
                                                        <a href="leaves.php?reject_id=<?=$row['id']?>" class="btn btn-danger btn-sm"><small>Reject</small> </a></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Action</th>
                                                    </tr> 
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Availability">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    $mysql1="SELECT * FROM leaves where status=1";
                                                    $result=mysqli_query($conn,$mysql1);
                                                    if(!$result){
                                                        echo mysqli_error($conn);
                                                    }
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $roll=$row['stdroll'];
                                                        $mysql="SELECT * FROM students where roll_no='$roll' ORDER BY id DESC";
                                                        $result2=mysqli_query($conn,$mysql);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        ?>
                                                    <tr class="my-auto">
                                                        <td><?=$row['leave_id']?></td>
                                                        <td><?=$row['stdroll'] ?></td>
                                                        <td><?=$row2['fullname'] ?></td>
                                                        <td><?=$row['leavedate']?> || <?=$row['dtime']?></td>
                                                        <td><?php if($row['arrival_date']==""){echo $row['leavedate'];}else{echo $row['arrival_date'];}?> || <?=$row['atime']?></td>
                                                       
                                                    
                                                        <!-- <td class="btn-group"><a href="leaves.php?approve_id=<?=$row['id']?>" class="btn btn-primary btn-sm"><small>Approve</small> </a>
                                                        <a href="leaves.php?reject_id=" class="btn btn-danger btn-sm"><small>Reject</small> </a></td> -->
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr> 
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Bookings">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    $mysql1="SELECT * FROM leaves where status=2";
                                                    $result=mysqli_query($conn,$mysql1);
                                                    if(!$result){
                                                        echo mysqli_error($conn);
                                                    }
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $roll=$row['stdroll'];
                                                        $mysql="SELECT * FROM students where roll_no='$roll'";
                                                        $result2=mysqli_query($conn,$mysql);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        ?>
                                                    <tr class="my-auto">
                                                        <td><?=$row['leave_id']?></td>
                                                        <td><?=$row['stdroll'] ?></td>
                                                        <td><?=$row2['fullname'] ?></td>
                                                        <td><?=$row['leavedate']?> || <?=$row['dtime']?></td>
                                                        <td><?php if($row['arrival_date']==""){echo $row['leavedate'];}else{echo $row['arrival_date'];}?> || <?=$row['atime']?></td>
                                                       
                                                    
                                                        <!-- <td class="btn-group"><a href="leaves.php?approve_id=<?=$row['id']?>" class="btn btn-primary btn-sm"><small>Approve</small> </a>
                                                        <a href="leaves.php?reject_id=" class="btn btn-danger btn-sm"><small>Reject</small> </a></td> -->
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr> 
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Status</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $mysql1="SELECT * FROM leaves";
                                                    $result=mysqli_query($conn,$mysql1);
                                                    if(!$result){
                                                        echo mysqli_error($conn);
                                                    }
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $roll=$row['stdroll'];
                                                        $mysql="SELECT * FROM students where roll_no='$roll'";
                                                        $result2=mysqli_query($conn,$mysql);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                    ?>
                                                    <tr class="my-auto">
                                                        <td><?=$row['leave_id']?></td>
                                                        <td><?=$row['stdroll'] ?></td>
                                                        <td><?=$row2['fullname'] ?></td>
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
                                                    
                                                        <!-- <td><a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> <small>GatePass</small> </a></td> -->
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Leave ID</th>
                                                        <th>Roll</th>
                                                        <th>Name</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Status</th>
                                                        <!-- <th>Action</th> -->
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
            </div>
        </div>
    </main>
    <!-- Main Content end -->


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>