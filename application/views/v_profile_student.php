<!--begin::Content-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <?php
                                // var_dump($mahasiswa);
                                ?>
                                <h4 class="modal-title">Edit Data <?= $mahasiswa['nm_pd'] ?></h4>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body  with-border">

                                <form action="<?= base_url('profileStudent/editUser') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12 border-bottom-dark border-1">
                                                <p class="h3 mb-3 ">Data Profile</p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Email</label>
                                                    <input type="text" hidden class="form-control" value="<?= $mahasiswa['id_user'] ?>" name="id_user">
                                                    <input type="text" hidden class="form-control" value="<?= $mahasiswa['id'] ?>" name="id">
                                                    <input type="email" class="form-control" value="<?= $mahasiswa['email'] ?>" name="email">
                                                </div>

                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Foto</label>
                                                    <input type="file" class="form-control" name="file">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" placeholder="Isi jika password ingin diubah" name="password">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" required name="nm_pd" value="<?= $mahasiswa['nm_pd'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                            <select class="form-control" aria-label="Default select example" name="jk">
                                                                <option value="L" <?php if ($mahasiswa['jk'] == 'L') {
                                                                                        echo 'selected';
                                                                                    } ?>>Laki-Laki</option>
                                                                <option value="P" <?php if ($mahasiswa['jk'] == 'P') {
                                                                                        echo 'selected';
                                                                                    } ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NISN</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nisn" value="<?= $mahasiswa['nisn'] ?>">
                                                            <input type="text" class="form-control" id="exampleInputEmail1" hidden required name="id" value="<?= $mahasiswa['id'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIRM</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nirm" value="<?= $mahasiswa['nirm'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIRL</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nirl" value="<?= $mahasiswa['nirl'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">PIN</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="pin" value="<?= $mahasiswa['pin'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NPWP</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="npwp" value="<?= $mahasiswa['npwp'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIK</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" required name="nik" value="<?= $mahasiswa['nik'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" required name="tmpt_lahir" value="<?= $mahasiswa['tmpt_lahir'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="exampleInputEmail1" required name="tgl_lahir" value="<?= $mahasiswa['tgl_lahir'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID KK</label>
                                                            <input type="number" class="form-control" id="exampleInputEmail1" required name="id_kk" value="<?= $mahasiswa['id_kk'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Alamat</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="jln" value="<?= $mahasiswa['jln'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Agama</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_agama">
                                                                <?php foreach ($agama as $a) { ?>
                                                                    <option value="<?= $a['id_agama'] ?>"><?= $a['nm_agama'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">RT</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="rt" value="<?= $mahasiswa['rt'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">RW</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="rw" value="<?= $mahasiswa['rw'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Kelurahan</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="ds_kel" value="<?= $mahasiswa['ds_kel'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Kode POS</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="kode_pos" value="<?= $mahasiswa['kode_pos'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jenis Tinggal</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_jns_tinggal">
                                                                <?php foreach ($jenis_tinggal as $jt) { ?>
                                                                    <option value="<?= $jt['id_jns_tinggal'] ?>" <?php if ($mahasiswa['id_jns_tinggal'] == $jt['id_jns_tinggal']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $jt['nm_jns_tinggal'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Alat Transportasi</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_alat_transport">
                                                                <?php foreach ($alat_transportasi as $at) { ?>
                                                                    <option value="<?= $at['id_alat_transport'] ?>" <?php if ($mahasiswa['id_alat_transport'] == $at['id_alat_transport']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $at['nm_alat_transport'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Telpon Rumah</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="no_tel_rmh" value="<?= $mahasiswa['no_tel_rmh'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nomor Handphone</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" value="<?= $mahasiswa['no_hp'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email</label>
                                                            <input type="email" class="form-control" id="exampleInputEmail1" required name="email" value="<?= $mahasiswa['email'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- biodata ayah -->
                                                <div class="row">
                                                    <div class="col-12 border-bottom-dark border-1">
                                                        <p class="h3 mb-3 ">Data Ayah</p>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIK ayah</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nik_ayah" value="<?= $mahasiswa['nik_ayah'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama ayah</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nm_ayah" value="<?= $mahasiswa['nm_ayah'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tanggal Lahir ayah</label>
                                                            <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_lahir_ayah" value="<?= $mahasiswa['tgl_lahir_ayah'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_jenjang_pendidikan_ayah">
                                                                <?php foreach ($jenjang_pendidikan as $jp) { ?>
                                                                    <option value="<?= $jp['id_jenj_didik'] ?>" <?php if ($mahasiswa['id_jenjang_pendidikan_ayah'] == $jp['id_jenj_didik']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $jp['nm_jenj_didik'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pekerjaan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_pekerjaan_ayah">
                                                                <?php foreach ($pekerjaan as $pj) { ?>
                                                                    <option value="<?= $pj['id_pekerjaan'] ?>" <?php if ($mahasiswa['id_pekerjaan_ayah'] == $pj['id_pekerjaan']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $pj['nm_pekerjaan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Penghasilan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_penghasilan_ayah">
                                                                <?php foreach ($penghasilan as $ph) { ?>
                                                                    <option value="<?= $ph['id_penghasilan'] ?>" <?php if ($mahasiswa['id_penghasilan_ayah'] == $ph['id_penghasilan']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $ph['nm_penghasilan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- data ibu -->
                                                <div class="row">
                                                    <div class="col-12 border-bottom-dark border-1">
                                                        <p class="h3 mb-3 ">Data Ibu</p>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIK Ibu</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nik_ibu" value="<?= $mahasiswa['nik_ibu'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Ibu</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nm_ibu_kandung" value="<?= $mahasiswa['nm_ibu_kandung'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tanggal Lahir Ibu</label>
                                                            <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_lahir_ibu" value="<?= $mahasiswa['tgl_lahir_ibu'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_jenjang_pendidikan_ibu">
                                                                <?php foreach ($jenjang_pendidikan as $jp) { ?>
                                                                    <option value="<?= $jp['id_jenj_didik'] ?>" <?php if ($mahasiswa['id_jenjang_pendidikan_ibu'] == $jp['id_jenj_didik']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $jp['nm_jenj_didik'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pekerjaan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_pekerjaan_ibu">
                                                                <?php foreach ($pekerjaan as $pj) { ?>
                                                                    <option value="<?= $pj['id_pekerjaan'] ?>" <?php if ($mahasiswa['id_pekerjaan_ibu'] == $pj['id_pekerjaan']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $pj['nm_pekerjaan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Penghasilan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_penghasilan_ibu">
                                                                <?php foreach ($penghasilan as $ph) { ?>
                                                                    <option value="<?= $ph['id_penghasilan'] ?>" <?php if ($mahasiswa['id_penghasilan_ibu'] == $ph['id_penghasilan']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $ph['nm_penghasilan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- biodata wali -->
                                                <div class="row">
                                                    <div class="col-12 border-bottom-dark border-1">
                                                        <p class="h3 mb-3 ">Data Wali</p>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIK wali</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nik_wali" value="<?= $mahasiswa['nik_wali'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama wali</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nm_wali" value="<?= $mahasiswa['nm_wali'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tanggal Lahir wali</label>
                                                            <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_lahir_wali" value="<?= $mahasiswa['tgl_lahir_wali'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_jenjang_pendidikan_wali">
                                                                <?php foreach ($jenjang_pendidikan as $jp) { ?>
                                                                    <option value="<?= $jp['id_jenj_didik'] ?>" <?php if ($mahasiswa['id_jenjang_pendidikan_wali'] == $jp['id_jenj_didik']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $jp['nm_jenj_didik'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pekerjaan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_pekerjaan_wali">
                                                                <?php foreach ($pekerjaan as $pj) { ?>
                                                                    <option value="<?= $pj['id_pekerjaan'] ?>" <?php if ($mahasiswa['id_pekerjaan_wali'] == $pj['id_pekerjaan']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?= $pj['nm_pekerjaan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Penghasilan</label>
                                                            <select class="form-control" aria-label="Default select example" name="id_penghasilan_wali">
                                                                <?php foreach ($penghasilan as $ph) { ?>
                                                                    <option value="<?= $ph['id_penghasilan'] ?>" <?php if ($mahasiswa['id_penghasilan_wali'] == $ph['id_penghasilan']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $ph['nm_penghasilan'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Kewarganegaraan</label>
                                                            <select class="form-control" aria-label="Default select example" name="kewarganegaraan">
                                                                <?php foreach ($kewarganegaraan as $k) { ?>
                                                                    <option value="<?= $k['kewarganegaraan'] ?>" <?php if ($mahasiswa['kewarganegaraan'] == $k['kewarganegaraan']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= $k['nm_wil'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->


                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
</div>