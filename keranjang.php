<?php include 'header.php'; ?>



<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Keranjang</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->
<!-- <pre>
	<?php 
	print_r($_SESSION); 
	?>
</pre> -->
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			
			<div class="col-md-12">
				<form method="post" action="keranjang_update.php">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">KERANJANG BELANJA</h3>
						</div>

		<?php 
		if(isset($_GET['alert'])){
			if($_GET['alert'] == "keranjang_kosong"){
				echo "<div class='alert alert-danger text-center'>Tidak bisa checkout, karena keranjang belanja masih kosong. <br/> Silahkan belanja terlebih dulu.</div>";
			}
		}
		?>

		<?php 
		if(isset($_SESSION['keranjang'])){

			$jumlah_isi_keranjang = count($_SESSION['keranjang']);

			if($jumlah_isi_keranjang != 0){

				?>


				<table class="shopping-cart-table table">
					<thead>
						<tr>
							<th>Produk</th>
							<th></th>
							<th class="text-center">Harga</th>
							<th class="text-center">Berat</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Total Harga</th>
						</tr>
					</thead>
					<tbody>

						<?php
					// cek apakah produk sudah ada dalam keranjang
						$jumlah_total = 0;
						$total = 0;
						$berat_total = 0;
						$berat = 0;
						for($a = 0; $a < $jumlah_isi_keranjang; $a++){
							$id_produk = $_SESSION['keranjang'][$a]['produk'];
							$jml = $_SESSION['keranjang'][$a]['jumlah'];

							$isi = mysqli_query($koneksi,"select * from tb_produk where produk_id='$id_produk'");
							$i = mysqli_fetch_assoc($isi);

							$stok = $i['stok'];
							$total += $i['harga']*$jml;
							$jumlah_total += $total;

							$berat += $i['berat']*$jml;
							$berat_total += $berat;
							?>

							<tr>
								<td class="thumb">
									<?php if($i['produk_foto'] == ""){ ?>
										<img src="admin/images/produk/produk.png">
									<?php }else{ ?>
										<img src="admin/images/produk/<?php echo $i['produk_foto'];?>">
									<?php } ?>
								</td>
								<td class="details">
									<a href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['nama_produk'] ?></a>
							</td>
							<td class="price text-center"><strong><?php echo "Rp. ".number_format($i['harga']) . " ,-"; ?></strong></td>
							
							<td class="price text-center"><strong><?php echo $i['berat']; ?> Gram</strong></td>
							<td class="qty text-center">
								<input class="harga" id="harga_<?php echo $i['produk_id'] ?>" type="hidden" value="<?php echo $i['harga']; ?>">
								<input name="produk[]" value="<?php echo $i['produk_id'] ?>" type="hidden">
								<input style="text-align:center" max="<?= $stok ?>" class="input jumlah" name="jumlah[]" id="jumlah_<?php echo $i['produk_id'] ?>" nomor="<?php echo $i['produk_id'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" min="1">
							</td>
							<td class="total text-center"><strong class="primary-color total_harga" id="total_<?php echo $i['produk_id'] ?>"><?php echo "Rp. ".number_format($total) . " ,-"; ?></strong></td>
							<td class="text-right"><a class="main-btn icon-btn" href="keranjang_hapus.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i class="fa fa-close"></i></a></td>
						</tr>

						<?php
						$total = 0;

					}

					?>

				</tbody>
				<tfoot>
					<tr>
						<th class="empty" colspan="4"></th>
						<th>TOTAL</th>
						<th colspan="2" class="sub-total"><?php echo "Rp. ".number_format($jumlah_total) . " ,-"; ?></th>
					
					</tr>
				</tfoot>
			</table>

			<div class="pull-right">
				<input type="submit" class="main-btn" value="Update Keranjang">
				<a class="primary-btn" href="checkout.php">Check Out</a>
			</div>
			<?php
		}else{

			echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
		}


					}else{
						echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
					}
					?>

				</div>
			</form>

		</div>

	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /section -->



<?php include 'footer.php'; ?>