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
    <title>OneGuard | Faculty And Staffs</title>
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
            $sql="DELETE FROM staffs WHERE id='$reject_id'";
            $approve=mysqli_query($conn,$sql);
            if(!$approve){
                echo mysqli_error($conn);
            }else{
            $_SESSION['success']="Deleted !";
            }
        }
        if(isset($_POST['submitbtn'])){
            $id=$_POST['id'];
            $fullname=$_POST['fullname'];
            $phone= $_POST['phone'];
            $role= $_POST['role'];
            $designation= $_POST['designation'];
                if($_POST['password']){
                    $password= $_POST['password'];
                    $sql="UPDATE staffs SET fullname='$fullname', phone='$phone', password='$password',role='$role',designation='$designation' where id='$id'";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            $error = "Oops ! AN Error Occured.";
                            echo mysqli_error($conn);
                        }else{
                            $_SESSION['success']="Details Updated and password is: ".$password;
                        }
                }
                else{
                    $sql="UPDATE staffs SET fullname='$fullname', phone='$phone', role='$role',designation='$designation' where id='$id'";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            echo mysqli_error($conn);
                            $error = "Oops ! AN Error Occured.";
                        }else{
                            $_SESSION['success']="Details Updated";
                        }
                }
        }
        if(isset($_POST['submitbtnadd'])){
            $fullname=$_POST['fullname'];
            $email= $_POST['email'];
            $phone= $_POST['phone'];
            $role= $_POST['role'];
            $designation= $_POST['designation'];
            $password= $_POST['password'];
            $cpassword= $_POST['confirm'];
            //$exist=false;
            $existsql="SELECT * FROM staffs WHERE email='$email'";
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
                    $sql="INSERT INTO staffs (fullname,email,phone,password,role,designation) VALUES ( '$fullname', '$email', '$phone', '$password', '$role', '$designation')";
                    $result=mysqli_query($conn,$sql);
                        if(!$result){
                            // echo $sql;
                            echo mysqli_error($conn);
                        }else{
                            $_SESSION['success']="Data Added";
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
                                <button class="btn btn-primary ms-auto" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Faculty or Staffs </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Faculty or Staffs</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="staffs.php" method="POST">
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
                                                    <label for="username" class="form-label">Designation</label>
                                                    <select class="form-select" id="designation" name="designation"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Choose One...</option>
                                                        <option value="Faculty">Faculty</option>
                                                        <option value="Gate Staff">Gate Staff</option>
                                                        <option value="Admin Department">Admin Department</option>
                                                        <option value="Hostel InCharge">Hostel InCharge</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="username" class="form-label">Rights</label>
                                                    <select class="form-select" id="role" name="role"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Choose One...</option>
                                                        <option value="2">Edit Rights</option>
                                                        <option value="3">View Rights</option>
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
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Rights</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $mysql1="SELECT * FROM staffs where id!=1 ORDER BY id DESC";
                                        $result=mysqli_query($conn,$mysql1);
                                        if(!$result){
                                            echo mysqli_error($conn);
                                            
                                        }
                                        $i=1;
                                        while($row = mysqli_fetch_assoc($result)) {

                                            ?>
                                        <tr class="my-auto">
                                            <td><?=$i?></td>
                                            <td><?=$row['fullname'] ?></td>
                                            <td><?=$row['email'] ?></td>
                                            <td><?=$row['phone']?> </td>
                                            <td><?=$row['designation']?></td>
                                            <td>
                                                <?php if($row['role']==1){echo "ADMIN";}?>
                                                <?php if($row['role']==2){echo 'EDIT';}?>
                                                <?php if($row['role']==3){echo 'VIEW';}?>
                                            </td>
                                            <td >
                                            <!-- <a href="staffs.php?approve_id=<?=$row['id']?>" class="btn btn-primary btn-sm"><small><i class="bi bi-pencil"></i></small> </a> -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row['id']?>">
                                            <small><i class="bi bi-pencil"></i></small>
                                            </button>
                                            <!-- <a href="leaves.php?reject_id=<?=$row['id']?>" class="btn btn-danger btn-sm"><small><i class="bi bi-eye"></i></small> </a> -->
                                            <a href="staffs.php?delete_id=<?=$row['id']?>" class="btn btn-danger btn-sm"><small><i class="bi bi-trash"></i></small> </a></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="staffs.php" method="POST">
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                    <div class="row">
                                                    <div class="mb-2 col-md-6">
                                                        <label for="username" class="form-label">FULL NAME</label>
                                                        <input type="text" class="form-control" value="<?=$row['fullname']?>" required id="fullname" name="fullname">
                                                    </div>
                                                    <div class="mb-2 col-md-6">
                                                        <label for="username" class="form-label">EMAIL</label>
                                                        <input type="email" class="form-control" disabled readonly value="<?=$row['email']?>" required id="email" name="email">
                                                    </div>
                                                    <div class="mb-2 col-md-6">
                                                        <label for="username" class="form-label">PHONE NUMBER</label>
                                                        <input type="number" class="form-control" value="<?=$row['phone']?>" required id="phone" name="phone">
                                                    </div>
                                                    <div class="mb-2 col-md-6">
                                                        <label for="username" class="form-label">Designation</label>
                                                        <select class="form-select" id="designation" name="designation"
                                                            aria-label="Default select example">
                                                            <option disabled>Choose One...</option>
                                                            <option <?php if($row['designation']=='Faculty'){echo "selected";}?>  value="Faculty">Faculty</option>
                                                            <option <?php if($row['designation']=='Gate Staff'){echo "selected";}?>  value="Gate Staff">Gate Staff</option>
                                                            <option <?php if($row['designation']=='Admin Department'){echo "selected";}?>  value="Admin Department">Admin Department</option>
                                                            <option <?php if($row['designation']=='Hostel InCharge'){echo "selected";}?>  value="Hostel InCharge">Hostel InCharge</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-2 col-md-6">
                                                        <label for="username" class="form-label">Rights</label>
                                                        <select class="form-select" id="role" name="role"
                                                            aria-label="Default select example">
                                                            <option disabled>Choose One...</option>
                                                            <option  <?php if($row['role']==2){echo "selected";}?> value="2">Edit Rights</option>
                                                            <option  <?php if($row['role']==3){echo "selected";}?> value="3">View Rights</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-2 col-md-6">
                                                        <label for="password" class="form-label">PASSWORD</label>
                                                        <input type="password" class="form-control"  id="password" name="password">
                        
                                                        <div id="passHelp" class="form-text">Leave it empty if you do not wish to reset password</div>
                                                    </div>
                                                    <div class="mx-auto text-center">
                                                        <button type="submit" name="submitbtn" class="btn btn-success">Submit</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <?php
                                        $i=$i+1;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Rights</th>
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