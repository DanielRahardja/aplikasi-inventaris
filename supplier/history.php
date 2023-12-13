<div class="container">
    <div class="content">
    <h1>History</h1>
    <div class="table-responsive">
        <!-- Tables -->
    <table class="table">
    <!-- Table Header -->
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Barang</th>
            <th scope="col">Tambah Stok</th>
            <th scope="col">Waktu</th>
        </tr>
    </thead>
    
    <?php $nomor=1; ?>
    <!-- Koneksi Database untuk pengambilan data barang secara keseluruhan -->
      <?php
        $namaAkun= $_SESSION['namaAkun'];
        $result= mysqli_query($koneksi,"Select * from masukbarang where supplier='$namaAkun'");
              
          while ($data= mysqli_fetch_assoc($result)){

      ?>
    <!-- Table Content -->
    <tbody>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['namaBarang']; ?></td>
            <td><?php echo $data['jumlahMasuk']; ?></td>
            <td><?php echo $data['tanggalMasuk']; ?></td>
            <?php } ?>
        </tr>
    </tbody>
    </table>
    </div>
    </div>
</div>