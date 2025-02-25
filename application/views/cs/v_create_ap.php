<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <form action="<?= base_url('cs/apExternal/createApProforma') ?>" method="POST">
                <div class="card-body">
                    <div class="content-header">
                        <center>
                            <h3 class="page-title text-center">CREATE PO <?= $vendor['nama_vendor']
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
                                    <a href="<?= base_url('cs/apExternal/detailAp/' . encrypt_url($id_vendor)) ?>" class="btn text-light" style="background-color: #9c223b;">
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
                                                        <!-- <th>VARIABEL</th> -->
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
                                                        $this->db->where('b.id_vendor', $id_vendor);

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

                                                            <td><?= rupiah($query['flight_msu2']) ?></td>

                                                            <td><?= rupiah($query['hd_daerah2']) ?></td>
                                                            <td><?= rupiah((int)$query['others2']) ?></td>

                                                            <td><?= rupiah((int)$query['flight_msu2'] + (int)$query['others2'] + (int)$query['hd_daerah2']) ?></td>

                                                            <!-- <input type="text" name="variabel[]" class="form-control"> -->
                                                            <input hidden type="text" name="shipment_id[]" value="<?= $query['id'] ?>">
                                                            <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                            <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">

                                                        </tr>

                                                    <?php
                                                        $total_koli = $total_koli + $query['koli'];
                                                        $total_weight = $total_weight + $query['berat_js'];
                                                        $total_special_weight = $total_special_weight + $query['berat_msr'];

                                                        $total_smu = $total_smu + $query['flight_msu2'];
                                                        $total_hd_daerah =  $total_hd_daerah + $query['hd_daerah2'];


                                                        $sub_total_hd_daerah = $sub_total_hd_daerah +  (int)$query['hd_daerah2'] + (int)$query['others2'] + (int)$query['flight_msu2'];
                                                        // } else {
                                                        //     $sub_total_hd_daerah = $sub_total_hd_daerah +  $query['hd_daerah2'] + $query['others2'];
                                                        // }

                                                        $others =  $others + (int)$query['others2'];
                                                    } ?>

                                                    <tr>
                                                        <td colspan="4">TOTAL <?= $i ?> AWB</td>
                                                        <td><?= $total_koli ?> </td>
                                                        <td><?= $total_weight ?> </td>
                                                        <td><?= $total_special_weight ?> </td>

                                                        <td><?= rupiah($total_smu) ?></td>

                                                        <td><?= rupiah($total_hd_daerah) ?></td>

                                                        <td><?= rupiah($others) ?> </td>


                                                        <td><?= rupiah($sub_total_hd_daerah) ?></td>


                                                    </tr>

                                                </tbody>

                                            </table>
                                            <br>
                                            <h3 class="title text-center"><i class="fa fa-info"></i> PO INFORMATION</h3>
                                            <br>

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>

                            </div>


                            <?php
                            $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);

                            // $terbilang = $f->format($sub_total_smu) . ' Rupiahs';
                            // $terbilang = ucwords($terbilang);
                            // rupiah($sub_total_smu);
                            // } else {
                            $terbilang = $f->format($sub_total_hd_daerah) . ' Rupiahs';
                            $terbilang = ucwords($terbilang);
                            // }


                            ?>
                            <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_hd_daerah ?>">

                            <input type="text" class="form-control" name="terbilang" value="<?= $terbilang ?>" hidden>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Other (Rp.) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" required name="other" value="0"></input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
                                    <textarea class="form-control" required name="purpose"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="pic" class="font-weight-bold">No. Invoice <span class="text-danger">*</span></label>
                                <input type="text" name="no_invoice" id="no_invoice" class="form-control" required>
                                <span id="alertNoInvoice" style="color: red; display:none">No Invoice Sudah Ada,Pastikan cek kembali agar tidak terjadi tagihan berulang</span>
                            </div>

                            <div class="col-md-4">
                                <label for="pic" class="font-weight-bold">Due Date <span class="text-danger">*</span></label>
                                <input type="date" name="due_date" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="note_cs">Payment Mode</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode" value="0" onclick="javascript:Cash();" id="cash">
                                    <label class="form-check-label" for="mode1">
                                        Cash
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode" value="1" onclick="javascript:Cash();" id="tf">
                                    <label class="form-check-label" for="mode2">
                                        Bank Transfer
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4" style="display:none;" id="via">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Via</label>
                                    <input type="text" name="via" class="form-control">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="btnSubmitPo" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Submit PO</button>
                                </div>
                            </div>
                        </div>
                    </section>
            </form>
        </div>
    </div>
</div>
</div>

<script>
     //JS
     $("#no_invoice").bind("keyup change", function() {

         var no_invoice = $(this).val();

         $.ajax({
             url: '<?= base_url('cs/ApExternal/checkNoInvoice') ?>',
             type: "get", // <---- ADD this to mention that your ajax is post
             data: {

                 no_invoice: no_invoice
             }, // <-- ADD email here as pram to be submitted
             success: function(data) {
                 if (data == 1) {
                    $('#alertNoInvoice').attr('style','color: red; display:block');
                    $("#btnSubmitPo").prop("disabled",true);

                 } else {
                     $("#alertNoInvoice").attr('style','color: red; display:none');
                     $("#btnSubmitPo").prop("disabled",false);

                 }
             }
         });

     });
 </script>