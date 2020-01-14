 <?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // Panggil data setting
?>
<?php
$query     = "select max(user_id)as kode from tb_user"; 
$cari_kd   = mysqli_query($conn,$query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'],4,7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah=$kode+1; //kode yang sudah di pecah di tambah 1
  if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id_usr="USR-00".$tambah;
    }else{
    $id_usr="USR-0".$tambah;
	}
	?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin | Data User</title>

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
              <h6 class="m-0 font-weight-bold text-primary">Data User 
          <a href='tambahuser.php' class='badge badge-success' data-toggle="modal" data-target="#exampleModal" ><i class='fa fa-plus'></i> Tambah Data User</a> </h6>
              <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
             
              </div>
            </div>
            <!-- Card Body -->
         
             <!-- DataTales Example -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-stripped table-hover datatab" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background-color: #595959; color:#fff; line-height:8px">
                    <tr style="text-align:center;">
                      <th>ID User</th>
                      <th>Nama User</th>
                      <th>Username</th>
                      <th>Akses</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php 
          $query = mysqli_query($conn,"SELECT * FROM tb_user");
      
          while ($data = mysqli_fetch_assoc($query)) 
          {
          ?>
            <tr style="text-align:center;">
              <td><?php echo $data['user_id']; ?></td>
              <td><?php echo $data['nama_user']; ?></td>
              <td><?php echo $data['username']; ?></td>
              <td><?php echo $data['hakakses']; ?></td>
              <td>
                <!-- Button untuk modal -->
                <h5><a href="#" type="button" class="badge badge-info" data-toggle="modal" data-target="#myModal<?php echo $data['user_id']; ?>"><i class='fa fa-edit'></i> edit</a>
                <a href='#' data-href='modul/aksiuser/aksiuserhapus.php?user_id=<?= $data['user_id'] ?>' class='badge badge-danger' data-toggle='modal' data-target='#confirm-delete'><i class='fa fa-times'></i> hapus  </a></h5>
                
              </td>
            </tr>

            
            <!-- Modal Edit M-->
            <div class="modal fade" id="myModal<?php echo $data['user_id']; ?>" role="dialog">
            <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <center> <h5>Form Edit User</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modul/aksiuser/aksiedituser.php" method="post">
      <?php
                        $id = $data['user_id']; 
                        $query_view = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id='$id'");
                        //$result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_view)) { $nu = $row['nama_user']; $us = $row['username']; $jb = $row['hakakses']; 
                        ?>


      <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Id User</label>
    <div class="col-sm-9">
      
      <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $id ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="nama_user" class="col-sm-3 col-form-label">Nama User</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $nu ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="username" name="username" value="<?= $us ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-9">
    <select class="form-control" name="hakakses">
  <option value="<?= $jb ?>"><?= $jb ?></option>
  <option value="admin">admin</option>
  <option value="pemilik">pemilik</option>
</select>  
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
       <center> <h5>Form Tambah Data User</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modul/aksiuser/aksisimpanuser.php?id=<?=$id_usr?>" method="post">
      <div class="form-group row">
    <div class="col-sm-9">
    </div>
  </div>
      <div class="form-group row">
    <label for="nama_user" class="col-sm-3 col-form-label">Nama User</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="nama user" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="password"  name="password" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-9">
    <select class="form-control" name="jabatan">
  <option value="admin">Admin</option>
  <option value="pemilik">Pemilik</option>
</select>  
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

<!-- End Modal Edit HTML -->

<!-- Modal Hapus HTML -->

<?php include 'alerthapus.php' ?>
<br><br><br><br><br><br><br><br><br><br><br><br>

  <!-- Footer -->

<?php include 'footer.php' ?>

<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* 
  var modal = $(this)
  modal.find('.modal-title').text('')
  modal.find('.modal-body input').val(recipient)
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
                url : 'datauser.php',
                data :  'rowid='+rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
