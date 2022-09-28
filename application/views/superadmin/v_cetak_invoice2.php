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
                        <!-- <img src="<?= base_url('uploads/LogoRaw.png') ?>" width="150" height="55" style="margin-top:-40px"> -->
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

                    <?php $no = 1; ?>


                    <th rowspan="0" style="text-align: center; width:2%;height:3%">QC43489</th>
                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>
                    <th rowspan="0" style="text-align: center; width:2%;height:3%">QC43489</th>
                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>

                    <th rowspan="2" style="text-align: center; width:2%;height:3%">QC43489</th>

                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>
                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>

                    <th rowspan="3" style="text-align: center; width:2%;height:3%">QC43489</th>

                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>
                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>
                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td style="text-align: left;width:5%">1</td>
                        <?php } ?>
                        <td style="text-align: center;width:8%">1</td>
                        <td style="text-align: center;width:6%">1</td>
                        <td style="text-align: center;width:8%">kdj</td>
                        <td style="text-align: center;width:6%">5</td>
                        <td style="text-align: center;width:8%">5</td>
                        <?php if ($info['is_packing'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">5</td>
                        <?php  } ?>
                        <?php if ($info['is_insurance'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">g</td>
                        <?php  } ?>
                        <?php if ($info['is_others'] == 1) {
                        ?>
                            <td style="text-align: center;width:10%">6</td>
                        <?php  } ?>
                        <td style="text-align: left;">9</td>

                        <td style="text-align: left;">9</td>

                    </tr>


                    <?php
                    $total_koli = 0;
                    ?>



                    <?php

                    $total_weight = 8;
                    $total_special_weight = 0 + 1;
                    $total_amount = 2;
                    $no++;
                    ?>

                    <tr>
                        <?php if ($info['print_do'] == 1) {
                        ?>
                            <td colspan="5" style="text-align: center;height:3%">TOTAL 8 AWB</td>

                        <?php } elseif ($info['is_insurance'] == 1) {
                        ?>
                            <td colspan="4" style="text-align: center;height:3%">TOTAL 8 AWB</td>
                        <?php } elseif ($info['is_others'] == 1) {
                        ?>
                            <td colspan="4" style="text-align: center;height:3%">TOTAL 8 AWB</td>
                        <?php } else {
                        ?>
                            <td colspan="4" style="text-align: center;height:3%">TOTAL 8 AWB</td>

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

                        <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_packing'] == 1) {
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

                        <?php  } elseif ($info['is_packing'] == 1 && $info['is_insurance'] == 1) {
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

                        <?php  } elseif ($info['print_do'] == 1 && $info['is_insurance'] == 1 && $info['is_packing'] == 1) {
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

                        <?php  } elseif ($info['is_packing'] == 1 && $info['is_insurance'] == 1) {
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

            <br><br><br>

            <!-- <div class="note">
                <p>Note * : <?= $info[''] ?></p>

            </div> -->


            <div class="said">
                <p style="font-weight: bold;">
                    <?php

                    echo "#" . $info['terbilang'] . "#";
                    ?>
                </p>
            </div>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            Cab. SCBD, Jakarta
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>A/C No : 006 306 7374 (IDR)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center;">FINANCE</td>
                    </tr>
                </table>
            </div>
            <p style="font-size:10px">* INTEREST CHARGEST AT 10 % PER MONTH WILL BE LEVIED ON OVERDUE INVOICES</p>
        </div>


    </div>


</body>