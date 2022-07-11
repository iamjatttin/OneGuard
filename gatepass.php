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
$error=0;
if(isset($_POST['leaveid'])){
    $leaveid=$_POST['leaveid'];
    $sql="SELECT * from leaves where leave_id='$leaveid'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo mysqli_error($conn);
        $error='Not Found !';
    }
    $count=mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    if($count==0){
        $error='Request Not Found !';
    }
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
    <title>OneGuard | GatePass</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 <?php
                                    if($row['status']==0){
                                        echo' bg-warning';
                                    }
                                    if($row['status']==2){
                                        echo'bg-danger';
                                    }
                                    if($row['status']==1){   
                                        echo' bg-success';      
                                    } 
                                    ?>
                                 mt-5 mx-auto ">
                <div class="card">
                    <div class="row">
                        <div class="col-11 <?php
                                    if($row['status']==0){
                                        echo' bg-warning';
                                    }
                                    if($row['status']==2){
                                        echo'bg-danger';
                                    }
                                    if($row['status']==1){   
                                        echo' bg-success';      
                                    } 
                                    ?> mx-auto">
                            <div class="card">
                            <?php
                                $roll=$row['stdroll'];
                                $staff=$row['approvedby'];
                                $sql2="SELECT * FROM students where roll_no='$roll'";     
                                $result2=mysqli_query($conn,$sql2);
                                if(!$result2){
                                    echo mysqli_error($conn);
                                    $error='Not Found !';
                                }
                                
                                $stdrow=mysqli_fetch_assoc($result2);

                                $sql3="SELECT * FROM staffs where id='$staff'";     
                                $result3=mysqli_query($conn,$sql3);
                                if(!$result3){
                                    echo mysqli_error($conn);
                                    $error='Not Found !';
                                }
                                $staffrow=mysqli_fetch_assoc($result3);

                                if($error){
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>ERROR</strong> $error.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div><hr>";
                                    }
                            ?>
                                <div class="card-body">
                                    
                                    <div class="row mx-auto mb-2 text-center">
                                        <div class="col-md-6 mx-auto text-center" style="background-color:#e2e2e2;">
                                        
                                            <div id="qrcode"></div>
                                        
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                            Leave ID
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                                <?=$row['leave_id']?>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                            Name
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                                <?=$stdrow['fullname']?>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                            Roll No.
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                                <?=$stdrow['roll_no']?>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                            Branch-Semester
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                                <?=$stdrow['branch']?>-
                                                <?=$stdrow['semester']?>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                            Leave Date | time
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6 ">
                                                <?=$row['leavedate']?> | <?=$row['dtime']?>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                        Arrival Date | time
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                            <?php if($row['arrival_date']==""){echo $row['leavedate'];}else{echo $row['arrival_date'];}?> | <?=$row['atime']?>
                                        
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-5">
                                        Status
                                        </div>
                                        <div class="col-1">
                                                :
                                        </div>
                                        <div class="col-6">
                                                        <?php 
                                                            if($row['status']==0){
                                                                echo' <span class="badge bg-warning mt-1">Pending</span>';
                                                            }
                                                            if($row['status']==2){
                                                                echo' <span class="badge bg-danger mt-1">Rejected</span>';
                                                            }
                                                            if($row['status']==1){   
                                                                echo' <span class="badge bg-success mt-1">Approved</span>';      
                                                            } 
                                                            ?>
                                        </div>
                                    </div>
                                    <?php 
                                        if($row['status']==0){
                                            
                                        }
                                        if($row['status']==2){
                                            ?>
                                                <div class="row mb-1">
                                                    <div class="col-5">
                                                        Rejected By
                                                    </div>
                                                    <div class="col-1">
                                                            :
                                                    </div>
                                                    <div class="col-6">
                                                            <?=$staffrow['fullname']?>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                        if($row['status']==1){   
                                            ?>
                                                <div class="row mb-1">
                                                    <div class="col-5">
                                                        Approved By
                                                    </div>
                                                    <div class="col-1">
                                                            :
                                                    </div>
                                                    <div class="col-6">
                                                            <?=$staffrow['fullname']?>
                                                    </div>
                                                </div>
                                            <?php   
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./assets/js/jquery-3.5.1.js"></script>
    <script src="./assets/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery.qrcode@1.0.3/jquery.qrcode.min.js"></script>
    <script>
        $(function(){
          
            $("#qrcode").html("");
            var txt = '<?=$row['leave_id']?>';
            var width = 100;
            var height = 100;
            generateQRcode(width, height, txt );
            return false;
            
            
            function generateQRcode(width, height, text) {
                $('#qrcode').qrcode({width: width,height: height,text: text});
            }
            
            });
    </script>
                                    
</body>

</html>