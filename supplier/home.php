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
            <div class="card bg-primary text-white" style="width: 13rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-box mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang</h5>
                    <div class="display-4"><?php echo $totBarang; ?></div>
                </div>
            </div>
            <div class="card bg-success text-white ml-2" style="width: 13rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-warehouse mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Stok Gudang</h5>
                    <div class="display-4"><?php echo $totStokBarang; ?></div>
                </div>
            </div>
            <div class="card bg-success text-white ml-2" style="width: 13rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-boxes-stacked mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang Tersedia</h5>
                    <div class="display-4"><?php echo $totTersedia; ?></div>
                </div>
            </div>
            <div class="card bg-warning text-white ml-2" style="width: 13rem;">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa-solid fa-boxes-packing mr-2"></i>
                    </div>
                    <h5 class="card-title">Total Barang Masuk</h5>
                    <div class="display-4"><?php echo $totbarangMasuk; ?></div>
                </div>
            </div>
            <div class="card bg-danger text-white ml-2" style="width: 13rem;">
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
        <h1>Pemberitahuan</h1>
         <!-- Tables -->
      <div class="table-responsive-sm mt-2" id="notifier">
        <table class="table table-bordered">
        <!-- Table Header -->
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Catatan</th>
                
            </tr>
        </thead>
        
        <?php 
          $fetchdata=mysqli_query($koneksi,"Select * from barang where stok <=5 ");

          //Generate Number
          $nomor=1; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata)){

          ?>
        <!-- Table Content -->
        <tbody>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['namaBarang']; ?></td>
                <td>
                  <?php 
                    if ($data['stok']== 0) {
                    ?>
                      <label>Stok sudah habis</label>
                    <?php
                    }elseif ($data['stok']<= 5) { ?>
                      <label>Sisa Stok: <?php echo $data['stok']; ?></label>
                    <?php }
                    else{
                      echo $data['stok'];
                    }
                    ?>
              </td>
                
            </tr>
              <?php } ?>
      </tbody>
      </table>
    </div>
        <!-- End Row -->
    </div>
</div>