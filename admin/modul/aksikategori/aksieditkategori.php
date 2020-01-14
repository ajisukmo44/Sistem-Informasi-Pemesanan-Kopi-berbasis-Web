<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['simpan']))
{
  $id         = mysqli_real_escape_string($conn,$_POST['kategori_id']);
  $nama       = mysqli_real_escape_string($conn,$_POST['kategori_nama']);
  
  // Proses update data dari form ke db

  $sql = "UPDATE tb_kategori SET kategori_id    = '$id',
                                    kategori_nama  = '$nama'
                              WHERE kategori_id    = '$id' ";

      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../datakategori.php')</script>";
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