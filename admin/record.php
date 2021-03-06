<?php
 include 'record/record_pemesanan.php';  
 include 'record/record_pembayaran.php'; 
 include 'record/record_pelanggan.php';  
 include 'record/record_pengiriman.php';
?>
  
  
  
  <!-- Content Row -->
  <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body"> 
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pemesanan </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $psn ?></div>
        </div>
        <div class="col-auto"><a href="datapemesanan.php">
          <i class="fas fa-file fa-2x text-gray-300"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Pembayaran</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pb ?></div>
        </div>
        <div class="col-auto"><a href="datapembayaran.php">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Pengiriman</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $pgr ?></div>
            </div>
            <div class="col">
              <div class="progress progress-sm mr-2">
                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto"><a href="datapengiriman.php">
          <i class="fas fa-bus fa-2x text-gray-300"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-danger shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Data Pelanggan</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $plg ?></div>
        </div>
        <div class="col-auto"><a href="datapelanggan.php">
          <i class="fas fa-user fa-2x text-gray-300"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
