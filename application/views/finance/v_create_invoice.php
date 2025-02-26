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
                                                            <input hidden type="text" name="shipment_id[]" value="<?= $get_shipment['id'] ?>">
                                                            <th rowspan="<?= $total_do + 1 ?>"><?= $get_shipment['shipment_id'] ?></th>
                                                            <?php
                                                            foreach ($data_do as $d) {
                                                            ?>
                                                                <tr>

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
                                                            <?php $total_koli = $total_koli + (int)$d['koli'];
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
                                                        <td class="font-weight-bold" id="percent_ppn_view">

                                                        </td>
                                                        <td id="amount_ppn">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="14">

                                                        </td>
                                                        <td class="font-weight-bold">
                                                            TOTAL
                                                        </td>
                                                        <td id="total">

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
                                    <input type="text" class="form-control" name="terbilang" id="terbilang" value="<?= $terbilang ?>" hidden>
                                    <input type="text" class="form-control" name="invoice" id="amount" value="<?= $amount ?>" hidden>
                                    <input type="text" class="form-control" name="ppn" id="ppn" hidden>
                                    <input type="text" class="form-control" name="pph" id="pph" hidden>
                                    <input type="text" class="form-control" name="total_invoice" id="total_invoice" value="<?= $total_amount ?>" hidden>
                                    <input type="text" name="shipper" value="<?= $get_shipment['shipper'] ?>" class="form-control">
                                    <input type="text" name="customer_pickup" hidden value="<?= $get_shipment['shipper'] ?>" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="percent_ppn" class="font-weight-bold">PPN</label>
                                    <input type="number" name="percent_ppn" id="percent_ppn" value="1.1" class="form-control">
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
                                            <input class="form-check-input" name="is_ppn" type="checkbox" value="1" id="is_ppn">
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
                                    <button type="button" class="btn btn-success mt-6 ml-4" id="btnProcessInvoice">Process Invoice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function formatRupiah(angka, prefix) {
            if (typeof angka !== "string") angka = String(angka);

            // Hapus karakter non-angka
            let numberString = "";
            for (let i = 0; i < angka.length; i++) {
                if (angka[i] >= "0" && angka[i] <= "9" || angka[i] === ",") {
                    numberString += angka[i];
                }
            }

            // Format angka menjadi Rupiah
            let split = numberString.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + " " + rupiah : "");
        }

        function terbilang(n) {
                const belowTwenty = [
                    "", "one", "two", "three", "four", "five",
                    "six", "seven", "eight", "nine", "ten",
                    "eleven", "twelve", "thirteen", "fourteen", "fifteen",
                    "sixteen", "seventeen", "eighteen", "nineteen"
                ];
                const tens = [
                    "", "", "twenty", "thirty", "forty", "fifty",
                    "sixty", "seventy", "eighty", "ninety"
                ];
                const scales = [
                    "", "thousand", "million", "billion", "trillion"
                ];

                // Recursive function to convert numbers to words
                function toWords(num) {
                    if (num === 0) return "zero";
                    if (num < 20) return belowTwenty[num];
                    if (num < 100) {
                        return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? " " + belowTwenty[num % 10] : "");
                    }
                    if (num < 1000) {
                        return belowTwenty[Math.floor(num / 100)] + " hundred" +
                            (num % 100 !== 0 ? " and " + toWords(num % 100) : "");
                    }

                    let scaleIndex = 0, remainingNum = num;
                    let words = "";

                    while (remainingNum > 0) {
                        const chunk = remainingNum % 1000;
                        if (chunk !== 0) {
                            const chunkWords = toWords(chunk);
                            words = chunkWords + " " + scales[scaleIndex] + (words ? " " + words : "");
                        }
                        remainingNum = Math.floor(remainingNum / 1000);
                        scaleIndex++;
                    }

                    return words.trim();
                }

                return toWords(n);
            }


        var percent_ppn = $('#percent_ppn').val();
        var amount = $('#amount').val();
        var ppn = amount * percent_ppn / 100;
        $('#amount_ppn').html(formatRupiah(Math.round(ppn)));
        //set value input name ppn using name
        $('#ppn').val(Math.round(ppn));


        // percent_ppn_view
        $('#percent_ppn_view').html('PPN ' + percent_ppn + ' %');
        var total_amount = parseInt(amount) + parseInt(ppn);
        $('#total').html(formatRupiah(Math.round(total_amount)));
        $('#total_invoice').val(Math.round(total_amount));
        // pph 
        $('#pph').val(Math.round(amount * 2 / 100));
        // terbilang 
        var terbilangs = terbilang(total_amount) + ' Rupiahs'
        $('#terbilang').val(terbilangs.toUpperCase())
        $('#percent_ppn').keyup(function() {
            var percent_ppn = $('#percent_ppn').val();
            var amount = $('#amount').val();
            var ppn = amount * percent_ppn / 100;
            $('#amount_ppn').html(formatRupiah(Math.round(ppn)));
            //set value input name ppn using name
            $('#ppn').val(Math.round(ppn));


            // percent_ppn_view
            $('#percent_ppn_view').html('PPN ' + percent_ppn + ' %');
            var total_amount = parseInt(amount) + parseInt(ppn);
            $('#total').html(formatRupiah(Math.round(total_amount)));
            // #amount 
            $('#total_invoice').val(Math.round(total_amount));
            var terbilangs = terbilang(total_amount) + ' Rupiahs'
            $('#terbilang').val(terbilangs.toUpperCase())



            
        });
    });
</script>

<script>
    // btnProcessInvoice
    // confirm swal 
    $('#btnProcessInvoice').click(function() {
        // cek yang required di form apakah sudah diisi
        var due_date = $('input[name="due_date"]').val();
        var address = $('textarea[name="address"]').val();
        
        var pic = $('input[name="pic"]').val();
        if (due_date == '' || address == '' ) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill all required field!',
            })
            return false;
        }
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to create invoice for this shipment?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Create Invoice!'
        }).then((result) => {
            if (result.isConfirmed) {
                // submit form 
                $('form').submit();
                // swal loading 
                Swal.fire({
                    title: 'Please Wait..',
                    html: 'Creating Invoice',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    allowOutsideClick: false,
                    showConfirmButton: false
                })
            }
        })
    });

</script>