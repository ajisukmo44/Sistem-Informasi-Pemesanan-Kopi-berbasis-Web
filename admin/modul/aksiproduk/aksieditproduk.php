<?php session_start();
include '../../koneksi.php'; 
   // Panggil koneksi ke database

  $id     = $_POST['produk_id'];
  $np     = $_POST['nama_produk'];
  $ki     = $_POST['kategori_id'];
  $hg     = $_POST['harga'];
  $re     = $_POST['released'];
  $be     = $_POST['berat'];
  $st     = $_POST['stok'];
  $ds     = $_POST['deskripsi'];

  $gambar_produk = $_FILES['img']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_produk != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['img']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, '../../images/produk/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE tb_produk SET nama_produk = '$np', kategori_id = '$ki', harga = '$hg', berat = '$be', stok = '$st', released = '$re', deskripsi = '$ds', produk_foto = '$nama_gambar_baru' ";
                    $query .= "WHERE produk_id = '$id'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='../../dataproduk.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../../dataproduk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE tb_produk SET nama_produk = '$np', kategori_id = '$ki', harga = '$hg', berat = '$be', stok = '$st', released = '$re', deskripsi = '$ds' ";
      $query .= "WHERE produk_id = '$id'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../../dataproduk.php';</script>";
      }
    }


    
  