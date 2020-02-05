<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Reset Password</li>
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
						<center><h3 class="title">Masukan Email Anda</h3></center>
					</div>

					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							
							<form action="mail/send2.php" method="post">
								
								<div class="form-group">
									<label for="">Email Anda</label>
									<input type="email" class="input" required="required" name="email" placeholder="Masukkan email anda ..">
								</div>


								<div class="form-group">
									<input type="submit" class="primary-btn btn-block" value="KIRIM RESET PASSWORD">
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