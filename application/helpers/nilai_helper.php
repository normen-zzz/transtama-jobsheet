<?php

function konversi($nilai)
{
    $CI = &get_instance();
    if ($nilai == 4) {
        return 'A';
    } elseif ($nilai == 3) {
        return 'B';
    } elseif ($nilai == 2) {
        return 'C';
    } elseif ($nilai == 1) {
        return 'D';
    } elseif ($nilai == 0) {
        return 'E';
    } else {
        return 'T';
    }
}
