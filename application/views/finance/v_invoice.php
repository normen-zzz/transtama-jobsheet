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
                    <form action="<?= base_url('finance/invoice/final') ?>" method="POST">
                        <h6 class="page-title">Check Invoice</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Shipment ID/DO Number" name="shipment_id">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success">Submit</button>
                                <a href="<?= base_url('finance/jobsheet') ?>" class="btn btn-primary"> Reset Filter</a>

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

                                    <form action="<?= base_url('finance/Invoice/paidInvoice') ?>">

                                        <table id="tableInvoice" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>No Invoice</th>
                                                    <th>Date Created</th>
                                                    <th>Due Date</th>
                                                    <th>Time Line</th>
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

                                                    $tgl1 = strtotime(date('Y-m-d'));
                                                    $tgl2 = strtotime($j['due_date']);

                                                    $jarak = $tgl2 - $tgl1;

                                                    $perbedaan = $jarak / 60 / 60 / 24;

                                                    if ($perbedaan <= 7) {
                                                        $total_mepet = $total_mepet + 1;
                                                    }
                                                    // echo $total_mepet;
                                                ?>
                                                    <tr>

                                                        <!-- <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td> -->
                                                        <td><input type="checkbox" value="<?= $j['no_invoice'] ?>" name="no_invoice" id="no_invoice"></td>
                                                        <td><a target="blank" href="<?= 'https://tesla-smartwork.transtama.com/Invoice/printProforma/' . $j['no_invoice'] ?>"><?= $j['no_invoice'] ?></a> </td>
                                                        <td><?= bulan_indo($j['date']) ?></td>
                                                        <td><?php if ($j['status'] == 2) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                            } else {
                                                                echo  bulan_indo($j['due_date']);
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($j['status'] == 2) {
                                                                echo '<span class="text-success">Paid</span> ';
                                                            } else {
                                                                if ($perbedaan <= 7) {
                                                                    $total_mepet = $total_mepet + 1;
                                                            ?>
                                                                    <span data-perbedaan="<?= $total_mepet ?>" id="the-span"></span>
                                                                <?php   }


                                                                if ($perbedaan < 0) {
                                                                    $total_mepet += 1;
                                                                    echo '<span class="text-danger">Expired</span> 
																	<br> Please Follow up This invoice';
                                                                ?>
                                                            <?php
                                                                } elseif ($perbedaan <= 7 || $perbedaan >= 0) {
                                                                    echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                } else {
                                                                    echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                }
                                                            }
                                                            ?>
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
                                                            <?php if ($j['status'] == 2) {
                                                            ?>
                                                                <a href="<?= base_url('finance/invoice/detailInvoice/' . $j['id_invoice'] . '/' . $j['no_invoice']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <?php  } else {
                                                            ?>
                                                                <a href="<?= base_url('finance/invoice/detailInvoice/' . $j['id_invoice'] . '/' . $j['no_invoice']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <a href="<?= base_url('finance/invoice/editInvoice/' . $j['id_invoice'] . '/' . $j['no_invoice']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit</a>
                                                                <button data-toggle="modal" data-target="#modal-paid<?= $j['no_invoice'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Paid</button>
                                                            <?php } ?>
                                                            <a target="blank" href="<?= base_url('finance/invoice/printProformaFull/' . $j['no_invoice']) ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i>PDF </a>
                                                            <!-- <a target="blank" href="<?= base_url('finance/invoice/printProformaExcell/' . $j['no_invoice']) ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a> -->
                                                            <a target="blank" href="<?= 'https://tesla-smartwork.transtama.com/Invoice/printProformaExcell/'.$j['no_invoice'] ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
                                                        </td>

                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                        </form>

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




