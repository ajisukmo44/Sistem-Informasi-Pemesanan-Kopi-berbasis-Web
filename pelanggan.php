<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Profil Pelanggan</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">
			

			<div id="main" class="col-md-12">
				
				<h4>DATA PROFIL</h4>

				<div id="store">

					<div class="row">

						<div class="col-lg-12">
							

							<table class="table table-bordered">
								<tbody>
									<?php 
									$id = $_SESSION['pelanggan_id'];
									$pelanggan = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan WHERE pelanggan_id='$id'");
									while($i = mysqli_fetch_array($pelanggan)){
										?>
										<tr>
											<th width="20%">Nama</th>	
											<td><?php echo $i['nama'] ?></td>
										</tr>
									
										<tr>
											<th width="20%">Email</th>	
											<td><?php echo $i['email'] ?></td>
										</tr>
										<tr>
											<th>HP</th>	
											<td><?php echo $i['no_hp'] ?></td>
										</tr>
										<tr>
											<th>Alamat</th>	
											<td><?php echo $i['alamat'] ?></td>
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

<br><br><br><br><br>
<?php include 'footer.php'; ?>