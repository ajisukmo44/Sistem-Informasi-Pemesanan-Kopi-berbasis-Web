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

  <title>Admin | Data Pemesanan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
      <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan 
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
                      <th>Detail</th>
                       <th>Tgl Checkout</th>
                       <th>Palanggan</th>
                       <th>Total Bayar</th>
                       <th>Status</th>
                       <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>

                     <?php 
                     $query = mysqli_query($conn,"SELECT * FROM tb_order a JOIN tb_pelanggan b ON a.pelanggan_id = b.pelanggan_id ORDER BY a.order_id DESC");
                     if(mysqli_num_rows($query) == 0)
                     {echo "
                       
                       belum ada data 
                 
                       ";}
                     while ($data = mysqli_fetch_assoc($query)) 
                     {
                      $tb         = number_format($data['total_bayar'], 0, ',', '.');
                      $tanggal1   = date('d-m-Y', strtotime($data['tgl_checkout']));	
                      $status     = $data['status'];
                     ?>
                       <tr style="text-align:center;">
    <td><?= $data['order_id'] ?></td>
    <td>	<a href="detail_invoice.php?id=<?php echo $data['order_id']; ?>"  class='badge badge-secondary'><i class="fa fa-file"></i> detail</a></td>
    
    <td><?= $tanggal1 ?></td>
    <td><?= $data['nama'] ?></td>
    <td><?= $tb ?></td> 
    <td> 
    <?php 
						if($status == 0){
							echo "<a href='#' ><span class='badge badge-danger'>Pesanan Gagal</span></a>";
						}elseif($status == 1){
							echo "<a href='#' ><span class='badge badge-danger'>Belum DiBayar</span></a>";
						}elseif($status == 2){
							echo "<a href='#' ><span class='badge badge-warning'>Menunggu Validasi Pembayaran</span></a>";
						}elseif($status == 3){
							echo "<a href='#' ><span class='badge badge-success'>Pemesanan Tervalidasi</span></a>";
						}elseif($status == 4){
							echo "<a href='#' ><span class='badge badge-info'>Pesanan Telah DiKirim</span></a>";
						}elseif($status == 5){
							echo "<a href='#' ><span class='badge badge-success'>Selesai</span></a>";
						};
						?>
           </td>

           <td><a href="#" type="button" class="badge badge-primary" data-toggle="modal" data-target="#myModal<?php echo $data['order_id']; ?>"><i class='fa fa-edit'></i> update</a></td> 
  </tr>
                         
                       <!-- Modal Edit -->
                       <div class="modal fade" id="myModal<?php echo $data['order_id']; ?>" role="dialog">
                       <div class="modal-dialog" role="document">
                   <div class="modal-content">
                   <div class="modal-header">
                   <h5 class="ml-5">UPDATE STATUS DATA PEMESANAN</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                   <div class="modal-body">
                   <form action="modul/aksivalidasi/statusupdate.php" method="POST">
     
                   <h5 style="text-align:center;"><a href="modul/aksivalidasi/statusupdate.php?order_id=<?= $data['order_id'] ?>"  class="badge badge-success btn-sm mr-3"><i class='fa fa-check'></i> Pesanan Tervalidasi</a>
                   <a href="modul/aksivalidasi/statusupdate3.php?order_id=<?= $data['order_id'] ?>"  class="badge badge-info btn-sm"><i class='fa fa-truck'></i> Pesanan telah dikirim</a></h5>
                   <hr>
                      <?php 
                        }
                        //mysql_close($host);
                        ?>        
                      </form>
                  </div>
                </div>
                
              </div>
            </div>
      
        </tbody>
      </table>          
  </div>



 
                   </div>
                       </div>

<br> <br> <br> <br> <br> <br> <br>

<br> <br> <br> <br> <br> <br> <br>
    <!-- Modal HTML -->
<!-- Area Chart -->




     <!-- Modal HTML End -->

<!-- Modal HTML -->

<?php include 'alerthapus.php' ?>

  <!-- End of Main Content -->

  <!-- Footer -->

<?php include 'footer.php' ?>

<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id_user');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'datapemesanan.php',
                data :  'rowid='+rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>