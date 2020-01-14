<?php 

include 'koneksi.php';

session_start();

unset($_SESSION['pelanggan_id']);
unset($_SESSION['status']);

header("location:index.php");
?>