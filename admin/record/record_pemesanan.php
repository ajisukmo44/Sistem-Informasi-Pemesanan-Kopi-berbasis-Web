<?php
$sql 	= "SELECT * FROM tb_order";
$data 	= mysqli_query($conn, $sql);
$psn = mysqli_num_rows($data);
?>