<div class="container">
  <!-- Content -->
  <div class="content">
      <h1><i class="fa-solid fa-box fa-sm mr-2"></i>Data Barang</h1>
      <!-- Row -->
      <div class="row">
          <div class="col-8 mr-5">
              <!-- Button -->
              <div class="btn-group" role="group" aria-label="Basic example">
              
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
      <!-- Tables -->
      <div class="table-responsive-sm">
        <table class="table table-bordered">
        <!-- Table Header -->
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Spesifikasi</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        
        <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from barang where namaBarang like '%$keyword%'");
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from barang where namaBarang like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
        <!-- Table Content -->
        <tbody>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['namaBarang']; ?></td>
                <td><?php echo $data['spesifikasi']; ?></td>
                <td><?php echo $data['kategori']; ?></td>
                <td>
                  <?php 
                    if ($data['stok']== 0) {
                    ?>
                      <label class='text-danger'>Stok Habis</label>
                    <?php
                    }elseif ($data['stok']<= 5) { ?>
                      <label class='text-warning'><?php echo $data['stok']; ?></label>
                    <?php }
                    else{
                      echo $data['stok'];
                    }
                    ?>
              </td>
                <td>
                  <button class="btn btn-success" data-toggle="modal" data-target="#updateBarang<?php echo $data['no']; ?>">
                    <i class="fa fa-cart-plus"></i>
                  </button>
                </td>
                
                <!-- <th>1</th>
                <td>Projector Infocus</td>
                <td>Jakarta</td>
                <td>Alat Presentasi</td>
                <td>
                    <img src="content/images/proyektor.jpg" width="100px" height="100px">
                </td>
                <td><label class="text-danger">Habis</label></td>-->
            </tr>
              <!-- Modal Update -->
              <div class="modal fade" id="updateBarang<?php echo $data['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateBarangLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="updateBarangLabel">Tambah Stok Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form action="tambahstok.php" method="POST">
                      <input type="hidden" id="nomor" name="no" value="<?php echo $data['no']; ?>" readonly=true>
                      <div class="form-group">
                        <label for="namaBarang">Nama Barang</label><br/>
                        <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?php echo $data['namaBarang']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="spesifikasi">Spesifikasi</label>
                        <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"  readonly><?php echo $data['spesifikasi']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="kategori">Kategori</label><br/>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $data['kategori']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label> <br/>
                        <small>stok barang yang tersedia: <?php echo $data['stok']; ?></small>
                        <input type="number" class="form-control" id="stok" name="stok" placeholder="0" value="0" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
      </tbody>
      </table>
    </div>
    <!-- Row -->
    <div class="row">
          <div class="col-5">
            
              
          </div>
          <div class="col-2">
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