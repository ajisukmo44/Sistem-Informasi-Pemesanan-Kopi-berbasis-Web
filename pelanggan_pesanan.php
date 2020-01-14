<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Riwayat Transaksi</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">
			
			

			<div id="main" class="col-md-12">
				
				<h4>RIWAYAT TRANSAKSI</h4>
		
				<div id="store">
					<div class="row">

						<div class="col-lg-12">

							<?php 
							if(isset($_GET['alert'])){
								if($_GET['alert'] == "gagal"){
									echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
								}elseif($_GET['alert'] == "sukses"){
									echo "<div class='alert alert-success'>Pesanan berhasil dibuat, silahkan melakukan pembayaran!</div>";
								}elseif($_GET['alert'] == "terkirim"){
									echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil terkirim, silahkan menunggu konfirmasi dari admin!</div>";
								}
							}
							?>



							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
										
										    <th>Order ID</th>
											<th>Detail</th>
											<th>Tgl Checkout</th>
											<th>Nama Pelanggan</th>
											<th class="text-center">Status Pemesanan</th>
											<th class="text-center">No Resi</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
			<?php 
			$id = $_SESSION['pelanggan_id'];
			$invoice = mysqli_query($koneksi,"SELECT * FROM tb_order_detail a JOIN tb_order b ON a.order_id = b.order_id WHERE pelanggan_id= '$id' GROUP BY  a.order_id ORDER BY b.order_id ASC");
							
			while($i = mysqli_fetch_array($invoice)){
				?>
				<tr>
					<td> <?php echo $i['order_id'] ?> </td>
					<td>	<a class='btn btn-sm btn-primary btn-xs' href="pelanggan_invoice.php?id=<?php echo $i['order_id']; ?>"><i class="fa fa-file"></i> detail</a> </td>
					<td><?php echo $i['tgl_checkout'] ?></td>
					<td><?php echo $i['nama_penerima'] ?></td>
					<td class="text-center">
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
					</td>

							<?php
							$ido = $i['order_id']; 
							$sql = "select * from tb_pengiriman where order_id= '$ido' ";
							$query = mysqli_query($koneksi,$sql);
							$data = mysqli_fetch_array($query);
							$no_resi = $data['no_resi'];

                               ?>

					<td class="text-center">
						<?php 
						if($i['status'] == 4){
							echo $no_resi;
						}elseif($i['status'] ==5){
							echo $no_resi;
						}elseif($i['status'] ==3){
							echo "-";
						}
						elseif($i['status'] ==2){
							echo "-";
						}
						elseif($i['status'] ==1){
							echo "-";
						};
						?>
					</td>
					<td class="text-center">
						
							
							<a class='btn btn-sm btn-primary btn-xs' href="konfirpembayaran.php?id=<?php echo $i['order_id']; ?>"><i class="fa fa-dollar"></i> Konfir Pembayaran</a>
						 <a class='btn btn-sm btn-success btn-xs' href="selesai_act.php?id=<?php echo $i['order_id']; ?>"><i class="fa fa-check"></i> Selesai</a>
					
					</td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>
							


						</div>	

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<br><br><br><br><br>
<br><br><br><br><br>
<?php include 'footer.php'; ?>