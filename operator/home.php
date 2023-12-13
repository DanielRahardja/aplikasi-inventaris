<?php
    //Untuk perhitungan data dashboard
    //Pegawai
    $pegawai= mysqli_query($koneksi,"select * from pegawai");
    $totPegawai= mysqli_num_rows($pegawai);
    //Supplier
    $supplier= mysqli_query($koneksi,"select * from supplier");
    $totSupplier= mysqli_num_rows($supplier);
    //Akun
    $akun= mysqli_query($koneksi,"select * from users");
    $totAkun= mysqli_num_rows($akun);
    //Ruangan
    $ruang= mysqli_query($koneksi,"select * from ruangan");
    $totRuang= mysqli_num_rows($ruang);
    //Total Barang
    $barang= mysqli_query($koneksi,"select * from barang");
    $totBarang= mysqli_num_rows($barang);
    //Barang Tersedia
    $barang= mysqli_query($koneksi,"select * from barang where stok > 0");
    $totTersedia= mysqli_num_rows($barang);
    //Barang Tersedia
    $barang= mysqli_query($koneksi,"select * from barang where stok = 0");
    $totHabis= mysqli_num_rows($barang);
    //Stok Barang
    $stokbarang= mysqli_query($koneksi,"SELECT SUM(stok) AS total_stok FROM barang");
        if ($stokbarang && $stokbarang->num_rows > 0) {
            $row = $stokbarang->fetch_assoc();
            $totStokBarang = $row['total_stok'];
        }
    //Barang Masuk
    $barangMasuk= mysqli_query($koneksi,"SELECT SUM(jumlahMasuk) AS total_masuk FROM masukbarang");
        if ($barangMasuk && $barangMasuk->num_rows > 0) {
            $row = $barangMasuk->fetch_assoc();
            $totbarangMasuk = $row['total_masuk'];
        }
    //Barang Rusak
    $barangRusak= mysqli_query($koneksi,"SELECT SUM(jumlahRusak) AS total_rusak FROM barang");
        if ($barangRusak && $barangRusak->num_rows > 0) {
            $row = $barangRusak->fetch_assoc();
            $totRusak = $row['total_rusak'];
        }
    //Inventaris
    $inventaris= mysqli_query($koneksi,"select * from inventaris");
    $totTI= mysqli_num_rows($inventaris);
    //Pinjam
    $pinjam= mysqli_query($koneksi,"select * from inventaris where statuspeminjaman ='Sedang Dipinjam'");
    $totPinjam= mysqli_num_rows($pinjam);
    // Kembali: Selesai
    $selesai= mysqli_query($koneksi,"select * from inventaris where statuspeminjaman ='Selesai'");
    $totSelesai= mysqli_num_rows($selesai);
    // Kembali: Terlambat
    $telat= mysqli_query($koneksi,"select * from inventaris where statuspeminjaman ='Terlambat'");
    $totTelat= mysqli_num_rows($telat);
?>
<!-- Content -->
<div class="container">
<div class="content">
        <h1>Dashboard <i class="fa-solid fa-chart-line"></i></h1>
        <hr>
        <!-- Start Row Barang -->
        <div class="row ml-1">
            <div class="card bg-primary text-white" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-box mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang</h5>
                    <div class="display-4"><?php echo $totBarang; ?></div>
                </div>
            </div>
            <div class="card bg-success text-white ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-warehouse mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Stok Gudang</h5>
                    <div class="display-4"><?php echo $totStokBarang; ?></div>
                </div>
            </div>
            <div class="card bg-success text-white ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-boxes-stacked mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang Tersedia</h5>
                    <div class="display-4"><?php echo $totTersedia; ?></div>
                </div>
            </div>
            <div class="card bg-danger text-white ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-box-open mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang Habis</h5>
                    <div class="display-4"><?php echo $totHabis; ?></div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        <!-- Transaksi -->
        <div class="row ml-1">
            <!-- Transaksi -->
            <div class="card bg-info text-white mt-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-file-invoice mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Transaksi Inventaris</h5>
                    <div class="display-4"><?php echo $totTI; ?></div>
                </div>
            </div>
            <div class="card bg-warning text-white mt-2 ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-people-carry-box mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Pinjam</h5>
                    <div class="display-4"><?php echo $totPinjam; ?></div>
                </div>
            </div>
            <div class="card bg-success text-white mt-2 ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-calendar-check mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Selesai</h5>
                    <div class="display-4"><?php echo $totSelesai; ?></div>
                </div>
            </div>
            <div class="card bg-danger text-white mt-2 ml-2" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-calendar-xmark mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Terlambat</h5>
                    <div class="display-4"><?php echo $totTelat; ?></div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>