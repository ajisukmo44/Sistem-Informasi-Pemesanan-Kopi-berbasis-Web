<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Passing Data To Modal</title>
    <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">
  
 
     </head>

  <body>
    <div class="container">
      <div class="row"> 
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>ID Bayar</th>
            <th colspan="2">Opsi</th>
          </tr>
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kopi_mukidi";

            // Membuat Koneksi
            $koneksi = new mysqli($servername, $username, $password, $dbname);
            
            // Melakukan Cek Koneksi
            if ($koneksi->connect_error) {
                die("Koneksi Gagal : " . $koneksi->connect_error);
            } 

            //Melakukan query
            $sql = "SELECT * FROM tb_bayar";
            $hasil = $koneksi->query($sql);
            $no = 1;
            if ($hasil->num_rows > 0) {
                foreach ($hasil as $row) { ?>
                  <tr>     
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['order_id']; ?></td>
                  <?php echo "<td><a href='#myModal' class='btn btn-default btn-small' id='custId' data-toggle='modal' data-id=".$row['id_bayar'].">Detail</a></td>"; ?>
                  </tr>
            <?php 
            $no++; 
            } 
              } else { 
            echo "0 results"; 
              } $koneksi->close(); 
            ?>

        </table>
      </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
  
<?php include '../admin/footer.php' ?>
  </body>
</html>