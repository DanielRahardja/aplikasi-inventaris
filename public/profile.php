<div class="container">
    <div class="content">
        <h1><i class="fa-solid fa-address-card fa-sm mr-2"></i>Profile</h1>
        <form>
        <!-- Untuk Pegawai -->
        <?php
            $namaAkun= $_SESSION['namaAkun'];
            //Pegawai
            $pegawai= mysqli_query($koneksi,"Select * from pegawai where namaPegawai='".$namaAkun."'");
            if (mysqli_num_rows($pegawai) == 1) {
                while ($data2= mysqli_fetch_assoc($pegawai)){ //Begin while result user
            ?>
                <div class="form-group row">
                    <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="namaLengkap" value="<?php echo $data2['namaPegawai']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="alamat" value="<?php echo $data2['alamat']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="jenisKelamin" value="<?php echo $data2['jenisKelamin']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tglLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="tglLahir" value="<?php echo $data2['tanggalLahir']; ?>">
                    </div>
                </div>
            <?php
                }
            }
        ?>
        <!-- Untuk User -->
        <?php
            //User 
            $result= mysqli_query($koneksi,"Select * from users where namaAkun='".$namaAkun."'");
            if (mysqli_num_rows($result) == 1) {
                while ($data= mysqli_fetch_assoc($result)){ //Begin while result user
            ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="email" value="<?php echo $data['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akses" class="col-sm-2 col-form-label">Akses</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control-plaintext" id="akses" value="<?php echo $data['privelege']; ?>">
                    </div>
                </div>
            <?php         
                }
            }//End while result user
            
        ?>
        </form>
    </div>
</div>