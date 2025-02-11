<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title text-center">INVOICE <?= $due_date['customer']
                                                                        ?> </h3>
                            <div class="d-inline-block align-items-center">
                                <a href="<?= base_url('finance/invoice/final') ?>" class="btn text-light" style="background-color: #9c223b;">
                                    <i class="fa fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <section class=" content">
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
                                                    <th>DEST</th>
                                                    <th>NO.DO</th>
                                                    <th>SERVICE</th>
                                                    <th>COLLIE</th>
                                                    <th>WEIGHT</th>
                                                    <th>SPECIAL WEIGHT</th>
                                                    <th>RATE</th>
                                                    <th>TOTAL AMOUNT</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total_koli = 0;
                                                $total_weight = 0;
                                                $total_special_weight = 0;
                                                $total_amount = 0;

                                                foreach ($invoice as $inv) {
                                                    $no = 1;


                                                    $service =  $inv['service_name'];
                                                    if ($service == 'Charter Service') {
                                                        $packing = $inv['packing'];
                                                        $total_sales = ($inv['freight_kg'] + $packing +  $inv['special_freight'] +  $inv['others'] + $inv['surcharge'] + $inv['insurance']);
                                                    } else {
                                                        $disc = $inv['disc'];
                                                        // kalo gada disc
                                                        if ($disc == 0) {
                                                            $freight  = $inv['berat_js'] * $inv['freight_kg'];
                                                            $special_freight  = $inv['berat_msr'] * $inv['special_freight'];
                                                        } else {
                                                            $freight_discount = $inv['freight_kg'] * $disc;
                                                            $special_freight_discount = $inv['special_freight'] * $disc;
                                                            $freight = $freight_discount * $inv['berat_js'];
                                                            $special_freight  = $special_freight_discount * $inv['berat_msr'];
                                                        }
                                                        $packing = $inv['packing'];
                                                        $total_sales = ($freight + $packing + $special_freight +  $inv['others'] + $inv['surcharge'] + $inv['insurance']);
                                                    }



                                                ?>
                                                    <tr>

                                                        <input hidden type="text" name="shipment_id[]" value="<?= $inv['id'] ?>">
                                                        <td><?= $inv['shipment_id'] ?></td>
                                                        <td><?= bulan_indo($inv['tgl_pickup']) ?></td>
                                                        <td><?= $inv['tree_consignee'] ?></td>
                                                        <td><?= $inv['note_cs'] ?></td>
                                                        <td><?= $inv['prefix'] ?></td>
                                                        <td><?= $inv['koli'] ?></td>
                                                        <td><?= $inv['berat_js']; ?></td>
                                                        <td><?= $inv['berat_msr']; ?></td>
                                                        <td><?php if ($service == 'Charter Service') {
                                                                echo rupiah($inv['special_freight']);
                                                            } else {
                                                                echo  rupiah($inv['freight_kg']);
                                                            } ?></td>

                                                        <td><?php
                                                            echo rupiah($total_sales);
                                                            ?></td>
                                                        <!-- <td> <a href="<?= base_url('finance/invoice/deleteInvoice/' . $inv['id_invoice'] . '/' . $inv['no_invoice']) ?>" class=" btn btn-sm text-light tombol-hapus" data-flashdata="<?= $inv['shipment_id'] ?>" style="background-color: #9c223b;">Delete</a></td> -->

                                                    </tr>

                                                <?php
                                                    $total_koli = $total_koli + $inv['koli'];
                                                    $total_weight = $total_weight + $inv['berat_js'];
                                                    $total_special_weight = $total_special_weight + $inv['berat_msr'];
                                                    $total_amount = $total_amount + $total_sales;
                                                    $no++;
                                                } ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">TOTAL <?= $total_invoice ?> AWB</td>
                                                    <td><?= $total_koli ?></td>
                                                    <td><?= $total_weight ?></td>
                                                    <td><?= $total_special_weight ?></td>
                                                    <td class="font-weight-bold">SUB TOTAL</td>
                                                    <td><?= rupiah($total_amount) ?></td>
                                                </tr>
                                                <?php if ($inv['is_ppn'] == 1) {
                                                ?>
                                                    <tr style="border:none">
                                                        <td colspan="8">
                                                        </td>
                                                        <td class="font-weight-bold">
                                                            PPN 1,1 %
                                                        </td>
                                                        <td>
                                                            <?php

                                                            $ppn =  $total_amount * 0.011;
                                                            echo rupiah($ppn);
                                                            ?>

                                                        </td>
                                                    </tr>
                                                <?php  }  ?>
                                                <tr>
                                                    <td colspan="8">

                                                    </td>
                                                    <td class="font-weight-bold">
                                                        TOTAL
                                                    </td>
                                                    <td>
                                                        <?php $total_amount = $total_amount + $ppn;
                                                        echo  rupiah($total_amount);
                                                        ?>

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
                        <div class="col-md-4">
                            <label for="pic" class="font-weight-bold">Customer</label>
                            <input type="pic" name="shipper" value="<?= $inv['customer'] ?>" class="form-control" disabled>
                        </div>
                        <div class="col-md-5">
                            <label for="pic" class="font-weight-bold">Address</label>
                            <textarea name="address" class="form-control" disabled><?= $inv['address'] ?></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="pic" class="font-weight-bold">No. Telp</label>
                            <input type="no_telp" name="no_telp" class="form-control" value="<?= $inv['no_telp'] ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="pic" class="font-weight-bold">PIC Invoice</label>
                            <input type="pic" name="pic" value="<?= $inv['pic'] ?>" class="form-control" disabled>
                            <input type="no_invoice" name="no_invoice" hidden value="<?= $inv['no_invoice'] ?>" class="form-control">
                            <input type="text" name="id_invoice" hidden value="<?= $inv['id_invoice'] ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="due_date" class="font-weight-bold">Due Date</label>
                            <input type="date" class="form-control" name="due_date" value="<?= $inv['due_date'] ?>" required disabled>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="font-weight-bold">Print DO</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="print_do" type="checkbox" <?php if ($inv['print_do'] == 1) {
                                                                                                        echo 'checked';
                                                                                                    } ?> value="1" id="flexCheckDefault" disabled>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ya
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="font-weight-bold">PPN</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="is_ppn" disabled type="checkbox" value="1" id="ppn" <?php if ($inv['is_ppn'] == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ya
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="font-weight-bold">PPH</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="is_pph" disabled type="checkbox" value="1" id="pph" <?php if ($inv['is_pph'] == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="mr-auto">
                                <h3 class="page-title text-center">PAYMENT STATUS <?= $shipper['shipper']
                                                                                    ?> </h3>
                                <div class="d-inline-block align-items-center">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if ($inv['status'] == 2) {
                            ?>
                                <div class="d-flex align-items-center flex-wrap mb-8">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50 symbol-light mr-5 bg-success">
                                        <span class="symbol-label  bg-success">
                                            <i class="fa fa-check text-light"></i>
                                        </span>
                                    </div>
                                    <!--begin::Text-->

                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <a href="#" data-toggle="modal" data-target="#modal-paid<?= $inv['no_invoice'] ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Paid</a>
                                        <?php
                                        $due_date = new DateTime($inv['due_date']);
                                        $date = date('Y-m-d');
                                        $date = new DateTime($date);
                                        $perbedaan = $due_date->diff($date)->format("%a");
                                        ?>
                                        <span class="text-success font-weight-bold"><?= bulan_indo($inv['payment_date']) ?>, <?= $inv['payment_time'] ?></span>
                                    </div>
                                    <!--end::Text-->
                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder"><?php
                                                                                                                                        echo  rupiah($total_amount);
                                                                                                                                        ?></span>

                                </div>
                            <?php } else {
                            ?>

                                <div class="d-flex align-items-center flex-wrap mb-8">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50 symbol-light mr-5 bg-danger">
                                        <span class="symbol-label  bg-danger">
                                            <i class="fa fa-window-close text-light"></i>
                                        </span>
                                    </div>
                                    <!--begin::Text-->

                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Unpaid</a>
                                        <?php
                                        $due_date = new DateTime($inv['due_date']);
                                        $date = date('Y-m-d');
                                        $date = new DateTime($date);
                                        $perbedaan = $due_date->diff($date)->format("%a");
                                        ?>
                                        <span class="text-muted font-weight-bold"><?= $perbedaan ?> Days Again</span>
                                    </div>
                                    <!--end::Text-->
                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder"><?php
                                                                                                                                        echo  rupiah($total_amount);
                                                                                                                                        ?></span>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-paid<?= $inv['no_invoice'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proof of Payment with no <b><?= $inv['no_invoice'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/invoice/paid') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            $files = explode('+', $inv['bukti_bayar']);
                            $no = 1;
                            foreach ($files as $file) {

                            ?>
                                <div class="col-md-6">
                                    <b>Image <?= $no ?> :</b> <img src="<?= base_url('uploads/bukti_bayar/') ?><?= $file ?>" height="350px"> <br>
                                    <?php $no++; ?>
                                </div>
                            <?php    } ?>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>