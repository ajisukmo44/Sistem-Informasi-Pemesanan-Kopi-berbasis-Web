<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$idkat   = mysqli_real_escape_string($conn, $_GET['kategori_id']);

$sql = "DELETE FROM tb_kategori WHERE kategori_id = '$idkat' ";
   
if (mysqli_query($conn, $sql)) 
    {
      echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('../../datakategori.php')</script>"; 
    }
      else 
      {
          echo "Error updating record: " . mysqli_error($conn);
      }
    ?>