<?php foreach ($prodi as $p) { ?>
    <div class="modal fade" id="modalEdit<?= $p['id_prodi'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $p['nama_prodi'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('superadmin/jadwalMataKuliah/editJadwalMatakuliah') ?>" method="POST">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama prodi</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $p['nama_prodi'] ?>" name="nama_prodi">
                                <input type="text" hidden class="form-control" id="exampleInputEmail1" value="<?= $p['id_prodi'] ?>" name="id_prodi">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode Prodi</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" required name="kode_prodi" value="<?= $p['kode_prodi'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select class="form-control" aria-label="Default select example" name="status">
                                    <option>Pilih Status</option>
                                    <option value="0" <?php if ($p['status'] == 0) {
                                                            echo "selected";
                                                        } ?>>Tidak Aktif</option>
                                    <option value="1" <?php if ($p['status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fakultas</label>
                                <select class="form-control" aria-label="Default select example" name="id_fakultas">
                                    <option>Pilih Fakultas</option>
                                    <?php foreach ($fakultas as $f) { ?>
                                        <option value="<?= $f['id_fakultas'] ?>" <?php if ($p['id_fakultas'] == $f['id_fakultas']) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $f['nama_fakultas'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                <select class="form-control" aria-label="Default select example" name="id_jenjang_didik">
                                    <option>Pilih Jenjang</option>
                                    <option value="0" <?php if ($p['id_jenjang_didik'] == 0) {
                                                            echo "selected";
                                                        } ?>>S1</option>
                                    <option value="1" <?php if ($p['id_jenjang_didik'] == 1) {
                                                            echo "selected";
                                                        } ?>>S2</option>
                                    <option value="2" <?php if ($p['id_jenjang_didik'] == 2) {
                                                            echo "selected";
                                                        } ?>>S3</option>
                                </select>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>