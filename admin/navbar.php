<?php
include 'fungsi/time.php';     
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form> -->

<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">

<h4><span style="font-family:arial;"> &nbsp;<img src="../frontend/img/logo1.png" alt="" style="width:200px"></span></h4>

</form>




<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <!-- <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a> -->
    <!-- Dropdown - Messages -->
    <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li> -->

  <!-- Nav Item - Alerts -->
  

  <!-- Nav Item - Messages -->
  <li class="nav-item dropdown no-arrow mx-1">
    
    <h6><span class="badge badge-secondary badge-counter mt-4"  style=" color:#fff"><?php 
 echo $hr . ", " . $tgl . " " . $bln . " " . $thn ; ?></span></h6>
    <!-- Dropdown - Messages -->
    
  </li>

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $sesen_nama ?></span>
     <img src="images/admin2.png" alt="" style="width:25px">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="editpassword.php">
        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
        Ganti Password
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Log Out
      </a>
    </div>
  </li>

</ul>

</nav>