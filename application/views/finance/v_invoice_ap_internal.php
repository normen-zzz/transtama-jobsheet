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
                                <button type="submit" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-create-ap"> <i class="fa fa-plus"></i> Create AP</button>
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
                                                    <th>PIC</th>
                                                    <!-- <th>No Invoice</th> -->
                                                    <th>Date Created</th>
                                                    <th>Invoice</th>
                                                    <th>PPN</th>
                                                    <th>PPH</th>
                                                    <th>Total Invoice</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($proforma as $j) {
                                                ?>
                                                    <tr>
                                                        <td><?= $j['vendor'] ?> <br>
                                                            <a href="#"><?= $j['no_invoice'] ?></a>
                                                        </td>
                                                        <td><?= bulan_indo($j['date']) ?></td>
                                                        <td><?= rupiah($j['total_ap']) ?></td>
                                                        <td><?= rupiah($j['ppn']) ?></td>
                                                        <td><?= rupiah($j['pph']) ?></td>
                                                        <td><?= rupiah(($j['total_ap']) - $j['pph'] - $j['ppn']) ?></td>

                                                        <td>
                                                            <?php if ($j['status'] == 0) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter">Pending</span>';
                                                            } elseif ($j['status'] == 1) {
                                                                echo "<span class='label label-success label-inline font-weight-lighter'>Paid</span> <br>";
                                                                echo bulan_indo($j['payment_date']);
                                                            ?>
                                                            <?php  } elseif ($j['status'] == 2) {
                                                                echo '<span class="label label-purple label-inline font-weight-lighter">Unpaid</span>';
                                                            }  ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($j['status'] == 1) {
                                                            ?>
                                                                <a href="<?= base_url('finance/ap/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <?php  } else {
                                                            ?>
                                                                <a href="<?= base_url('finance/ap/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit</a>
                                                                <button data-toggle="modal" data-target="#modal-paid<?= $j['id_invoice'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Paid</button>
                                                            <?php } ?>
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



<?php foreach ($proforma as $j) {
?>
    <div class="modal fade" id="modal-paid<?= $j['id_invoice'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proof of Payment with no <b><?= $j['no_invoice'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/ap/paid') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" required>
                            <input type="text" hidden class="form-control" name="unique_invoice" value="<?= $j['unique_invoice'] ?>" required>

                        </div>
                        <!-- <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Time</label>
                            <input type="time" class="form-control" name="payment_time" required>

                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-lg-right font-weight-bold">Upload Proof</label>
                            <input type="file" id="input-file-now" name="ktp[]" accept="image/*" multiple />
                        </div> -->
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


<div class="modal fade" id="modal-create-ap">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create AP Internal </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/ap/paid') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="due_date" class="font-weight-bold">PIC</label>
                        <input type="text" class="form-control" name="pic" required>
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