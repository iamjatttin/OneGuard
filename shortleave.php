<?php

session_start();
// echo ($_SESSION['id']);
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
    $rand=rand(10000,99999);
    $sl='SL-';
    $leave_id=$sl.$roll.$rand;
    $sql="INSERT INTO leaves (leave_type,leave_id,stdroll,leavedate,dtime,atime,reason) VALUES ( '1','$leave_id','$roll', '$ddate','$dtime', '$atime', '$reason')";
    $result2=mysqli_query($conn,$sql);
    $_SESSION['success']='Your Leave Request with ID: <strong>'.$leave_id.'</strong> has been placed.';
    header('location:leaves.php');
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
                <div class="col-md-8 bg-info mx-auto">
                    <div class="card">
                        <div class="card-header ">
                            <h2 class="text-center ">Short Leave Request</h2>
                        </div>
                        <div class="card-body">
                            <form action="shortleave.php" method="POST">
                                <div class="container-fluid">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Leave DATE:</label>
                                        <input type="date" class="form-control" id="exampleInputdate" name="ddate"
                                            id="ddate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">DEPARTURE TIME:</label>
                                        <Select class="form-control" name="dtime">
                                            <option selected disabled>Choose one..</option>
                                            <option value="08:00 AM">08:00 AM</option>
                                            <option value="09:00 AM">09:00 AM</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="01:00 PM">01:00 PM</option>
                                            <option value="02:00 PM">02:00 PM</option>
                                            <option value="03:00 PM">03:00 PM</option>
                                            <option value="04:00 PM">04:00 PM</option>
                                            <option value="05:00 PM">05:00 PM</option>
                                            <option value="06:00 PM">06:00 PM</option>
                                            <!-- <option value="19">8:00 AM</option> -->
                                        </Select>
                                        <!-- <input type="time" class="form-control" id="exampleInputdate" name="dtime" id="dtime"> -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">ARRIVAL TIME:</label>
                                        <Select class="form-control" name="atime">
                                            <option selected disabled>Choose one..</option>
                                            <option value="08:00 AM">08:00 AM</option>
                                            <option value="09:00 AM">09:00 AM</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="01:00 PM">01:00 PM</option>
                                            <option value="02:00 PM">02:00 PM</option>
                                            <option value="03:00 PM">03:00 PM</option>
                                            <option value="04:00 PM">04:00 PM</option>
                                            <option value="05:00 PM">05:00 PM</option>
                                            <option value="06:00 PM">06:00 PM</option>
                                            <!-- <option value="19">8:00 AM</option> -->
                                        </Select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">LEAVE REASON</label>
                                        <textarea class="form-control" name="reason" id="reason"
                                            placeholder="REASON FOR LEAVE" id="floatingTextarea2"
                                            style="height: 100px"></textarea>

                                    </div>
                                    <button type="submit" name="submitbtn" class="btn btn-primary">Submit
                                        Application</button>
                            </form>
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