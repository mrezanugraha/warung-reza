<?php 
    include '../config/koneksi.php';
// Mulai sesi
session_start();

// Periksa status login pengguna
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika pengguna belum login, alihkan ke halaman login
    header("Location: ../index.php");
    exit();
}

// Set header-cache untuk mencegah caching halaman
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Konten halaman yang memerlukan autentikasi
// ...
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            html, body {
        height: 100%;
    }

    #layoutSidenav {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #layoutSidenav_content {
        flex: 1 0 auto;
    }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .card-text {
            font-size: 18px;
            color: #333;
        }

        .card-primary .card-body {
            background-color: #007bff;
        }

        .card-success .card-body {
            background-color: #28a745;
        }

        .card-warning .card-body {
            background-color: #ffc107;
        }

        .card-danger .card-body {
            background-color: #dc3545;
        }
    </style>
    </head>
    <body class="sb-nav-fixed">
    <?php 
    session_start();

   // Menghitung jumlah total barang
   $queryTotalBarang = "SELECT COUNT(*) as total_barang FROM barang";
   $resultTotalBarang = mysqli_query($koneksi, $queryTotalBarang);
   $totalBarang = mysqli_fetch_assoc($resultTotalBarang)['total_barang'];

   // Menghitung jumlah total penerimaan barang
   $queryTotalPenerimaan = "SELECT COUNT(*) as total_penerimaan FROM penerimaan_barang";
   $resultTotalPenerimaan = mysqli_query($koneksi, $queryTotalPenerimaan);
   $totalPenerimaan = mysqli_fetch_assoc($resultTotalPenerimaan)['total_penerimaan'];

   // Menghitung jumlah total penjualan
   $queryTotalPenjualan = "SELECT COUNT(*) as total_penjualan FROM penjualan";
   $resultTotalPenjualan = mysqli_query($koneksi, $queryTotalPenjualan);
   $totalPenjualan = mysqli_fetch_assoc($resultTotalPenjualan)['total_penjualan'];

   // Menghitung nilai total persediaan barang
   $queryTotalPersediaan = "SELECT SUM(harga_barang * jumlah_barang) as total_persediaan FROM barang";
   $resultTotalPersediaan = mysqli_query($koneksi, $queryTotalPersediaan);
   $totalPersediaan = 0; // Inisialisasi total persediaan

   if ($resultTotalPersediaan && mysqli_num_rows($resultTotalPersediaan) > 0) {
       $row = mysqli_fetch_assoc($resultTotalPersediaan);
       $totalPersediaan = $row['total_persediaan'];
   }

    // Mengambil data penjualan terbaru
    $queryPenjualanTerbaru = "SELECT * FROM penjualan ORDER BY tanggal_penjualan DESC LIMIT 5";
    $resultPenjualanTerbaru = mysqli_query($koneksi, $queryPenjualanTerbaru);

    // Mengambil data penerimaan barang terbaru
    $queryPenerimaanTerbaru = "SELECT * FROM penerimaan_barang ORDER BY tanggal_penerimaan DESC LIMIT 5";
    $resultPenerimaanTerbaru = mysqli_query($koneksi, $queryPenerimaanTerbaru);
    ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Warung Reza</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-secondary bg-warning" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link  active text-black" href="./home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Tabel</div>
                            <a class="nav-link text-white" href="./barang.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                                Barang
                            </a>
                            <a class="nav-link text-white" href="./penerimaan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                                Penerimaan Barang
                            </a>
                            <a class="nav-link text-white" href="./penjualan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Penjualan
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <a class="btn btn-danger ms-auto me-2" href="../proses/logout.php">Logout</a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <div class="container">
                <h1 class="text-center my-4">Home</h1>

                <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card card-primary">
                    <div class="card-body text-light">
                        <h3 class="card-title">Jumlah Total Barang</h3>
                        <p class="card-text text-light"><?php echo $totalBarang; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-success text-light">
                    <div class="card-body">
                        <h3 class="card-title">Jumlah Total Penerimaan Barang</h3>
                        <p class="card-text text-light"><?php echo $totalPenerimaan; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-warning text-light">
                    <div class="card-body">
                        <h3 class="card-title">Jumlah Total Penjualan</h3>
                        <p class="card-text text-light"><?php echo $totalPenjualan; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-danger text-light">
                    <div class="card-body">
                        <h3 class="card-title">Nilai Total Persediaan Barang</h3>
                        <p class="card-text text-light"><?php echo $totalPersediaan; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Penjualan Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                        <?php
                            while ($dataPenjualan = mysqli_fetch_assoc($resultPenjualanTerbaru)) {
                                echo '<li class="list-group-item">' . $dataPenjualan['tanggal_penjualan'] . '</li>';
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Penerimaan Barang Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php
                            while ($dataPenerimaan = mysqli_fetch_assoc($resultPenerimaanTerbaru)) {
                                echo '<li class="list-group-item">' . $dataPenerimaan['tanggal_penerimaan'] . ' - ' . $dataPenerimaan['jumlah_barang'] . ' barang diterima</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
            </div>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Muhammad Reza Nugraha 2023</div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>
