<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Rumah Kopi Mukidi Temanggung</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="frontend/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="frontend/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="frontend/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="frontend/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="frontend/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="frontend/css/style2.css" />

    <link href="gambar/logo1.ico" rel="shortcut icon"/>
	

  <!-- Custom styles for this template -->
</head>

<?php
include 'koneksi.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if(!isset($_SESSION['status'])){

	// halaman yg dilindungi jika customer belum login
	$lindungi = array('pelanggan.php','customer_logout.php');

	// periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
	if(in_array($file, $lindungi)){
		header("location:index.php");
	}

	if($file == "checkout.php"){
		header("location:masuk.php?alert=login-dulu");
	}

}else{

	// halaman yg tidak boleh diakses jika customer sudah login
	$lindungi = array('masuk.php','daftar.php');

	// periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
	if(in_array($file, $lindungi)){
		header("location:customer.php");
	}

}



if($file == "checkout.php"){


	if(!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0){

		header("location:keranjang.php?alert=keranjang_kosong");

	}
}



?>
<body>

	<style>
		.product-name {
			height: 5px;
		}
	</style>
	<!-- HEADER -->
	<header>
		
		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="frontend/img/logo1.png" alt="" style="width:200px">
							
						</a>
					</div>
					<!-- /Logo -->
				
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">

							<?php 
							if(isset($_SESSION['keranjang'])){
								$jumlah_isi_keranjang = count($_SESSION['keranjang']);
							}else{
								$jumlah_isi_keranjang = 0;
							}
							?>

							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php echo $jumlah_isi_keranjang; ?></span>
								</div>
								<strong class="text-uppercase">Keranjang</strong>
								<br>
								<?php 
								$total = 0;
								if(isset($_SESSION['keranjang'])){
									$jumlah_isi_keranjang = count($_SESSION['keranjang']);
									for($a = 0; $a < $jumlah_isi_keranjang; $a++){
										$id_produk = $_SESSION['keranjang'][$a]['produk'];
										$isi = mysqli_query($koneksi,"select * from tb_produk where produk_id='$id_produk'");
										$i = mysqli_fetch_assoc($isi);
										$total += $i['harga'];
									}
								}
								?>
								<span><?php echo "Rp. ".number_format($total)." ,-"; ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										<?php 
										$total_berat = 0;
			if(isset($_SESSION['keranjang'])){

				$jumlah_isi_keranjang = count($_SESSION['keranjang']);

				if($jumlah_isi_keranjang != 0){
					// cek apakah produk sudah ada dalam keranjang
					for($a = 0; $a < $jumlah_isi_keranjang; $a++){
						$id_produk = $_SESSION['keranjang'][$a]['produk'];
						$isi = mysqli_query($koneksi,"select * from tb_produk where produk_id='$id_produk'");
						$i = mysqli_fetch_assoc($isi);

						$total_berat += $i['berat'];
						?>

						<div class="product product-widget">
							<div class="product-thumb">
								<?php if($i['produk_foto'] == ""){ ?>
									<img src="admin/images/produk/produk.png">
								<?php }else{ ?>
									<img src="admin/images/produk/<?php echo $i['produk_foto'];?>">
								<?php } ?>
							</div>
							<div class="product-body">
								<h3 class="product-price"><?php echo "Rp. ".number_format($i['harga']) . " ,-"; ?></h3>
								<h2 class="product-name"><a href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['nama_produk'] ?></a></h2>
							</div>
							<a class="cancel-btn" href="keranjang_hapus.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i style="font-size:18px; margin-right:3px" class="fa fa-trash"></i></a>
						</div>

						<?php

					}
				}else{
					echo "<center>Keranjang Masih Kosong.</center>";
				}
				

			}else{
				echo "<center>Keranjang Masih Kosong.</center>";
			}
			?>
			
									</div>
									<div class="shopping-cart-btns">
										<a class="main-btn" href="keranjang.php">Keranjang</a>
										<a class="primary-btn" href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<?php 
						if(isset($_SESSION['status'])){
							$id_customer = $_SESSION['pelanggan_id'];
							$customer = mysqli_query($koneksi,"select * from tb_pelanggan where pelanggan_id='$id_customer'");
							$c = mysqli_fetch_assoc($customer);
							?>
							<!-- Account -->
							<li class="header-account dropdown default-dropdown" style="min-width: 200px">
								<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
									<div class="header-btns-icon">
										<i class="fa fa-user-o"></i>
									</div>
									<strong class="text-uppercase"><?php echo $c['nama']; ?> <i class="fa fa-caret-down"></i></strong>
								</div>
								<span><?php echo $c['email']; ?></span>
								<ul class="custom-menu">
									<li><a href="pelanggan.php"><i class="fa fa-user-o"></i> Akun Saya</a></li>
									<li><a href="pelanggan_pesanan.php"><i class="fa fa-list"></i>Transaksi Saya</a></li>
									<li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
								</ul>
							</li>
							<!-- /Account -->
							<?php
						}else{
							?>
							<li class="header-account dropdown default-dropdown">
								<a href="masuk.php" class="text-uppercase main-btn">login</a> 
								<a href="daftar.php" class="text-uppercase main-btn">daftar</a>
							</li>
							<?php
						}
						?>

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="index.php">Home</a></li>
						<li><a href="produk.php">Produk Kategori</a></li>	
						<li><a href="tentangkami.php">Tentang Kami</a></li>
						

					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
	
				<!-- /category















