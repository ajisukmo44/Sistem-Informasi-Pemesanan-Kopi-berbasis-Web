<?php 
include 'koneksi.php';

$id  = $_POST['id_pelanggan'];
$nama  = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

$cek_email = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan where email='$email'");
if(mysqli_num_rows($cek_email) > 0){
	header("location:daftar.php?alert=duplikat");
}else{
	mysqli_query($koneksi, "INSERT INTO tb_pelanggan values ('$id','$nama','$email','$hp','$alamat','$password')");
	header("location:masuk.php?alert=terdaftar");
}
