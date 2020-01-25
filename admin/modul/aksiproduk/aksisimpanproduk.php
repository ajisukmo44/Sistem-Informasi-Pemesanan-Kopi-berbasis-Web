<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

$id   = mysqli_real_escape_string($conn, $_GET['id']);

if(isset($_POST['simpan']))
{ 

  $nama_produk  = mysqli_real_escape_string($conn,$_POST['nama_produk']);
  $kategori     = mysqli_real_escape_string($conn,$_POST['kategori_id']);
  $harga        = mysqli_real_escape_string($conn,$_POST['harga']);
  $released     = mysqli_real_escape_string($conn,$_POST['released']);
  $berat         = mysqli_real_escape_string($conn,$_POST['berat']);
  $stok         = mysqli_real_escape_string($conn,$_POST['stok']);
  $deskripsi    = mysqli_real_escape_string($conn,$_POST['deskripsi']);

  $cekdata = "SELECT nama_produk FROM tb_produk WHERE nama_produk = '$nama_produk' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: nama_produk telah terdaftar, silahkan pakai nama_produk lain!');history.go(-1)</script>";
  }
    else
    {   
        $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name    = $_FILES['img']['name']; // File adalah name dari tombol input pada form
        $file_ext     = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size    = $_FILES['img']['size'];
        $file_tmp     = $_FILES['img']['tmp_name'];
        $lokasi       = '../../images/produk/'.$nama_produk.'.'.$file_ext;
        $img          = $nama_produk.'.'.$file_ext;
  
        if(in_array($file_ext, $allowed_ext) === true)
        {
          move_uploaded_file($file_tmp, $lokasi);


      // Proses insert data dari form ke db
      $sql = "INSERT INTO tb_produk ( produk_id,
                                nama_produk,
                                kategori_id,
                                harga,
                                berat,
                                stok,
                                released,
                                deskripsi,
                                produk_foto
                               )
                        VALUES ('$id',
                                '$nama_produk',
                                '$kategori',
                                '$harga',
                                '$berat',
                                '$stok',
                                '$released',
                                '$deskripsi',
                                '$img')";

            if(mysqli_query($conn, $sql)) 
            {
              echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../dataproduk.php')</script>";
            } 
              else 
              {
                echo "Error updating record: " . mysqli_error($conn);
              }
          }
          
          else
          {
            echo "<script>alert('Jenis file tidak sesuai!');history.go(-1)</script>";
          }
      }
      }
        else
        {
          echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
        }
      ?>