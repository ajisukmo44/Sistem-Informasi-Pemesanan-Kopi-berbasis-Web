 <?php session_start();
 include 'koneksi.php';              // Panggil koneksi ke database
 include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
 include 'fungsi/cek_session.php';      // Panggil data setting
 
    if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_produk WHERE produk_id = '$id' ";
        $result = $conn->query($sql);
        foreach ($result as $baris) { 
            $des = $baris['deskripsi']; 
            ?>
            <table class="table">
              <p><?= $des ?></p>
              
            </table>
        <?php 

        }
    }
?>