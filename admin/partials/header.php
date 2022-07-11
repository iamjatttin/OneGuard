<!-- top navigation bar -->
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
                            <li><a class="dropdown-item" href="#">Action</a></li>
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
<!-- top navigation bar -->
<!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li>
                        <a href="index.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-speedometer"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="leaves.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-lock"></i></span>
                            <span>All Leaves</span>
                        </a>
                    </li>
                    <li>
                        <a href="students.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-file"></i></span>
                            <span>Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="staffs.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-file"></i></span>
                            <span>Faculty and Staffs</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="nav-link px-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span class="me-2"> <i class="bi bi-person"> </i></span>
                            Apply For Leave
                        </a>
                        <ul class=" collapse" id="collapseExample">
                            <li><a class="nav-link ms-4" href="shortleave.php">SHORT LEAVE</a></li>
                            <li><a class="nav-link ms-4" href="longleave.php">LONG LEAVE</a></li>
                        </ul>  
                    </li> -->
                    <li>
                        <a href="../logout.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-lock"></i></span>
                            <span>Logout</span>
                        </a>
                    </li>
                    </a>
                </ul>
            </nav>
        </div>
    </div>

<!-- offcanvas -->