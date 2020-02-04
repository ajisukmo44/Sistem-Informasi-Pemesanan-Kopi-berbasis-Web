<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

	// membuat variabel untuk menampung data dari form
  $id             = $_GET['id'];
  $nama_produk    = $_POST['nama_produk'];
  $kategori_id    = $_POST['kategori_id'];
  $harga          = $_POST['harga'];
  $released       = $_POST['released'];
  $berat          = $_POST['berat'];
  $stok           = $_POST['stok'];
  $deskripsi      = $_POST['deskripsi'];
  $img            = $_FILES['img']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($img != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $img); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['img']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$img; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, '../../images/produk/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO tb_produk (produk_id, nama_produk, kategori_id, harga, released, berat, stok, deskripsi,produk_foto) VALUES ('$id', '$nama_produk', '$kategori_id','$harga','$released','$berat','$stok','$deskripsi','$nama_gambar_baru')";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='../../dataproduk.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../../dataproduk.php';</script>";
            }
} else {
   $query = "INSERT INTO tb_produk (produk_id, nama_produk, kategori_id, harga, released, berat, stok, deskripsi) VALUES ('$id', '$nama_produk', '$kategori_id','$harga','$released','$berat','$stok','$deskripsi')";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='../../dataproduk.php';</script>";
                  }
};

 














