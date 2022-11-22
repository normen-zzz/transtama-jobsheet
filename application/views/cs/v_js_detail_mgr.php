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
                                                    <td><?php if ($msr['service_name'] == 'Charter Service') {
                                                            echo $msr['service_name'] . '-' . $msr['pu_moda'];
                                                        } else {
                                                            echo  $msr['service_name'];;
                                                        } ?></td>
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

                                    <div class="table-responive">
                                        <table class="table table-bordered" style="width:100%">
                                            <tr>
                                                <td style="width: 10%;">
                                                    NOTE DRIVER
                                                </td>
                                                <td>
                                                    <?= $msr['note_driver'] ?>

                                                </td>
                                            </tr>
                                        </table>

                                    </div>

                                    <div class="table-responsive">
                                        <form action="<?= base_url('cs/jobsheet/updateso') ?>" method="POST">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>NO DO</th>
                                                        <th>Collie</th>
                                                        <th>Weight</th>
                                                        <!-- <th>Note</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $get_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $msr['shipment_id']])->result_array();
                                                    $total_berat = 0;
                                                    foreach ($get_do as $do) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" disabled class="form-control" name="note_cs[]" value="<?= $do['no_do'] ?>">
                                                                <input type="text" class="form-control" hidden name="id_do[]" value="<?= $do['id_berat'] ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" disabled class="form-control" name="collie[]" value="<?= $do['koli'] ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="weight[]" value="<?= $do['berat'] ?>">
                                                            </td>
                                                        </tr>
                                                    <?php $total_berat += (int)$do['berat'];
                                                    } ?>

                                                </tbody>

                                            </table>
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No. Flight</th>
                                                        <th>No. SMU</th>
                                                        <th>WEIGHT JS/MSR</th>
                                                        <th>WEIGHT SPECIAL HD</th>

                                                        <!-- <th>Note</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="no_flight" value="<?= $msr['no_flight'] ?>"> </td>
                                                        <td> <input type="text" class="form-control" placeholder="isi no smu" name="no_smu" value="<?= $msr['no_smu'] ?>">
                                                            <input type="text" class="form-control" hidden name="id" value="<?= $msr['id'] ?>">
                                                        </td>
                                                        <?php if ($get_do) {
                                                        ?>
                                                            <td> <input type="text" class="form-control" name="berat_js" disabled value="<?= $total_berat ?>"> </td>

                                                        <?php    } else {
                                                        ?>
                                                            <td> <input type="text" class="form-control" name="berat_js" value="<?= $msr['berat_js'] ?>"> </td>

                                                        <?php } ?>
                                                        <td> <input type="text" class="form-control" name="berat_msr" value="<?= $msr['berat_msr'] ?>"> </td>
                                                    </tr>

                                                </tbody>

                                            </table>


                                            <button class="btn btn-success">Submit</button>

                                            <!-- <?php if ($msr['status_so'] == 2) {
                                                    ?>
                                                <button class="btn btn-success">Submit</button>
                                            <?php } ?> -->
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

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title with-border text-success text-center">
                                        <i class="fas fa-dollar-sign text-success"></i> Sales Cost
                                    </h4>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <form action="<?= base_url('cs/jobsheet/updateSalesCost') ?>" method="POST">
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
                                                        <th>Special Cn</th>
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
                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="packing" value="<?= $msr['packing'] ?>"> </td>
                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="others" value="<?= $msr['others'] ?>"> </td>
                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="surcharge" value="<?= $msr['surcharge'] ?>"> </td>
                                                        <td> <input type="text" class="form-control" placeholder="isi no flight" name="insurance" value="<?= $msr['insurance'] ?>"> </td>
                                                        <input type="text" class="form-control" hidden name="id" value="<?= $msr['id'] ?>">
                                                        <td>
                                                            <?= $msr['disc'] ?> / <?= $msr['disc'] * 100 ?> %
                                                        </td>
                                                        <td>
                                                            <?= $msr['cn'] ?> / <?= $msr['cn'] * 100 ?> %
                                                        </td>
                                                        <td>
                                                            <?= $msr['specialcn'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i><b> Total Sales</b></i>
                                                        </td>
                                                        <td colspan="7"> <?= rupiah($total_sales) ?> </td>

                                                    </tr>

                                                </tbody>

                                            </table>
                                            <div class="table-responive">
                                                <table class="table table-bordered" style="width:100%">
                                                    <tr>
                                                        <td style="width: 10%;">
                                                            NOTE SO
                                                        </td>
                                                        <td>
                                                            <?= $msr['so_note'] ?>

                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                            <?php if ($msr['status_so'] == 2) {
                                            ?>
                                                <button class="btn btn-success">Submit</button>
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
                                                    <th>Sewa Gudang</th>
                                                    <th>Wrapping</th>
                                                    <th>Refund %</th>
                                                    <th>Special Refund (Rp.)</th>
                                                    <th>Insurance</th>
                                                    <th>Surcharge</th>
                                                    <th>Hand CGK</th>
                                                    <th>Hand Pickup/Delivery</th>
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
                                                        <td><?= $m['refund2'] ?> %</td>
                                                        <td><?= 'Rp' . $m['specialrefund2'] ?></td>
                                                        <td><?= rupiah($m['insurance2']) ?></td>
                                                        <td><?= rupiah($m['surcharge2']) ?></td>
                                                        <td><?= rupiah($m['hand_cgk2']) ?></td>
                                                        <td><?= rupiah($m['hand_pickup2']) ?></td>
                                                        <td><?= rupiah($m['hd_daerah2']) ?></td>
                                                        <td><?= $m['pph2'] ?></td>
                                                        <td><?= rupiah($m['sdm2']) ?></td>
                                                        <td><?= rupiah((int)$m['others2']) ?></td>
                                                        <td>
                                                            <?php
                                                            $id_atasan = $this->session->userdata('id_atasan');
                                                            // kalo dia atasan sales
                                                            // if ($id_atasan == 0 || $id_atasan == NULL) {
                                                            ?>
                                                            <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-acc-edit" style="background-color: #9c223b;">
                                                                Edit
                                                            </button>
                                                            <?php  //}

                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                if ($modal) {
                                                    $refund = $m['refund2'] / 100;
                                                    $pph = $m['pph2'] / 100;
                                                    $service =  $msr['service_name'];

                                                    if ($service == 'Charter Service') {
                                                        $total_cost = $m['flight_msu2'] + ($m['ra2']) + ($m['packing2']) +
                                                            ($total_sales * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr'])  + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2']) +
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

                                                        $total_cost = $m['flight_msu2'] + $ra + $packing +
                                                            ($total_sales * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr'])  + $m['insurance2'] + $m['surcharge2'] + ($hand_cgk) +
                                                            ($hand_pickup) + ($m['hd_daerah2']) + ($total_sales * $pph) +
                                                            $sdm + (int)$m['others2'];
                                                    }
                                                } else {
                                                    $total_cost = 0;
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
                                                            <?= ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr']) ?>
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
                                                            <?= rupiah(((int)$m['others2'])) ?>
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
                                                    <td colspan="13"> <?= rupiah($total_cost) ?> </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i><b> Note PIC Jobsheet</b></i>
                                                    </td>
                                                    <td colspan="13"> <?= $m['note'] ?> </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i><b> Note Manager CS</b></i>
                                                    </td>
                                                    <td colspan="13"> <?= $m['note_mgr_cs'] ?> </td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <center>
                                            <h2 class="title">VENDOR & AGENTS</h2>
                                        </center>
                                        <form action="<?= base_url('cs/salesOrder/updateso') ?>" method="POST">

                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Vendo/Agent</th>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($vendor_selected as $vs) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $vs['nama_vendor'] ?></td>
                                                            <td><?= ($vs['type'] == 0) ? 'Vendor' : 'Agent' ?></td>
                                                            <td><button type="button" class="btn btn-sm btn-xs align-middle text-light" data-toggle="modal" data-target="#modal-edit-vendor<?= $vs['id_invoice'] ?>" style="background-color: #9c223b;">
                                                                    Edit
                                                                </button>

                                                                <a href="<?= base_url('cs/jobsheet/deleteVendor/' . $vs['shipment_id'] . '/' . $vs['id_invoice']) ?>" class="btn btn-sm btn-xs align-middle text-light tombol-konfirmasi" style="background-color: #9c223b;">Delete</a> <br>

                                                            </td>
                                                        </tr>

                                                    <?php  } ?>

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

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">

                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border text-primary text-center">

                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2><?php $profit = $total_sales - $total_cost;
                                                echo rupiah($profit);
                                                ?></h2>

                                        </div>
                                        <div class="col-md-4">
                                            <?php if ($modal) {
                                            ?>
                                                <h1><i class="fas fa-file-invoice-dollar text-primary"></i> Total Profit <?= round($profit / $total_sales * 100, 0) ?> % </h1>

                                            <?php  } ?>
                                        </div>
                                        <?php
                                        if ($msr['status_so'] == 2) {
                                            $id_atasan = $this->session->userdata('id_atasan');
                                            // kalo dia atasan sales
                                            if ($id_atasan == 0 || $id_atasan == NULL) {
                                        ?>
                                                <div class="col-md-4"> <a href="<?= base_url('cs/jobsheet/approveSo/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Sales Order</a> </div>

                                            <?php  }
                                            ?>

                                        <?php }

                                        ?>
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




<div class="modal fade" id="modal-acc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Capital Cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('cs/salesOrder/addCapitalCost') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Flight MSU</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="flight_smu2">
                                    <input type="text" class="form-control" id="exampleInputEmail1" required hidden value="<?= $msr['id'] ?>" name="shipment_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">RA</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="ra2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Packing</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="packing2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Refund (%)</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="refund2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insurance</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="insurance2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Surcharge</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="surcharge2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hand CGK</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="hand_cgk2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hand Pickup</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="hand_pickup2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">HD Daerah</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="hd_daerah2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PPH (5)</label>
                                    <input type="text" class="form-control" placeholder="ex: 0.2, it's mean 2 %" id="exampleInputEmail1" required name="pph2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SDM</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="sdm2">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn text-light" style="background-color: #9c223b;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php foreach ($modal as $m) {
?>
    <div class="modal fade" id="modal-acc-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Capital Cost</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('cs/jobsheet/editCapitalCost') ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Flight MSU</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="flight_smu2" value="<?= $m['flight_msu2'] ?>">
                                        <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $m['id_modal'] ?>" name="id_modal">
                                        <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id'] ?>" name="shipment_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sewa Gudang</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="ra2" value="<?= $m['ra2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Wrapping</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="packing2" value="<?= $m['packing2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Refund (%)</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="refund2" value="<?= $m['refund2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Insurance</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="insurance2" value="<?= $m['insurance2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Surcharge</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="surcharge2" value="<?= $m['surcharge2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hand CGK</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="hand_cgk2" value="<?= $m['hand_cgk2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hand Pickup</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="hand_pickup2" value="<?= $m['hand_pickup2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">HD Daerah</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="hd_daerah2" value="<?= $m['hd_daerah2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">PPH (%)</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="pph2" value="<?= $m['pph2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SDM</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="sdm2" value="<?= $m['sdm2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Others</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="others2" value="<?= $m['others2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor</label>
                                        <select name="vendor[]" class="form-control" style="width: 300px;">
                                            <option value="0">NO VENDOR</option>
                                            <?php foreach ($vendors as $v) {
                                            ?>
                                                <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor'] ?></option>
                                            <?php  } ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Agent</label>
                                        <select name="vendor[]" class="form-control" style="width: 300px;">
                                            <option value="0">NO AGENT</option>
                                            <?php foreach ($agents as $v) {
                                            ?>
                                                <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor'] ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="note_cs">Note</label>
                                    <textarea name="note_mgr_cs" class="form-control"><?= $m['note_mgr_cs'] ?> </textarea>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn text-light" style="background-color: #9c223b;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>


<?php foreach ($vendor_selected as $vs2) {
?>
    <div class="modal fade" id="modal-edit-vendor<?= $vs2['id_invoice'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $vs2['nama_vendor'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('cs/jobsheet/editVendor') ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id'] ?>" name="shipment_id">
                                <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $vs2['id_invoice'] ?>" name="id_invoice">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor/Agent</label>
                                        <select name="vendor" class="form-control" style="width: 300px;">
                                            <option value="0">NO VENDOR</option>
                                            <?php foreach ($vendor_lengkap as $v) {
                                            ?>
                                                <option value="<?= $v['id_vendor'] ?>" <?php if ($v['id_vendor'] == $vs2['id_vendor']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $v['nama_vendor'] ?></option>
                                            <?php  } ?>
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn text-light" style="background-color: #9c223b;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>