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

  $cekdata = "SELECT order_id FROM tb_pengiriman WHERE order_id = '$oi' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: No Order telah terdaftar, silahkan pilih Order ID lain!');history.go(-1)</script>";
  }
    else
    {
      // Proses insert data dari form ke db
      $sql = "INSERT INTO tb_pengiriman ( no_resi,
                                order_id,
                                nama_pengirim,
                                nohp_pengirim,
                                tanggal_kirim,
                                keterangan
                                )
                        VALUES ('$nr',
                                '$oi',
                                '$np',
                                '$hp',
                                '$tk',
                                '$ket');";

  $sql .= "UPDATE tb_order SET status = 4 WHERE order_id = '$oi' ";
  
  if(mysqli_multi_query($conn, $sql))       {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapengiriman.php')</script>";
      } 
        else 
        {
          echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>