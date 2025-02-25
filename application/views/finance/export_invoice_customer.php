<table style="width:100%">
    <thead>
        <tr>
            <th>PICKUP DATE</th>
            <th>SHIPPER</th>
			<th>CONSIGNEE</th>
            <th>SHIPMENT ID</th>
            <th>DEST</th>
            <th>SERVICE</th>
            <th>COLLIE</th>
            <th>KG</th>
            <th>RATE</th>
            <th>PACKING</th>
            <th>OTHER</th>
            <th>TOTAL RATE</th>
			<th>NOTE SO</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($msrs as $msr) {
            $service =  $msr['service_name'];
            if ($service == 'Charter Service') {
                $total_sales = $msr['special_freight'];
            } else {
                $disc = $msr['disc'];
                // kalo gada disc
                if ($disc == 0) {
                    $freight  = $msr['berat_js'] * $msr['freight_kg'];
                    $special_freight  = $msr['berat_msr'] * $msr['special_freight'];
                } else {
                    $freight_discount = $msr['freight_kg'] * $disc;
                    $special_freight_discount = $msr['special_freight'] * $disc;

                    $freight = $freight_discount * $msr['berat_js'];
                    $special_freight  = $special_freight_discount * $msr['berat_msr'];
                }



                $packing = $msr['packing'];
                $total_sales = ($freight + $packing + $special_freight +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);

                $total_sales = $total_sales;
            }
        ?>

            <tr>
                <td><?= bulan_indo($msr['tgl_pickup']) ?></td>
                <td><?= $msr['shipper'] ?></td>
				<td><?= $msr['consigne'] ?></td>
                <td><?= $msr['shipment_id'] ?></td>
                <td><?= $msr['tree_consignee'] ?></td>
                <td><?= $service ?></td>
                <td><?= $msr['koli'] ?></td>
                <td><?php if ($service == 'Charter Service') {
                        echo $msr['berat_msr'];
                    } else {
                        echo  $msr['berat_js'];
                    }
                    ?></td>
                <td><?= rupiah($msr['freight_kg']) ?></td>
                <td><?= rupiah($msr['packing']) ?></td>
                <td><?= rupiah($msr['others']) ?></td>
                <td><?= rupiah($total_sales) ?></td>
				 <td><?= $msr['so_note'] ?></td>
                <td><?php
                    if ($msr['status_so'] == 2) {
                        echo 'Approve PIC JS';
                    } elseif ($msr['status_so'] == 3) {
                        echo 'Approve Manager CS';
                    } elseif ($msr['status_so'] == 4) {
                        echo 'Approve Finance';
                    } elseif ($msr['status_so'] == 1) {
                        echo 'SO Create By Sales';
                    }
                    ?></td>

            </tr>

        <?php  } ?>


    </tbody>

</table>