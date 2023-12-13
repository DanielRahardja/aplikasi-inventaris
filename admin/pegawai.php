<div class="container">
    <div class="content">
        <h1><i class="fa-solid fa-clipboard-user fa-sm mr-2"></i>Manajemen pegawai</h1>
        <!-- Row -->
        <div class="row">
          <div class="col-8 mr-5">
              <!-- Button -->
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary mb-5 mt-2" data-toggle="modal" data-target="#tambahPegawai">
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
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Status Akun</th>
                <th scope="col" colspan="3">Action</th>
            </tr>
        </thead>
        
        <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from pegawai where namaPegawai like '%$keyword%'");
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from pegawai where namaPegawai like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
        <!-- Table Content -->
        <tbody>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['namaPegawai']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['jenisKelamin']; ?></td>
                <td><?php echo $data['tanggalLahir']; ?></td>
                <td><?php echo $data['role']; ?></td>
                <td>
                  <!-- Cek Kondisi -->
                  <?php 
                    if ($data['statusAkun']== 'Tidak Aktif') {
                  ?>
                    <label class='text-danger'><?php echo $data['statusAkun']; ?></label>
                    <?php }else { ?>
                      <label class='text-success'><?php echo $data['statusAkun']; ?></label>
                  <?php } ?>
                </td>
                <td>
                    <?php 
                      if ($data['statusAkun']== 'Tidak Aktif') {
                        # code...
                      ?>
                      <a class="btn btn-danger" href="hapuspegawai.php?no=<?php echo $data['no'];?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"  >
                        <i class="fa fa-trash"></i>
                      </a>
                    <?php  
                      }else{
                    ?>
                    
                  <?php
                  }
                  ?>
                </td>
                <td>
                    <button class="btn btn-success" data-toggle="modal" data-target="#updatePegawai<?php echo $data['no']; ?>">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <!-- Modal Update -->
                    <div class="modal fade" id="updatePegawai<?php echo $data['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatePegawaiLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updatePegawaiLabel">Ubah Data Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="updatepegawai.php" method="POST">
                                <input type="hidden" class="form-control" id="nomor" name="no" value="<?php echo $data['no']; ?>" readonly=true>
                                <div class="form-group">
                                  <label for="namaPegawai">Nama Pegawai</label>
                                  <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" value="<?php echo $data['namaPegawai']; ?>"placeholder="Masukkan Nama Pegawai" required>
                                </div>
                                <div class="form-group">
                                  <label for="alamat">Alamat</label>
                                  <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamatnya..."required><?php echo $data['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="alamat">Jenis Kelamin</label>
                                  <!-- Option: Laki-Laki -->
                                  <input class="form-control-input" type="radio" name="jenisKelamin" id="jenisKelamin1" value="Laki-Laki" <?php if($data['jenisKelamin']=='Laki-Laki') echo 'checked'?>>
                                  <label class="form-control-label" for="jenisKelamin1">
                                  Laki-Laki
                                  </label>
                                  <!-- Option: Perempuan -->
                                  <input class="form-control-input" type="radio" name="jenisKelamin" id="jenisKelamin2" value="Perempuan" <?php if($data['jenisKelamin']=='Perempuan') echo 'checked'?>>
                                  <label class="form-control-label" for="jenisKelamin2">
                                  Perempuan
                                  </label>
                                </div>
                                <!-- Setup Query -->
                                <?php 
                                      $userid= mysqli_query($koneksi,"Select * from users where namaAkun='" . $data['namaPegawai'] . "'");
                                      while ($datauserid= mysqli_fetch_assoc($userid)){
                                  ?>
                                <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $datauserid['userid']; ?>" readonly=true>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">----Pilih Role----</option>
                                        <!-- Koneksi Database untuk pengambilan data kategori -->
                                        <?php
                                        $fetchRole= mysqli_query($koneksi,"Select * from privelege");
                                        while ($data2= mysqli_fetch_assoc($fetchRole)){
                                        if ($data['role']== $data2['namaPrivelege']) {
                      
                                        ?>
                                        <option value="<?php echo $data2['namaPrivelege']; ?>" selected><?php echo $data2['namaPrivelege']; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                        <option value="<?php echo $data2['namaPrivelege']; ?>"><?php echo $data2['namaPrivelege']; ?></option>
                                        <?php
                                        }?>
                

                                        <?php } ?>
                                    </select>
                                </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </td>
                <td>
                <?php 
                      if ($data['statusAkun']== 'Aktif') {
                        # code...
                      ?>
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#viewAkun<?php echo $data['namaPegawai']; ?>" title="Lihat Akun">
                        <i class="fa-solid fa-address-card"></i>
                      </button>
                      <!-- Modal View Akun -->
                      <div class="modal fade" id="viewAkun<?php echo $data['namaPegawai']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewAkunLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="viewAkunLabel">Informasi Akun</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                  <form action="hapusakunpegawai.php" method="get">
                                  <div class="form-group">
                                      <label for="namaAkun">Nama Akun</label>
                                      <input type="text" class="form-control" id="namaAkun" name="namaAkun" value="<?php echo $data['namaPegawai']; ?>" readonly>
                                  </div>
                                  <!-- Setup Query -->
                                  <?php 
                                      $selectUser= mysqli_query($koneksi,"Select * from users where namaAkun='" . $data['namaPegawai'] . "'");
                                      while ($data3= mysqli_fetch_assoc($selectUser)){
                                  ?>
                                  <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $data3['userid']; ?>" readonly=true>
                                  <div class="form-group">
                                      <label for="email">E-mail</label>
                                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $data3['email']; ?>" readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="role">Hak Akses</label>
                                      <input type="text" class="form-control" id="role" name="role" value="<?php echo $data3['privelege']; ?>" readonly>
                                  </div>
                                  
                            </div>
                            <div class="modal-footer">
                              <?php 
                                //Fetch User
                                $namaAkun= $_SESSION['namaAkun'];
                                if ($data3['namaAkun']!= $namaAkun) {
                              ?>
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin mau menonaktifkan akun ini?')" >Cabut Akun</button>
                              <?php }else { ?>
                                <button type="submit" class="btn btn-danger" title="Akun Anda" disabled>Cabut Akun</button>                             
                              <?php }
                              } ?>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php }else {
                      ?>
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#tambahAkun<?php echo $data['namaPegawai']; ?>" title="Daftarkan Akun">
                        <i class="fa-solid fa-address-card"></i>
                      </button>
                      <!-- Modal Daftar Akun -->
                    <div class="modal fade" id="tambahAkun<?php echo $data['namaPegawai']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahAkunLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="tambahAkunLabel">Daftar Akun Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="tambahakunpegawai.php" method="POST">
                            <div class="form-group">
                              <label for="username">Nama Pegawai</label>
                              <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['namaPegawai']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="email">Email <small>(wajib)</small></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                              <label for="password">Password <small>(wajib)</small></label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                            </div>
                            <div class="form-group">
                              <label for="role">Role</label>
                              <select class="form-control" name="role" id="role" required>
                                <option value="">----Pilih Role----</option>
                                <!-- Koneksi Database untuk pengambilan data kategori -->
                                <?php
                                $fetchRole1= mysqli_query($koneksi,"Select * from privelege");
                              
                                while ($data2= mysqli_fetch_assoc($fetchRole1)){
                                ?>
                                <option value="<?php echo $data2['namaPrivelege']; ?>"><?php echo $data2['namaPrivelege']; ?></option>

                                <?php } ?>
                              </select>
                            </div>
                          <div class="modal-footer">
                          <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Daftar Akun -->
                      <?php } ?>
                </td>

            </tr>
            <?php } ?>
        </tbody>
        </table>
        <!-- End Table -->
        </div>
        <!-- Row -->
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
<!-- Modals -->
<!-- Modal Insert -->
<div class="modal fade" id="tambahPegawai" tabindex="-1" role="dialog" aria-labelledby="tambahPegawaiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPegawaiLabel">Tambah Data Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahpegawai.php" method="POST">
        <div class="table-responsive">
          <table class="table">
              <tr>
                <td>
                <h2>Data Pegawai</h2>
                <div class="form-group">
                  <label for="namaPegawai">Nama Pegawai</label>
                  <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" placeholder="Masukkan nama pegawai" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamatnya..."required></textarea>
                </div>
                <div class="form-group">
                  <label for="alamat">Jenis Kelamin</label><br>
                  <!-- Option: Laki-Laki -->
                  <input class="form-control-input" type="radio" name="jenisKelamin" id="jenisKelamin1" value="Laki-Laki" checked>
                  <label class="form-control-label" for="jenisKelamin1">
                  Laki-Laki
                  </label><br>
                  <!-- Option: Perempuan -->
                  <input class="form-control-input" type="radio" name="jenisKelamin" id="jenisKelamin2" value="Perempuan">
                  <label class="form-control-label" for="jenisKelamin2">
                  Perempuan
                  </label>
                </div>
                <div class="form-group">
                  <label for="tglLahir">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tglLahir" name="tglLahir" required>
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" name="role" id="role" required>
                    <option value="">----Pilih Role----</option>
                    <!-- Koneksi Database untuk pengambilan data kategori -->
                    <?php
                    $fetchRole1= mysqli_query($koneksi,"Select * from privelege");
                  
                    while ($data2= mysqli_fetch_assoc($fetchRole1)){
                    ?>
                    <option value="<?php echo $data2['namaPrivelege']; ?>"><?php echo $data2['namaPrivelege']; ?></option>

                    <?php } ?>
                  </select>
                </div>
                </td>
                <td>
                <h2>Daftar Akun</h2>
                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email...." required>
                </div>
                <div class="form-group">
                  <label for="psw">Password</label>
                  <input type="password" class="form-control" id="psw" name="psw" placeholder="Masukkan Password....." required>
                </div>
                </td>
              </tr>
          </table>
        </div>
        
      <div class="modal-footer">
      <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Lantai -->