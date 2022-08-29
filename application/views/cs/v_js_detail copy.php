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

                                                    <td> <input type="text" class="form-control" value="<?= $msr['no_flight'] ?>"> </td>
                                                    <td> <input type="text" class="form-control" value="<?= $msr['no_smu'] ?>"> </td>
                                                    <td><?= $msr['berat_msr'] ?></td>
                                                    <td><?= $msr['berat_js'] ?></td>
                                                </tr>

                                            </tbody>

                                        </table>
                                        <button class="btn btn-success">Submit</button>
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
                                                <?php foreach ($sales as $s) {
                                                ?>
                                                    <tr>
                                                        <td> <i><b>Variabel</b></i> </td>
                                                        <td><?= rupiah($msr['freight_kg']) ?></td>
                                                        <td><?= rupiah($s['packing']) ?></td>
                                                        <td><?= rupiah($s['others']) ?></td>
                                                        <td><?= rupiah($s['surcharge']) ?></td>
                                                        <td><?= rupiah($s['insurance']) ?></td>
                                                        <td><?= rupiah($s['disc']) ?></td>
                                                        <td><?= rupiah($s['cn']) ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-lg-edit" style="background-color: #9c223b;">
                                                                Edit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                $freight  = $msr['berat_js'] * $msr['freight_kg'];
                                                $packing = $s['packing'] * $msr['berat_js'];
                                                $total_sales = ($freight + $packing + $s['others'] + $s['surcharge'] + $s['insurance'])
                                                    - $s['disc'] - $s['cn'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <i><b> Accumulation</b></i>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($msr['freight_kg']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($packing) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($s['others']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($s['surcharge']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($s['insurance']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($s['disc']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($s['cn']) ?>
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
                                                        <td><?= $m['refund2'] ?></td>
                                                        <td><?= rupiah($m['insurance2']) ?></td>
                                                        <td><?= rupiah($m['surcharge2']) ?></td>
                                                        <td><?= rupiah($m['hand_cgk2']) ?></td>
                                                        <td><?= rupiah($m['hand_pickup2']) ?></td>
                                                        <td><?= rupiah($m['hd_daerah2']) ?></td>
                                                        <td><?= $m['pph2'] ?></td>
                                                        <td><?= rupiah($m['sdm2']) ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-acc-edit" style="background-color: #9c223b;">
                                                                Edit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>


                                                <?php

                                                $total_cost = $m['flight_msu2'] + ($m['ra2'] * $msr['berat_js']) + ($m['packing2'] * $msr['berat_js']) +
                                                    ($total_sales * $m['refund2']) + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2'] * $msr['berat_js']) +
                                                    ($m['hand_pickup2'] * $msr['berat_js']) + $m['hd_daerah2'] + ($total_sales * $m['pph2']) +
                                                    $m['sdm2'] * $msr['berat_js'];
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
                                                        <?= rupiah($total_sales * $m['refund2']) ?>
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
                                                        <?= rupiah($m['hd_daerah2']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($total_sales * $m['pph2']) ?>
                                                    </td>
                                                    <td>
                                                        <?= rupiah($m['sdm2'] * $msr['berat_js']) ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i><b> Total Cost</b></i>
                                                    </td>
                                                    <td colspan="12"> <?= rupiah($total_cost) ?> </td>

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

        <!-- <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">

                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border text-primary text-center">
                                    <h4 class="box-title with-border">
                                        <i class="fas fa-file-invoice-dollar text-primary"></i> Total Profit
                                    </h4>

                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2><?php $profit = $total_sales - $total_cost;
                                                echo rupiah($profit);
                                                ?></h2>

                                        </div>
                                        <div class="col-md-6"><?= round($profit / $total_sales * 100, 0) ?> % </div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div> -->
    </div>
</div>


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Sales Cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('cs/jobsheet/addSalesCost') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Packing</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="packing">
                                    <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id_msr'] ?>" name="id_msr">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Others</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="others">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Surcharge</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="surcharge">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insurance</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="insurance">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Disc</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="disc">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cn</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="cn">
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
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


<!-- edit -->

<?php foreach ($sales as $s) {
?>
    <div class="modal fade" id="modal-lg-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Sales Cost</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('cs/jobsheet/editSalesCost') ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Packing</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="packing" value="<?= $s['packing'] ?>">
                                        <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $s['id_sales'] ?>" name="id_sales">
                                        <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id_msr'] ?>" name="id_msr">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Others</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="others" value="<?= $s['others'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Surcharge</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="surcharge" value="<?= $s['surcharge'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Insurance</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="insurance" value="<?= $s['insurance'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Disc</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="disc" value="<?= $s['disc'] ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cn</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="cn" value="<?= $s['cn'] ?>">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
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
                <form action="<?= base_url('cs/jobsheet/addCapitalCost') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Flight MSU</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required name="flight_smu2">
                                    <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id_msr'] ?>" name="id_msr">
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
                                        <input type="text" class="form-control" id="exampleInputEmail1" hidden required value="<?= $msr['id_msr'] ?>" name="id_msr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">RA</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" required name="ra2" value="<?= $m['ra2'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Packing</label>
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