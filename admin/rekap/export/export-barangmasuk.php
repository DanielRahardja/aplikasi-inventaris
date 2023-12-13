<div class="container">
  <div class="content">
      <h1>Rekap Barang Masuk</h1>
      <div class="table-responsive">
          <!-- Tables -->
      <table class="table">
      <!-- Table Header -->
      <thead class="thead-dark">
          <tr>
              <th scope="col">No</th>
              <th scope="col">Barang</th>
              <th scope="col">Tambah Stok</th>
              <th scope="col">Supplier</th>
              <th scope="col">Waktu</th>
          </tr>
      </thead>
      
      <?php 
            
            $fetchBM= mysqli_query($koneksi,"Select * from masukbarang");

            //Generate Number
            $nomor=1; 
            // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                    while ($data= mysqli_fetch_assoc($fetchBM)){

            ?>
      <!-- Table Content -->
      <tbody>
          <tr>
              <td><?php echo $nomor++; ?></td>
              <td><?php echo $data['namaBarang']; ?></td>
              <td><?php echo $data['jumlahMasuk']; ?></td>
              <td><?php echo $data['supplier']; ?></td>
              <td><?php echo $data['tanggalMasuk']; ?></td>
              <?php } ?>
          </tr>
      </tbody>
      </table>
      </div>
  </div>
</div>
<script>
    window.print();
    window.close();
</script>