<?php include 'header.php'; 

$idp = $_SESSION['pelanggan_id'];

?>
 <?php
 $query  = "SELECT  * FROM tb_pelanggan WHERE pelanggan_id = '$idp' "; 
 $cari   = mysqli_query($koneksi,$query);
 $data   = mysqli_fetch_array($cari);
 $id   = $data['pelanggan_id'];
 $nama   = $data['nama'];
 $email  = $data['email'];
 $nohp   = $data['no_hp'];
 $alamat = $data['alamat'];
 ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Edit Pelanggan</li>
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
						<center><h3 class="title">EDIT DATA PROFIL</h3></center>
					</div>

			
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							
							<form action="editprofil_act.php" method="post">
							<div class="form-group">
									<label for="">ID Pelanggan</label>
									<input type="text" class="input" name="id_pelanggan" value="<?= $id ?>" readonly>
								</div>
                               
								<div class="form-group">
									<label for="">Nama Lengkap</label>
									<input type="text" class="input" required="required" name="nama" value="<?= $nama ?>" >
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="email" class="input" required="required" name="email" value="<?= $email ?>">
								</div>
								<div class="form-group">
									<label for="">Nomor HP / Whatsapp</label>
									<input type="number" class="input" required="required" name="hp" value="<?= $nohp ?>">
								</div>
								<div class="form-group">
									<label for="">Alamat Lengkap</label>
									<input type="text" class="input" required="required" name="alamat" value="<?= $alamat ?>">
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="primary-btn btn-block" value="Update">
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