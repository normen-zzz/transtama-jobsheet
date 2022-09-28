<table style="width:100%">
    <thead>
        <tr>
            <th>PICKUP DATE</th>
            <th>SHIPMENT ID</th>
            <th>DEST</th>
            <th>SERVICE</th>
            <th>COLLIE</th>
            <th>KG</th>
            <th>RATE</th>
            <th>PACKING</th>
            <th>OTHER</th>
            <th>TOTAL RATE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($invoices as $inv) {
        ?>
            <tr>
                <td><?= bulan_indo($inv['tgl_pickup']) ?></td>
                <td><?= $inv['shipment_id'] ?></td>
                <td><?= $inv['tree_consignee'] ?></td>
                <td><?= $service ?></td>
                <td><?= $inv['koli'] ?></td>
                <td><?php if ($service == 'Charter Service') {
                        echo $inv['berat_msr'];
                    } else {
                        echo  $inv['berat_js'];
                    }
                    ?></td>
                <td><?= rupiah($inv['freight_kg']) ?></td>
                <td><?= rupiah($inv['packing']) ?></td>
                <td><?= rupiah($inv['others']) ?></td>
                <td><?= rupiah($total_sales) ?></td>

            </tr>

        <?php  }
        ?>

    </tbody>

</table>