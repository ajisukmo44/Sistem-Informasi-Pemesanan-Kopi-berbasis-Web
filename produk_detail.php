<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Detail Produk</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<?php 
$id_produk = $_GET['id'];
$data = mysqli_query($koneksi,"select * from tb_produk a, tb_kategori b where a.kategori_id=b.kategori_id and produk_id='$id_produk'");
while($d=mysqli_fetch_array($data)){
	?>
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-4">
						<div id="product-main-view">

							<div class="product-view">
								<?php if($d['produk_foto'] == ""){ ?>
									<img src="admin/images/produk/">
								<?php }else{ ?>
									<img src="admin/images/produk/<?php echo $d['produk_foto'] ?>">
								<?php } ?>
							</div>

						</div>
					</div>
					<div class="col-md-4">
						<div class="product-body">
							<div class="product-label">
								<span><?php echo $d['kategori_nama']; ?></span> <span> 
							<?php echo "Rp. ".number_format($d['harga']).",-"; ?> <?php if($d['stok'] == 0){?> <del class="product-old-price">Kosong</del> <?php } ?></span>
							</div>
							<br>
							<h2 class="product-name"><?php echo $d['nama_produk']; ?></h2>
							<br>
						
							<br/>
							<div>
						
								<!-- <a href="#">3 Review(s) / Add Review</a> -->
							</div>
							<p>
								<strong>Status:</strong> 
								<?php 
								if($d['stok'] == 0){
									echo "Kosong";
								}else{
									echo "Tersedia";
								} 
								?>
							</p>
							<p>
								<strong>Berat:</strong> 
								<?= $d['berat'] ?> Gram
							</p>
							
							<p>
								<strong>Released:</strong> 
								<?= $d['released'] ?>
							</p>
							<p>
								<strong>Stok:</strong> 
								<?= $d['stok'] ?>
							</p>

							</div>
							<br>

							<form action="">
								<div class="product-btns">
									<!-- <div class="qty-input">
										<span class="text-uppercase">QTY: </span>
										<input class="input" type="number" required="required">
									</div> -->
									<a class="primary-btn add-to-cart" href="keranjang_masukkan.php?id=<?php echo $d['produk_id']; ?>&redirect=detail"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
									<div class="pull-right">
										<!-- <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button> -->
									</div>
								</div>
							</form>


						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									
									<p><?php echo $d['deskripsi']; ?></p>
<hr>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<?php 
}
?>


<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Rekomendasi Produk Lainnya</h3>
				</div>
			</div>
			<!-- section title -->


			<?php           
			$data = mysqli_query($koneksi,"select * from tb_produk a,tb_kategori b where a.kategori_id=b.kategori_id order by rand() limit 4");
			while($d = mysqli_fetch_array($data)){
				?>

				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span><?php echo $d['kategori_nama'] ?></span>
							</div>

							<a href="produk_detail.php?id=<?php echo $d['produk_id'] ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i>Detail</a>

							<?php if($d['produk_foto'] == ""){ ?>
								<img src="admin/images/produk/produk.png" style="height: 250px">
							<?php }else{ ?>
								<img src="admin/images/produk/<?php echo $d['produk_foto'] ?>" style="height: 250px">
							<?php } ?>
						</div>
						<div class="product-body">
							<h3 class="product-price"><?php echo "Rp. ".number_format($d['harga']).",-"; ?> <?php if($d['stok'] == 0){?> <del class="product-old-price">Kosong</del> <?php } ?></h3>
							<h2 class="product-name"><a href="produk_detail.php?id=<?php echo $d['produk_id'] ?>"><?php echo $d['nama_produk']; ?></a></h2>
							
						</div>
					</div>
				</div>
				<!-- /Product Single -->

				<?php 
			}
			?>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>

<?php include 'footer.php'; ?>