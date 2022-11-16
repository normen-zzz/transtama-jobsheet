<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border text-center">
                                    <h2 class="box-title with-border font-weight-bold">
                                        DETAIL REQUEST REVISION
                                    </h2>
                                    <h4 class="box-title with-border font-weight-bold">
                                        <?= $title; ?>
                                    </h4>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Pickup Date</th>
                                                    <th>Shipment ID</th>
                                                    <th>SO Number</th>
                                                    <th>Customer</th>
                                                    <th>Consignee</th>
                                                    <!-- <th>Destination</th> -->
                                                    <th>Service</th>
                                                    <th>Comm</th>
                                                    <!-- <th>Shipper</th> -->
                                                    <!-- <th>No. Flight</th>
                                                    <th>No. SMU</th> -->
                                                    <th>Colly</th>
                                                    <th>Destination</th>
                                                    <!-- <th>WEIGHT JS(Kg)</th> -->
                                                    <!-- <th>Freight</th> -->
                                                    <th>Sales</th>
                                                    <!-- <th>Status</th> -->
                                                    <!-- <th>Note</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= bulan_indo($msr['tgl_pickup']) ?></td>
                                                    <td><?= $msr['shipment_id'] ?></td>
                                                    <td><?= $msr['so_id'] ?></td>
                                                    <td><?= $msr['shipper'] ?></td>
                                                    <td><?= $msr['consigne'] ?></td>
                                                    <!-- <td><?= $msr['destination'] ?></td> -->
                                                    <td><?= $msr['service_name'] ?></td>
                                                    <td><?= $msr['pu_commodity'] ?></td>
                                                    <!-- <td><?= $msr['id_user'] ?></td> -->
                                                    <!-- <td> <input type="text" class="form-control" value="<?= $msr['no_flight'] ?>"> </td>
                                                    <td> <input type="text" class="form-control" value="<?= $msr['no_smu'] ?>"> </td> -->
                                                    <!-- <td></td> -->
                                                    <td><?= $msr['koli'] ?></td>
                                                    <td><?= $msr['destination'] ?></td>
                                                    <!-- <td><?= $msr['berat_msr'] ?></td> -->
                                                    <!-- <td><?= $msr['berat_js'] ?></td> -->
                                                    <!-- <td><?= rupiah($msr['freight_kg']) ?></td> -->

                                                    <td><?= $msr['nama_user'] ?></td>
                                                    <!-- <td><?= $msr['pu_note'] ?></td> -->
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <form action="<?= base_url('cs/jobsheet/updateso') ?>" method="POST">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No. Flight</th>
                                                        <th>No. SMU</th>
                                                        <th>WEIGHT JS/MSR</th>
                                                        <th>WEIGHT SPECIAL HD</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="no_flight" value="<?= $msr['no_flight'] ?>"> </td>
                                                        <td> <input type="text" class="form-control" placeholder="isi no smu" name="no_smu" value="<?= $msr['no_smu'] ?>">
                                                            <input type="text" class="form-control" hidden name="id" value="<?= $msr['id'] ?>">
                                                        </td>
                                                        <td><?= $msr['berat_msr'] ?></td>
                                                        <td><?= $msr['berat_js'] ?></td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                            <?php if ($msr['status_so'] == 2) {
                                            ?>
                                                <!-- <button class="btn btn-success">Submit</button> -->
                                            <?php } ?>
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

        <?php if ($so_lama) {
        ?>
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-body">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title with-border text-success text-center">
                                            <i class="fas fa-dollar-sign text-success"></i> Old Sales Order
                                        </h4>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th><b>Description</b> </th>
                                                        <th>Freight/KG</th>
                                                        <th>Special Freight</th>
                                                        <th>Packing</th>
                                                        <th>Others</th>
                                                        <th>Surcharge</th>
                                                        <th>Insurance</th>
                                                        <th>Disc.</th>
                                                        <th>Cn</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!--berart js = weight js/msr-->
                                                    <!--berat_msr= special_freight-->
                                                    <?php
                                                    $service =  $msr['service_name'];
                                                    if ($service == 'Charter Service') {
                                                        $packing = $so_lama['packing_lama'];
                                                        $total_sales = ($so_lama['freight_lama'] + $packing +  $so_lama['special_freight_lama'] +  $so_lama['others_lama'] + $so_lama['surcharge_lama'] + $so_lama['insurance_lama']);
                                                    } else {
                                                        $disc = $so_lama['disc_lama'];
                                                        // kalo gada disc
                                                        if ($disc == 0) {
                                                            $freight  = $msr['berat_js'] * $so_lama['freight_lama'];
                                                            $special_freight  = $msr['berat_msr'] * $so_lama['special_freight_lama'];
                                                        } else {
                                                            $freight_discount = $so_lama['freight_lama'] * $disc;
                                                            $special_freight_discount = $so_lama['special_freight_lama'] * $disc;

                                                            $freight = $freight_discount * $msr['berat_js'];
                                                            $special_freight  = $special_freight_discount * $msr['berat_msr'];
                                                        }

                                                        $packing = $so_lama['packing_lama'];
                                                        $total_sales = ($freight + $packing + $special_freight +  $so_lama['others_lama'] + $so_lama['surcharge_lama'] + $so_lama['insurance_lama']);
                                                        $total_sales = $total_sales;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <i><b> Value</b></i>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['freight_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['packing_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['special_freight_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['others_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['surcharge_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($so_lama['insurance_lama']) ?>
                                                        </td>
                                                        <td>
                                                            <?= $so_lama['disc_lama'] ?> / <?= $so_lama['disc_lama'] * 100 ?> %
                                                        </td>
                                                        <td>
                                                            <?= $so_lama['cn_lama'] ?> / <?= $so_lama['cn_lama'] * 100 ?> %
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i><b> Total Sales</b></i>
                                                        </td>
                                                        <td colspan="7"> <?= rupiah($total_sales) ?> </td>

                                                    </tr>

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
        <?php  } else {
        ?>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-body">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title with-border text-success text-center">
                                            <i class="fas fa-dollar-sign text-success"></i> Old Sales Order
                                        </h4>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th><b>Description</b> </th>
                                                        <th>Freight/KG</th>
                                                        <th>Special Freight</th>
                                                        <th>Packing</th>
                                                        <th>Others</th>
                                                        <th>Surcharge</th>
                                                        <th>Insurance</th>
                                                        <th>Disc.</th>
                                                        <th>Cn</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!--berart js = weight js/msr-->
                                                    <!--berat_msr= special_freight-->
                                                    <?php
                                                    $service =  $msr['service_name'];
                                                    if ($service == 'Charter Service') {
                                                        $packing = $msr['packing'];
                                                        $total_sales = ($msr['freight_kg'] + $packing +  $msr['special_freight'] +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
                                                    } else {
                                                        $disc = $msr['disc'];
                                                        // kalo gada disc
                                                        if ($disc == 0) {
                                                            $freight  = $msr['berat_js'] * $msr['freight_kg'];
                                                            $special_freight  = $msr['berat_msr'] * $msr['special_freight'];
                                                        } else {
                                                            $freight_discount = $msr['freight_kg'] * $disc;
                                                            $special_freight_discount = $msr['special_freight'] * $disc;

                                                            $freight = $freight_discount * $msr['berat_js'];
                                                            $special_freight  = $special_freight_discount * $msr['berat_msr'];
                                                        }

                                                        $packing = $msr['packing'];
                                                        $total_sales = ($freight + $packing + $special_freight +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
                                                        $total_sales = $total_sales;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <i><b> Value</b></i>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['freight_kg']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['special_freight']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['packing']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['others']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['surcharge']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($msr['insurance']) ?>
                                                        </td>
                                                        <td>
                                                            <?= $msr['disc'] ?> / <?= $msr['disc'] * 100 ?> %
                                                        </td>
                                                        <td>
                                                            <?= $msr['cn'] ?> / <?= $msr['cn'] * 100 ?> %
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i><b> Total Sales</b></i>
                                                        </td>
                                                        <td colspan="7"> <?= rupiah($total_sales) ?> </td>

                                                    </tr>

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
        <?php  } ?>




        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title with-border text-danger text-center">
                                        <i class="fas fa-dollar-sign text-danger"></i> New Sales Order
                                    </h4>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><b>Description</b> </th>
                                                    <th>Freight/KG</th>
                                                    <th>Special Freight</th>
                                                    <th>Packing</th>
                                                    <th>Others</th>
                                                    <th>Surcharge</th>
                                                    <th>Insurance</th>
                                                    <th>Disc.</th>
                                                    <th>Cn</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--berart js = weight js/msr-->
                                                <!--berat_msr= special_freight-->
                                                <?php
                                                $service =  $msr['service_name'];
                                                // if ($service == 'Charter Service') {
                                                //     $total_sales_new = $request['freight_baru'];
                                                // } else {
                                                //     $disc = $request['disc_baru'];
                                                //     // kalo gada disc
                                                //     if ($disc == 0) {
                                                //         $freight  = $msr['berat_js'] * $request['freight_baru'];
                                                //         $special_freight  = $msr['berat_msr'] * $request['special_freight_baru'];
                                                //     } else {
                                                //         $freight_discount = $request['freight_baru'] * $disc;
                                                //         $special_freight_discount = $request['special_freight_baru'] * $disc;

                                                //         $freight = $freight_discount * $msr['berat_js'];
                                                //         $special_freight  = $special_freight_discount * $msr['berat_msr'];
                                                //     }

                                                //     // var_dump($freight);
                                                //     // die;

                                                //     $packing = $request['packing_baru'] * $msr['berat_js'];
                                                //     $total_sales_new = ($freight + $packing + $special_freight +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
                                                //     $total_sales_new = $total_sales_new;

                                                $service =  $msr['service_name'];
                                                if ($service == 'Charter Service') {
                                                    $packing = $request['packing_baru'];
                                                    $total_sales_new = ($request['freight_baru'] + $packing +  $request['special_freight_baru'] +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
                                                } else {
                                                    $disc = $request['disc_baru'];
                                                    // kalo gada disc
                                                    if ($disc == 0) {
                                                        $freight  = $msr['berat_js'] * $request['freight_baru'];
                                                        $special_freight  = $msr['berat_msr'] * $request['special_freight_baru'];
                                                    } else {
                                                        $freight_discount = $request['freight_baru'] * $disc;
                                                        $special_freight_discount = $request['special_freight_baru'] * $disc;

                                                        $freight = $freight_discount * $msr['berat_js'];
                                                        $special_freight  = $special_freight_discount * $msr['berat_msr'];
                                                    }

                                                    $packing = $request['packing_baru'];
                                                    $total_sales_new = ($freight + $packing + $special_freight +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
                                                    $total_sales_new = $total_sales_new;
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <i><b> Value</b></i>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['freight_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['special_freight_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['packing_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['others_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['surcharge_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['insurance_baru']) ?>
                                                    </td>
                                                    <td>
                                                        <?= $request['disc_baru'] ?> / <?= $request['disc_baru'] * 100 ?> %
                                                    </td>
                                                    <td>
                                                        <?= $request['cn_baru'] ?> / <?= $request['cn_baru'] * 100 ?> %
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i><b> Total Sales</b></i>
                                                    </td>
                                                    <td colspan="5"> <?= rupiah($total_sales_new) ?> </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i><b>Reason</b></i>
                                                    </td>
                                                    <td colspan="12">
                                                        <?= $request['alasan'] ?>
                                                    </td>
                                                </tr>

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

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border text-danger text-center">
                                    <h4 class="box-title with-border">
                                        <i class="fas fa-dollar-sign text-danger"></i> Capital Cost
                                    </h4>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <?php
                                    if ($modal) {
                                    } else {
                                    ?>
                                        <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-acc" style="background-color: #9c223b;">
                                            <i class="fas fa-plus"></i>
                                            Add Capital Cost
                                        </button>

                                    <?php  }
                                    ?>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><b>Description</b> </th>
                                                    <th>Flight SMU</th>
                                                    <th>RA</th>
                                                    <th>Packing</th>
                                                    <th>Refund %</th>
                                                    <th>Insurance</th>
                                                    <th>Surcharge</th>
                                                    <th>Hand CGK</th>
                                                    <th>Hand Pickup</th>
                                                    <th>HD Daerah</th>
                                                    <th>PPH %</th>
                                                    <th>SDM</th>
                                                    <th>Others</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modal as $m) {
                                                ?>
                                                    <tr>
                                                        <td> <i><b>Variabel</b></i> </td>
                                                        <td><?= rupiah($m['flight_msu2']) ?></td>
                                                        <td><?= rupiah($m['ra2']) ?></td>
                                                        <td><?= rupiah($m['packing2']) ?></td>
                                                        <td><?= $m['refund2'] ?>  %</td>
                                                        <td><?= rupiah($m['insurance2']) ?></td>
                                                        <td><?= rupiah($m['surcharge2']) ?></td>
                                                        <td><?= rupiah($m['hand_cgk2']) ?></td>
                                                        <td><?= rupiah($m['hand_pickup2']) ?></td>
                                                        <td><?= rupiah($m['hd_daerah2']) ?></td>
                                                        <td><?= $m['pph2'] ?></td>
                                                        <td><?= rupiah($m['sdm2']) ?></td>
                                                        <td><?= rupiah($m['others2']) ?></td>
                                                        <td>
                                                            <!-- <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-acc-edit" style="background-color: #9c223b;">
                                                                Edit
                                                            </button> -->
                                                        </td>
                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                if ($modal) {
                                                    $refund = $m['refund2'] / 100;
                                                    $pph = $m['pph2'] / 100;
                                                    $service =  $msr['service_name'];

                                                    if ($service == 'Charter Service') {
                                                        $total_cost_old = $m['flight_msu2'] + ($m['ra2']) + ($m['packing2']) +
                                                            ($total_sales * $refund) + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2']) +
                                                            ($m['hand_pickup2']) + ($m['hd_daerah2']) + ($total_sales * $pph) +
                                                            $m['sdm2'] + $m['others2'];
                                                    } else {
                                                        // sdm
                                                        $sdm_biasa  = $msr['berat_js'] * $m['sdm2'];
                                                        $sdm_special  = $msr['berat_msr'] * $m['sdm2'];
                                                        $sdm = $sdm_biasa + $sdm_special;

                                                        // ra
                                                        $ra_biasa  = $msr['berat_js'] * $m['ra2'];
                                                        $ra_special  = $msr['berat_msr'] * $m['ra2'];
                                                        $ra = $ra_biasa + $ra_special;
                                                        // packing
                                                        $packing_biasa  = $msr['berat_js'] * $m['packing2'];
                                                        $packing_special  = $msr['berat_msr'] * $m['packing2'];
                                                        $packing = $packing_biasa + $packing_special;

                                                        // hand cgk
                                                        $hand_cgk_biasa  = $msr['berat_js'] * $m['hand_cgk2'];
                                                        $hand_cgk_special  = $msr['berat_msr'] * $m['hand_cgk2'];
                                                        $hand_cgk = $hand_cgk_biasa + $hand_cgk_special;

                                                        // hand pickup
                                                        $hand_pickup_biasa  = $msr['berat_js'] * $m['hand_pickup2'];
                                                        $hand_pickup_special  = $msr['berat_msr'] * $m['hand_pickup2'];
                                                        $hand_pickup = $hand_pickup_biasa + $hand_pickup_special;

                                                        $total_cost_old = $m['flight_msu2'] + $ra + $packing +
                                                            ($total_sales * $refund) + $m['insurance2'] + $m['surcharge2'] + ($hand_cgk) +
                                                            ($hand_pickup) + ($m['hd_daerah2']) + ($total_sales * $pph) +
                                                            $sdm + $m['others2'];
                                                    }
                                                } else {
                                                    $total_cost_old = 0;
                                                }


                                                ?>

                                                <?php if ($modal) {
                                                ?>

                                                    <tr>
                                                        <td>
                                                            <i><b> Accumulation</b></i>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['flight_msu2']) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($service == 'Charter Service') {
                                                                echo  rupiah($m['ra2']);
                                                            } else {
                                                                echo rupiah($m['ra2'] * $msr['berat_js']);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($service == 'Charter Service') {
                                                                echo  rupiah($m['packing2']);
                                                            } else {
                                                                echo rupiah($m['packing2'] * $msr['berat_js']);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($total_sales * $refund) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['insurance2']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['surcharge2']) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($service == 'Charter Service') {
                                                                echo  rupiah($m['hand_cgk2']);
                                                            } else {
                                                                echo rupiah($m['hand_cgk2'] * $msr['berat_js']);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($service == 'Charter Service') {
                                                                echo  rupiah($m['hand_pickup2']);
                                                            } else {
                                                                echo rupiah($m['hand_pickup2'] * $msr['berat_js']);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(($m['hd_daerah2'])) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($total_sales * ($m['pph2'] / 100)) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($service == 'Charter Service') {
                                                                echo  rupiah($m['sdm2']);
                                                            } else {
                                                                $sdm_biasa  = $msr['berat_js'] * $m['sdm2'];
                                                                $sdm_special  = $msr['berat_msr'] * $m['sdm2'];
                                                                $sdm = $sdm_biasa + $sdm_special;
                                                                echo rupiah($sdm);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(($m['others2'])) ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>

                                                <?php   } else {
                                                ?>

                                                    <tr>
                                                        <td>
                                                            <i><b> Accumulation</b></i>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(0) ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                <?php  } ?>

                                                <tr>
                                                    <td>
                                                        <i><b> Total Cost</b></i>
                                                    </td>
                                                    <td colspan="12"> <?= rupiah($total_cost_old) ?> </td>

                                                </tr>

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

        <div class="row">
            <div class="col-md-6">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-body">
                        <section class="content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="box">
                                        <h1 class="title text-success">Old Profit</h1>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3><?php $profit = $total_sales - $total_cost_old;
                                                        echo rupiah($profit);
                                                        ?></h3>

                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($modal) {
                                                    ?>
                                                        <h3><i class="fas fa-file-invoice-dollar text-primary"></i> <?= round($profit / $total_sales * 100, 0) ?> % </h3>

                                                    <?php  } ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-body">

                        <section class="content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <h1 class="title text-danger">New Profit</h1>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3><?php $profit_new = $total_sales_new - $total_cost_old;
                                                        echo rupiah($profit_new);
                                                        ?></h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($modal) {
                                                    ?>
                                                        <h3><i class="fas fa-file-invoice-dollar text-primary"></i> <?= round($profit_new / $total_sales_new * 100, 0) ?> % </h3>

                                                    <?php  } ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <?php
            if ($request['status_revisi'] >= 2) {

                $id_atasan = $this->session->userdata('id_atasan');
                // kalo dia atasan sales
                $cek_approve_cs = $this->db->select('id_user_gm')->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                $tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                if ($id_atasan == 0 || $id_atasan == NULL) {
                    // kalo dia ada
                    if ($cek_approve_cs['id_user_gm'] == NULL) {
            ?>
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('finance/jobsheet/approveRevisiGm/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('finance/jobsheet/declineRevisiGm/' . $msr['id']) ?>" class="btn btn-danger tombol-konfirmasi">Decline Revision</a> </div>
                            </div>
                        </div>
                        <br>

                        <div class="col-md-4">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h4 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h4> <br>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h4> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h4> <br>
                                    <?php  } else {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h4> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
                                </div>
                            <?php  } ?>
                        </div>

                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h4> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h4> <br>
                                    <?php  } else {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h4> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                                </div>

                            <?php  } ?>
                        </div>
                    <?php  } else {
                    ?>
                        <div class="col-md-4">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h4 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h4> <br>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h4> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h4> <br>
                                    <?php  } else {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h4> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
                                </div>
                            <?php  } ?>
                        </div>

                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h4> <br>
                                    <?php  } else {
                                    ?>
                                        <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h4> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                                </div>

                            <?php  } ?>
                        </div>


                    <?php } ?>

                <?php } else {
                ?>

                    <div class="col-md-4">
                        <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                            <h4 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h4> <br>
                            <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                        ?>
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h4 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h4> <br>
                                <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                            </div>
                        <?php  } else {
                        ?>
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                                ?>
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h4> <br>
                                <?php  } else {
                                ?>
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h4> <br>
                                <?php  } ?>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
                            </div>
                        <?php  } ?>
                    </div>

                    <div class="col-md-4">
                        <?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
                        ?>
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
                                <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                            </div>
                        <?php  } else {
                        ?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
                                ?>
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h4> <br>
                                <?php  } else {
                                ?>
                                    <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h4> <br>
                                <?php  } ?>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                            </div>

                        <?php  } ?>
                    </div>


                <?php  }
                ?>

            <?php } else {
            ?>
                <div class="col-md-4">
                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait Manager Cs check the revision</h3> <br>
                        <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                    </div>
                </div>


            <?php  } ?>
        </div>


    </div>
</div>