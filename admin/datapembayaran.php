<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // Panggil data setting
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin | Data Pembayaran</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  
  <link href="images/logo1.ico" rel="shortcut icon"/>

</head>
 <!-- Page Wrapper -->



 <div id="wrapper">


<!-- // Sidebar -->
<?php include 'modul/sidebar.php'; ?>




<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
<?php include 'navbar.php'; ?>
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
      <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran 
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        </a>
     
      </div>
    </div>
    <!-- Card Body -->
 
     <!-- DataTales Example -->
     <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover " id="dataTable" width="100%" cellspacing="0">
        <thead style="background-color: #36B9CC; color:#fff; line-height:8px; text-align: center">
                      <th>Order ID</th>
                      <th>Nama Pengirim</th>
                       <th>Bank</th>
                       <th>Jumlah Transfer</th>
                       <th>Tanggal Transfer </th>
                       <th>Status</th>
                       <th>Bukti Transfer</th>
                       <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>

                     <?php 
                     $query = mysqli_query($conn,"SELECT * FROM tb_bayar ORDER BY status ASC");
                     if(mysqli_num_rows($query) == 0)
                     {echo "
                       
                       belum ada data 
                 
                       ";}
                     while ($data = mysqli_fetch_assoc($query)) 
                     {
                      $tt         = number_format($data['jumlah_transfer'], 0, ',', '.');
                      $tanggal1   = date('d-m-Y', strtotime($data['tanggal_transfer']));	
                      
                      $status   = $data['status'];
                     ?>
                       <tr style="text-align:center;">
    <td><?= $data['order_id'] ?></td>
    <td><?= $data['nama_pengirim'] ?></td>
    <td><?= $data['bank'] ?></td>
    <td><?= $tt ?></td>
    <td><?= $tanggal1 ?></td> 
    <td> 
    <?php 
						if($status == 1){
							echo "<a href='#' ><span class='badge badge-danger'>Belum Di Validasi</span></a>";
						}elseif($status == 2){
							echo "<a href='#' ><span class='badge badge-success'>Pembayaran Tervalidasi</span></a>";
						};
						?>
           </td>
           <?php echo "<td><a href='#myModal' class='badge badge-primary' id='custId' data-toggle='modal' data-id=".$data['id_bayar']."> <i class='fa fa-images'></i> Bukti Transfer  </a></td>"; ?>
<td>
    <?php
          $ido = $data['order_id']; 
          $idb = $data['id_bayar'];
          $a1 = "<h5><a href='modul/aksivalidasi/pbyupdate.php?id_bayar=$idb&order_id=$ido'  class='badge badge-success btn-sm'><i class='fa fa-check'></i></a></h5>";
          $a2 = "<h5><a href='#'  class='badge badge-secondary btn-sm'><i class='fa fa-check'></i></a></h5>";
          
          if ($status==1 ){
          echo $a1;
          } else   
          {
              echo $a2;
          };
           
           ?>
    
    
    
    
    </td>
   </tr>
   <?php

  }                     ?>  
        </tbody>
      </table>  

      </div>
            </div>
                

  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <p><b>BUKTI TRANSFER</b></p> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
    <!-- Modal HTML -->

<!-- Modal HTML -->

<?php include 'alerthapus.php' ?>

  <!-- End of Main Content -->

  <!-- Footer -->
<br><br><br><br><br>
<?php include 'footer.php' ?>

<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'buktitransfer.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>