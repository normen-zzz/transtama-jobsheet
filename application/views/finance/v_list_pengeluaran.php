<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark"><?= $title ?></h3>
                        <!-- <span class="text-muted font-weight-bold font-size-sm mt-1">Take Easy To Create Ap</span> -->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-inline-block align-items-center">
                            <button data-toggle="modal" data-target="#modal-add" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"> <i class="fa fa-plus"></i> Add</button>
                        </div>

                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="myTable">
                        <thead>
                            <tr>
                                <th>Nama Pengeluaran</th>
                                <th>Kode</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ap as $c) {
                            ?>
                                <tr>
                                    <td><?= $c['nama_kategori_pengeluaran'] ?></td>
                                    <td><?= $c['kode_kategori'] ?></td>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#modal-paid<?= $c['id_kategori'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Edit</a>
                                        <!-- <a href="<?= base_url('finance/ap/detail/' . $c['id_kategori']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">D</a> -->


                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>



<?php foreach ($ap as $c) {

?>
    <div class="modal fade" id="modal-paid<?= $c['id_kategori'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <b><?= $c['nama_kategori_pengeluaran'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/ap/editKategori') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Nama Pengeluaran</label>
                            <input type="text" class="form-control" name="nama_kategori_pengeluaran" value="<?= $c['nama_kategori_pengeluaran'] ?>" required>
                            <input type="text" hidden class="form-control" name="id_kategori" value="<?= $c['id_kategori'] ?>" required>

                        </div>
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Kode Pengeluaran</label>
                            <input type="text" class="form-control" name="kode_kategori" required value="<?= $c['kode_kategori'] ?>">

                        </div>

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

<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah List Pengeluaran </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/ap/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">Nama Kategori</label>
                                <input type="text" class="form-control" name="nama_kategori_pengeluaran" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">Kode Kategori</label>
                                <input type="text" class="form-control" name="kode_kategori">
                            </div>
                        </div>
                    </div>

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