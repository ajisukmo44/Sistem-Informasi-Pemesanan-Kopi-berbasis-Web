<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$nr   = mysqli_real_escape_string($conn, $_GET['no_resi']);

$sql = "DELETE FROM tb_pengiriman WHERE no_resi = '$nr' ";
if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapengiriman.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>