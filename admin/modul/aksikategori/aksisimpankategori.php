<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if(isset($_POST['simpan']))
{ 

  $nama   = mysqli_real_escape_string($conn,$_POST['kategori_nama']);

  $cekdata = "SELECT kategori_nama FROM tb_kategori WHERE kategori_nama = '$nama' ";
  $ada     = mysqli_query($conn, $cekdata);
      
      if(mysqli_num_rows($ada) > 0)
      { 
        echo "<script>alert('ERROR: Nama kategori telah terdaftar, silahkan pakai nama kategori lain!');history.go(-1)</script>";
      }
        else
        {
          // Proses insert data dari form ke db
          $sql = "INSERT INTO tb_kategori (
                                    kategori_nama)
                            VALUES ('$nama')";

          if(mysqli_query($conn, $sql)) 
          {
            echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../datakategori.php')</script>";
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