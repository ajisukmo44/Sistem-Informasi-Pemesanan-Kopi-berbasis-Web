<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['simpan']))
{
  
  $produk_id    = mysqli_real_escape_string($conn,$_POST['produk_id']);
  $nama_produk  = mysqli_real_escape_string($conn,$_POST['nama_produk']);
  $kategori     = mysqli_real_escape_string($conn,$_POST['kategori_id']);
  $harga        = mysqli_real_escape_string($conn,$_POST['harga']);
  $released     = mysqli_real_escape_string($conn,$_POST['released']);
  $berat         = mysqli_real_escape_string($conn,$_POST['berat']);
  $stok         = mysqli_real_escape_string($conn,$_POST['stok']);
  $deskripsi    = mysqli_real_escape_string($conn,$_POST['deskripsi']);

      $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name    = $_FILES['img']['name']; // File adalah name dari tombol input pada form
      $file_ext     = pathinfo($file_name, PATHINFO_EXTENSION);
      $file_size    = $_FILES['img']['size'];
      $file_tmp     = $_FILES['img']['tmp_name'];
      $lokasi       = '../../images/produk/'.$nama_produk.'.'.$file_ext;
      $img          = $nama_produk.'.'.$file_ext;

      if(!empty($file_tmp))
  {
    if(in_array($file_ext, $allowed_ext) === true)
    {
      //Hapus photo yang lama jika ada
      $del  = "SELECT produk_foto FROM tb_produk WHERE produk_id = '$produk_id' LIMIT 1";
      $res  = mysqli_query($conn, $del);
      $d    = mysqli_fetch_object($res);
      if(strlen($d->img)>3)
      if(file_exists($d->img))
      {
        // Memutuskan koneksi file yang lama
        unlink($d->img);
      }
      move_uploaded_file($file_tmp, $lokasi);
      // Update photo dengan yang baru
      $update = "UPDATE tb_produk SET produk_foto = '$img' WHERE produk_id = '$produk_id' ";
      $upd = mysqli_query($conn, $update);
    } 
      else
      {
        echo "<script>alert('Format file tidak sesuai!');history.go(-1)</script>";
      } 
  }
  
  // Proses update data dari form ke db
        $sql = "UPDATE tb_produk SET produk_id     = '$produk_id',
                                        nama_produk   = '$nama_produk',
                                        kategori_id   = '$kategori',
                                        harga         = '$harga',
                                        released      = '$released',
                                        berat          = '$berat',
                                        stok          = '$stok',
                                        deskripsi     = '$deskripsi'                   
                                   WHERE produk_id     = '$produk_id' ";

          if(mysqli_query($conn, $sql)) 
          {
            echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../dataproduk.php')</script>";
          } 
            else 
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
        }
          else
          {
            echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
          } 
        ?>