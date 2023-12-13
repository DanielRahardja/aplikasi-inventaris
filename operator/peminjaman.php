<div class="container">
    <div class="content">
      <h1>Data Inventaris: Peminjaman Barang</h1>
      <!-- Row -->
      <div class="row">
          <div class="col-9">
          <!-- Button -->
          <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success mb-5 mt-2 mr-2" href="?url=inventaris">
              <i class="fa fa-backward mr-2"></i>Kembali
            </a>
          </div>
          </div>
          <div class="col mb-2">
          <form action="" method="post">
              <input type="text" name="searchtxt" placeholder="Cari Data">
              <button type="submit" name="search" class="bg-primary"><i class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
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
              <th scope="col">Barang</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Ruang</th>
              <th scope="col">Keperluan</th>
          </tr>
      </thead>
      
      <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from pinjam where peminjam like '%$keyword%'");
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from pinjam where peminjam like '%$keyword%' limit $awalan,$jumlahdata");

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
              <td><?php echo $data['tanggalPinjam']; ?></td>
              <td><?php echo $data['barang']; ?></td>
              <td><?php echo $data['jumlah']; ?></td>
              <td><?php echo $data['ruang']; ?></td>
              <td><?php echo $data['keperluan']; ?></td>
              <?php } ?>
          </tr>
      </tbody>
      </table>
      <!-- End Table -->
      </div>
      <div class="row">
          <div class="col-9">
            
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