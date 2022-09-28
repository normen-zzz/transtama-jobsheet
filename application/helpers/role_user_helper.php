<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function nama_role($id_role)
{

    switch ($id_role) {
        case 1:
            $nama_role = 'Admin';
            break;
        case 2:
            $nama_role = 'Keuangan';
            break;
        case 3:
            $nama_role = 'Akademik';
            break;
        case 4:
            $nama_role = 'Dosen';
            break;
        case 5:
            $nama_role = 'Mahasiswa';
            break;

        default:

            break;
    }
    return $nama_role;
}
