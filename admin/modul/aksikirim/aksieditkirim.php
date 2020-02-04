<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['simpan']))
{
  
  $nr   = mysqli_real_escape_string($conn,$_POST['no_resi']);
  $oi    = mysqli_real_escape_string($conn,$_POST['order_id']);
  $np   = mysqli_real_escape_string($conn,$_POST['nama_pengirim']);
  $hp   = mysqli_real_escape_string($conn,$_POST['no_hp']);
  $tk    = mysqli_real_escape_string($conn,$_POST['tanggal_kirim']);
  $ket    = mysqli_real_escape_string($conn,$_POST['keterangan']);
  
  // Proses update data dari form ke db

  $sql = "UPDATE tb_pengiriman SET no_resi    = '$nr',
                                    order_id  = '$oi',
                                    nama_pengirim    = '$np',
                                    nohp_pengirim  = '$hp',
                                    tanggal_kirim   = '$tk',
                                    keterangan  = '$ket'
                              WHERE no_resi    = '$nr' ";

      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapengiriman.php')</script>";
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