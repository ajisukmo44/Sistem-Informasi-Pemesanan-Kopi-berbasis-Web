<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // Panggil data setting
include "fungsi/imgpreview.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin | Data Profil</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">


  <link href="images/logo1.ico" rel="shortcut icon"/>
<style>
.modal-admin {
    /* new custom width */
    line-height: 70%;
}
</style>
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
              <h6 class="m-0 font-weight-bold text-primary">Data Profil
              <div class="dropdown no-arrow">
             
             
              </div>
            </div>
            <!-- Card Body -->
         
             <!-- DataTales Example -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-stripped table-hover datatab" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background-color: #595959; color:#fff; line-height:8px">
                    <tr style="text-align:center;">
                      <th>ID</th>
                      <th>Foto</th>
                      <th>Isi Profil</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php 
          $query = mysqli_query($conn,"SELECT * FROM tb_profil ORDER BY id_profil");
      
          while ($data = mysqli_fetch_assoc($query)) 
          {
          ?>
            <tr style="text-align:center;">
              <td><?php echo $data['id_profil']; ?></td>
              <td style='text-align: center'><img src='../frontend/img/<?= $data['foto'] ?>' width='100px' height='70px'></td>
              <td style="text-align:justify"><?php echo $data['isi_profil']; ?></td>
              <td>
                <!-- Button untuk modal -->
                <h5><a href="#" type="button" class="badge badge-info" data-toggle="modal" data-target="#myModal<?php echo $data['id_profil']; ?>"><i class='fa fa-edit'></i> edit</a></h5>
                
              </td>
            </tr>



            <!-- Modal Edit -->

            
            <div class="modal fade bd-example-modal-lg" id="myModal<?php echo $data['id_profil']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
              <div class="modal-header">
              <center> <h5>Form Edit Profil</h5></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="modul/aksiprofil/aksieditprofil.php" method="post" enctype="multipart/form-data">
              <?php
                        $id = $data['id_profil']; 
                        $query_view = mysqli_query($conn, "SELECT * FROM tb_profil WHERE id_profil= '$id' ");
                        //$result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_view)) 
                        { $id = $row['id_profil']; $ip = $row['isi_profil']; 
                          $img = $row['foto'];
                        ?>

    <div class="form-group row">
      <input type="hidden" class="form-control" id="id_profil" name="id_profil" value="<?= $id ?>" readonly>
  </div>

  <div class="form-group row">
    <label for="isi_profil" class="col-sm-3 ml-3 col-form-label">Isi Profil</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="isi_profil" name="isi_profil" value="<?= $ip ?>" required>
    </div>
</div> 

  <div class="form-group row">
  <label for="gambar" class="col-sm-3 ml-3  col-form-label">Gambar Sebelumnya</label>
    <img style="margin-left:10px; margin-right:45px; margin-bottom:15px;" src="../frontend/img/<?= $data['foto'] ?> " width="20%" height="20%" /><br> 
     </div>
    <div class="form-group row">
    <label for="gambar" class="col-sm-3 ml-3 col-form-label">Gambar Baru</label>
    <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')"/> 
            <img id="preview" src="" alt="" style="margin-left:230px;" width="25%"/>
    </div>
  <div class="form-group row">
    <div class="col-sm-11">
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
            </div>
          <?php               
          } 
          ?>
        </tbody>
      </table>          
  </div>

  </div>
            </div>
<!-- Modal Edit HTML -->


<!-- End Modal Edit HTML -->

<!-- Modal Hapus HTML -->

<?php include 'alerthapus.php' ?>
<br><br><br>

  <!-- Footer -->
<br><br><br><br><br><br><br><br><br>

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
  