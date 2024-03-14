<?php

function getTotalSales($id)
{
    // Get a reference to the controller object
    $CI = get_instance();
    $CI->load->model('CsModel', 'cs');

    $msr = $CI->cs->getDetailSo($id)->row_array();

    $service =  $msr['service_name'];
    if ($service == 'Charter Service' || $service == 'Manpower Service' || $service == 'Multidrop Service'|| $service == 'Warehouse Service' ) {
        // $total_sales = $msr['special_freight'];
        $packing = $msr['packing'];
        $total_sales = ($msr['freight_kg'] + $packing +  $msr['special_freight'] +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
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

        // var_dump($freight);
        // die;

        $packing = $msr['packing'];
        $total_sales = ($freight + $packing + $special_freight +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
        // $comm = $msr['cn'] * $total_sales;
        // $disc = $msr['disc'] * $total_sales;

    }
    return $total_sales;
}
