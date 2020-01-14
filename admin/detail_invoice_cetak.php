<!DOCTYPE html>
<html>
<head>
	<title>invoice</title>
    <style>
		body{
			font-family: sans-serif;
		}

		.table{
			border-collapse: collapse;
		}
		.table th,
		.table td{
			padding: 5px 10px;
			border: 1px solid black;
		}
	</style>
</head>
<body>

	<?php 
	session_start();
	include 'koneksi.php';
	?>


  <div class="row">
 

 <!-- Area Chart -->
 <div class="col-xl-12 col-lg-8">
   <div class="card shadow mb-4">
     <!-- Card Header - Dropdown -->
    
      </div>
 
         <div class="section">
     <div class="container">
         <div class="row">
             <div id="main" class="col-md-12">
 
                     <div class="row mt-4">
 
                         <?php 
                         $id = $_GET['id'];
                         $invoice = mysqli_query($conn,"SELECT * FROM tb_order WHERE order_id='$id' order by order_id desc");
                         while($i = mysqli_fetch_array($invoice)){
                             ?>
 
 
                             <div class="col-lg-12">
                             
 <center><h4>INVOICE PEMESANAN | ORDER ID : <?php echo $i['order_id'] ?></h4></center>
 <hr>
 <div class="container">
             
                                 Nama    &nbsp;&nbsp; : <?php echo $i['nama_penerima']; ?><br/>
                                 Alamat  &nbsp;: <?php echo $i['alamat_penerima']; ?><br/>
                                 No Hp &nbsp;&nbsp;: <?php echo $i['no_hp']; ?><br/>
                                 <br/>
                             
                                 <div class="table-responsive">
                                     <table class="table table-bordered">
                                         <thead>
                                             <tr>
                                                 <th class="text-center" width="1%">NO</th>
                                                 <th colspan="2">Produk</th>
                                                 <th class="text-center">Harga</th>
                                                 <th class="text-center">Jumlah</th>
                                                 <th class="text-center">Total Harga</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php 
                                             $no = 1;
                                             $total = 0;
                                             $transaksi = mysqli_query($conn," select * from tb_order_detail, tb_produk where tb_order_detail.produk_id = tb_produk.produk_id and tb_order_detail.order_id='$id' ");
 
                                             while($d=mysqli_fetch_array($transaksi)){
                                                 $total += $d['harga'];
                                                 ?>
                                                 <tr>
                                                     <td class="text-center"><?php echo $no++; ?></td>
                                                     <td colspan="2"><?php echo $d['nama_produk']; ?></td>
                                                     <td class="text-center"><?php echo "Rp. ".number_format($d['harga']).",-"; ?></td>
                                                     <td class="text-center"><?php echo number_format($d['jumlah']); ?></td>
                                                     <td class="text-center"><?php echo "Rp. ".number_format($d['jumlah'] * $d['harga'])." ,-"; ?></td>
                                                 </tr>
                                                 <?php 
                                             }
                                             ?>
                                         </tbody>
                                         <tfoot>
                                             
                                                 <td colspan="4" style="border: none"></td>
                                                 <th>Ongkir (<?php echo $i['kurir'] ?>)</th>
                                                 <td class="text-center"><?php echo "Rp. ".number_format($i['ongkir'])." ,-"; ?></td>
                                             </tr>
                                             <tr>
                                                 <td colspan="4" style="border: none"></td>
                                                 <th>Total Bayar</th>
                                                 <td class="text-center"><?php echo "Rp. ".number_format($i['total_bayar'])." ,-"; ?></td>
                                             </tr>
                                         </tfoot>
                                     </table>
                                 </div>
 <hr>
 
                                 <h5  class="mb-4">status :
                                 <?php 
                         if($i['status'] == 0){
                             echo "<a href='#' ><span class='badge badge-danger'>Pesanan Gagal</span></a>";
                         }elseif($i['status'] == 1){
                             echo "<a href='#' ><span class='badge badge-danger'>Belum Di Bayar</span></a>";
                         }elseif($i['status'] == 2){
                             echo "<a href='#' ><span class='badge badge-warning'>Menunggu Validasi Pembayaran</span></a>";
                         }elseif($i['status'] == 3){
                             echo "<a href='#' ><span class='badge badge-success'>Pemesanan Tervalidasi</span></a>";
                         }elseif($i['status'] == 4){
                             echo "<a href='#' ><span class='badge badge-info'>Pesanan Telah DiKirim</span></a>";
                         }elseif($i['status'] == 5){
                             echo "<a href='#' ><span class='badge badge-success'>Selesai</span></a>";
                         }
                         ?> </h5> 
 
                             </div>	
 
 
                             <?php 
                         }
                         ?>
                     </div>
                 </div>
 
             </div>
         </div>
     </div>
	

	<script>
		window.print();
	</script>
</body>
</html>