<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // Panggil data setting
include "fungsi/imgpreview.php";
?>
<?php
$query     = "select max(produk_id)as kode from tb_produk"; 
$cari_kd   = mysqli_query($conn,$query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'],4,7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah=$kode+1; //kode yang sudah di pecah di tambah 1
  if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id_p="PRD-00".$tambah;
    }else{
    $id_p="PRD-0".$tambah;
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

  <title>Admin | Data Produk</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
              <h6 class="m-0 font-weight-bold text-primary">Data Produk 
          <a href='tambahuser.php' class='badge badge-success' data-toggle="modal" data-target="#exampleModal" ><i class='fa fa-plus'></i> Tambah Data Produk</a> </h6>
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
                      <th>ID Produk</th>
                      <th>Foto</th>
                      <th>Nama Produk</th>
                      <th>Kategori</th>
                      <th>Released</th>
                      <th>Harga</th>
                      <th>Berat</th>
                      <th>Stok</th>
                      <th>Deskripsi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php 
          $query = mysqli_query($conn,"SELECT * FROM tb_produk a JOIN tb_kategori b ON a.kategori_id = b.kategori_id ORDER BY a.produk_id");
      
          while ($data = mysqli_fetch_assoc($query)) 
          {
          ?>
            <tr style="text-align:center;">
              <td><?php echo $data['produk_id']; ?></td>
              <td style='text-align: center'><img src='images/produk/<?= $data['produk_foto'] ?>' width='50px' height='30px'></td>
              <td><?php echo $data['nama_produk']; ?></td>
              <td><?php echo $data['kategori_nama']; ?></td>
              <td><?php echo $data['released']; ?></td>
              <td><?php echo $data['harga']; ?></td>
              <td><?php echo $data['berat']; ?></td>
              <td><?php echo $data['stok']; ?></td>
              <td><a href='' class='badge badge-secondary'>Deskripsi</a></td>
              <td>
                <!-- Button untuk modal -->
                <h5><a href="#" type="button" class="badge badge-info" data-toggle="modal" data-target="#myModal<?php echo $data['produk_id']; ?>"><i class='fa fa-edit'></i> edit</a>
                <a href='#' data-href='modul/aksiproduk/aksihapusproduk.php?produk_id=<?= $data['produk_id'] ?>' class='badge badge-danger' data-toggle='modal' data-target='#confirm-delete'><i class='fa fa-times'></i> hapus  </a></h5>
                
              </td>
            </tr>



            <!-- Modal Edit -->

            
            <div class="modal fade bd-example-modal-lg" id="myModal<?php echo $data['produk_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
              <div class="modal-header">
              <center> <h5>Form Edit Produk</h5></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="modul/aksiproduk/aksieditproduk.php" method="post" enctype="multipart/form-data">
              <?php
                        $id = $data['produk_id']; 
                        $query_view = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_id='$id'");
                        //$result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_view)) 
                        { $np = $row['nama_produk']; $hr = $row['harga']; 
                          $rs = $row['released']; $st = $row['stok']; 
                          $kt = $row['kategori_id']; $ds = $row['deskripsi'];$br = $row['berat'];
                          $img = $row['produk_foto'];
                        ?>



    <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Id Produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="produk_id" name="produk_id" value="<?= $id ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-9">
      <input type="hidden" class="form-control" id="kategori_id" name="kategori_id" value="<?= $kt ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $np ?>" required>
    </div>
</div> 


<div class="form-group row">
    <label for="harga" class="col-sm-3 col-form-label">Harga</label>
    <div class="col-sm-9">
      <input type="number"  class="form-control" id="harga" name="harga" value="<?php echo $hr ?>" required>
    </div>
        </div>
        <div class="form-group row">
    <label for="berat" class="col-sm-3 col-form-label">Berat/Gram</label>
    <div class="col-sm-9">
      <input type="number"  class="form-control" id="berat" name="berat" value="<?php echo $br ?>" required>
    </div>
        </div>
    <div class="form-group row">
    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
    <div class="col-sm-9">
      <input type="number"  class="form-control" id="stok" name="stok" value="<?php echo $st ?>" required>
    </div>
  </div>  <div class="form-group row">
    <label for="released" class="col-sm-3 col-form-label">released</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" id="released" name="released" value="<?php echo $rs ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $ds ?>"  required>
    </div>
  </div>

  <div class="form-group row">
  <label for="gambar" class="col-sm-3 col-form-label">Gambar Sebelumnya</label>
    <img style="margin-left:10px; margin-right:45px; margin-bottom:15px;" src="images/produk/<?php echo $img ?> " width="20%" height="20%" /><br> 
     </div>
    <div class="form-group row">
    <label for="gambar" class="col-sm-3 col-form-label">Gambar Baru</label>
    <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')"/> 
            <img id="preview" src="" alt="" style="margin-left:150px;" width="25%"/>
    </div>
    <div class="form-group row">
      <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $kt ?>" readonly>
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

<div class="modal fade bd-example-modal-lg" id="examplemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
    <div class="modal-header">
       <center> <h5>Form Tambah Data Produk</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modul/aksiproduk/aksisimpanproduk.php?id=<?=$id_p;?>" method="post"  enctype="multipart/form-data">
 
  <div class="form-group row">
    <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="nama produk" required>
    </div>
</div> 
<div class="form-group row">
    <label for="kategori_id" class="col-sm-3 col-form-label">Kategori</label>
    <div class="col-sm-9">
    <select name="kategori_id" id="kategori_id" class="form-control" required>
              <option value="">--Pilih Kategori--</option>
                <?php
                $query = "SELECT * FROM tb_kategori ORDER BY kategori_id";
                $sql = mysqli_query($conn, $query);
                while($data = mysqli_fetch_array($sql)){echo '<option value="'.$data['kategori_id'].'">'.$data['kategori_nama'].'</option>';}
                ?>
              </select>
    </div>
  </div>  

  
  <div class="form-group row">
    <label for="harga" class="col-sm-3 col-form-label">Harga</label>
    <div class="col-sm-9">
      <input type="number" value="<?php echo $id1 ?>" class="form-control" id="harga" name="harga" placeholder="harga" required>
    </div>
        </div>
        <div class="form-group row">
    <label for="berat" class="col-sm-3 col-form-label">Berat/Gram</label>
    <div class="col-sm-9">
      <input type="number" value="<?php echo $id1 ?>" class="form-control" id="berat" name="berat" placeholder="berat" required>
    </div>
        </div>
    <div class="form-group row">
    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
    <div class="col-sm-9">
      <input type="number" value="<?php echo $id1 ?>" class="form-control" id="stok" name="stok" placeholder="stok" required>
    </div>
  </div>  <div class="form-group row">
    <label for="released" class="col-sm-3 col-form-label">released</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" id="released" name="released" placeholder="released" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi"  required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="fasilitas" class="col-sm-3 col-form-label">Foto Paket</label>
    <div class="col-sm-9">
    <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" required/>
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="25%"/>
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
  </div>
</div>

<!-- End Modal Tambah HTML -->



<!-- DATA KATEGORI -->


<!-- End Modal Edit HTML -->

<!-- Modal Hapus HTML -->

<?php include 'alerthapus.php' ?>
<br><br><br>

  <!-- Footer -->
<br><br><br><br><br><br><br><br><br><br>
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
            var rowid = $(e.relatedTarget).data('id_produk');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'dataproduk.php',
                data :  'rowid='+rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
   <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal1').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id_kategori');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'dataproduk.php',
                data :  'rowid='+rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
