<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title"><?= $title; ?></h3>
                            <div class="d-inline-block align-items-center">
                                <button data-toggle="modal" data-target="#modal-add" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"> <i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">

                                        <table id="table" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Vendor</th>
                                                   
                                                    <th>Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($vendors as $j) {
                                                ?>
                                                    <tr>
                                                        <td><?= $j['nama_vendor'] ?></td>
                                                       
                                                        <td><?php if ($j['type'] == 0) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter">Vendor</span>';
                                                            } else {

                                                                echo '<span class="label label-danger label-inline font-weight-lighter">Agent</span>';
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <!-- <a href="<?= base_url('finance/vendor/delete/' . $j['id_vendor']) ?>" class="btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;"><i class="fa fa-trash"></i></a> -->
                                                            <button data-toggle="modal" data-target="#modal-paid<?= $j['id_vendor'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"><i class="fa fa-pen"></i></button>
                                                        </td>

                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>



<?php foreach ($vendors as $j) {
?>
    <div class="modal fade" id="modal-paid<?= $j['id_vendor'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <b><?= $j['nama_vendor'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('cs/vendor/edit') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="font-weight-bold">Vendor/Agent Name</label>
                                        <input type="text" class="form-control" name="nama_vendor" value="<?= $j['nama_vendor'] ?>">
                                        <input type="text" class="form-control" name="id_vendor" hidden value="<?= $j['id_vendor'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="font-weight-bold">PIC</label>
                                        <input type="text" class="form-control" name="pic" value="<?= $j['pic'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="font-weight-bold">No. Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening" value="<?= $j['no_rekening'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="font-weight-bold">Type</label>
                                        <select name="type" class="form-control" style="width:200px;">
                                            <option value="0" <?php if ($j['type'] == 0) {
                                                                    echo 'selected';
                                                                } ?>>Vendor</option>
                                            <option value="1" <?php if ($j['type'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>Agent</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">Address</label>
                                <textarea class="form-control" name="alamat"><?= $j['alamat'] ?></textarea>
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
    <!-- /.modal -->

<?php } ?>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Vendors/Agents </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('cs/vendor/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">Vendor/Agent Name</label>
                                <input type="text" class="form-control" name="nama_vendor" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">PIC</label>
                                <input type="text" class="form-control" name="pic">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">No. Rekening</label>
                                <input type="text" class="form-control" name="no_rekening">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">Type</label>
                                <select name="type" class="form-control" style="width:200px;" required>
                                    <option value="0">Vendor</option>
                                    <option value="1">Agent</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date" class="font-weight-bold">Address</label>
                        <textarea class="form-control" name="alamat"></textarea>
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