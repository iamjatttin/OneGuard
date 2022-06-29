<?php

session_start();
// echo ($_SESSION['id']);
// echo($_SESSION['id']);
include 'partials/dbconnect.php';
    if(isset($_POST['submitbtn'])){
    $id=$_SESSION['student_id'];
    $ddate=$_POST['ddate'];
    $dtime= $_POST['dtime'];
    $atime= $_POST['atime'];
    $reason= $_POST['reason'];
    $mysql="SELECT roll_no FROM students where id='$id'";
    $result=mysqli_query($conn,$mysql);
    $row = mysqli_fetch_assoc($result);
    $roll=$row['roll_no'];
    $sql="INSERT INTO short_leave (stdroll,leavedate,dtime,atime,reason) VALUES ( '$roll', '$ddate','$dtime', '$atime', '$reason')";
    $result2=mysqli_query($conn,$sql);
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
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <h2 class="text-center">Short Leave Request</h2>
                <div class="col-md-8 mt-5 mx-auto">
                    <form action="shortleave.php" method="POST">
                        <div class="container-fluid">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">DEPARTURE DATE:</label>
                                <input type="date" class="form-control" id="exampleInputdate" name="ddate" id="ddate">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">DEPARTURE TIME:</label>
                                <input type="time" class="form-control" id="exampleInputdate" name="dtime" id="dtime">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">ARRIVAL TIME:</label>
                                <input type="time" class="form-control" id="exampleInputdate" name="atime" id="atime">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">LEAVE REASON</label>
                                <textarea class="form-control" name="reason" id="reason" placeholder="REASON FOR LEAVE"
                                    id="floatingTextarea2" style="height: 100px"></textarea>

                            </div>
                            <button type="submit" name="submitbtn" class="btn btn-primary">Submit Application</button>
                    </form>

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