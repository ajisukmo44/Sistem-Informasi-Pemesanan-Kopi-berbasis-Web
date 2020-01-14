<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

$order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

if(isset($order_id))
{
  $sql = "UPDATE tb_order SET status = 3 WHERE order_id = '$order_id' ";

      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Pemesanan Telah di validasi! Klik ok untuk melanjutkan');location.replace('../../datapemesanan.php')</script>";
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