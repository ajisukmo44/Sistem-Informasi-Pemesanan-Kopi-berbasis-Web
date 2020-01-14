<?php session_start();
include 'koneksi.php';                    // Panggil koneksi ke database

$id  = mysqli_real_escape_string($koneksi, $_GET['id']);

if(isset($id))
{
  $sql = "UPDATE tb_order SET status = 5 WHERE order_id = '$id' ";

      if(mysqli_query($koneksi, $sql)) 
      {
        echo "<script>alert('Pemesanan Telah di Update! Klik ok untuk melanjutkan');location.replace('pelanggan_pesanan.php')</script>";
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