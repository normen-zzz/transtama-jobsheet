<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <form action="<?= base_url('finance/apExternal/processEditAp') ?>" method="POST">
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
                                    <a href="<?= base_url('finance/apExternal/created') ?>" class="btn text-light" style="background-color: #9c223b;">
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
                                                        <th>Flight SMU</th>
                                                        <th>HD Daerah</th>

                                                        <th>OTHERS</th>
                                                        <th>TOTAL AMOUNT</th>
                                                        <th>VARIABEL</th>
                                                        <th>DIFFERENCE</th>
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


                                                            <td>
                                                                <input type="text" name="variabel[]" class="form-control" value="<?= $inv['variabel'] ?>">
                                                                <input hidden type="text" name="shipment_id[]" value="<?= $inv['id'] ?>">
                                                                <input hidden type="text" name="id_invoice[]" value="<?= $inv['id_invoice'] ?>">
                                                                <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                                <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">
                                                            </td>


                                                            <td><?= rupiah((int)$inv['variabel'] - ($inv['flight_msu2'] + $inv['hd_daerah2'] + (int)$inv['others2'])) ?></td>

                                                        </tr>

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

                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>

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
                                    $terbilang = $f->format($sub_total_hd_daerah + $inv['other']) . ' Rupiahs';
                                    $terbilang = ucwords($terbilang);
                                    ?>

                                    <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_hd_daerah ?>">
                                    <input type="text" class="form-control" name="terbilang" hidden value="<?= $terbilang ?>">
                                    <input type="text" class="form-control" name="unique_invoice" hidden value="<?= $inv['unique_invoice'] ?>">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
                                            <textarea class="form-control" required name="purpose" readonly disabled><?= $inv['purpose'] ?></textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="pic" class="font-weight-bold">No. Invoice</label>
                                        <input type="text" name="no_invoice" value="<?= $inv['no_invoice'] ?>" readonly class="form-control" disabled>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Other (Rp.) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" required name="other" value="<?= $inv['other'] ?>"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="due_date" class="font-weight-bold">Ppn (%)</label>
                                        <input type="text" class="form-control" name="ppn" value="<?= ($inv['ppn'] / ($inv['total_ap'])) * 100 ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="due_date" class="font-weight-bold"> Special Ppn (Rp.)</label>
                                        <input type="text" class="form-control" name="special_ppn" value="<?= $inv['special_ppn'] ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="due_date" class="font-weight-bold">Pph (%)</label>
                                        <input type="text" class="form-control" name="pph" value="<?= ($inv['pph'] / ($inv['total_ap'])) * 100 ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="due_date" class="font-weight-bold">Special Pph (Rp.)</label>
                                        <input type="text" class="form-control" name="special_pph" value="<?= $inv['special_pph'] ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="due_date" class="font-weight-bold">Due Date</label>
                                        <input type="date" class="form-control" name="due_date" value="<?= $inv['due_date'] ?>" disabled>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php

                                        if ($inv['status'] <= 2) {
                                        ?>
                                            <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Update Po</button>
                                            <a href="<?= base_url('finance/apExternal/approve/' . $inv['unique_invoice']) ?>" class=" btn btn-sm text-light mt-6 ml-4 tombol-konfirmasi" style="background-color: #9c223b;">Received</a>

                                        <?php    } elseif ($inv['status'] == 3) {

                                        ?>
                                            <span>
                                                <span class="fa fa-check-circle text-success"></span>
                                                This <?= $inv['no_invoice'] ?> has been Received, Wait Approve Manager Finance To Check
                                            </span>

                                        <?php } elseif ($inv['status'] == 5) {

                                        ?>
                                            <span>
                                                <span class="fa fa-check-circle text-success"></span>
                                                This <?= $inv['no_invoice'] ?> has Approved by GM, Please to pay according the Approved Amount
                                            </span>

                                        <?php } else {

                                        ?>
                                            <span>
                                                <span class="fa fa-check-circle text-success"></span>
                                                This <?= $inv['no_invoice'] ?> was Paid
                                            </span>

                                        <?php } ?>
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