<?php session_start();
include 'koneksi.php';               // Panggil koneksi ke database
include 'fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';    // Panggil data setting

$sql = "SELECT min(tanggal_kirim) AS min_tanggal FROM tb_pengiriman";
$result = mysqli_query($conn, $sql);
  while ($data = mysqli_fetch_array($result))         

        $tanggal = date('d-m-Y', strtotime($data['min_tanggal'])) ;

        $tanggal1 = date('d-m-Y') ;

?>

<!DOCTYPE html>
<html lang="en">

<head>   
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Admin | Laporan Pengiriman</title>

  <link href="images/logo1.ico" rel="shortcut icon"/>
  <!-- Custom fonts for this template-->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

      <!-- Custom styles for this template-->
      <link href="css/sb-admin-2.min.css" rel="stylesheet">
      
  <script src="../tgl/date/jquery.min.js"></script>
  <!-- Bootstrap Core CSS -->
  <link href="../tgl/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <script src="../tgl/newdate/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../tgl/newdate/datepicker.css">
  <script src="../tgl/newdate/datepicker.js"></script>

</head>
<body>

 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- // Sidebar -->
<?php include 'modul/sidebar2.php'; ?>




<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <?php include 'navbar2.php'; ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">LAPORAN PENGIRIMAN
        
             </div>
          
     <form action="modul/lap_pengiriman.php" method="post" enctype="multipart/form-data">
             <div class="form-group row mt-3 ml-3 ">
                  <div class="col-3 mb-4">
                  Tanggal Awal <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $tanggal ?>">
                  </div>
                

                  <div class="col-3 mr-1">
                  Tanggal Akhir <input type="text" class="form-control" name="tanggal1" id="tanggal1" value="<?php echo $tanggal1 ?>">
                  </div>

                  <div class="col-md-4">
            <button type="submit" name="submit" class="btn btn-info mt-4"><i class="fa fa-print" ></i> CETAK LAPORAN</button>
                  </div>
                  
                  </div>
          
              </div>
              
             <div>
             </form>
            
            <!-- Card Body -->


            </div>
  <!-- Footer -->
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Kopi Mukidi &copy;2019</span>
      </div>
    </div>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</footer>
<script>
    $(function()
  {
    $('#tanggal').datepicker({autoclose: true,todayHighlight: true,format: 'dd-mm-yyyy'});
    $('#tanggal1').datepicker({autoclose: true,todayHighlight: true,format: 'dd-mm-yyyy'});
  });
      </script> 

      </body>
</html>