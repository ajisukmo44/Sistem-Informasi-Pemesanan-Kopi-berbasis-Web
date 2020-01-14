<?php
$sql 	= "SELECT * FROM tb_pengiriman";
$data 	= mysqli_query($conn, $sql);
$pgr = mysqli_num_rows($data);
?>