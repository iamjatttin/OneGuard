<?php
 session_start();
  $alert=false;
  $error=false;
  //  include 'partials/dbconnect.php';
  $servername="localhost";
  $username="root";
  $password="";
  $database="oneguard";
  
  $conn=mysqli_connect($servername,$username,$password,$database);
  if(!$conn){
   echo ("ERROR".mysqli_connect_error());
  }
    if(isset($_POST['submitbtn'])){
        $fullname=$_POST['fullname'];
        $email= $_POST['email'];
        $phone= $_POST['phone'];
        $roll_no= $_POST['roll_no'];
        $branch= $_POST['branch'];
        $semester= $_POST['semester'];
        $password= $_POST['password'];
        $cpassword= $_POST['confirm'];
        //$exist=false;
        $existsql="SELECT * FROM students WHERE email='$username'";
        $result=mysqli_query($conn,$existsql);
        $numexistrows=mysqli_num_rows($result);
        if($numexistrows>0)
            {
            //$exist=true;
            $error="USERNAME ALREADY EXIST";
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
                      $error = "Oops ! AN Error Occured.";
                    }
            }
            else{
                $error="Passwords Do not match";
            }
        }
    }
?>
<!doctype html>
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
    <title>OneGuard | Register</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
            </button>
            <img src="assets/images/logo.png" class="img-fluid me-2" width="50px" height="50px" alt="oneguard">
            <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">OneGuard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar"
                aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="topNavBar">
                <ul class="navbar-nav d-flex ms-auto my-3 my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="signup.php">SIGNUP</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row">
            <div class="col-sm-8 mx-auto mt-5 bg-info">
                <div class="card ">
                    <div class="card-header pt-2">
                    <?php
                      if($error){
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>ERROR</strong> $error.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div><hr>";
                      }
                    ?>
                    <h1 class="text-center">OneGuard</h1>
                    </div>
                    <div class="card-body p-2 mt-2">
                      <u><h2 class="text-center">Student Register</h2></u>
                      <form action="signup.php" method="POST">
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
                            <button type="submit" name="submitbtn" class="btn btn-success">SIGN UP</button>
                            <a href="login.php" class="btn btn-warning">Login</a>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>

</html>
</body>

</html>