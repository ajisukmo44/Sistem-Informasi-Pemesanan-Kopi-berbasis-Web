<?php 
include 'koneksi.php';

session_start();
$query     = "select max(order_id)as kode from tb_order"; 
$cari_kd   = mysqli_query($koneksi,$query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'],4,7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah=$kode+1; //kode yang sudah di pecah di tambah 1
  if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id_odr="ODR-00".$tambah;
    }else{
    $id_odr="ODR-0".$tambah;
    }

$id_plg = $_SESSION['pelanggan_id'];

$tanggal = date('Y-m-d');

$nama = $_POST['nama'];
$hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

$provinsi = $_POST['provinsi2'];
$kabupaten = $_POST['kabupaten2'];

$alamat1 = $alamat.','.$kabupaten.','.$provinsi;

$kurir = $_POST['kurir'] ." - ". $_POST['service'];
$berat = $_POST['berat'];

$ongkir = $_POST['ongkir2'];

$total_bayar = $_POST['total_bayar']+$ongkir;

mysqli_query($koneksi,"insert into tb_order values('$id_odr','$tanggal','$id_plg','$nama','$alamat1','$hp','$kurir','$berat','$ongkir','$total_bayar','1')")or die(mysqli_error($koneksi));

$last_id = mysqli_insert_id($koneksi);


// transaksi



$jumlah_isi_keranjang = count($_SESSION['keranjang']);

for($a = 0; $a < $jumlah_isi_keranjang; $a++){
	$id_produk = $_SESSION['keranjang'][$a]['produk'];
	$jml = $_SESSION['keranjang'][$a]['jumlah'];

	$isi = mysqli_query($koneksi,"select * from tb_produk where produk_id='$id_produk'");
	$i = mysqli_fetch_assoc($isi);

	$produk = $i['produk_id'];
	$stok = $i['stok'];

	$jumlah = $_SESSION['keranjang'][$a]['jumlah'];
	$harga = $i['harga'];
	
	$stokbaru = $stok - $jumlah ;
	
	mysqli_query($koneksi,"insert into tb_order_detail values('$id_odr','$produk','$harga','$jumlah');");
	


	mysqli_query($koneksi,"UPDATE tb_produk SET stok='$stokbaru' WHERE produk_id='$produk'");
	

	unset($_SESSION['keranjang'][$a]);
}


header("location:mail/send.php?id=$id_odr");