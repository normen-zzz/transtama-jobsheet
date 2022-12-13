<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <form action="<?= base_url('finance/ap/createApProforma') ?>" method="POST">
                <div class="card-body">
                    <div class="content-header">
                        <center>
                            <h3 class="page-title text-center">CREATE AP <?= $vendor['nama_vendor']
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
                                    <a href="<?= base_url('finance/ap/detailAp/' . encrypt_url($id_vendor)) ?>" class="btn text-light" style="background-color: #9c223b;">
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
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>AWB</th>
                                                        <th>DATE</th>
                                                        <th>CONSIGNEE</th>
                                                        <th>DEST</th>
                                                        <th>COLLY</th>
                                                        <th>WEIGHT JS</th>
                                                        <th>WEIGHT MSR</th>

                                                        <th>FLIGHT SMU</th>


                                                        <th>HD Daerah</th>

                                                        <th>OTHERS</th>
                                                        <th>TOTAL AMOUNT</th>
                                                        <th>VARIABEL</th>
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


                                                    for ($i = 0; $i < sizeof($shipments); $i++) {
                                                        $this->db->select('a.shipment_id as resi, a.koli, a.berat_js,c.id_vendor,a.consigne, a.berat_msr, a.id,a.shipper, a.destination, a.tree_consignee,a.tgl_pickup,a.so_id, a.jobsheet_id, b.*, c.id_invoice, c.status');
                                                        $this->db->from('tbl_shp_order a');
                                                        $this->db->join('tbl_modal b', 'a.id=b.shipment_id');
                                                        $this->db->join('tbl_invoice_ap c', 'a.id=c.shipment_id');
                                                        $this->db->where('c.shipment_id', $shipments[$i]);
                                                        $query = $this->db->get()->row_array();
                                                        $total_sales = 0;


                                                    ?>
                                                        <tr>
                                                            <td><?= $query['resi'] ?> <br> <small><?= $query['shipper'] ?></small> </td>
                                                            <td><?= bulan_indo($query['tgl_pickup']) ?></td>
                                                            <td><?= $query['consigne'] ?></td>
                                                            <td><?= $query['tree_consignee'] ?></td>
                                                            <td><?= $query['koli'] ?></td>
                                                            <td><?= $query['berat_js'] ?></td>
                                                            <td><?= $query['berat_msr'] ?></td>

                                                            <?php if ($vendor['type'] == 0) {
                                                            ?>
                                                                <td><?= rupiah($query['flight_msu2']) ?></td>
                                                            <?php  } else {
                                                            ?>
                                                                <td><?= rupiah($query['hd_daerah2']) ?></td>
                                                            <?php  } ?>

                                                            <td><?= rupiah($query['others2']) ?></td>

                                                            <?php if ($vendor['type'] == 0) {
                                                            ?>
                                                                <td><?= rupiah($query['flight_msu2'] + $query['others2']) ?></td>
                                                            <?php  } else {
                                                            ?>
                                                                <td><?= rupiah($query['hd_daerah2'] + $query['others2']) ?></td>
                                                            <?php  } ?>
                                                            <td>
                                                                <input type="text" name="variabel[]" class="form-control">
                                                                <input hidden type="text" name="shipment_id[]" value="<?= $query['id'] ?>">
                                                                <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                                <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">
                                                            </td>
                                                        </tr>

                                                    <?php
                                                        $total_koli = $total_koli + $query['koli'];
                                                        $total_weight = $total_weight + $query['berat_js'];
                                                        $total_special_weight = $total_special_weight + $query['berat_msr'];

                                                        $total_smu = $total_smu + $query['flight_msu2'];
                                                        $total_hd_daerah =  $total_hd_daerah + $query['hd_daerah2'];

                                                        $sub_total_smu = $sub_total_smu +  $query['flight_msu2'] + $query['others2'];
                                                        $sub_total_hd_daerah = $sub_total_hd_daerah +  $query['hd_daerah2'] + $query['others2'];

                                                        $others =  $others + $query['others2'];
                                                    } ?>

                                                    <tr>
                                                        <td colspan="4">TOTAL <?= $i ?> AWB</td>
                                                        <td><?= $total_koli ?> </td>
                                                        <td><?= $total_weight ?> </td>
                                                        <td><?= $total_special_weight ?> </td>
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
                                                        <td>

                                                            <!-- <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Submit</button> -->

                                                        </td>
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

                                <div class="col-md-4">
                                    <label for="pic" class="font-weight-bold">No. Invoice</label>
                                    <input type="text" name="no_invoice" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="due_date" class="font-weight-bold">Due Date</label>
                                    <input type="date" class="form-control" name="due_date" required>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">PPN</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="ppn" type="checkbox" value="1" id="ppn">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">PPH</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="pph" type="checkbox" value="1" id="pph">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Process AP</button>
                                </div>
                            </div>
                        </div>
                    </section>
            </form>
        </div>
    </div>
</div>
</div>