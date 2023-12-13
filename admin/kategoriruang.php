<div class="container">
<div class="content">
    <h1>Kelola Kategori Ruangan</h1>
    <!-- Row -->
    <div class="row">
      <div class="col-8 mr-5">
          <!-- Button -->
          <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary mb-5 mt-2" data-toggle="modal" data-target="#tambahKategoriRuang">
            <i class="fa fa-plus-circle mr-2"></i>Tambah Data
          </button>
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
      <table class="table">
        <!-- Table Header -->
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
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
          $fetchdata=mysqli_query($koneksi,"Select * from kategoriruangan where namaKategoriRuang like '%$keyword%'");
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from kategoriruangan where namaKategoriRuang like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
        <!-- Table Content -->
        <tbody>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['namaKategoriRuang']; ?></td>
                <td>
                    <a class="btn btn-danger" href="hapuskategoriruang.php?idKategoriRuang=<?php echo $data['idKategoriRuang'];?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"  >
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
          <div class="col-9">
            <!-- Quotes -->
              <span>Catatan: Data-data kategori ini akan otomatis ditambahkan ke pemilihan kategori di bagian penambahan data ruangan</span>
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
<!-- Modals -->
<!-- Modal Insert -->
<div class="modal fade" id="tambahKategoriRuang" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriRuangLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriRuangLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahkategoriruang.php" method="POST">
        <div class="form-group">
          <label for="namaKategoriRuang">Nama Kategori</label>
          <input type="text" class="form-control" id="namaKategoriRuang" name="namaKategoriRuang" placeholder="Masukkan Nama Kategori">
        </div>
      <div class="modal-footer">
      <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>