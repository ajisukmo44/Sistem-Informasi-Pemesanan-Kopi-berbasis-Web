<?php include 'header.php'; ?>

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
	

<?php
        $data = mysqli_query($koneksi,"SELECT * FROM tb_profil");
  

while($d = mysqli_fetch_array($data)){
    ?>
<p><center><h2>RUMAH KOPI MUKIDI</h2></center></p>
    <hr>

	<div id="main" class="col-md-5">
		<img src="frontend/img/<?= $d['foto'] ?>" alt="" style="width:100%; height:330px">
		
		<hr>
			</div>
			<div id="main" class="col-md-7">
		<p style="text-align:justify; font-size:16px"><?= $d['isi_profil']; ?></p>
		
		<hr>
			</div>





        
							<?php 
						}
						?>
			<!-- /MAIN -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>