<?php session_start();
include 'koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['submit']))
{
  $id         = mysqli_real_escape_string($koneksi,$_POST['id_pelanggan']);
  $nama       = mysqli_real_escape_string($koneksi,$_POST['nama']);
  $alamat     = mysqli_real_escape_string($koneksi,$_POST['alamat']);
  $email      = mysqli_real_escape_string($koneksi,$_POST['email']);
  $no_hp      = mysqli_real_escape_string($koneksi,$_POST['hp']);
  
  // Proses update data dari form ke db

  $sql = "UPDATE tb_pelanggan SET   pelanggan_id    = '$id',
                                    nama             = '$nama',
                                    alamat           = '$alamat',
                                    email            =  '$email',
                                    no_hp            = '$no_hp'
                                WHERE pelanggan_id     = '$id' ";

  if(mysqli_query($koneksi, $sql)) 
  {
    echo "<script>location.replace('pelanggan.php')</script>";
  } 
    else 
    {
      echo "Error updating record: " . mysqli_error($koneksi);
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>