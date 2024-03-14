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
									  <br><br>

                                    <div class="table-responsive">
										 <h4 class="text-center">Detail Package</h4>
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
                                                    <?php $total_berat += $do['berat'];
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
                                                        <td><?= $msr['berat_js'] ?></td>
                                                        <td><?= $msr['berat_msr'] ?></td>
                                                    </tr>

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
                                                

                                                    $total_sales = getTotalSales($msr['id']);
                                                
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
                                                    <th>Insurance</th>
                                                    <th>Surcharge</th>
                                                    <th>Hand CGK</th>
                                                    <th>Hand Pickup/Delivery</th>
                                                    <th>HD Daerah</th>
                                                    <th>PPH %</th>
                                                    <th>SDM</th>
                                                    <th>Others</th>
                                                    <!-- <th>Action</th> -->
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
                                                        <td><?= rupiah($m['insurance2']) ?></td>
                                                        <td><?= rupiah($m['surcharge2']) ?></td>
                                                        <td><?= rupiah($m['hand_cgk2']) ?></td>
                                                        <td><?= rupiah($m['hand_pickup2']) ?></td>
                                                        <td><?= rupiah($m['hd_daerah2']) ?></td>
                                                        <td><?= $m['pph2'] ?> %</td>
                                                        <td><?= rupiah($m['sdm2']) ?></td>
                                                        <td><?= rupiah($m['others2']) ?></td>
                                                        <!-- <td>
                                                            <button type="button" class="btn btn btn-sm btn-xs align-middle text-light mb-2" data-toggle="modal" data-target="#modal-acc-edit" style="background-color: #9c223b;">
                                                                Edit
                                                            </button>
                                                        </td> -->
                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                if ($modal) {
                                                    $refund = $m['refund2'] / 100;
                                                    $pph = $m['pph2'] / 100;
                                                    $service =  $msr['service_name'];

                                                    if ($service == 'Charter Service') {
                                                        $total_cost = $m['flight_msu2'] + ($m['ra2']) + ($m['packing2']) +
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

                                                        $total_cost = $m['flight_msu2'] + $ra + $packing +
                                                            ($total_sales * $refund) + $m['insurance2'] + $m['surcharge2'] + ($hand_cgk) +
                                                            ($hand_pickup) + ($m['hd_daerah2']) + ($total_sales * $pph) +
                                                            $sdm + $m['others2'];;
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
            <!-- APPROVE SALES MANAGER -->
           
            <!-- APPROVE PIC JS -->
            <?php if ($approve_managerial['approve_cs']) {
                $nama_user = $this->db->get_where('tb_user', ['id_user' => $approve_managerial['approve_cs']])->row_array();
            ?>
                <div class="col-md-4">

                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h4 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i>Approve PIC Jobsheet CS</h4> <br>
                        <h4 class="text-title text-center"><?= $nama_user['nama_user'] ?></h4>
                        <h4 class="text-title text-center"><?= $approve_managerial['created_at_cs'] ?></h4>
                    </div>

                </div>

            <?php  } else {
            ?>
                <div class="col-md-4">
                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h4 class="text-title text-center mt-2"> <i class="fa fa-calendar text-danger"></i>Wait Approve PIC Jobsheet CS</h4> <br>
                        <h4 class="text-title text-center"></h4>
                    </div>
                </div>
            <?php  } ?>

            <!-- APPROVE MANAGER CS -->

            <?php if ($approve_managerial['approve_mgr_cs']) {
                $nama_user = $this->db->get_where('tb_user', ['id_user' => $approve_managerial['approve_mgr_cs']])->row_array();
            ?>
                <div class="col-md-4">
                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i>Approve CS Manager</h3> <br>
                        <h4 class="text-title text-center"><?= $nama_user['nama_user'] ?></h4>
                        <h4 class="text-title text-center"><?= $approve_managerial['approve_mgr_cs_date'] ?></h4>
                    </div>
                </div>
            <?php  } else {
            ?>
                <div class="col-md-4">
                    <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                        <h4 class="text-title text-center mt-2"> <i class="fa fa-calendar text-danger"></i>Wait Approve CS Manager</h4> <br>
                        <h4 class="text-title text-center"></h4>
                    </div>
                </div>

            <?php  } ?>

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
                                        if ($msr['status_so'] == 3) {
                                        ?>
                                            <div class="col-md-4"> <a href="<?= base_url('finance/jobsheet/approveSo/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Jobsheet</a> </div>

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
                    <form action="<?= base_url('cs/salesOrder/editCapitalCost') ?>" method="POST">
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