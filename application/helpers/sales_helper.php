<?php
function totalSales($shipment_id)
{
    $CI = &get_instance();

    $msr = $CI->db->query('SELECT a.*,b.service_name FROM tbl_shp_order AS a INNER JOIN tb_service_type AS b on a.service_type = b.code WHERE shipment_id = ' . $shipment_id . ' ')->row_array();
    $service =  $msr['service_name'];
    if ($service == 'Charter Service') {
        // $total_sales = $msr['special_freight'];
        $packing = $msr['packing'];
        $total_sales = ($msr['freight_kg'] + $packing +  $msr['special_freight'] +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
    } else {
        $disc = $msr['disc'];
        // kalo gada disc
        if ($disc == 0) {
            if ($msr['freight_kg'] != 0 && $msr['special_freight'] == 0) {
                $freight  = $msr['berat_js'] * $msr['freight_kg'];
                $special_freight  = 0;
            } elseif ($msr['freight_kg'] == 0 && $msr['special_freight'] != 0) {
                $freight  = 0;
                $special_freight  = $msr['special_freight'];
            } elseif ($msr['freight_kg'] != 0 && $msr['special_freight'] != 0) {
                $freight  = $msr['berat_js'] * $msr['freight_kg'];
                $special_freight  = $msr['berat_msr'] * $msr['special_freight'];;
            }
        } else {
            $freight_discount = $msr['freight_kg'] - ($msr['freight_kg'] * $disc);
            $special_freight_discount =  $msr['special_freight'] - ($msr['special_freight'] * $disc);

            if ($msr['freight_kg'] != 0 && $msr['special_freight'] == 0) {
                $freight  = $msr['berat_js'] * $freight_discount;
                $special_freight  = 0;
            } elseif ($msr['freight_kg'] == 0 && $msr['special_freight'] != 0) {
                $freight  = 0;
                $special_freight  = $special_freight_discount;
            } elseif ($msr['freight_kg'] != 0 && $msr['special_freight'] != 0) {
                $freight  = $msr['berat_js'] * $freight_discount;
                $special_freight  = $msr['berat_msr'] * $special_freight_discount;
            }
        }

        // var_dump($freight);
        // die;

        $packing = $msr['packing'];
        $total_sales = ($freight + $packing + $special_freight +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
        // $comm = $msr['cn'] * $total_sales;
        // $disc = $msr['disc'] * $total_sales;

        return $total_sales;
    }
}
