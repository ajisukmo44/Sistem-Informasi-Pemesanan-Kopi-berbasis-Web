<?php include 'header.php'; ?>

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div id="main" class="col-md-6">
		<img src="frontend/img/007.jpg" alt="" style="width:100%; height:400px">
		
		<hr>
			</div>
			<div id="main" class="col-md-6">
		<img src="frontend/img/004.jpg" alt="" style="width:100%; height:400px">
		
		<hr>
			</div>
			<center><h3 style="background-color:#red"> KOPI MUKIDI </h3></center>
			<hr>
		<div class="row" >

			<!-- MAIN -->
			<div id="main" class="col-md-12">

				<!-- STORE -->
					<!-- row -->
					<div class="row">

						<?php
						$halaman = 12;
						$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						$result = mysqli_query($koneksi, "SELECT * FROM tb_produk");
						$total = mysqli_num_rows($result);
						$pages = ceil($total/$halaman);  
						if(isset($_GET['urutan']) && $_GET['urutan'] == "harga"){
							if(isset($_GET['cari'])){
								$cari = $_GET['cari'];
								$data = mysqli_query($koneksi,"SELECT * FROM a.tb_produk , b.tb_kategori  WHERE a.kategori_id = b.kategori_id and a.nama_produk like '%$cari%' ORDER BY a.harga ASC LIMIT $mulai, $halaman");
							}else{
								$data = mysqli_query($koneksi,"SELECT * FROM tb_produk a, tb_kategori b WHERE a.kategori_id = b. kategori_id ORDER BY a.harga ASC LIMIT $mulai, $halaman");
							}
						}else{

							if(isset($_GET['cari'])){
								$cari = $_GET['cari'];
								$data = mysqli_query($koneksi,"SELECT * FROM tb_produk a, tb_kategori b WHERE a.kategori_id = b.kategori_id AND a.ama_produk LIKE '%$cari%' ORDER BY a.produk_id DESC LIMIT $mulai, $halaman");
							}else{
								$data = mysqli_query($koneksi,"SELECT * FROM tb_produk a, tb_kategori b WHERE a.kategori_id = b.kategori_id ORDER BY a.produk_id DESC LIMIT $mulai, $halaman");
							}
						}          
						$no = $mulai+1;

						while($d = mysqli_fetch_array($data)){
							?>

							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb">
										<div class="product-label">
											<span><?php echo "Rp. ".number_format($d['harga']).",-"; ?> <?php if($d['stok'] == 0){?> <del class="product-old-price">Kosong</del> <?php } ?></span>
										</div>

										<a href="produk_detail.php?id=<?php echo $d['produk_id'] ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail </a>
										
										<?php if($d['produk_foto'] == ""){ ?>
											<img src="admin/images/produk.png" style="height: 250px">
										<?php }else{ ?>
											<img src="admin/images/produk/<?php echo $d['produk_foto'] ?>" style="height: 250px">
										<?php } ?>
									</div>
									<div class="product-body">
									
										<h2 class="product-name"><a href="produk_detail.php?id=<?php echo $d['produk_id'] ?>"><?php echo $d['nama_produk']; ?></a></h2>
										<div class="product-btns" style="margin-top:12px">
										</div>
									</div>
								</div>
							</div>
							<!-- /Product Single -->

							<?php 
						}
						?>

					</div>
					<!-- /row -->
				<!-- /STORE -->

				
				<div class="store-filter clearfix">
					<div class="pull-right">
						<ul class="store-pages">
							<li><span class="text-uppercase">Page:</span></li>
							<?php for ($i=1; $i<=$pages ; $i++){ ?>
								<?php if($page==$i){ ?>
									<li class="active"><?php echo $i; ?></li>
								<?php }else{ ?>

									<?php 
									if(isset($_GET['cari'])){
										$cari = $_GET['cari'];
										$c = "&cari=".$cari;
									}
									if(isset($_GET['urutan']) && $_GET['urutan'] == "harga"){
										?>
										<li><a href="?halaman=<?php echo $i; ?>&urutan=harga<?php echo $c ?>"><?php echo $i; ?></a></li>
										<?php 
									}else{
										?>
										<li><a href="?halaman=<?php echo $i; ?><?php echo $c ?>"><?php echo $i; ?></a></li>
										<?php
									}
									?>

								<?php } ?>
							<?php } ?>
						</ul>
					</div>
				</div>

			</div>
			<!-- /MAIN -->

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>