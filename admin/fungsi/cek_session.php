<?php
if(isset($_SESSION['username']))
{
	$sesen_id_user	= $_SESSION['user_id'];
	$sesen_nama	= $_SESSION['nama_user']; 
	$sesen_username = $_SESSION['username'];
	$sesen_jabatan = $_SESSION['hakakses']; 
}
?>