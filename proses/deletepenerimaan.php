<?php 

    include '../config/koneksi.php';

    $id = $_POST['id'];

    $query      = "DELETE FROM penerimaan_barang WHERE id = '$id'";
    $result     = mysqli_query($koneksi,$query);

    if ($result) {
        header('location: ../views/penerimaan.php');
    }else{
        echo "Data gagal dihapus";
    }
?>