detail.php
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kopi_mukidi";

    // membuat koneksi
    $koneksi = new mysqli($servername, $username, $password, $dbname);

    // melakukan pengecekan koneksi
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    } 

    if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_bayar WHERE id_bayar = '$id' ";
        $result = $koneksi->query($sql);
        foreach ($result as $baris) { 
            $img = $baris['bukti_transfer']; 
            ?>
            <table class="table">
                <tr>
                    <td>Kode Barang</td>
                    <td>:</td>
                    <td><?php echo $baris['order_id']; ?></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td><?php echo $baris['nama_pengirim']; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi Barang</td>
                    <td>:</td>
                    <td> 
                   <img src='../gambar/bukti_pembayaran/<?= $img ?>' width='450px' height='600px'></td>
                </tr>
            </table>
        <?php 

        }
    }
    $koneksi->close();
?>