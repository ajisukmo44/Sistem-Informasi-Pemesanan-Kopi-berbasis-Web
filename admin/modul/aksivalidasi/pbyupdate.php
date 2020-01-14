<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

$id_bayar = mysqli_real_escape_string($conn, $_GET['id_bayar']);
$order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

if(isset($id_bayar))
{
  $sql = "UPDATE tb_bayar SET status = 2 WHERE id_bayar = '$id_bayar'; ";
  $sql .= "UPDATE tb_order SET status = 3 WHERE order_id = '$order_id' ";
  
  if(mysqli_multi_query($conn, $sql)) 

      {
        echo "<script>alert('Pembayaran Telah di validasi! Klik ok untuk melanjutkan');location.replace('../../datapembayaran.php')</script>";
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