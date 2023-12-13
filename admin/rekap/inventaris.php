<div class="container">
    <!-- Konten -->
    <div class="content">
        <h1>Data Inventaris</h1>
        <!-- Row -->
        <div class="row">
          <div class="col-8 mr-5">
            <!-- Button -->
            <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success" target="_blank" href="?url=export-inventaris">Print<i class="fa-solid fa-print ml-1"></i></a>
            </div>
          </div>
          <div class="col mb-2">
            <form action="" method="post" class="form-inline">
              <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="searchtxt" placeholder="Cari Data">
                <button type="submit" name="search" class="bg-primary ml-1"><i class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
              </div>
            </form>
          </div>
          
        </div>
        <div class="table-responsive-sm">
          <!-- Tables -->
          <table class="table table-bordered">
          <!-- Table Header -->
          <thead class="thead-dark">
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
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from inventaris where peminjam like '%$keyword%' or petugas like '%$keyword%' or statuspeminjaman like '%$keyword%'");
          //Pagination Config
          $jumlahdata=5;
          $totaldata= mysqli_num_rows($fetchdata);
          $jumlahpagination= ceil($totaldata/$jumlahdata); 

          if (isset($_GET['page'])){
            $active= $_GET['page'];
          }else{
            $active= 1;
          }

          $awalan= ($active*$jumlahdata)-$jumlahdata;
          $link= 3;
          // Link Start
          if ($active > $link) {
            $start= $active - $link;
          }else{
            $start= 1;
          }
          // Link End
          if ($active < ($jumlahpagination-$link)) {
            $end= $active + $link;
          }else{
            $end= $jumlahpagination;
          }
          //End Config
          $fetchdata_limit= mysqli_query($koneksi,"Select * from inventaris where peminjam like '%$keyword%' or petugas like '%$keyword%' or statuspeminjaman like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

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
                  <td>
                    <?php 
                      if ($data['statuspeminjaman']== 'Sedang Dipinjam') {
                    ?>
                        <label class='bg-warning text-light'><?php echo $data['statuspeminjaman']; ?></label>
                    <?php
                      }elseif ($data['statuspeminjaman']== 'Selesai') { ?>
                        <label class='bg-success text-light'><?php echo $data['statuspeminjaman']; ?></label>
                    <?php 
                      }elseif ($data['statuspeminjaman']== 'Terlambat') {
                    ?>
                    <label class='bg-danger text-light'><?php echo $data['statuspeminjaman']; ?></label>
                    <?php } ?>
                  </td>
                  <td><?php echo $data['waktuUpdate']; ?></td>
                  <td><?php echo $data['petugas']; ?></td>
                  
              </tr>
              <?php } ?>
          </tbody>
          </table>
        <!-- End Table -->
        </div>
        <!-- Row -->
        <div class="row">
          <div class="col-9">
            <caption>
              <strong>Keterangan Indikator</strong><br>
              <label class="bg-warning text-light">Sedang Dipinjam</label>: Barang sedang dipinjam oleh peminjam. <br>
              <label class="bg-success text-light">Selesai</label>: Peminjam telah menyelesaikan proses peminjaman tepat waktu.
            </caption>
          </div>
          <div class="col">
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php if ($active > 1) {?>
                  <li class="page-item"><a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $active-1; ?>">&laquo;</a></li>
                <?php } ?>  
                <!-- Generate page from data -->
                <?php for ($i= $start; $i <= $end; $i++) { ?>
                <?php if ($active == $i) : ?>
                  <a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $i; ?>" style="color:white;background:blue;"><?php echo $i; ?></a></li>
                <?php else : ?>
                  <a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
                <?php } ?>
                <?php if ($active < $jumlahpagination) {?>
                  <li class="page-item"><a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $active + 1; ?>">&raquo;</a></li>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>
    </div>
</div>