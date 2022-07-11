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
    <title>OneGuard | Students</title>
</head>

<body>
    <!-- header include -->
    <?php 
        include './partials/header.php';
      
        if(isset($_GET['delete_id'])){
            $reject_id=$_GET['delete_id'];
            // echo "approve11".$approve_id;
            $rejecter=$_SESSION['admin_id'];
            // $approver=0;
            $sql="DELETE FROM students WHERE id='$reject_id'";
            $approve=mysqli_query($conn,$sql);
            if(!$approve){
                echo mysqli_error($conn);
            }else{
            $_SESSION['success']="Student Deleted";
            }
        }
        if(isset($_POST['submitbtn'])){
            $id=$_POST['id'];
            $fullname=$_POST['fullname'];
            $phone= $_POST['phone'];
            $branch= $_POST['branch'];
            $semester= $_POST['semester'];
                if($_POST['password']){
                    $password= $_POST['password'];
                    $sql="UPDATE students SET fullname='$fullname', phone='$phone', password='$password',branch='$branch',semester='$semester' where id='$id'";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            $error = "Oops ! AN Error Occured.";
                            echo mysqli_error($conn);
                        }else{
                            $_SESSION['success']="Student Details Updated and password is: ".$password;
                        }
                }
                else{
                    $sql="UPDATE students SET fullname='$fullname', phone='$phone', branch='$branch',semester='$semester' where id='$id'";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            echo mysqli_error($conn);
                            $error = "Oops ! AN Error Occured.";
                        }else{
                            $_SESSION['success']="Student Details Updated";
                        }
                }
        }
        if(isset($_POST['submitbtnadd'])){
            $fullname=$_POST['fullname'];
            $email= $_POST['email'];
            $phone= $_POST['phone'];
            $roll_no= $_POST['roll_no'];
            $branch= $_POST['branch'];
            $semester= $_POST['semester'];
            $password= $_POST['password'];
            $cpassword= $_POST['confirm'];
            //$exist=false;
            $existsql="SELECT * FROM students WHERE email='$email'";
            $result=mysqli_query($conn,$existsql);
            $numexistrows=mysqli_num_rows($result);
            if($numexistrows>0)
                {
                //$exist=true;
                $error="Email ALREADY EXIST";
                }
            else
            {
            //$exist=false;
                if($password==$cpassword){
                    $sql="INSERT INTO students (fullname,email,phone,password,roll_no,branch,semester) VALUES ( '$fullname', '$email', '$phone', '$password', '$roll_no', '$branch', '$semester')";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            echo mysqli_error($conn);
                        }else{
                            $_SESSION['success']="Student Added";
                        }
                }
                else{
                    $error="Passwords Do not match";
                }
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
            
            if($error){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>ERROR</strong> $error.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div><hr>";
            }
                    
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2  ms-auto">
                    <div class="card">
                        <div class="card-header ">
                            <div class="btn-group  w-fit ms-auto w-auto w-fit">
                                <button class="btn btn-primary ms-auto" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">ADD Student </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="students.php" method="POST">
                                                <div class="row">
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">FULL NAME</label>
                                                    <input type="text" class="form-control" required id="fullname" name="fullname">
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">EMAIL</label>
                                                    <input type="email" class="form-control" required id="email" name="email">
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">PHONE NUMBER</label>
                                                    <input type="number" class="form-control" required id="phone" name="phone">
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">ROLL NUMBER</label>
                                                    <input type="number" class="form-control" required id="roll_no" name="roll_no">
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">BRANCH</label>
                                                    <select class="form-select" id="branch" name="branch"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Choose One...</option>
                                                        <option value="CSE">CSE</option>
                                                        <option value="EEE">EEE</option>
                                                        <option value="ECE">ECE</option>
                                                        <option value="ME">ME</option>
                                                        <option value="BCA">BCA</option>
                                                        <option value="BBA">BBA</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">SEMESTER</label>
                                                    <select class="form-select" id="semester" name="semester"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Choose One...</option>
                                                        <option value="1" selected>1ST SEM</option>
                                                        <option value="2">2ND SEM</option>
                                                        <option value="3">3RD SEM</option>
                                                        <option value="4">4TH SEM</option>
                                                        <option value="5">5TH SEM</option>
                                                        <option value="6">6TH SEM</option>
                                                        <option value="7">7TH SEM</option>
                                                        <option value="8">8TH SEM</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="password" class="form-label">PASSWORD</label>
                                                    <input type="password" class="form-control" required id="password" name="password">
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="confirm" class="form-label">CONFIRM PASSWORD</label>
                                                    <input type="password" class="form-control" required id="confirm" name="confirm"
                                                        aria-describedby="passhelp">
                                                    <div id="passHelp" class="form-text">MAKE SURE TO ENTER THE SAME PASSWORD</div>
                                                </div>
                                                <div class="mx-auto text-center">
                                                    <button type="submit" name="submitbtnadd" class="btn btn-success">Submit</button>
                                                </div>
                                                </div>
                                            </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Roll</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Branch | SEM</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $mysql1="SELECT * FROM students  ORDER BY id DESC";
                                        $result=mysqli_query($conn,$mysql1);
                                        if(!$result){
                                            echo mysqli_error($conn);
                                        }
                                        while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                        <tr class="my-auto">
                                            <td><?=$row['roll_no']?></td>
                                            <td><?=$row['fullname'] ?></td>
                                            <td><?=$row['email'] ?></td>
                                            <td><?=$row['phone']?> </td>
                                            <td><?=$row['branch']?> || <?=$row['semester']?></td>
                                            
                                            <td >
                                            <!-- <a href="students.php?approve_id=<?=$row['id']?>" class="btn btn-primary btn-sm"><small><i class="bi bi-pencil"></i></small> </a> -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row['id']?>">
                                            <small><i class="bi bi-pencil"></i></small>
                                            </button>
                                            <!-- <a href="leaves.php?reject_id=<?=$row['id']?>" class="btn btn-danger btn-sm"><small><i class="bi bi-eye"></i></small> </a> -->
                                            <a href="students.php?delete_id=<?=$row['id']?>" class="btn btn-danger btn-sm"><small><i class="bi bi-trash"></i></small> </a></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Student Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="students.php" method="post">
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="<?=$row['id']?>">
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">FULL NAME</label>
                                                            <input type="text" class="form-control" value="<?=$row['fullname']?>" required id="fullname" name="fullname">
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">EMAIL</label>
                                                            <input type="email" class="form-control" disabled readonly value="<?=$row['email']?>"  required id="email" name="email">
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">PHONE NUMBER</label>
                                                            <input type="number" class="form-control" value="<?=$row['phone']?>" required id="phone" name="phone">
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">ROLL NUMBER</label>
                                                            <input type="number" disabled readonly class="form-control"value="<?=$row['roll_no']?>"  required id="roll_no" name="roll_no">
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">BRANCH</label>
                                                            <select class="form-select" id="branch" name="branch"
                                                                aria-label="Default select example">
                                                                <!-- <option selected disabled>Choose One...</option> -->
                                                                <option <?php if($row['branch']=="CSE"){echo "selected";}?> value="CSE">CSE</option>
                                                                <option <?php if($row['branch']=="EEE"){echo "selected";}?> value="EEE">EEE</option>
                                                                <option <?php if($row['branch']=="ECE"){echo "selected";}?> value="ECE">ECE</option>
                                                                <option <?php if($row['branch']=="ME"){echo "selected";}?> value="ME">ME</option>
                                                                <option <?php if($row['branch']=="BCA"){echo "selected";}?> value="BCA">BCA</option>
                                                                <option <?php if($row['branch']=="BBA"){echo "selected";}?> value="BBA">BBA</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="username" class="form-label">SEMESTER</label>
                                                            <select class="form-select" id="semester" name="semester"
                                                                aria-label="Default select example">
                                                                <!-- <option selected disabled>Choose One...</option> -->
                                                                <option  <?php if($row['semester']==1){echo "selected";}?>  value="1" >1ST SEM</option>
                                                                <option <?php if($row['semester']==2){echo "selected";}?> value="2">2ND SEM</option>
                                                                <option <?php if($row['semester']==3){echo "selected";}?> value="3">3RD SEM</option>
                                                                <option  <?php if($row['semester']==4){echo "selected";}?> value="4">4TH SEM</option>
                                                                <option  <?php if($row['semester']==5){echo "selected";}?> value="5">5TH SEM</option>
                                                                <option  <?php if($row['semester']==6){echo "selected";}?> value="6">6TH SEM</option>
                                                                <option  <?php if($row['semester']==7){echo "selected";}?> value="7">7TH SEM</option>
                                                                <option  <?php if($row['semester']==8){echo "selected";}?> value="8">8TH SEM</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 col-md-6">
                                                            <label for="password" class="form-label">PASSWORD</label>
                                                            <input type="password" class="form-control"  id="password" name="password">
                                                        
                                                            <div id="passHelp" class="form-text">Leave it empty if you do not wish to reset password</div>
                                                        </div>
                                                        <div class="mx-auto text-center">
                                                            <button type="submit" name="submitbtn" class="btn btn-success">Update</button>
                                                        </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

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