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
    ?>
    <!-- header include -->
    <!-- Main COntent -->
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-0 bg-info text-center ms-auto">
                    <h2>Welcome !</h2>
                    <p>This Project is under Construction</p>
                </div>
                <div class="col-md-8 mt-5 text-center mx-auto">
                    <form action="../gatepass.php" id='formId' method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="leaveid" placeholder="Enter Leave ID" id="leave">
                                <button class="btn btn-success" name="leavesearch"type="submit" id="searchbtn">Search</button>
                                <button class="btn btn-info" name="leavesearch" type="button" id="camera">scan</button>
                        </div>
                        <video id="preview"></video>
                    </form>
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
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    

<script type="text/javascript">

$("#camera").click(function(){

  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

  scanner.addListener('scan', function (content) {
    $("#leave").val(content);
    // alert(content);
    $("#formId").submit();

  });

  Instascan.Camera.getCameras().then(function (cameras) {

    if (cameras.length > 0) {

      scanner.start(cameras[1]);

    } else {

      console.error('No cameras found.');

    }

  }).catch(function (e) {

    console.error(e);

  });
}); 
</script>
</body>

</html>