<?php session_start();
 include 'koneksi.php';              // Panggil koneksi ke database
 include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
 include 'fungsi/cek_session.php';  

    if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_bayar WHERE id_bayar = '$id' ";
        $result = $conn->query($sql);
        foreach ($result as $baris) { 
            $img = $baris['bukti_transfer']; 
            ?>
            <table class="table">
              
                   <img src='../gambar/bukti_pembayaran/<?= $img ?>' width='460px' height='600px'></td>
              
            </table>
        <?php 

        }
    }
?>