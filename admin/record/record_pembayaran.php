<?php
$sql 	= "SELECT * FROM tb_bayar";
$data 	= mysqli_query($conn, $sql);
$pb = mysqli_num_rows($data);
?>