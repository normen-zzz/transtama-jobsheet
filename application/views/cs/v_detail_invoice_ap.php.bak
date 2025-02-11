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
                            <h3 class="page-title text-center">EDIT PO <?= $vendor['nama_vendor']
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
                                                        <th>AWB</th>
                                                        <th>DATE</th>
                                                        <th>CONSIGNEE</th>
                                                        <th>COLLY</th>
                                                        <th>WEIGHT JS</th>
                                                        <!-- <th>WEIGHT MSR</th> -->
                                                        <?php if ($vendor['type'] == 0) {
                                                        ?>
                                                            <th>FLIGHT SMU</th>

                                                        <?php  } else {
                                                        ?>
                                                            <th>HD Daerah</th>
                                                        <?php  } ?>
                                                        <th>OTHERS</th>
                                                        <th>TOTAL AMOUNT</th>
                                                        <!-- <th>VARIABEL</th> -->
                                                        <!-- <th>DIFFERENCE</th> -->
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

                                                            <?php if ($vendor['type'] == 0) {
                                                            ?>
                                                                <td><?= rupiah($inv['flight_msu2']) ?></td>
                                                            <?php  } else {
                                                            ?>
                                                                <td><?= rupiah($inv['hd_daerah2']) ?></td>
                                                            <?php  } ?>


                                                            <td><?= rupiah($inv['others2']) ?></td>

                                                            <?php if ($vendor['type'] == 0) {
                                                            ?>
                                                                <td><?= rupiah($inv['flight_msu2'] + $inv['others2']) ?></td>
                                                            <?php  } else {
                                                            ?>
                                                                <td><?= rupiah($inv['hd_daerah2'] + $inv['others2']) ?></td>
                                                            <?php  } ?>

                                                            <input hidden type="text" name="shipment_id[]" value="<?= $inv['id'] ?>">
                                                            <input hidden type="text" name="id_invoice[]" value="<?= $inv['id_invoice'] ?>">
                                                            <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                            <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">


                                                        </tr>

                                                    <?php
                                                        $total_koli = $total_koli + $inv['koli'];
                                                        $total_weight = $total_weight + $inv['berat_js'];
                                                        $total_special_weight = $total_special_weight + $inv['berat_msr'];

                                                        $total_smu = $total_smu + $inv['flight_msu2'];
                                                        $total_hd_daerah =  $total_hd_daerah + $inv['hd_daerah2'];

                                                        $sub_total_smu = $sub_total_smu +  $inv['flight_msu2'] + $inv['others2'];
                                                        $sub_total_hd_daerah = $sub_total_hd_daerah +  $inv['hd_daerah2'] + $inv['others2'];

                                                        $others =  $others + $inv['others2'];
                                                        $no++;
                                                    } ?>

                                                    <tr>
                                                        <td colspan="3">TOTAL <?= $no - 1 ?> AWB</td>
                                                        <td><?= $total_koli ?> </td>
                                                        <td><?= $total_weight ?> </td>
                                                        <?php if ($vendor['type'] == 0) {
                                                        ?>
                                                            <td><?= rupiah($total_smu) ?></td>
                                                        <?php  } else {
                                                        ?>
                                                            <td><?= rupiah($total_hd_daerah) ?></td>
                                                        <?php  } ?>

                                                        <td><?= rupiah($others) ?> </td>

                                                        <?php if ($vendor['type'] == 0) {
                                                        ?>
                                                            <td><?= rupiah($sub_total_smu) ?></td>
                                                        <?php  } else {
                                                        ?>
                                                            <td><?= rupiah($sub_total_hd_daerah) ?></td>
                                                        <?php  } ?>

                                                    </tr>
                                                </tbody>

                                            </table>
                                            <br>
                                            <h3 class="title text-center"><i class="fa fa-info"></i> AP INFORMATION</h3>
                                            <br>

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>

                                <div class="row">
                                    <?php
                                    $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);
                                    if ($vendor['type'] == 0) {
                                        $terbilang = $f->format($sub_total_smu) . ' Rupiahs';
                                        $terbilang = ucwords($terbilang);
                                        rupiah($sub_total_smu);
                                    } else {
                                        $terbilang = $f->format($sub_total_hd_daerah) . ' Rupiahs';
                                        $terbilang = ucwords($terbilang);
                                    }

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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
                                            <textarea class="form-control" required name="purpose"><?= $inv['purpose'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="pic" class="font-weight-bold">No. Invoice</label>
                                        <input type="text" name="no_invoice" value="<?= $inv['no_invoice'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="pic" class="font-weight-bold">Due Date <span class="text-danger">*</span></label>
                                        <input type="date" name="due_date" class="form-control" value="<?= $inv['due_date'] ?>">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Edit PO</button>
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