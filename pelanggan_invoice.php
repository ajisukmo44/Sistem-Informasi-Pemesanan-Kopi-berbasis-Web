<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Invoice </li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">
			<div id="main" class="col-md-12">
			<?php 
							if(isset($_GET['alert'])){
								if($_GET['alert'] == "gagal"){
									echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
								}elseif($_GET['alert'] == "sukses"){
									echo "<div class='alert alert-success'>Pesanan berhasil dibuat, silahkan melakukan pembayaran!</div>";
								}elseif($_GET['alert'] == "upload"){
									echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil tersimpan, silahkan menunggu konfirmasi dari admin!</div>";
								}
							}
							?>

					<div class="row">

						<?php 
						$idp = $_SESSION['pelanggan_id'];
						$id = $_GET['id'];
						$invoice = mysqli_query($koneksi,"SELECT * FROM tb_order WHERE pelanggan_id='$idp' AND order_id='$id' order by order_id desc");
						while($i = mysqli_fetch_array($invoice)){
							?>


							<div class="col-lg-12">
							<div> <center>
<h4><p> <img src="frontend/img/logo1.png" alt="" style="width:150px"> </p> INVOICE PEMESANAN | ORDER ID : <?php echo $i['order_id'] ?></h4></center>
							</div>
<HR><div class="pull-right">
				<a href="pelanggan_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> CETAK</a>
				</div>
<div class="container">
			
								Nama    &nbsp;&nbsp; : <?php echo $i['nama_penerima']; ?><br/>
								Alamat  &nbsp;: <?php echo $i['alamat_penerima']; ?><br/>
								No Hp &nbsp;&nbsp;: <?php echo $i['no_hp']; ?><br/>
								<br/>
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" width="1%">NO</th>
												<th colspan="2">Produk</th>
												<th class="text-center" >Harga</th>
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
													<td class="text-center"><?php echo number_format($d['jumlah']); ?></td>
													<td class="text-center"><?php echo "Rp. ".number_format($d['jumlah'] * $d['harga'])." ,-"; ?></td>
												</tr>
												<?php 
											}
											?>
										</tbody>
										<tfoot>
											
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
								</div>


								<h5>STATUS :</h5> 
								<?php 
						if($i['status'] == 0){
							echo "<a href='#' ><span class='label label-danger'>Pesanan Gagal</span></a>";
						}elseif($i['status'] == 1){
							echo "<a href='#' ><span class='label label-danger'>Belum Di Bayar</span></a>";
						}elseif($i['status'] == 2){
							echo "<a href='#' ><span class='label label-warning'>Menunggu Validasi Pembayaran</span></a>";
						}elseif($i['status'] == 3){
							echo "<a href='#' ><span class='label label-success'>Pemesanan Tervalidasi</span></a>";
						}elseif($i['status'] == 4){
							echo "<a href='#' ><span class='label label-info'>Pesanan Telah DiKirim</span></a>";
						}elseif($i['status'] == 5){
							echo "<a href='#' ><span class='label label-success'>Selesai</span></a>";
						}
						?>

							</div>	


							<?php 
						}
						?>
					</div>
				</div>

			</div>
		</div>
		<hr>
		<div style="margin-left:15px">
		<b>PEMBAYARAN DI TUJUKAN KEPADA :</b>
		
		<p><img src="frontend/img/bni1.png" alt="" style="width:130px;  margin-top:4px; margin-bottom:4px"> </p>
		<p>34578634654 - an: mukidi </p>
	</div>
	<hr>
	<div style="margin-left:15px">
		<p>Jika sudah melakukan pembayaran silahkan kirim konfirmasi pembayaran :  <a href="konfirpembayaran.php?id=<?php echo $id; ?>" style="color:blue;">Klik Di Sini</a></p>
	</div>
	<hr>
	</div>
</div>

<?php include 'footer.php'; ?>