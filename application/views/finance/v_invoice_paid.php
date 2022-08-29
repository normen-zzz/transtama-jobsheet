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

                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/invoice/invoicePaid') ?>" method="POST">
                        <h6 class="page-title">Check Invoice</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Shipment ID/DO Number" name="shipment_id">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success">Submit</button>
                                <a href="<?= base_url('finance/invoice/invoicePaid') ?>" class="btn btn-primary"> Reset Filter</a>

                            </div>
                            <?php if (isset($invoice)) {
                            ?>
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td style="font-weight: bold;">No Invoice</td>
                                            <td>: <?= $invoice['no_invoice'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Shipment ID/DO Number</td>
                                            <td>: <?= $shipment_id ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Due Date</td>
                                            <td>: <?= $invoice['due_date'] ?> </td>
                                        </tr>
                                    </table>

                                </div>

                            <?php  }  ?>
                        </div>
                    </form>
                </div>
                <hr>

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
                                                    <th>No Invoice</th>
                                                    <th>Date Created</th>
                                                    <th>Due Date</th>
                                                    <!-- <th>Time Line</th> -->
                                                    <th>Customer Invoice</th>
                                                    <th>Customer Pickup</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($proforma as $j) {
                                                    $total_mepet = 0;


                                                    // echo $perbedaan;
                                                ?>
                                                    <tr>

                                                        <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td>
                                                        <td><?= bulan_indo($j['date']) ?></td>
                                                        <td><?php if ($j['status'] == 2) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                            } else {
                                                                echo  bulan_indo($j['due_date']);
                                                            } ?>
                                                        </td>

                                                        <td><?= $j['customer'] ?></td>
                                                        <td><?= $j['customer_pickup'] ?></td>
                                                        <td>
                                                            <?php if ($j['status'] == 1) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter">Pending</span>';
                                                            } elseif ($j['status'] == 2) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                            } elseif ($j['status'] == 3) {
                                                                echo '<span class="label label-purple label-inline font-weight-lighter">Unpaid</span>';
                                                            }  ?>
                                                        </td>
                                                        <td>
                                                            <a target="blank" href="<?= base_url('finance/invoice/printProformaFull/' . $j['no_invoice']) ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i>PDF </a>
                                                            <a target="blank" href="<?= base_url('finance/invoice/printProformaExcell/' . $j['no_invoice']) ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
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