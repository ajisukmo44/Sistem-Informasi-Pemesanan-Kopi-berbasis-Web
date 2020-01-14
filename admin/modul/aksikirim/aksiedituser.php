<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['simpan']))
{
  $user_id    = mysqli_real_escape_string($conn,$_POST['user_id']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $nama_user   = mysqli_real_escape_string($conn,$_POST['nama_user']);
  $hakakses   = mysqli_real_escape_string($conn,$_POST['hakakses']);
  
  // Proses update data dari form ke db

  $sql = "UPDATE tb_user SET user_id     = '$user_id',
                          nama_user    = '$nama_user',
                          username    = '$username',
                          hakakses    =  '$hakakses'
                    WHERE user_id     = '$user_id' ";

  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../datauser.php')</script>";
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