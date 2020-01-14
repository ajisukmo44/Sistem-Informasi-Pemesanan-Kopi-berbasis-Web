<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$idusr   = mysqli_real_escape_string($conn, $_GET['user_id']);

$sql = "DELETE FROM tb_user WHERE user_id = '$idusr' ";
if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('../../datauser.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>