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

  <title>Admin | Data Pengiriman</title>

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
      <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman <a href='#' class='badge badge-success' data-toggle="modal" data-target="#exampleModal" ><i class='fa fa-plus'></i> Tambah Data Pengiriman</a> </h6>
         
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
                      <th>No Resi</th>
                      <th>Order ID</th>
                       <th>Nama Pengirim</th>
                       <th>No Hp </th>
                       <th>Tanggal Kirim </th>
                       <th>keterangan</th>
                       <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>

                     <?php 
                     $query = mysqli_query($conn,"SELECT * FROM tb_pengiriman ORDER BY order_id DESC");
                     if(mysqli_num_rows($query) == 0)
                     {echo "
                       
                       belum ada data 
                 
                       ";}
                     while ($data = mysqli_fetch_assoc($query)) 
                     {
                      $tk   = date('d-m-Y', strtotime($data['tanggal_kirim'])); $no   = $data['no_resi']; 
                      $np   = $data['nama_pengirim'];  $hp   = $data['nohp_pengirim'];
                      $oi   = $data['order_id'];   $ket   = $data['keterangan'];
                     ?>

                       <tr style="text-align:center;">

                        <td><?= $no ?></td>
                        <td><?= $oi ?></td>
                        <td><?= $np ?></td>
                        <td><?= $hp ?></td> 
                        <td><?= $tk ?></td>
                        <td><?= $ket ?></td> 
                        
                        <td>
                <!-- Button untuk modal -->
                <h5><a href="#" type="button" class="badge badge-info" data-toggle="modal" data-target="#myModal<?php echo $data['no_resi']; ?>"><i class='fa fa-edit'></i> edit</a>
                <a href='#' data-href='modul/aksikirim/aksihapuspengiriman.php?no_resi=<?= $data['no_resi'] ?>' class='badge badge-danger' data-toggle='modal' data-target='#confirm-delete'><i class='fa fa-times'></i> hapus  </a></h5>
                
              </td>
   </tr>
                         

            
            <!-- Modal Edit M-->
    <!-- Modal Edit M-->
    <div class="modal fade" id="myModal<?php echo $data['no_resi']; ?>" role="dialog">
            <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <center> <h5>Form Edit Pengiriman</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<<<<<<< HEAD
      <form action="modul/aksikirim/aksieditkirim.php" method="post">
=======
      <form action="modul/aksiuser/aksieditkirim.php" method="post">
>>>>>>> 738e1f491b42bc96835d06d519f816d5dced2dc9
      <?php
                        $id = $data['no_resi']; 
                        $query_view = mysqli_query($conn, "SELECT * FROM tb_pengiriman WHERE no_resi='$id'");
                        //$result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_view)) { $oi = $row['order_id']; 
                          $tk = $row['tanggal_kirim']; $np = $row['nama_pengirim']; 
                          $hp = $row['nohp_pengirim']; $ket = $row['keterangan']; 
                        ?>


      <div class="form-group row">
    <label for="username" class="col-sm-4 col-form-label">No Resi</label>
    <div class="col-sm-8">
      
      <input type="text" class="form-control" id="no_resi" name="no_resi" value="<?= $id ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="order_id" class="col-sm-4 col-form-label">Order ID</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="order_id" name="order_id" value="<?= $oi ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="nama_pengirim" class="col-sm-4 col-form-label">Nama Pengirim</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="<?= $np ?>" required>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" id="no_hp"  name="no_hp" value="<?= $hp ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggal_kirim" class="col-sm-4 col-form-label">Tanggal Kirim</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim" value="<?= $tk ?>"  required>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
      <input type="keterangan" class="form-control" id="keterangan"  name="keterangan" value="<?= $ket ?>" required>
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <div class="col-sm-12">
    <button type="submit" name="simpan" class="btn btn-success float-right"></span><i class="fa fa-check"></i> Update</button>
    <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
</div>
  </div>
  <?php 
                        }
                        //mysql_close($host);
                        ?>        
                      </form>
                  </div>
                </div>
                
              </div>
            </div>
          <?php               
          } 
          ?>
        </tbody>
      </table>          
  </div>


<!-- Modal Edit HTML -->



<!-- Modal Tambah HTML -->

<div class="modal fade" id="exampleModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <center> <h5>Form Tambah Data Pengiriman</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modul/aksikirim/aksisimpanpengiriman.php" method="post">


    <div class="form-group row">
    <label for="order_id" class="col-sm-4 col-form-label">ORDER ID</label>
    <div class="col-sm-8">
    <select name="order_id" id="order_id" class="form-control" required>
              <option value="">--ID ORDER--</option>
                <?php
                $query = "SELECT * FROM tb_order WHERE status= 3 ORDER BY order_id";
                $sql = mysqli_query($conn, $query);
                while($data = mysqli_fetch_array($sql)){echo '<option value="'.$data['order_id'].'">'.$data['order_id'].'</option>';}
                ?>
              </select>
    </div>
  </div>
      <div class="form-group row">
    <label for="no_resi" class="col-sm-4 col-form-label">No Resi</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="no_resi" name="no_resi" placeholder="nama resi pengiriman" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="nama_pengirim" class="col-sm-4 col-form-label">Nama Pengirim</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="nama pengirim" required>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" id="no_hp"  name="no_hp" placeholder="no hp" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggal_kirim" class="col-sm-4 col-form-label">Tanggal Kirim</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim"  required>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
      <input type="keterangan" class="form-control" id="keterangan"  name="keterangan" placeholder="keterangan" required>
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <div class="col-sm-12">
    <button type="submit" name="simpan" class="btn btn-success float-right"></span><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
</div>
  </div>
</form>
      </div>
     
    </div>
  </div>
</div>

<!-- End Modal Tambah HTML -->


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
