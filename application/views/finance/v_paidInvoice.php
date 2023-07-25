<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">
                    <center>
                        <h3 class="title text-center"><i class="fa fa-dollar-sign"></i>PROFORMA INVOICE <?= $shipper['shipper']
                                                                                                        ?> </h3>
                    </center>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="overflow: auto;">
                        <form action="<?= base_url('finance/jobsheet/procesCreateInvoice') ?>" method="POST">
                            <div class="col-12">
                                <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>No Invoice</th>
                                                        <th>Date Created</th>
                                                        <th>Due Date</th>
                                                        <th>Time Line</th>
                                                        <th>Customer Invoice</th>
                                                        <th>Customer Pickup</th>
                                                        <th>Payment Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                    foreach ($proforma as $j) {
                                                        $total_mepet = 0;

                                                        $tgl1 = strtotime(date('Y-m-d'));
                                                        $tgl2 = strtotime($j['due_date']);

                                                        $jarak = $tgl2 - $tgl1;

                                                        $perbedaan = $jarak / 60 / 60 / 24;

                                                        if ($perbedaan <= 7) {
                                                            $total_mepet = $total_mepet + 1;
                                                        }
                                                        // echo $total_mepet;
                                                    ?>
                                                        <tr>

                                                            <!-- <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td> -->
                                                            <td><input type="checkbox" class="no_invoice" value="<?= $j['no_invoice'] ?>" name="no_invoice[]" id="no_invoice"></td>
                                                            <td><a target="blank" href="<?= 'https://tesla-smartwork.transtama.com/Invoice/printProforma/' . $j['no_invoice'] ?>"><?= $j['no_invoice'] ?></a> </td>
                                                            <td><?= bulan_indo($j['date']) ?></td>
                                                            <td><?php if ($j['status'] == 2) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                                } else {
                                                                    echo  bulan_indo($j['due_date']);
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($j['status'] == 2) {
                                                                    echo '<span class="text-success">Paid</span> ';
                                                                } else {
                                                                    if ($perbedaan <= 7) {
                                                                        $total_mepet = $total_mepet + 1;
                                                                ?>
                                                                        <span data-perbedaan="<?= $total_mepet ?>" id="the-span"></span>
                                                                    <?php   }


                                                                    if ($perbedaan < 0) {
                                                                        $total_mepet += 1;
                                                                        echo '<span class="text-danger">Expired</span> 
																	<br> Please Follow up This invoice';
                                                                    ?>
                                                                <?php
                                                                    } elseif ($perbedaan <= 7 || $perbedaan >= 0) {
                                                                        echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                    } else {
                                                                        echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $j['customer'] ?></td>
                                                            <td><?= $j['customer_pickup'] ?></td>
                                                            <td>
                                                                <?php if ($j['status'] == 1) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter">Pending</span>';
                                                                } elseif ($j['status'] == 2) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                                } elseif ($j['status'] == 3) {
                                                                    echo '<span class="label label-purple label-inline font-weight-lighter">Unpaid</span>';
                                                                }  ?>
                                                            </td>
                                                            

                                                        </tr>

                                                    <?php } ?>





                                                </tbody>


                                            </table>
                                            <br>
                                            <h3 class="title text-center"><i class="fa fa-building"></i>PROFORMA INVOICE INFORMATION</h3>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-4">
                                    <label for="pic" class="font-weight-bold">Customer</label>
                                    <?php
                                    $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);
                                    $terbilang = $f->format($total_amount) . ' Rupiahs';
                                    $terbilang = ucwords($terbilang);
                                    ?>
                                    <input type="text" class="form-control" name="terbilang" hidden value="<?= $terbilang ?>">
                                    <input type="text" class="form-control" name="invoice" hidden value="<?= $amount ?>">
                                    <input type="text" class="form-control" name="ppn" hidden value="<?= $ppn ?>">
                                    <input type="text" class="form-control" name="pph" hidden value="<?= $pph ?>">
                                    <input type="text" class="form-control" name="total_invoice" hidden value="<?= $total_amount ?>">
                                    <input type="text" name="shipper" value="<?= $get_shipment['shipper'] ?>" class="form-control">
                                    <input type="text" name="customer_pickup" hidden value="<?= $get_shipment['shipper'] ?>" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label for="pic" class="font-weight-bold">Address</label>
                                    <textarea name="address" class="form-control"><?= $get_shipment['city_shipper'] ?></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="pic" class="font-weight-bold">No. Telp</label>
                                    <input type="no_telp" name="no_telp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="pic" class="font-weight-bold">PIC Invoice</label>
                                    <input type="pic" name="pic" value="<?= $get_shipment['pic_invoice'] ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="due_date" class="font-weight-bold">Due Date</label>
                                    <input type="date" class="form-control" name="due_date" required>
                                    <!-- <input type="text" name="shipment_id" class="form-control" value="<?= $shipment_id ?>"> -->
                                </div>
                            </div>
                            <br><br>
                            <h3 class="title text-center"><i class="fa fa-cog"></i> Setting Options</h3> <br>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Print DO</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="print_do" type="checkbox" value="1" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">PPN</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_ppn" type="checkbox" value="1" id="ppn">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">PPH</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_pph" type="checkbox" value="1" id="pph">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Reimbursment</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_reimbursment" type="checkbox" value="1" id="reimbursment">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Special Rate</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_special" type="checkbox" value="1" id="special">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Packing</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_packing" type="checkbox" value="1" id="packing">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Insurance</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_insurance" type="checkbox" value="1" id="insurance">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Others</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_others" type="checkbox" value="1" id="others">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Remarks</label>
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_remarks" type="checkbox" value="1" id="remarks">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">Process Invoice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>