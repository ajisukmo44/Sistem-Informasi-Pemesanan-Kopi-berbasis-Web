<?php include 'header.php'; ?>
<?php
session_start();
$query     = "select max(pelanggan_id)as kode from tb_pelanggan"; 
$cari_kd   = mysqli_query($koneksi,$query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'],4,7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah=$kode+1; //kode yang sudah di pecah di tambah 1
  if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id_plg="PLG-00".$tambah;
    }else{
    $id_plg="PLG-0".$tambah;
	}
	?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Daftar Customer</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			
			<div class="col-md-12">
				<div class="order-summary clearfix">
					<div class="section-title">
						<center><h3 class="title">PENDAFTARAN PELANGGAN BARU</h3></center>
					</div>

					<?php 
					if(isset($_GET['alert'])){
						if($_GET['alert'] == "duplikat"){
							echo "<div class='alert alert-danger text-center'>Maaf email ini sudah digunakan, silahkan gunakan email yang lain.</div>";
						}
					}
					?>

					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							
							<form action="daftar_act.php" method="post">
							<div class="form-group">
									<label for="">ID Pelanggan</label>
									<input type="text" class="input" name="id_pelanggan" value="<?= $id_plg ?>" readonly>
								</div>
								<div class="form-group">
									<label for="">Nama Lengkap</label>
									<input type="text" class="input" required="required" name="nama" placeholder="Masukkan nama lengkap ..">
								</div>

								
								<div class="form-group">
									<label for="">Email</label>
									<input type="email" class="input" required="required" name="email" placeholder="Masukkan email ..">
								</div>

								<div class="form-group">
									<label for="">Nomor HP / Whatsapp</label>
									<input type="number" class="input" required="required" name="hp" placeholder="Masukkan nomor HP/Whatsapp ..">
								</div>

								<div class="form-group">
									<label for="">Alamat Lengkap</label>
									<input type="text" class="input" required="required" name="alamat" placeholder="Masukkan alamat lengkap ..">
								</div>

								<div class="form-group">
									<label for="">Username</label>
									<input type="text" class="input" required="required" autocomplete="off" name="username" placeholder="Masukkan username ..">
								</div>

								<div class="form-group">
									<label for="">Password</label>
									<input type="password" class="input" required="required" autocomplete="off" name="password" placeholder="Masukkan password ..">
									<small class="text-muted">Password ini digunakan untuk login ke akun anda.</small>
								</div>

								<div class="form-group">
									<input type="submit" class="primary-btn btn-block" value="Daftar">
									<a href="masuk.php" class="main-btn btn-block text-center">login</a>
								</div>
							</form>

						</div>
					</div>

				</div>

			</div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->



<?php include 'footer.php'; ?>