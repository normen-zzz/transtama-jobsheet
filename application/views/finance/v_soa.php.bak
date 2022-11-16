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
                                <a target="blank" href="<?= base_url('finance/invoice/exportSoa/') ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
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
                                                    <th>Customers</th>
                                                    <th>No Invoice</th>
                                                    <th>Shipment</th>
                                                    <!-- <th>Date Created</th> -->
                                                    <th>Due Date</th>
                                                    <th>Tagihan(Rp)</th>
                                                    <th>Invoice</th>
                                                    <th>PPN</th>
                                                    <th>PPH 23</th>
                                                    <th>Total After PPH</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($proforma as $j) {

                                                ?>
                                                    <tr>

                                                        <td><?= $j['customer'] ?></td>
                                                        <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td>
                                                        <td><?= bulan($j['shipment']) ?></td>
                                                        <td><?php
                                                            echo  bulan_indo($j['due_date']);
                                                            ?>
                                                        </td>
                                                        <td><?= rupiah($j['total_invoice']) ?></td>
                                                        <td><?= rupiah($j['invoice']) ?></td>
                                                        <td><?= rupiah($j['ppn']) ?></td>
                                                        <td><?= rupiah($j['pph']) ?></td>
                                                        <td><?php $total = $j['total_invoice'] - $j['pph'];
                                                            echo rupiah($total) ?></td>
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
    <div class="modal fade" id="modal-paid<?= $j['no_invoice'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proof of Payment with no <b><?= $j['no_invoice'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/invoice/paid') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" required>
                            <input type="text" hidden class="form-control" name="no_invoice" value="<?= $j['no_invoice'] ?>" required>

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