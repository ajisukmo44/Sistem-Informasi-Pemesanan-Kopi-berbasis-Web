<?php 
include 'koneksi.php';

$idb  = $_POST['id_bayar'];
$id  = $_POST['order_id'];
$np = $_POST['nama'];
$bnk = $_POST['bank'];
$jt = $_POST['jumlah_transfer'];
$tt = $_POST['tanggal_transfer'];



$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['bukti_transfer']['name'];

	mysqli_query($koneksi, "INSERT INTO tb_bayar values ('$idb','$id','$np','$bnk','$jt','$tt','','1')");
	



	if($filename1 != ""){
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	
		if(in_array($ext,$allowed) ) {
			move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], 'gambar/bukti_pembayaran/'.$rand.'_'.$filename1);
			$file_gambar = $rand.'_'.$filename1;
	
			mysqli_query($koneksi,"UPDATE tb_bayar SET bukti_transfer='$file_gambar' WHERE id_bayar='$idb'");
		}

if(in_array($ext,$allowed) ) {
	
	mysqli_query($koneksi,"UPDATE tb_order SET status='2' WHERE order_id='$id'");
			
		}

	

	}

	
	header("location:pelanggan_pesanan.php?alert=terkirim");



?>
