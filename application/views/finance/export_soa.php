<center><?= $title ?></center>
<table style="width:100%">
    <thead>
        <tr>
            <th>Customers</th>
            <th>No Invoice</th>
            <th>Shipment</th>
            <!-- <th>Date Created</th> -->
            <th>Due Date</th>
            <th>Tagihan(Rp)</th>
            <th>Invoice</th>
            <th>PPN</th>
            <th>PPH 23</th>
            <th>Total After PPH</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_invoice = 0;
        $invoice = 0;
        $ppn = 0;
        $pph = 0;
        $total_setelah_pph = 0;
        foreach ($proforma as $j) {
        ?>
            <tr>
                <td><?= $j['customer'] ?></td>
                <td><?= "'" . $j['no_invoice'] . "'" ?> </td>
                <td><?= bulan($j['shipment']) ?></td>
                <td><?php
                    echo  bulan_indo($j['due_date']);
                    ?>
                </td>
                <td><?= rupiah($j['total_invoice']) ?></td>
                <td><?= rupiah($j['invoice']) ?></td>
                <td><?= rupiah($j['ppn']) ?></td>
                <td><?= rupiah($j['pph']) ?></td>
                <td><?php $total = $j['total_invoice'] - $j['pph'];
                    echo rupiah($total) ?></td>
                <td>
                    <?php if ($j['status'] == 1) {
                        echo 'Pending';
                    } elseif ($j['status'] == 2) {
                        echo 'Paid';
                    } elseif ($j['status'] == 3) {
                        echo 'Unpaid';
                    }  ?>
                </td>
            </tr>

        <?php
            $total_invoice += (int)$j['total_invoice'];
            $invoice += (int)$j['invoice'];
            $ppn += (int)$j['ppn'];
            $pph += (int)$j['pph'];
            $total_setelah_pph += (int)$total;
        } ?>
        <tr>
            <td colspan="4" style="text-align:center">Total</td>
            <td><?= rupiah($total_invoice) ?></td>
            <td><?= rupiah($invoice) ?></td>
            <td><?= rupiah($ppn) ?></td>
            <td><?= rupiah($pph) ?></td>
            <td><?= rupiah($total_setelah_pph) ?></td>
        </tr>

    </tbody>

</table>