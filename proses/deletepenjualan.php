<?php 

    include '../config/koneksi.php';

    $id = $_POST['id'];

    $query      = "DELETE FROM penjualan WHERE id = '$id'";
    $result     = mysqli_query($koneksi,$query);

    if ($result) {
        header('location: ../views/penjualan.php');
    }else{
        echo "Data gagal dihapus";
    }
?>