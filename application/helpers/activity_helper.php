<?php

function activity_log($username, $nama_user)
{
    $CI = &get_instance();

    $param['nama_user'] = $nama_user;
    $param['username'] = $username;
    $param['ip_address'] = $CI->input->ip_address();

    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log($param);
}

function activity_log_out($username)
{
    date_default_timezone_set('Asia/Jakarta');
    $CI = &get_instance();

    $sql = $CI->db->query("SELECT max(id_log) as id_log FROM tb_log_login WHERE username ='$username'")->row();
    $id = $sql->id_log;

    //load model log
    $CI->load->model('m_log');
    $param['logout_at'] = date('Y-m-d H:i:s');
    //save to database
    $CI->m_log->update_log($id, $param);
}

function log_aktifitas($aksi, $nama_table)
{
    $CI = &get_instance();

    $param['id_user'] = $CI->session->userdata('id_user');
    $param['aksi'] = $aksi;
    $param['nama_table'] = $nama_table;
    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log_aktifitas($param);
}

function semesterMatkul($semester)
{
    if ($semester == 1) {
        return 'Semester 1';
    } elseif ($semester == 2) {
        return 'Semester 2';
    } elseif ($semester == 3) {
        return 'Semester 3';
    } elseif ($semester == 4) {
        return 'Semester 4';
    } elseif ($semester == 5) {
        return 'Semester 5';
    } elseif ($semester == 6) {
        return 'Semester 6';
    } elseif ($semester == 7) {
        return 'Semester 7';
    } elseif ($semester == 8) {
        return 'Semester 8';
    }
}
function semesterHsk($semester)
{
    if ($semester == 1) {
        return 'SEMESTER I';
    } elseif ($semester == 2) {
        return 'SEMESTER II';
    } elseif ($semester == 3) {
        return 'SEMESTER III';
    } elseif ($semester == 4) {
        return 'SEMESTER IV';
    } elseif ($semester == 5) {
        return 'SEMESTER V';
    } elseif ($semester == 6) {
        return 'SEMESTER VI';
    } elseif ($semester == 7) {
        return 'SEMESTER VII';
    } elseif ($semester == 8) {
        return 'SEMESTER VIII';
    }
}

function semesterMhs($semester)
{
    if ($semester == 1) {
        return 'I (Satu)';
    } elseif ($semester == 2) {
        return 'II (Dua)';
    } elseif ($semester == 3) {
        return 'III (Tiga)';
    } elseif ($semester == 4) {
        return 'IV (Empat)';
    } elseif ($semester == 5) {
        return 'V (Lima)';
    } elseif ($semester == 6) {
        return 'VI (Enam)';
    } elseif ($semester == 7) {
        return 'VII(Tujuh)';
    } elseif ($semester == 8) {
        return 'VIII(Delapan)';
    }
}
