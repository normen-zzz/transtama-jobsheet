<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css">
<style>
    table {
        width: 100%;
        font-size: 12pt;

    }

    table,
    th,
    td {
        border-collapse: collapse;
        text-align: left;
        table-layout: fixed;
        font-size: 13px;

    }

    td {
        color: black;
        word-wrap: break-word;

    }

    h1 {
        font-size: 40px;
        margin-top: 1px;
    }

    .garis {
        border-top: 1px solid black;
        /* margin-left: 30px;
        margin-right: 40px; */
    }

    #nilai {
        text-align: right;
        float: right;
    }

    .footer {
        margin-left: 30px;
        /* margin-top: 230px; */
        position: fixed;
        top: 520px;
    }

    p {
        font-size: 16px;
    }

    /* table td,
    table td * {
        vertical-align: top;
    } */
</style>

<body style="font-family:'Open Sans',sans-serif; margin:-5px; margin-top:60px;" onload="window.print()">

    <div class="content" style="border: none;margin-left: -5px; margin-right:5px">
        <div class="header">
            <table style="width: 100%;" style="font-size: 10px; margin-left:200px">
                <tr>
                    <td rowspan="3" style="width:150px">
                        <img src="<?= base_url('uploads/LogoRaw.png') ?>" width="150" height="55" style="margin-top:-40px">
                    </td>
                    <td style="text-align: center;">Customer</td>
                    <td><b><?= $info['customer'] ?></b> </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;text-align: center;">Address</td>
                    <td><?= $info['address'] ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">No. Telp</td>
                    <td><?= $info['no_telp'] ?></td>
                </tr>
            </table>

        </div>
        <div class="title" style="text-align: center;">
            <?php
            if ($info['status'] == 0) {
            ?>
                <h3>PROFORMA INVOICE</h3>
            <?php   } else {
                echo '<h3>INVOICE</h3>';
            }
            ?>
        </div>
        <div class="garis"></div>
        <div class="isi">
            <table style="margin-top: 50px;">
                <tr>
                    <td>
                        PT. TRANSTAMA LOGISTICS EXPRESS
                    </td>
                    <td>
                        INVOICE No
                    </td>
                    <td>
                        <?php if ($info['is_revisi'] == 1) {
                            echo $info['no_invoice'] . ' - Revisi';
                        } else {
                            echo $info['no_invoice'];
                        }  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        JL. PENJERNIHAN II NO. III B
                    </td>
                    <td>
                        DATE
                    </td>
                    <td>
                        <?= tanggal_invoice2($info['date']) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        JAKARTA PUSAT 10210
                    </td>
                    <td>
                        DUE DATE
                    </td>
                    <td>
                        <?= tanggal_invoice2($info['due_date']) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        PHONE : (021) 57852609 (HUNTING)
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        FAX : (021) 57852608
                    </td>
                    <td>
                        PIC
                    </td>
                    <td>
                        <?= $info['pic'] ?>
                    </td>
                </tr>

            </table>
        </div>
        <br><br>
        <div class="shipment">
            <?php $cek_special = $info['is_special'];
            if ($cek_special == 1) {
            ?>
                <table border="1" style="width:100%; border-bottom:none; border-left:none">
                    <thead>
                        <tr>
                            <th style="text-align: center;height:3%">AWB</th>
                            <?php if ($info['print_do'] == 1) {
                            ?>
                                <th style="text-align: center;height:3%">No Do</th>
                            <?php  } ?>
                            <th style="text-align: center;">DATE</th>
                            <th style="text-align: center;">DEST</th>
                            <th style="text-align: center;">SERVICE</th>
                            <th style="text-align: center;">COLLIE</th>
                            <?php if ($info['is_packing'] == 1) {
                            ?>
                                <th style="text-align: center;">PACKING</th>
                            <?php  } ?>
                            <?php if ($info['is_insurance'] == 1) {
                            ?>
                                <th style="text-align: center;">INSURANCE</th>
                            <?php  } ?>
                            <?php if ($info['is_others'] == 1) {
                            ?>
                                <th style="text-align: center;">OTHERS</th>
                            <?php  } ?>
                            <th style="text-align: center;">WEIGHT</th>
                            <th style="text-align: center;">RATE</th>
                            <!-- <th style="text-align: center;">SPECIAL WEIGHT</th>
                            <th style="text-align: center;">SPECIAL RATE</th> -->
                            <th style="text-align: center;">TOTAL AMOUNT</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_koli = 0;
                        $total_weight = 0;
                        $total_special_weight = 0;
                        $total_amount = 0;

                        foreach ($invoice as $inv) {
                            $get_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $inv['shipment_id']]);
                            $data_do = $get_do->result_array();
                            $total_do = $get_do->num_rows();
                            $no = 1;
                            $service =  $inv['service_name'];
                            if ($service == 'Charter Service') {
                                $packing = $inv['packing'];
                                $insurance = $inv['insurance'];
                                $total_sales = ($inv['freight_kg'] + $packing +  $inv['special_freight'] +  $inv['others'] + $inv['surcharge'] + $insurance);
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
                                $insurance = $inv['insurance'];
                                $total_sales = ($freight + $packing + $special_freight +  $inv['others'] + $inv['surcharge'] + $insurance);
                            }
                            if ($total_do == 0) {
                                if ($inv['no_so'] != NULL && $inv['no_stp'] != NULL) {
                                    $no_do = $inv['note_cs'] . '<br>/' . $inv['no_so'] . '/' . $inv['no_stp'];
                                } else {
                                    $no_do = $inv['note_cs'];
                                }
                        ?>
                                <tr>
                                    <td style="text-align: center; width:13%;height:3%" rowspan="2"><?= $inv['shipment_id'] ?></td>
                                    <?php if ($info['print_do'] == 1) {
                                    ?>
                                        <td style="text-align: left;width:12%" rowspan="2"><?= $no_do ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;width:8%" rowspan="2"><?= tanggal_invoice($inv['tgl_pickup']) ?></td>
                                    <td style="text-align: center;width:6%" rowspan="2"><?= $inv['tree_consignee'] ?></td>
                                    <td style="text-align: center;width:10%" rowspan="2"><?php if ($inv['service_name'] == 'Charter Service') {
                                                                                                echo $inv['service_name'] . '-' . $inv['pu_moda'];
                                                                                            } else {
                                                                                                echo  $inv['service_name'];;
                                                                                            } ?></td>
                                    <td style="text-align: center;width:6%" rowspan="2"><?= $inv['koli'] ?></td>
                                    <?php if ($info['is_packing'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%" rowspan="2"><?= rupiah($inv['packing']); ?></td>
                                    <?php  } ?>
                                    <?php if ($info['is_insurance'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%" rowspan="2"><?= rupiah($inv['insurance']); ?></td>
                                    <?php  } ?>
                                    <?php if ($info['is_others'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%" rowspan="2"><?= rupiah($inv['others']); ?></td>
                                    <?php  } ?>
                                    <td style="text-align: center;width:6%"><?= $inv['berat_js']; ?></td>
                                    <td style="text-align: left;"><?php
                                                                    echo  rupiah($inv['freight_kg']);
                                                                    ?></td>
                                    <td style="text-align: left;"><?php
                                                                    echo rupiah($freight);
                                                                    ?></td>

                                </tr>
                                <tr>
                                    <td style="text-align: center;width:8%"><?= $inv['berat_msr']; ?></td>
                                    <td style="text-align: left;"><?php
                                                                    echo rupiah($inv['special_freight']);
                                                                    ?></td>
                                    <td><?= rupiah($special_freight); ?></td>
                                </tr>


                            <?php $total_koli = $total_koli + $inv['koli'];
                            } else {
                            ?>
                                <?php
                                foreach ($data_do as $d) {
                                ?>
                                    <tr>
                                        <td style="text-align: center; width:13%;height:3%" rowspan="<?= $total_do ?>"><?= $inv['shipment_id'] ?></td>
                                        <?php if ($info['print_do'] == 1) {
                                        ?>
                                            <td style="text-align: left;width:12%" rowspan="<?= $total_do ?>"><?= $d['no_do'] ?></td>
                                        <?php } ?>
                                        <td style="text-align: center;width:8%" rowspan="<?= $total_do ?>"><?= tanggal_invoice($inv['tgl_pickup']) ?></td>
                                        <td style="text-align: center;width:6%" rowspan="<?= $total_do ?>"><?= $inv['tree_consignee'] ?></td>
                                        <td style="text-align: center;width:10%" rowspan="<?= $total_do ?>"><?php if ($inv['service_name'] == 'Charter Service') {
                                                                                                                echo $inv['service_name'] . '-' . $inv['pu_moda'];
                                                                                                            } else {
                                                                                                                echo  $inv['service_name'];;
                                                                                                            } ?></td>
                                        <td style="text-align: center;width:6%" rowspan="<?= $total_do ?>"><?= $d['koli'] ?></td>
                                        <?php if ($info['is_packing'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%" rowspan="<?= $total_do ?>"><?= rupiah($inv['packing']); ?></td>
                                        <?php  } ?>
                                        <?php if ($info['is_insurance'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%" rowspan="<?= $total_do ?>"><?= rupiah($inv['insurance']); ?></td>
                                        <?php  } ?>
                                        <?php if ($info['is_others'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%" rowspan="<?= $total_do ?>"><?= rupiah($inv['others']); ?></td>
                                        <?php  } ?>


                                        <td style="text-align: center;width:6%"><?= $d['berat']; ?></td>
                                        <td style="text-align: left;"><?php
                                                                        echo  rupiah($inv['freight_kg']);
                                                                        ?></td>

                                        <td style="text-align: left;"><?php if ($service == 'Charter Service') {
                                                                            echo rupiah($total_sales);
                                                                        } else {
                                                                            echo  rupiah($inv['freight_kg'] * $d['berat']);
                                                                        } ?></td>

                                    </tr>

                                    <tr>
                                        <td style="text-align: center;width:8%"><?= $inv['berat_msr']; ?></td>
                                        <td style="text-align: left;"><?php
                                                                        echo rupiah($inv['special_freight']);
                                                                        ?></td>
                                        <td><?= rupiah($inv['berat_msr'] * $inv['special_freight']); ?></td>
                                    </tr>
                                <?php $total_koli = $total_koli + $d['koli'];
                                } ?>

                            <?php  } ?>

                        <?php
                            // $total_koli = $total_koli + $inv['koli'];
                            $total_weight = $total_weight + $inv['berat_js'];
                            $total_special_weight = $total_special_weight + $inv['berat_msr'];
                            $total_amount = $total_amount + $total_sales;
                            $no++;
                        } ?>

                        <tr>
                            <?php if ($info['print_do'] == 1) {
                            ?>
                                <td colspan="5" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>

                            <?php } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>
                            <?php } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>
                            <?php } else {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>

                            <?php  } ?>

                            <td style="text-align: center;"><?= $total_koli ?></td>

                            <?php if ($info['print_do'] == 1 && $info['is_packing'] == 1) {
                            ?>
                                <td></td>
                            <?php } elseif ($info['print_do'] == 1) {
                            ?>

                            <?php  } elseif ($info['is_packing'] == 1) {
                            ?>
                                <td></td>

                            <?php  } else {
                            ?>
                            <?php } ?>
                            <?php if ($info['is_insurance'] == 1) {
                            ?>
                                <td></td>
                            <?php  } ?>
                            <?php if ($info['is_others'] == 1) {
                            ?>
                                <td></td>
                            <?php  } ?>
                            <td style="text-align: center;"><?= $total_weight ?></td>
                            <td class="font-weight-bold" style="text-align: center; font-weight:bold">SUB TOTAL</td>
                            <td><?= rupiah($total_amount) ?></td>
                        </tr>
                        <tr style="border:none;">
                            <?php if ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="10" style="border-left:none;">
                                </td>
                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_packing'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } else {
                            ?>
                                <td colspan="6" style="border-left:none">
                                </td>

                            <?php } ?>

                            <?php if ($info['is_ppn'] == 1) {
                            ?>
                                <td class="font-weight-bold" style="text-align: center;font-weight:bold;height:3%">
                                    PPN 1,1 %
                                </td>
                                <td>
                                    <?php

                                    $ppn =  $total_amount * 0.011;
                                    echo rupiah($ppn);
                                    ?>

                                </td>
                            <?php  } else {
                                $ppn = 0;
                            } ?>
                        </tr>
                        <tr>
                            <?php if ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="10" style="border-left:none;">
                                </td>
                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_packing'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } else {
                            ?>
                                <td colspan="6" style="border-left:none">
                                </td>

                            <?php } ?>

                            <td class="font-weight-bold" style="text-align: center; font-weight:bold;height:3%;">
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
            <?php } else {
            ?>
                <table border="1" style="width:100%; border-bottom:none; border-left:none">
                    <thead>
                        <tr>
                            <th style="text-align: center;height:3%">AWB</th>
                            <?php if ($info['print_do'] == 1) {
                            ?>
                                <th style="text-align: center;height:3%">No Do</th>
                            <?php  } ?>
                            <th style="text-align: center;">DATE</th>
                            <th style="text-align: center;">DEST</th>
                            <th style="text-align: center;">SERVICE</th>
                            <th style="text-align: center;">COLLIE</th>
                            <th style="text-align: center;">WEIGHT</th>
                            <?php if ($info['is_packing'] == 1) {
                            ?>
                                <th style="text-align: center;">PACKING</th>
                            <?php  } ?>
                            <?php if ($info['is_insurance'] == 1) {
                            ?>
                                <th style="text-align: center;">INSURANCE</th>
                            <?php  } ?>
                            <?php if ($info['is_others'] == 1) {
                            ?>
                                <th style="text-align: center;">OTHERS</th>
                            <?php  } ?>
                            <th style="text-align: center;">RATE</th>
                            <th style="text-align: center;">TOTAL AMOUNT</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_koli = 0;
                        $total_weight = 0;
                        $total_special_weight = 0;
                        $total_amount = 0;

                        foreach ($invoice as $inv) {

                            $get_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $inv['shipment_id']]);
                            $data_do = $get_do->result_array();
                            $total_do = $get_do->num_rows();

                            $no = 1;
                            $service =  $inv['service_name'];
                            if ($service == 'Charter Service') {
                                $packing = $inv['packing'];
                                $insurance = $inv['insurance'];
                                $total_sales = ($inv['freight_kg'] + $packing +  $inv['special_freight'] +  $inv['others'] + $inv['surcharge'] + $insurance);
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
                                $insurance = $inv['insurance'];
                                $total_sales = ($freight + $packing + $special_freight +  $inv['others'] + $inv['surcharge'] + $insurance);
                            }


                            if ($total_do == 0) {
                                if ($inv['no_so'] != NULL && $inv['no_stp'] != NULL) {
                                    $no_do = $inv['note_cs'] . '<br>/' . $inv['no_so'] . '/' . $inv['no_stp'];
                                } else {
                                    $no_do = $inv['note_cs'];
                                }
                        ?>
                                <tr>
                                    <td style="text-align: center; width:13%;height:3%"><?= $inv['shipment_id'] ?></td>
                                    <?php if ($info['print_do'] == 1) {
                                    ?>
                                        <td style="text-align: left;width:12%"><?= $no_do ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;width:8%"><?= tanggal_invoice($inv['tgl_pickup']) ?></td>
                                    <td style="text-align: center;width:6%"><?= $inv['tree_consignee'] ?></td>
                                    <td style="text-align: center;width:10%"><?php if ($inv['service_name'] == 'Charter Service') {
                                                                                    echo $inv['service_name'] . '-' . $inv['pu_moda'];
                                                                                } else {
                                                                                    echo  $inv['service_name'];;
                                                                                } ?></td>
                                    <td style="text-align: center;width:6%"><?= $inv['koli'] ?></td>
                                    <td style="text-align: center;width:8%"><?= $inv['berat_js']; ?></td>
                                    <?php if ($info['is_packing'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%"><?= rupiah($inv['packing']); ?></td>
                                    <?php  } ?>
                                    <?php if ($info['is_insurance'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%"><?= rupiah($inv['insurance']); ?></td>
                                    <?php  } ?>
                                    <?php if ($info['is_others'] == 1) {
                                    ?>
                                        <td style="text-align: center;width:10%"><?= rupiah($inv['others']); ?></td>
                                    <?php  } ?>
                                    <td style="text-align: left;"><?php if ($service == 'Charter Service') {
                                                                        echo rupiah($inv['special_freight']);
                                                                    } else {
                                                                        echo  rupiah($inv['freight_kg']);
                                                                    } ?></td>
                                    <td style="text-align: left;"><?php
                                                                    echo rupiah($total_sales);
                                                                    ?></td>
                                </tr>

                            <?php $total_koli = $total_koli + $inv['koli'];
                            } else {

                            ?>
                                <th rowspan="<?= $total_do ?>" style="text-align: center; width:2%;height:3%"><?= $inv['shipment_id'] ?></th>
                                <?php
                                foreach ($data_do as $d) {
                                ?>
                                    <tr>
                                        <?php if ($info['print_do'] == 1) {
                                        ?>
                                            <td style="text-align: left;width:12%"><?= $d['no_do'] ?></td>
                                        <?php } ?>
                                        <td style="text-align: center;width:8%"><?= tanggal_invoice($inv['tgl_pickup']) ?></td>
                                        <td style="text-align: center;width:6%"><?= $inv['tree_consignee'] ?></td>
                                        <td style="text-align: center;width:10%"><?php if ($inv['service_name'] == 'Charter Service') {
                                                                                        echo $inv['service_name'] . '-' . $inv['pu_moda'];
                                                                                    } else {
                                                                                        echo  $inv['service_name'];;
                                                                                    } ?></td>
                                        <td style="text-align: center;width:6%"><?= $d['koli'] ?></td>
                                        <td style="text-align: center;width:8%"><?= $d['berat']; ?></td>
                                        <?php if ($info['is_packing'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%"><?= rupiah($inv['packing']); ?></td>
                                        <?php  } ?>
                                        <?php if ($info['is_insurance'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%"><?= rupiah($inv['insurance']); ?></td>
                                        <?php  } ?>
                                        <?php if ($info['is_others'] == 1) {
                                        ?>
                                            <td style="text-align: center;width:10%"><?= rupiah($inv['others']); ?></td>
                                        <?php  } ?>
                                        <td style="text-align: left;"><?php if ($service == 'Charter Service') {
                                                                            echo rupiah($inv['special_freight']);
                                                                        } else {
                                                                            echo  rupiah($inv['freight_kg']);
                                                                        } ?></td>

                                        <td style="text-align: left;"><?php if ($service == 'Charter Service') {
                                                                            echo rupiah($total_sales);
                                                                        } else {
                                                                            echo  rupiah($inv['freight_kg'] * $d['berat']);
                                                                        } ?></td>

                                    </tr>
                                <?php $total_koli = $total_koli + $d['koli'];
                                } ?>

                            <?php   }

                            ?>

                        <?php
                            // $total_koli = $total_koli + $inv['koli'];
                            $total_weight = $total_weight + $inv['berat_js'];
                            $total_special_weight = $total_special_weight + $inv['berat_msr'];
                            $total_amount = $total_amount + $total_sales;
                            $no++;
                        } ?>

                        <tr>
                            <?php if ($info['print_do'] == 1) {
                            ?>
                                <td colspan="5" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>

                            <?php } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>
                            <?php } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>
                            <?php } else {
                            ?>
                                <td colspan="4" style="text-align: center;height:3%">TOTAL <?= $total_invoice ?> AWB</td>

                            <?php  } ?>

                            <td style="text-align: center;"><?= $total_koli ?></td>
                            <td style="text-align: center;"><?= $total_weight ?></td>
                            <?php if ($info['is_packing'] == 1) {
                            ?>
                                <td></td>
                            <?php  } ?>
                            <?php if ($info['is_insurance'] == 1) {
                            ?>
                                <td></td>
                            <?php  } ?>
                            <?php if ($info['is_others'] == 1) {
                            ?>
                                <td></td>
                            <?php  } ?>

                            <td class="font-weight-bold" style="text-align: center; font-weight:bold; border-bottom:none">SUB TOTAL</td>
                            <td><?= rupiah($total_amount) ?></td>
                        </tr>
                        <tr style="border:none;">
                            <?php if ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="10" style="border-left:none;">
                                </td>
                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_packing'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } else {
                            ?>
                                <td colspan="6" style="border-left:none">
                                </td>

                            <?php } ?>


                            <?php if ($info['is_ppn'] == 1) {
                            ?>
                                <td class="font-weight-bold" style="text-align: center;font-weight:bold;height:3%">
                                    PPN 1,1 %
                                </td>
                                <td>
                                    <?php

                                    $ppn =  $total_amount * 0.011;
                                    echo rupiah($ppn);
                                    ?>

                                </td>
                            <?php  } else {
                                $ppn = 0;
                            } ?>
                        </tr>
                        <tr>
                            <?php if ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="10" style="border-left:none;">
                                </td>
                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="9" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_others'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_packing'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1) {
                            ?>
                                <td colspan="8" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['print_do'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_insurance'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_packing'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } elseif ($info['is_others'] == 1) {
                            ?>
                                <td colspan="7" style="border-left:none">
                                </td>

                            <?php  } else {
                            ?>
                                <td colspan="6" style="border-left:none">
                                </td>

                            <?php } ?>

                            <td class="font-weight-bold" style="text-align: center; font-weight:bold;height:3%;">
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
            <?php  }

            ?>
            <div class="said">
                <p style="font-weight: bold;">
                    <?php

                    echo "#" . $info['terbilang'] . "#";
                    ?>
                </p>
            </div> <br><br><br>
            <div class="payment" style="margin-top: -50px;">
                <table>
                    <tr>
                        <td>
                            Please remit payment to our account with Full Amount:
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>PT. TRANSTAMA LOGISTICS EXPRESS</td>
                        <td style="text-align: center;">Jakarta, <?= bulan_indo($info['date']) ?></td>
                    </tr>
                    <tr>
                        <td>
                            Bank Details:
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            -BANK CENTRAL ASIA (BCA)
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cab. SCBD, Jakarta
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>A/C No : 006 306 7374 (IDR)</td>
                        <td> <img src="<?= base_url('uploads/ttd/dwi.jpeg') ?>" width="150" height="60" style="margin-top:-50px; margin-left:100px"></td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td style="text-align: center;">FINANCE</td>
                    </tr>
                </table>
            </div>
            <p style="font-size:10px">* INTEREST CHARGEST AT 10 % PER MONTH WILL BE LEVIED ON OVERDUE INVOICES</p>
        </div>


    </div>


</body>