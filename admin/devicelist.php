<!-- Content -->
<div class="container">
  <div class="content">
      <h1>Kelola Alat</h1>
      <!-- Row -->
      <div class="row">
          <div class="col-8 mr-5">
              <!-- Button -->
              <div class="btn-group" role="group" aria-label="Basic example">
              <a class="btn btn-info" href="?url=kategoridevice">Kategori Device<i class="fa fa-list ml-2"></i></a>
              <a class="btn btn-info ml-2" href="?url=device">Device<i class="fa fa-list ml-2"></i></a>
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
      
      <div class="table-responsive">
        <!-- Tables -->
        <table class="table">
          <!-- Table Header -->
          <thead class="thead-dark">
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Tipe</th>
                  <th scope="col">Kode Device</th>
                  <th scope="col">Jumlah Device</th>
                  <th scope="col">View Data</th>
              </tr>
          </thead>
          
          <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from kategoridevice where namaTipe like '%$keyword%'");
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from kategoridevice where namaTipe like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
          <!-- Table Content -->
          <tbody>
              <tr>
                  <td><?php echo $nomor++; ?></td>
                  <td><?php echo $data['namaTipe']; ?></td>
                  <td><?php echo $data['kode']; ?></td>
                  <td>
                  <?php 
                        $namaTipe = mysqli_real_escape_string($koneksi, $data['namaTipe']);
                        $hitungalat = mysqli_query($koneksi, "SELECT * FROM device WHERE tipedevice = '$namaTipe'");
                        $totAlat= mysqli_num_rows($hitungalat);
                        echo $totAlat;
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-success" href="?url=device&no=<?php echo $data['no'];?>" >
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                  <?php } ?>
              </tr>
          </tbody>
        </table>
      </div>
      <!-- Row -->
    <div class="row">
      <div class="col-8">
        
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
<!-- Modals -->
<!-- Modal Insert -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahkategori.php" method="POST">
        <div class="form-group">
          <label for="namaKategori">Nama Kategori</label>
          <input type="text" class="form-control" id="namaKategori" name="namaKategori" placeholder="Masukkan Nama Kategori">
        </div>
      <div class="modal-footer">
      <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>