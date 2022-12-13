<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <form action="<?= base_url('cs/apExternal/processEditAp') ?>" method="POST">
                <input type="text" hidden name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                <div class="card-body">
                    <div class="content-header">
                        <center>
                            <h3 class="page-title text-center">DETAIL PO <?= $vendor['nama_vendor']
                                                                            ?> </h3>
                            <span class="text"><?= $vendor['alamat'] ?></span> - <?php if ($vendor['type'] == 0) {
                                                                                    ?>
                                <span>Vendor</span>

                            <?php  } else {
                            ?>
                                <span>Agent</span>
                            <?php  } ?>
                        </center>
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">

                                <div class="d-inline-block align-items-center">
                                    <a href="<?= base_url('cs/apExternal/created') ?>" class="btn text-light" style="background-color: #9c223b;">
                                        <i class="fa fa-arrow-left"></i>
                                        Back</a>
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
                                            <table class="table table-bordered" style="width:100%" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>Vendor</th> -->
                                                        <th>AWB</th>
                                                        <th>DATE</th>
                                                        <th>CONSIGNEE</th>
                                                        <th>COLLY</th>
                                                        <th>WEIGHT JS</th>
                                                        <!-- <th>WEIGHT MSR</th> -->
                                                        <th>FLIGHT SMU</th>
                                                        <th>HD Daerah</th>
                                                        <th>OTHERS</th>
                                                        <th>TOTAL AMOUNT</th>
                                                        <!-- <th>VARIABEL</th>
                                                        <th>DIFFERENCE</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_koli = 0;
                                                    $total_weight = 0;
                                                    $total_special_weight = 0;
                                                    $total_amount = 0;
                                                    $total_smu = 0;
                                                    $sub_total_smu = 0;
                                                    $total_hd_daerah = 0;
                                                    $sub_total_hd_daerah = 0;
                                                    $others = 0;
                                                    $no = 1;
                                                    foreach ($invoice as $inv) {
                                                        $total_sales = 0;

                                                    ?>
                                                        <tr>

                                                            <td><?= $inv['resi'] ?> <br> <small><?= $inv['shipper'] ?></small> </td>
                                                            <td><?= bulan_indo($inv['tgl_pickup']) ?></td>
                                                            <td><?= $inv['consigne'] ?>-<?= $inv['tree_consignee'] ?></td>
                                                            <td><?= $inv['koli'] ?></td>
                                                            <td><?= $inv['berat_js'] ?></td>
                                                            <td><?= rupiah($inv['flight_msu2']) ?></td>
                                                            <td><?= rupiah($inv['hd_daerah2']) ?></td>
                                                            <td><?= rupiah((int)$inv['others2']) ?></td>
                                                            <td><?= rupiah($inv['flight_msu2'] + $inv['hd_daerah2'] + (int)$inv['others2']) ?></td>
                                                        </tr>
                                                        <input hidden type="text" name="shipment_id[]" value="<?= $inv['id'] ?>">
                                                        <input hidden type="text" name="id_invoice[]" value="<?= $inv['id_invoice'] ?>">
                                                        <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                        <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">

                                                    <?php
                                                        $total_koli = $total_koli + $inv['koli'];
                                                        $total_weight = $total_weight + $inv['berat_js'];
                                                        $total_special_weight = $total_special_weight + $inv['berat_msr'];

                                                        $total_smu = $total_smu + $inv['flight_msu2'];
                                                        $total_hd_daerah =  $total_hd_daerah + $inv['hd_daerah2'];

                                                        $sub_total_smu = $sub_total_smu +  $inv['flight_msu2'] + (int)$inv['others2'];
                                                        $sub_total_hd_daerah = $sub_total_hd_daerah + $inv['flight_msu2'] +  $inv['hd_daerah2'] + (int)$inv['others2'];

                                                        $others =  $others + (int)$inv['others2'];
                                                        $no++;
                                                    } ?>


                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">TOTAL <?= $no - 1 ?> AWB</td>
                                                        <td><?= $total_koli ?> </td>
                                                        <td><?= $total_weight ?> </td>
                                                        <td><?= rupiah($total_smu) ?></td>
                                                        <td><?= rupiah($total_hd_daerah) ?></td>

                                                        <td><?= rupiah($others) ?> </td>


                                                        <td><?= rupiah($sub_total_hd_daerah) ?></td>


                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <br>
                                            <h3 class="title text-center"><i class="fa fa-info"></i> PO INFORMATION</h3>
                                            <br>

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>

                                <div class="row">
                                    <?php
                                    $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);

                                    $terbilang = $f->format($sub_total_hd_daerah) . ' Rupiahs';
                                    $terbilang = ucwords($terbilang);


                                    if ($vendor['type'] == 0) {
                                    ?>
                                        <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_smu ?>">
                                    <?php  } else {
                                    ?>
                                        <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_hd_daerah ?>">

                                    <?php   }

                                    ?>
                                    <input type="text" class="form-control" name="terbilang" hidden value="<?= $terbilang ?>">
                                    <input type="text" class="form-control" name="unique_invoice" hidden value="<?= $inv['unique_invoice'] ?>">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
                                            <textarea class="form-control" required name="purpose"><?= $inv['purpose'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="pic" class="font-weight-bold">No. Invoice</label>
                                        <input type="text" name="no_invoice" disabled value="<?= $inv['no_invoice'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Other (Rp.) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" required name="other" value="<?= $inv['other'] ?>"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Due Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" required name="other" value="<?= $inv['due_date'] ?>"></input>
                                        </div>
                                    </div>


                                    <div class="col-md-4" id="mode">
                                        <label for="note_cs">Payment Mode</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mode" value="0" <?php if ($inv['mode'] == 0) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                            <label class="form-check-label" for="mode1">
                                                Cash
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mode" value="1" <?php if ($inv['mode'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                            <label class="form-check-label" for="mode2">
                                                Bank Transfer
                                            </label>
                                        </div>
                                    </div>


                                    <?php if ($inv['mode'] == 1) {
                                    ?>
                                        <div class="col-md-4">
                                            <div class=" form-group">
                                                <label for="exampleInputEmail1">Via</label>
                                                <input type="text" name="via" class="form-control" value="<?= $inv['via_transfer'] ?>">
                                            </div>
                                        </div>

                                    <?php  } ?>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mr-auto">
                                            <h3 class="page-title text-center">PAYMENT STATUS PO <?= $vendor['nama_vendor']
                                                                                                    ?> </h3>
                                            <div class="d-inline-block align-items-center">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($inv['status'] == 4) {
                                        ?>
                                            <div class="d-flex align-items-center flex-wrap mb-8">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50 symbol-light mr-5 bg-success">
                                                    <span class="symbol-label  bg-success">
                                                        <i class="fa fa-check text-light"></i>
                                                    </span>
                                                </div>
                                                <!--begin::Text-->

                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <a href="#" data-toggle="modal" data-target="#modal-paid<?= $inv['no_invoice'] ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Paid</a>
                                                    <?php
                                                    $due_date = new DateTime($inv['due_date']);
                                                    $date = date('Y-m-d');
                                                    $date = new DateTime($date);
                                                    $perbedaan = $due_date->diff($date)->format("%a");
                                                    ?>
                                                    <span class="text-success font-weight-bold"><?= bulan_indo($inv['payment_date']) ?></span>
                                                </div>
                                                <!--end::Text-->
                                                <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                    <?= rupiah($sub_total_hd_daerah) ?>

                                                </span>

                                            </div>
                                        <?php } else {
                                        ?>

                                            <div class="d-flex align-items-center flex-wrap mb-8">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50 symbol-light mr-5 bg-danger">
                                                    <span class="symbol-label  bg-danger">
                                                        <i class="fa fa-window-close text-light"></i>
                                                    </span>
                                                </div>
                                                <!--begin::Text-->

                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Unpaid</a>
                                                    <?php
                                                    $due_date = new DateTime($inv['due_date']);
                                                    $date = date('Y-m-d');
                                                    $date = new DateTime($date);
                                                    $perbedaan = $due_date->diff($date)->format("%a");
                                                    ?>
                                                    <!-- <span class="text-muted font-weight-bold"><?= $perbedaan ?> Days Again</span> -->
                                                </div>
                                                <!--end::Text-->
                                                <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                    <?= rupiah($sub_total_hd_daerah + $inv['other']) ?>
                                                </span>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>