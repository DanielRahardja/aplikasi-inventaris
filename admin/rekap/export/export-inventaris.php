<div class="container">
	<div class="content">
    <h2>Rekapitulasi Data Inventaris Barang</h2>
        <div class="data-tables datatable-dark" >
            
        <!-- Tables -->
        <table class="table table-bordered">
            <!-- Table Header -->
            <thead class="thead">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Ruang</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Status Peminjaman</th>
                    <th scope="col">Waktu Update</th>
                    <th scope="col">Petugas</th>
                </tr>
            </thead>
            
            <?php 
            
            $fetchInv= mysqli_query($koneksi,"Select * from inventaris");

            //Generate Number
            $nomor=1; 
            // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                    while ($data= mysqli_fetch_assoc($fetchInv)){

            ?>
            <!-- Table Content -->
            <tbody>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data['peminjam']; ?></td>
                    <td><?php echo $data['tanggalpinjam']; ?></td>
                    <td><?php echo $data['tanggalkembali']; ?></td>
                    <td><?php echo $data['barang']; ?></td>
                    <td><?php echo $data['jumlahPinjam']; ?></td>
                    <td><?php echo $data['ruangan']; ?></td>
                    <td><?php echo $data['keperluan']; ?></td>
                    <td><?php echo $data['statuspeminjaman']; ?></td>
                    <td><?php echo $data['waktuUpdate']; ?></td>
                    <td><?php echo $data['petugas']; ?></td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
            
        </div>
    </div>
</div>
<script>
    window.print();
    window.close();
</script>
</body>

</html>