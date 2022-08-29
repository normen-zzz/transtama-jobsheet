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
        margin-left: 30px;
        margin-right: 40px;
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
</style>

<body style="font-family:'Open Sans',sans-serif; margin:-15px; margin-top:-50px;" onload="window.print()">

    <div class="inv" style="margin-left: -10px; margin-top:-20px;">
        <table border="0">
            <tr>
                <td style="width: 40%; margin-bottom: 10px;">
                    <img src="<?= base_url('uploads/LogoRaw.png') ?>" width="120" height="45" style="margin-bottom:5px;">
                    <!-- <img src="<?= base_url('uploads/tlx2.jpg') ?>" width="120" height="45" style="margin-bottom:5px;"> -->
                </td>
                <td style="font-size: 20px; padding-top:25px; font-weight:bold;">
                    <b style="margin-left: 0px;">SALES ORDER</b>
                </td>
            </tr>
        </table>

    </div>
    <div class="content" style="border: 1px solid black;margin-left: -15px; margin-right:5px">
        <table style="width:100%;">
            <tr>
                <td style="font-size: 10px; width:20%"><b>DESTINATION</b>
                </td>
                <td style="border-left:1px solid black"><b>
                        <span style="font-size: 12px; padding-top:-60px"><b><?= $order['destination'] ?></b> </span>
                    </b>
                </td>

            </tr>
        </table>
        <table style="width:100%; border-left:none;border-right:none" border="1">
            <tr>
                <td style=" font-size: 10px; width:18.7%"><b>DETAIL INFO</b>
                </td>
                <td style=" font-size: 10px; width:15%"><b>COMPANY NAME</b>
                </td>
                <td style=" font-size: 10px; width:10%"><b>CP</b>
                </td>
                <td style=" font-size: 10px; width:30%"><b>ADDRESS</b>
                </td>
                <td style=" font-size: 10px; width:10%"><b>PHONE</b>
                </td>

            </tr>
            <tr>
                <td style=" font-size: 10px; width:16%"><b>SHIPPER</b>
                </td>
                <td style=" font-size: 10px; width:15%"><?= $order['shipper'] ?>
                </td>
                <td style=" font-size: 10px; width:10%"><b></b>
                </td>
                <td style=" font-size: 10px; width:30%"><?= $order['city_shipper'] ?>, <?= $order['state_shipper'] ?>
                </td>
                <td style=" font-size: 10px; width:10%">
                </td>

            </tr>
            <tr>
                <td style=" font-size: 10px; width:16%"><b>CONSIGNEE</b>
                </td>
                <td style=" font-size: 10px; width:15%"><?= $order['consigne'] ?>
                </td>
                <td style=" font-size: 10px; width:10%"><?= $order['sender'] ?>
                </td>
                <td style=" font-size: 10px; width:30%"><?= $order['destination'] ?>
                </td>
                <td style=" font-size: 10px; width:10%">
                </td>

            </tr>
            <tr>
                <td style=" font-size: 10px; width:16%"><b>PAYMENT</b>
                </td>
                <td style=" font-size: 10px; width:15%">
                    <?php if ($order['payment'] == 'Cash') {
                    ?>
                        <input type="checkbox" class="form-control" value="CASH">CASH
                    <?php  } ?>
                </td>
                <td style=" font-size: 10px; width:15%">
                    <?php if ($order['payment'] == 'Credit') {
                    ?>
                        <input type="checkbox" class="form-control" value="CREDIT">CREDIT
                    <?php  } ?>
                </td>
                <td style=" font-size: 10px; width:30%" colspan="2"> DAYS From Pick up/Invoice/Receive
                </td>

            </tr>
            <tr>
                <td style=" font-size: 10px; width:16%"><b>SERVICE</b>
                </td>
                <td style=" font-size: 10px; width:30%" colspan="4"> <?= $order['pu_service'] ?>
                </td>

            </tr>
        </table>
        <center>
            <h4 style="margin-top: 2px;">SHIPMENT CONTENT</h4>
        </center>
        <table style="width:100%;" border="1">
            <tr>
                <td style="font-size: 10px; width:16%;text-align:left"><b>COMMODITY</b>
                </td>
                <td style=" font-size: 10px; width:15%; text-align:center"><b>COLLY</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>WEIGHT</b>
                </td>
                <td style=" font-size: 10px; width:30%; text-align:center" colspan="3"><b>VOLUME</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>TOTAL VOLUME</b>
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width:16%;text-align:center"><?= $order['pu_commodity'] ?>
                </td>
                <td style=" font-size: 10px; width:15%; text-align:center"><?= $order['koli'] ?> COLLY
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $order['berat_msr'] ?> Kg</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:right">
                    cm X
                </td>
                <td style=" font-size: 10px; width:10%; text-align:right">
                    cm X
                </td>
                <td style=" font-size: 10px; width:10%; text-align:right">
                    cm X
                </td>
                <td style=" font-size: 10px; width:10%; text-align:right">
                    cm X
                </td>
            </tr>
        </table>
        <table style="width:100%;" border="1">
            <tr>
                <td style="font-size: 10px; width:16%;text-align:left"><b>FREIGHT(RATE)</b>
                </td>
                <td style=" font-size: 10px; width:15%; text-align:center"><b>PACKING</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>INSURANCE</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>SURCHARGE</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>DISCOUNT</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>COMMMISION</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>OTHERS</b>
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width:16%;text-align:center"><b><?= rupiah($order['freight_kg']) ?></b>
                </td>
                <td style=" font-size: 10px; width:15%; text-align:center"><b><?= rupiah($order['packing']) ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= rupiah($order['insurance']) ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= rupiah($order['surcharge']) ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $order['disc'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $order['cn'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= rupiah($order['others']) ?></b>
                </td>
            </tr>
        </table>


        <table style="width:100%;" border="1">
            <tr>
                <td style="font-size: 10px; width:5%;text-align:left"><b>TOTAL SELLING</b>
                </td>
                <td style="font-size: 10px; width:15%; text-align:center;"><b>NOTE</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>MARKETING</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $sales['nama_user'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $sales['created_at'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"> <img src="<?= base_url('uploads/ttd/' . $sales['ttd']) ?>" width="80" height="40" style="margin-bottom:5px;">
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width:16%;text-align:left"><b><?= rupiah($order['freight_kg'] * $order['berat_js']) ?></b>
                </td>
                <td style=" font-size: 10px; width:15%; text-align:left" rowspan="3" colspan="2"><?= $order['pu_note'] ?>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>MARKETING MGR</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $manager_sales['nama_user'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $tgl_approve_mgr_sales['created_at_manager'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center">
                    <?php if ($manager_sales['ttd']) {
                    ?>
                        <img src="<?= base_url('uploads/ttd/' . $manager_sales['ttd']) ?>" width="80" height="40" style="margin-bottom:5px;">

                    <?php } ?>

                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width:16%;text-align:left"><b>TANGGAL PICKUP</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>CS</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $approve['pic_js'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $approve['created_at_cs'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>TTD</b>
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width:16%;text-align:left"><?= bulan_indo($order['tgl_pickup']) ?>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>FINANCE</b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $approve['finance'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b><?= $approve['created_at_finance'] ?></b>
                </td>
                <td style=" font-size: 10px; width:10%; text-align:center"><b>TTD</b>
                </td>
            </tr>
        </table>
    </div>

</body>