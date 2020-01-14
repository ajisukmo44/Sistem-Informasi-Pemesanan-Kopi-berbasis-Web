<?php include 'header.php'; 
$id  = mysqli_real_escape_string($koneksi, $_GET['id']);

?>
<?php
session_start();
$query     = "select max(id_bayar)as kode from tb_bayar"; 
$cari_kd   = mysqli_query($koneksi,$query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'],4,7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah=$kode+1; //kode yang sudah di pecah di tambah 1
  if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id_byr="BYR-00".$tambah;
    }else{
    $id_byr="BYR-0".$tambah;
	}
	?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">konfirmasi pembayaran</li>
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
					<div class="section-title"  style="text-align:center">
						<h3 class="title">KONFIRMASI PEMBAYARAN</h3>
					</div>

					<?php 
					if(isset($_GET['alert'])){
						if($_GET['alert'] == "duplikat"){
							echo "<div class='alert alert-danger text-center'>Maaf id_bayar ini sudah digunakan, silahkan gunakan email yang lain.</div>";
						}
					}
					?>

					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							
							<form action="konfir_act.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
									<input type="hidden" class="input" required="required" name="id_bayar" value="<?= $id_byr ?> " readonly>
								</div>
								<div class="form-group">
									<label for="">ID ORDER</label>
									<input type="text" class="input" required="required" name="order_id" value="<?= $id ?> " readonly>
								</div>
								
						
								<div class="form-group">
									<label for="">nama Pengirim</label>
									<input type="text" class="input" required="required" name="nama" placeholder="Masukkan nama pengirim ..">
								</div>
								<div class="form-group">
									<label for="">Bank</label>
									<input type="text" class="input" required="required" name="bank" placeholder="Masukkan nama bank ..">
								</div>

								<div class="form-group">
									<label for="">Jumlah Transfer</label>
									<input type="number" class="input" required="required" name="jumlah_transfer" placeholder="Masukkan jumlah transfer ..">
								</div>
								<div class="form-group">
									<label for="">Tanggal Transfer</label>
									<input type="date" class="input" required="required" name="tanggal_transfer" >
								</div>
								<div class="form-group">
									<label for="">Bukti Transfer</label>
									<input type="file" class="input" required="required" name="bukti_transfer">
									<small class="text-muted">File yang diperbolehkan hanya file gambar.</small>
								</div>
								

								<div class="form-group">
									<input type="submit" class="primary-btn btn-block" value="Kirim Konfirmasi">
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