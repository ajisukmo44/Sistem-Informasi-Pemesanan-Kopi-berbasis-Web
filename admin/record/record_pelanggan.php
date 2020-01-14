<?php
$sql 	= "SELECT * FROM tb_pelanggan";
$data 	= mysqli_query($conn, $sql);
$plg = mysqli_num_rows($data);
?>