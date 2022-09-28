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
                                                        <th>AWB</th>
                                                        <th>DATE</th>
                                                        <th>DEST</th>
                                                        <th style="width: 10%;">NO.DO</th>
                                                        <th style="width: 20%;">REMARKS</th>
                                                        <!-- <th style="width: 20%;">MODA</th> -->
                                                        <th>SERVICE</th>
                                                        <th>COLLIE</th>
                                                        <th>WEIGHT</th>
                                                        <th>RATE</th>
                                                        <th>SPECIAL WEIGHT</th>
                                                        <th>SPECIAL RATE</th>
                                                        <th>PACKING</th>
                                                        <th>OTHERS</th>
                                                        <th>INSURANCE</th>
                                                        <th>SURCHARGE</th>
                                                        <th>TOTAL AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_koli = 0;
                                                    $total_weight = 0;
                                                    $total_special_weight = 0;
                                                    $total_amount = 0;
                                                    $amount = 0;

                                                    for ($i = 0; $i < sizeof($shipment_id); $i++) {
                                                        $total_awb = sizeof($shipment_id);
                                                        $this->db->select('a.*, b.service_name, b.prefix');
                                                        $this->db->from('tbl_shp_order a');
                                                        $this->db->join('tb_service_type b', 'a.service_type=b.code');
                                                        $this->db->where('a.id', $shipment_id[$i]);
                                                        $get_shipment = $this->db->get()->row_array();


                                                        $get_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $get_shipment['shipment_id']]);
                                                        $data_do = $get_do->result_array();
                                                        $total_do = $get_do->num_rows();


                                                        $service =  $get_shipment['service_name'];
                                                        if ($service == 'Charter Service') {
                                                            $packing = $get_shipment['packing'];
                                                            $total_sales = ($get_shipment['freight_kg'] + $packing +  $get_shipment['special_freight'] +  $get_shipment['others'] + $get_shipment['surcharge'] + $get_shipment['insurance']);
                                                        } else {
                                                            $disc = $get_shipment['disc'];
                                                            // kalo gada disc
                                                            if ($disc == 0) {
                                                                $freight  = $get_shipment['berat_js'] * $get_shipment['freight_kg'];
                                                                $special_freight  = $get_shipment['berat_msr'] * $get_shipment['special_freight'];
                                                            } else {
                                                                $freight_discount = $get_shipment['freight_kg'] * $disc;
                                                                $special_freight_discount = $get_shipment['special_freight'] * $disc;
                                                                $freight = $freight_discount * $get_shipment['berat_js'];
                                                                $special_freight  = $special_freight_discount * $get_shipment['berat_msr'];
                                                            }
                                                            $packing = $get_shipment['packing'];
                                                            $total_sales = ($freight + $packing + $special_freight +  $get_shipment['others'] + $get_shipment['surcharge'] + $get_shipment['insurance']);
                                                        }

                                                    ?>
                                                        <?php

                                                        if ($total_do == 0) {
                                                        ?>
                                                            <tr>

                                                                <input hidden type="text" name="shipment_id[]" value="<?= $get_shipment['id'] ?>">
                                                                <td><?= $get_shipment['shipment_id'] ?></td>
                                                                <td><?= bulan_indo($get_shipment['tgl_pickup']) ?></td>
                                                                <td><?= $get_shipment['tree_consignee'] ?></td>
                                                                <td>
                                                                    <input type="text" name="note_cs[]" class="form-control" value="<?= $get_shipment['note_cs'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="so_note[]" value="<?= $get_shipment['so_note'] ?>">
                                                                </td>
                                                                <td><?= $get_shipment['prefix'] ?></td>
                                                                <td><?= $get_shipment['koli'] ?></td>
                                                                <td><?= $get_shipment['berat_js']; ?></td>
                                                                <td><?php
                                                                    echo  rupiah($get_shipment['freight_kg']);
                                                                    ?></td>
                                                                <td><?= $get_shipment['berat_msr']; ?></td>
                                                                <td><?php
                                                                    echo rupiah($get_shipment['special_freight']);
                                                                    ?></td>
                                                                <td><?= rupiah($get_shipment['others']); ?></td>
                                                                <td><?= rupiah($get_shipment['packing']); ?></td>
                                                                <td><?= rupiah($get_shipment['insurance']); ?></td>
                                                                <td><?= rupiah($get_shipment['surcharge']); ?></td>


                                                                <td><?php
                                                                    echo rupiah($total_sales);
                                                                    ?></td>

                                                            </tr>

                                                        <?php } else {
                                                        ?>
                                                            <th rowspan="<?= $total_do + 1 ?>"><?= $get_shipment['shipment_id'] ?></th>
                                                            <?php
                                                            foreach ($data_do as $d) {
                                                            ?>
                                                                <tr>
                                                                    <input hidden type="text" name="shipment_id[]" value="<?= $get_shipment['id'] ?>">
                                                                    <!-- <td><?= $get_shipment['shipment_id'] ?></td> -->
                                                                    <td><?= bulan_indo($get_shipment['tgl_pickup']) ?></td>
                                                                    <td><?= $get_shipment['tree_consignee'] ?></td>
                                                                    <td><?= $d['no_do'] ?></td>
                                                                    <td>
                                                                        <input type="text" name="so_note[]" value="<?= $get_shipment['so_note'] ?>">
                                                                    </td>
                                                                    <td><?= $get_shipment['prefix'] ?></td>
                                                                    <td><?= $d['koli'] ?></td>
                                                                    <td><?= $d['berat']; ?></td>
                                                                    <td><?php
                                                                        echo  rupiah($get_shipment['freight_kg']);
                                                                        ?></td>
                                                                    <td><?= $get_shipment['berat_msr']; ?></td>
                                                                    <td><?php
                                                                        echo rupiah($get_shipment['special_freight']);
                                                                        ?></td>
                                                                    <td><?= rupiah($get_shipment['others']); ?></td>
                                                                    <td><?= rupiah($get_shipment['packing']); ?></td>
                                                                    <td><?= rupiah($get_shipment['insurance']); ?></td>
                                                                    <td><?= rupiah($get_shipment['surcharge']); ?></td>
                                                                    <td><?php
                                                                        echo rupiah($total_sales);
                                                                        ?></td>
                                                                </tr>
                                                            <?php $total_koli = $total_koli + $d['koli'];
                                                            } ?>

                                                        <?php  } ?>

                                                    <?php
                                                        // $total_koli = $total_koli + $get_shipment['koli'];
                                                        $total_weight = $total_weight + $get_shipment['berat_js'];
                                                        $total_special_weight = $total_special_weight + $get_shipment['berat_msr'];
                                                        $amount = $amount + $total_sales;
                                                    } ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">TOTAL <?= $total_awb ?> AWB</td>
                                                        <td><?= $total_koli ?></td>
                                                        <td><?= $total_weight ?></td>
                                                        <td></td>
                                                        <td><?= $total_special_weight ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="font-weight-bold">SUB TOTAL</td>
                                                        <td><?= rupiah($amount) ?></td>
                                                    </tr>
                                                    <tr style="border:none">
                                                        <td colspan="14">
                                                        </td>
                                                        <td class="font-weight-bold">
                                                            PPN 1,1 %
                                                        </td>
                                                        <td>
                                                            <?php

                                                            $ppn =  $amount * 0.011;
                                                            $pph =  $amount * 0.02;
                                                            echo rupiah($ppn);
                                                            ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="14">

                                                        </td>
                                                        <td class="font-weight-bold">
                                                            TOTAL
                                                        </td>
                                                        <td>
                                                            <?php $total_amount = $amount + $ppn;
                                                            echo  rupiah($total_amount);
                                                            ?>
                                                        </td>
                                                    </tr>

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