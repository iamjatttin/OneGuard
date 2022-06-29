<?php
 session_start();
 $servername="localhost";
$username="root";
$password="";
$database="oneguard";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
 echo ("ERROR".mysqli_connect_error());
}
$login=false;
$error=false;
  //  include 'partials/dbconnect.php';
    if(isset($_POST['submitbtn'])){
    
    $username= $_POST['username'];
    $password= $_POST['password'];
    $sql=" Select * from students where email='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);
    if ($num==1){
    $login=true;
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    $_SESSION['student_id']=$row['id'];
    // echo($_SESSION['id']);
    header('location:index.php');
    }
  
    else{
      $error="INVALID USERNAME OR PASSWORD";
    }
  }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>LOGIN</title>
    <style>
        body {
            background-image: url(desk2.jpg);
        }

        .container {
            opacity: 0.8;
        }
    </style>

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
            <div class="col-sm-5 mx-auto mt-5 bg-info">
                <div class="card ">
                    <div class="card-header pt-2">
                    <?php
                      if($login){
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>SUCCESS</strong>You are logged in.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div> <hr>";
                      }
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
                      <u><h2 class="text-center">Student Login</h2></u>
                        <form action="login.php" method="POST">
                            <div class="mb-3" col-md-6>
                                <label for="username" class="form-label">EMAIL</label>
                                <input type="email" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3 text-center">
                              <button type="submit" name="submitbtn" class="btn btn-primary">LOGIN</button>
                              <a href="signup.php" class="btn btn-warning">Register</a>
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