<?php 

    include '../config/koneksi.php';

    $id = $_POST['id'];

    $query      = "DELETE FROM barang WHERE id = '$id'";
    $result     = mysqli_query($koneksi,$query);

    if ($result) {
        header('location: ../views/barang.php');
    }else{
        echo "Data gagal dihapus";
    }
?>