<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 
	session_start();
	include 'koneksi.php';
	?>

	<style>
		body{
			font-family: sans-serif;
		}

		.table{
			border-collapse: collapse;
		}
		.table th,
		.table td{
			padding: 5px 10px;
			border: 1px solid black;
		}
	</style>

	<div>

		<?php 
		$id = $_GET['id'];
		$idp = $_SESSION['pelanggan_id'];
		$invoice = mysqli_query($koneksi,"SELECT * FROM tb_order WHERE pelanggan_id='$idp' AND order_id='$id' order by order_id desc");
		while($i = mysqli_fetch_array($invoice)){
			?>


			<div>

				<center>
				
				<h4> <p><img src="frontend/img/logo1.png" alt="" style="width:150px"></p> INVOICE PEMESANAN | ORDER ID : <?php echo $i['order_id'] ?></h4>
				</center>


<hr>
				<br/>
								<br/>
								Nama   &nbsp; : <?php echo $i['nama_penerima']; ?><br/>
								Alamat : <?php echo $i['alamat_penerima']; ?><br/>
								No Hp &nbsp;&nbsp;: <?php echo $i['no_hp']; ?><br/>
								<br/>
				<br/>

				<table class="table">
					<thead>
						<tr>
							<th class="text-center" width="1%">NO</th>
							<th colspan="2">Produk</th>
							<th class="text-center">Harga</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						$total = 0;
						$transaksi = mysqli_query($koneksi," select * from tb_order_detail, tb_produk where tb_order_detail.produk_id = tb_produk.produk_id and tb_order_detail.order_id='$id' ");
						while($d=mysqli_fetch_array($transaksi)){
							$total += $d['harga'];
							?>
							<tr>
								<td class="text-center"><?php echo $no++; ?></td>
								
								<td colspan="2"><?php echo $d['nama_produk']; ?></td>
								<td class="text-center"><?php echo "Rp. ".number_format($d['harga']).",-"; ?></td>
								<td class="text-center" style="text-align:center"><?php echo number_format($d['jumlah']); ?></td>
								<td class="text-center"><?php echo "Rp. ".number_format($d['jumlah'] * $d['harga'])." ,-"; ?></td>
							</tr>
							<?php 
						}
						?>
					</tbody>
					<tfoot>
						
						<tr>
							<td colspan="4" style="border: none"></td>
							<th>Ongkir (<?php echo $i['kurir'] ?>)</th>
							<td class="text-center"><?php echo "Rp. ".number_format($i['ongkir'])." ,-"; ?></td>
						</tr>
						<tr>
							<td colspan="4" style="border: none"></td>
							<th>Total Bayar</th>
							<td class="text-center"><?php echo "Rp. ".number_format($i['total_bayar'])." ,-"; ?></td>
						</tr>
					</tfoot>
				</table>


				<h5>STATUS :</h5> 
						<?php 
						if($i['status'] == 0){
							echo "<a href='#' ><span class='label label-danger'>Pesanan Gagal</span></a>";
						}elseif($i['status'] == 1){
							echo "<a href='#' ><span class='label label-danger'>Belum Di Bayar</span></a>";
						}elseif($i['status'] == 2){
							echo "<a href='#' ><span class='label label-warning'>Menunggu Validasi Pembayaran</span></a>";
						}elseif($i['status'] == 3){
							echo "<a href='#' ><span class='label label-primary'>Pemesanan Tervalidasi</span></a>";
						}elseif($i['status'] == 4){
							echo "<a href='#' ><span class='label label-warning'>Pesanan Telah DiKirim</span></a>";
						}elseif($i['status'] == 5){
							echo "<a href='#' ><span class='label label-success'>Selesai</span></a>";
						}
						?>

			</div>	


			<?php 
		}
		?>
	</div>
	<hr>
		<div style="margin-left:4px; margin-top:5px">
		<p>PEembayaran Ditunjukan Kepada:</p>
		
		<p><img src="frontend/img/bni1.png" alt="" style="width:130px;  margin-top:4px; margin-bottom:4px"> </p>
		<p>34578634654 - an: mukidi </p>
	</div>

	<script>
		window.print();
	</script>
</body>
</html>