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
                                                        <th>WEIGHT JS(Kg)</th>
                                                        <th>WEIGHT MSR(Kg)</th>

                                                        <!-- <th>Note</th> -->
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
                                                <?php


                                                $disc = $msr['disc'];
                                                // kalo gada disc
                                                if ($disc == 0) {
                                                    $freight  = $msr['berat_js'] * $msr['freight_kg'];
                                                } else {
                                                    $freight_discount = $msr['freight_kg'] * $disc;
                                                    $freight = $freight_discount * $msr['berat_js'];
                                                }

                                                // var_dump($freight);
                                                // die;

                                                $packing = $msr['packing'] * $msr['berat_js'];
                                                $total_sales = ($freight + $packing + $msr['others'] + $msr['surcharge'] + $msr['insurance']);
                                                // $comm = $msr['cn'] * $total_sales;
                                                // $disc = $msr['disc'] * $total_sales;

                                                $total_sales = $total_sales;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <i><b> Value</b></i>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($msr['freight_kg']) ?>
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
                                                <?php


                                                $disc = $request['disc_baru'];
                                                // kalo gada disc
                                                if ($disc == 0) {
                                                    $freight  = $msr['berat_js'] * $request['freight_baru'];
                                                } else {
                                                    $freight_discount = $request['freight_baru'] * $disc;
                                                    $freight = $freight_discount * $msr['berat_js'];
                                                }

                                                // var_dump($freight);
                                                // die;

                                                $packing = $request['packing_baru'] * $msr['berat_js'];
                                                $total_sales_new = ($freight + $packing + $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
                                                // $comm = $msr['cn'] * $total_sales;
                                                // $disc = $msr['disc'] * $total_sales;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <i><b> Value</b></i>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($request['freight_baru']) ?>
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
                                                        <td><?= $m['refund2'] ?> / <?= $m['refund2'] * 100 ?>%</td>
                                                        <td><?= rupiah($m['insurance2']) ?></td>
                                                        <td><?= rupiah($m['surcharge2']) ?></td>
                                                        <td><?= rupiah($m['hand_cgk2']) ?></td>
                                                        <td><?= rupiah($m['hand_pickup2']) ?></td>
                                                        <td><?= rupiah($m['hd_daerah2']) ?></td>
                                                        <td><?= $m['pph2'] ?></td>
                                                        <td><?= rupiah($m['sdm2']) ?></td>
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
                                                    $total_cost_old = $m['flight_msu2'] + ($m['ra2'] * $msr['berat_js']) + ($m['packing2'] * $msr['berat_js']) +
                                                        ($total_sales * $refund) + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2'] * $msr['berat_js']) +
                                                        ($m['hand_pickup2'] * $msr['berat_js']) + ($m['hd_daerah2']) + ($total_sales * $m['pph2']) +
                                                        $m['sdm2'] * $msr['berat_js'];
                                                    $total_cost_new = $m['flight_msu2'] + ($m['ra2'] * $msr['berat_js']) + ($m['packing2'] * $msr['berat_js']) +
                                                        ($total_sales * $refund) + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2'] * $msr['berat_js']) +
                                                        ($m['hand_pickup2'] * $msr['berat_js']) + ($m['hd_daerah2']) + ($total_sales_new * $m['pph2']) +
                                                        $m['sdm2'] * $msr['berat_js'];
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
                                                            <?= rupiah($m['ra2'] * $msr['berat_js']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['packing2'] * $msr['berat_js']) ?>
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
                                                            <?= rupiah($m['hand_cgk2'] * $msr['berat_js']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['hand_pickup2'] * $msr['berat_js']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah(($m['hd_daerah2'])) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($total_sales * $m['pph2']) ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($m['sdm2'] * $msr['berat_js']) ?>
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
            $tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
            if ($request['status_revisi'] == 5 || $request['status_revisi'] == 6) {
            ?>
                <div class="col-md-4">
                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
                        <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                    ?>
                        <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                            <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
                            <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                        </div>
                    <?php  } else {
                    ?>
                        <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                            <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                            ?>
                                <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
                            <?php  } else {
                            ?>
                                <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
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
                                <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
                            <?php  } else {
                            ?>
                                <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By By GM</h3> <br>
                            <?php  } ?>
                            <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                        </div>

                    <?php  } ?>
                </div>

                <?php  } else {
                $id_atasan = $this->session->userdata('id_atasan');
                // kalo dia atasan sales
                if ($id_atasan == 0 || $id_atasan == NULL) {
                    $cek_approve_cs = $this->db->select('id_user_mgr')->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                    $tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                    // kalo dia ada
                    if ($cek_approve_cs['id_user_mgr'] == NULL) {
                ?>
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/approveRevisiMgrCs/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="<?= base_url('cs/jobsheet/declineRevisiMgrCs/') ?>" method="POST">
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <div class="row">
                                        <div class="col-md-7 ml-2">
                                            <label for="note_mgr font-weight-bold">Reason</label>
                                            <input type="text" name="id" hidden value="<?= $msr['id'] ?>">
                                            <textarea name="note_mgr" class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-4 mt-8 ml-2">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Decline Revision</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else {
                    ?>
                        <div class="col-md-4">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
                                    <?php  } else {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
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
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
                                    <?php  } else {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h3> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                                </div>

                            <?php  } ?>
                        </div>



                    <?php  } ?>

                    <?php } else {
                    // kalo dia pic jobsheet
                    $cek_approve_cs = $this->db->select('id_user_cs')->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                    $tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
                    // kalo dia ada
                    // var_dump($cek_approve_cs);
                    // die;
                    if ($cek_approve_cs['id_user_cs'] == NULL) {
                    ?>
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/approveRevisiCs/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/declineRevisiCs/' . $msr['id']) ?>" class="btn btn-danger tombol-konfirmasi">Decline Revision</a> </div>
                            </div>
                        </div> -->

                    <?php } else {
                    ?>
                        <div class="col-md-4">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
                                <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
                                    <!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
                                </div>
                            <?php  } else {
                            ?>
                                <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                    <?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
                                    <?php  } else {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
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
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
                                    <?php  } else {
                                    ?>
                                        <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h3> <br>
                                    <?php  } ?>
                                    <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
                                </div>

                            <?php  } ?>
                        </div>



                    <?php  } ?>

            <?php }
            }
            ?>
        </div>

    </div>
</div>