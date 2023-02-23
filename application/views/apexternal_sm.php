<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="description" content="Shipper Apps Transtama Logistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url('assets/') ?>back/metronic2/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/back/') ?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url('uploads/') ?>LogoRaw.png" />
    <style>
        /* @media (max-width: 575.98px) { ... } */
        @media screen and (max-width: 600px) {
            #chat {
                display: none;
            }
        }

        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->


<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="card card-custom gutter-b example example-compact">
                <form action="<?= base_url('cs/apExternal/processEditAp') ?>" method="POST">
                    <input type="text" hidden name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                    <div class="card-body">
                        <div class="content-header">
                            <center>
                                <h3 class="page-title text-center">DETAIL PO <?= $vendor['nama_vendor'] . '<br>' . $invoice[0]['no_po']
                                                                                ?> </h3>
                                <span class="text"><?= $vendor['alamat'] ?></span> - <?php if ($vendor['type'] == 0) {
                                                                                        ?>
                                    <span>Vendor</span>

                                <?php  } else {
                                ?>
                                    <span>Agent</span>
                                <?php  } ?>
                            </center>
                            <div class="d-flex align-items-center">
                                <div class="mr-auto">

                                    <div class="d-inline-block align-items-center">
                                        <?php if ($invoice[0]['status'] == 1) {

                                        ?>
                                            <a href="<?= base_url('Apexternal/approveSm/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>" class="btn text-light" style="background-color: #9c223b;">
                                                Approve</a>
                                        <?php } else {
                                            echo 'Approved';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="box">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" style="width:100%" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>Vendor</th> -->
                                                            <th>AWB</th>
                                                            <th>DATE</th>
                                                            <th>CONSIGNEE</th>
                                                            <th>COLLY</th>
                                                            <th>WEIGHT JS</th>
                                                            <!-- <th>WEIGHT MSR</th> -->
                                                            <th>FLIGHT SMU</th>
                                                            <th>HD Daerah</th>
                                                            <th>OTHERS</th>
                                                            <th>TOTAL AMOUNT</th>
                                                            <!-- <th>VARIABEL</th>
                                                        <th>DIFFERENCE</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $total_koli = 0;
                                                        $total_weight = 0;
                                                        $total_special_weight = 0;
                                                        $total_amount = 0;
                                                        $total_smu = 0;
                                                        $sub_total_smu = 0;
                                                        $total_hd_daerah = 0;
                                                        $sub_total_hd_daerah = 0;
                                                        $others = 0;
                                                        $no = 1;
                                                        foreach ($invoice as $inv) {
                                                            $total_sales = 0;

                                                        ?>
                                                            <tr>

                                                                <td><?= $inv['resi'] ?> <br> <small><?= $inv['shipper'] ?></small> </td>
                                                                <td><?= bulan_indo($inv['tgl_pickup']) ?></td>
                                                                <td><?= $inv['consigne'] ?>-<?= $inv['tree_consignee'] ?></td>
                                                                <td><?= $inv['koli'] ?></td>
                                                                <td><?= $inv['berat_js'] ?></td>
                                                                <td><?= rupiah($inv['flight_msu2']) ?></td>
                                                                <td><?= rupiah($inv['hd_daerah2']) ?></td>
                                                                <td><?= rupiah((int)$inv['others2']) ?></td>
                                                                <td><?= rupiah($inv['flight_msu2'] + $inv['hd_daerah2'] + (int)$inv['others2']) ?></td>
                                                            </tr>
                                                            <input hidden type="text" name="shipment_id[]" value="<?= $inv['id'] ?>">
                                                            <input hidden type="text" name="id_invoice[]" value="<?= $inv['id_invoice'] ?>">
                                                            <input hidden type="text" name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
                                                            <input hidden type="text" name="nama_vendor" value="<?= $vendor['nama_vendor'] ?>">

                                                        <?php
                                                            $total_koli = $total_koli + $inv['koli'];
                                                            $total_weight = $total_weight + $inv['berat_js'];
                                                            $total_special_weight = $total_special_weight + $inv['berat_msr'];

                                                            $total_smu = $total_smu + $inv['flight_msu2'];
                                                            $total_hd_daerah =  $total_hd_daerah + $inv['hd_daerah2'];

                                                            $sub_total_smu = $sub_total_smu +  $inv['flight_msu2'] + (int)$inv['others2'];
                                                            $sub_total_hd_daerah = $sub_total_hd_daerah + $inv['flight_msu2'] +  $inv['hd_daerah2'] + (int)$inv['others2'];

                                                            $others =  $others + (int)$inv['others2'];
                                                            $no++;
                                                        } ?>


                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">TOTAL <?= $no - 1 ?> AWB</td>
                                                            <td><?= $total_koli ?> </td>
                                                            <td><?= $total_weight ?> </td>
                                                            <td><?= rupiah($total_smu) ?></td>
                                                            <td><?= rupiah($total_hd_daerah) ?></td>

                                                            <td><?= rupiah($others) ?> </td>


                                                            <td><?= rupiah($sub_total_hd_daerah) ?></td>


                                                        </tr>
                                                    </tfoot>

                                                </table>
                                                <br>
                                                <h3 class="title text-center"><i class="fa fa-info"></i> PO INFORMATION</h3>
                                                <br>

                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>

                                    <div class="row">
                                        <?php
                                        $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);

                                        $terbilang = $f->format($sub_total_hd_daerah) . ' Rupiahs';
                                        $terbilang = ucwords($terbilang);


                                        if ($vendor['type'] == 0) {
                                        ?>
                                            <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_smu ?>">
                                        <?php  } else {
                                        ?>
                                            <input type="text" class="form-control" name="total_ap" hidden value="<?= $sub_total_hd_daerah ?>">

                                        <?php   }

                                        ?>
                                        <input type="text" class="form-control" name="terbilang" hidden value="<?= $terbilang ?>">
                                        <input type="text" class="form-control" name="unique_invoice" hidden value="<?= $inv['unique_invoice'] ?>">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
                                                <textarea class="form-control" required name="purpose"><?= $inv['purpose'] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="pic" class="font-weight-bold">No. Invoice</label>
                                            <input type="text" name="no_invoice" disabled value="<?= $inv['no_invoice'] ?>" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Other (Rp.) <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" required name="other" value="<?= $inv['other'] ?>"></input>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Due Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" required name="other" value="<?= $inv['due_date'] ?>"></input>
                                            </div>
                                        </div>


                                        <div class="col-md-4" id="mode">
                                            <label for="note_cs">Payment Mode</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mode" value="0" <?php if ($inv['mode'] == 0) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <label class="form-check-label" for="mode1">
                                                    Cash
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mode" value="1" <?php if ($inv['mode'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <label class="form-check-label" for="mode2">
                                                    Bank Transfer
                                                </label>
                                            </div>
                                        </div>


                                        <?php if ($inv['mode'] == 1) {
                                        ?>
                                            <div class="col-md-4">
                                                <div class=" form-group">
                                                    <label for="exampleInputEmail1">Via</label>
                                                    <input type="text" name="via" class="form-control" value="<?= $inv['via_transfer'] ?>">
                                                </div>
                                            </div>

                                        <?php  } ?>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mr-auto">
                                                <h3 class="page-title text-center">PAYMENT STATUS PO <?= $vendor['nama_vendor']
                                                                                                        ?> </h3>
                                                <div class="d-inline-block align-items-center">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if ($inv['status'] == 4) {
                                            ?>
                                                <div class="d-flex align-items-center flex-wrap mb-8">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5 bg-success">
                                                        <span class="symbol-label  bg-success">
                                                            <i class="fa fa-check text-light"></i>
                                                        </span>
                                                    </div>
                                                    <!--begin::Text-->

                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" data-toggle="modal" data-target="#modal-paid<?= $inv['no_invoice'] ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Paid</a>
                                                        <?php
                                                        $due_date = new DateTime($inv['due_date']);
                                                        $date = date('Y-m-d');
                                                        $date = new DateTime($date);
                                                        $perbedaan = $due_date->diff($date)->format("%a");
                                                        ?>
                                                        <span class="text-success font-weight-bold"><?= bulan_indo($inv['payment_date']) ?></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        <?= rupiah($sub_total_hd_daerah) ?>

                                                    </span>

                                                </div>
                                            <?php } else {
                                            ?>

                                                <div class="d-flex align-items-center flex-wrap mb-8">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5 bg-danger">
                                                        <span class="symbol-label  bg-danger">
                                                            <i class="fa fa-window-close text-light"></i>
                                                        </span>
                                                    </div>
                                                    <!--begin::Text-->

                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Unpaid</a>
                                                        <?php
                                                        $due_date = new DateTime($inv['due_date']);
                                                        $date = date('Y-m-d');
                                                        $date = new DateTime($date);
                                                        $perbedaan = $due_date->diff($date)->format("%a");
                                                        ?>
                                                        <!-- <span class="text-muted font-weight-bold"><?= $perbedaan ?> Days Again</span> -->
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        <?= rupiah($sub_total_hd_daerah + $inv['other']) ?>
                                                    </span>
                                                </div>
                                            <?php  } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--begin::Footer-->
    <?php $this->load->view('templates/back/footer') ?>

    <!--end::Main-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10 bg-dark">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0 text-light">Profile User
                <!-- <small class="text-muted font-size-sm ml-2">12 messages</small> -->
            </h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->

        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">

                    <div class="symbol-label" style="background-image:url('<?= base_url('assets/back/metronic2/') ?>media/users/300_21.jpg')"></div>

                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <a href="#" class="font-weight-bold font-size-h5 text-light text-hover-light"><?= $this->session->userdata('nama_user') ?></a>
                    <div class="text-muted mt-1"></div>
                    <div class="navi mt-2">
                        <a href="#" class="navi-item">
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <!--begin::Svg Icon | path:<?= base_url('assets/back/metronic2/') ?>media/svg/icons/Communication/Mail-notification.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text text-light text-hover-light"><?= $this->session->userdata('email') ?></span>
                            </span>
                        </a>
                        <?php $role = $this->session->userdata('id_role');
                        if ($role == 5 or $role == 4) {
                        ?>
                            <a href="<?= base_url('backoffice/logout') ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                        <?php } else {
                        ?>
                            <a href="<?= base_url('backoffice/logout') ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>

                        <?php  } ?>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->
            <!--begin::Nav-->
            <div class="navi navi-spacer-x-0 p-0">
                <!--begin::Item-->
                <a href="<?= base_url('profile') ?>" class="navi-item">
                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <!--begin::Svg Icon | path:<?= base_url('assets/back/metronic2/') ?>media/svg/icons/General/Notification2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold text-light">Profil Saya</div>
                            <div class="text-light">Lihat detail profil
                                <span class="label label-light-light label-inline text-dark font-weight-bold">lihat</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--end::Nav-->

        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->


    <!--begin::Chat Panel-->
    <div class="modal modal-sticky modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:<?= base_url('assets/back/metronic2/') ?>media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <!--end::Scrolltop-->

        <!--begin::Global Config(global config for global JS scripts)-->
        <script>
            var KTAppSettings = {
                "breakpoints": {
                    "sm": 576,
                    "md": 768,
                    "lg": 992,
                    "xl": 1200,
                    "xxl": 1400
                },
                "colors": {
                    "theme": {
                        "base": {
                            "white": "#ffffff",
                            "primary": "#3699FF",
                            "secondary": "#E5EAEE",
                            "success": "#1BC5BD",
                            "info": "#8950FC",
                            "warning": "#FFA800",
                            "danger": "#F64E60",
                            "light": "#E4E6EF",
                            "dark": "#181C32"
                        },
                        "light": {
                            "white": "#ffffff",
                            "primary": "#E1F0FF",
                            "secondary": "#EBEDF3",
                            "success": "#C9F7F5",
                            "info": "#EEE5FF",
                            "warning": "#FFF4DE",
                            "danger": "#FFE2E5",
                            "light": "#F3F6F9",
                            "dark": "#D6D6E0"
                        },
                        "inverse": {
                            "white": "#ffffff",
                            "primary": "#ffffff",
                            "secondary": "#3F4254",
                            "success": "#ffffff",
                            "info": "#ffffff",
                            "warning": "#ffffff",
                            "danger": "#ffffff",
                            "light": "#464E5F",
                            "dark": "#ffffff"
                        }
                    },
                    "gray": {
                        "gray-100": "#F3F6F9",
                        "gray-200": "#EBEDF3",
                        "gray-300": "#E4E6EF",
                        "gray-400": "#D1D3E0",
                        "gray-500": "#B5B5C3",
                        "gray-600": "#7E8299",
                        "gray-700": "#5E6278",
                        "gray-800": "#3F4254",
                        "gray-900": "#181C32"
                    }
                },
                "font-family": "Poppins"
            };
        </script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <!-- jQuery 3 -->
        <script src="<?= base_url('assets/'); ?>back/plugins/jquery/jquery.js"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/global/plugins.bundle.js"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/js/scripts.bundle.js"></script>
        <script src="<?= base_url('assets/back/metronic2/') ?>js/pages/crud/forms/editors/summernote.js"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Vendors(used by this page)-->
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
        <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/gmaps/gmaps.js"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="<?= base_url('assets/') ?>back/metronic2/js/pages/widgets.js"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Page Scripts-->
        <!-- Select2 -->
        <script src="<?= base_url('assets/back/') ?>plugins/select2/js/select2.min.js"></script>

        <script src="<?= base_url('assets/assets/backend/') ?>vendor_plugins/bootstrap-slider/bootstrap-slider.js"></script>
        <script src="<?= base_url('assets/assets/backend/') ?>vendor_components/OwlCarousel2/dist/owl.carousel.js"></script>
        <script src="<?= base_url('assets/assets/backend/') ?>vendor_components/flexslider/jquery.flexslider.js"></script>
        <script src="<?= base_url('assets/assets/') ?>js/sweetalert2.all.min.js"></script>
        <script src="//cdn.ckeditor.com/4.13.1/basic/ckeditor.js"></script>

</body>
<!--end::Body-->

</html>
<script type="text/javascript">
    $('select').select2({
        allowClear: true,
    });
</script>
<script>
    <?= $this->session->flashdata('messageAlert'); ?>
</script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#mahasiswa").select2({
            // allowClear: true,
        });
    });
</script>

<?php
$dataflash = json_encode($this->session->flashdata('message'));
?>

<script>
    var flashData = <?= $dataflash ?>;
    if (flashData) {
        Swal.fire(flashData)
    }

    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const data = $(this).data('flashdata');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'data ' + data + ' akan dihapus ?',
            showCancelButton: true,
            confirmButtonColor: '#0095cc',
            // confirmationButtonColor: '#0095cc',
            cancelButtonColor: '#ff562f',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })
    })

    $('.tombol-update').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const data = $(this).data('flashdata');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'data ' + data + ' akan diupdate ?',
            showCancelButton: true,
            confirmButtonColor: '#0095cc',
            // confirmationButtonColor: '#0095cc',
            cancelButtonColor: '#ff562f',
            confirmButtonText: 'Update'
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })
    })
    $('.tombol-konfirmasi').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const data = $(this).data('flashdata');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'data ' + data + ' akan Proses ?',
            showCancelButton: true,
            confirmButtonColor: '#0095cc',
            // confirmationButtonColor: '#0095cc',
            cancelButtonColor: '#ff562f',
            confirmButtonText: 'Update'
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })
    })

    $(document).ready(function() {

        var myTable = $('#myTable').DataTable({});
    });
</script>

<script>
    var flashData = <?= $dataflash ?>;
    if (flashData) {
        Swal.fire(flashData)
    }

    $('.tombol-konfirmasi').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const data = $(this).data('flashdata');
        Swal.fire({
            title: 'Are you sure ?',
            // text: 'data ' + data + ' akan dihapus ?',
            showCancelButton: true,
            confirmButtonColor: '#0095cc',
            // confirmationButtonColor: '#0095cc',
            cancelButtonColor: '#ff562f',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })
    })
</script>

<script>
    $('#table').DataTable({
        "ordering": false
    });
</script>

<script>
    $('#example1').DataTable({
        "ordering": false
    });
</script>

<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#myTableMsr').DataTable({
            "processing": true,
            // "responsive": true,
            "serverSide": true,
            "ordering": true,
            "dom": "<'row '<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "order": [
                [0, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url('cs/jobsheet/getData'); ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [
                [5, 10, 50],
                [5, 10, 50]
            ], // Combobox Limit
            "columns": [{
                    "data": "tgl_pickup",
                },
                {
                    "data": "no_stp",
                },
                {
                    "data": "customer",
                },
                {
                    "data": "consigne",
                },
                {
                    "data": "colly",
                },
                {
                    "data": "freight_kg",
                },
                {
                    "data": "sales",
                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        if (status == 0) {
                            return '<span class="label label-lg label-light-danger label-inline">Progress</span>';
                        } else {
                            return '<span class="label label-lg label-light-success label-inline">Success</span>';
                        }
                    }
                },
                {
                    "data": "id_msr",
                    "render": function(data, type, row, meta) {
                        return '<a href="<?= base_url('cs/jobsheet/detail/') ?>' + data + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a> <a href="<?= base_url('cs/jobsheet/edit/') ?>' + data + '" class="btn btn-success text-light mt-1">Edit</a> ';
                    }
                },
            ],
        });
    });
</script>


<script>
    $(document).ready(function() {
        var i = 2;
        $(".tambah-ap").on('click', function() {


            row = '<div class="rec-element-ap" style="margin-left:20px">' +
                '<div class="row">' +
                '<div class="col-md-3">' +
                '<label for="note_cs">Choose Category ' + i + '</label>' +
                '<div class="form-group rec-element-ap">' +
                '<input type="hidden" class="browse-category form-control" id="id_category' + i + '"  name="id_category[]">' +
                '<input type="text" readonly class="browse-category form-control" id="nama_kategori' + i + '" data-index="' + i + '" name="nama_kategori_pengeluaran[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4" style="margin-left:5px">' +
                '<label for="note_cs">Description ' + i + '</label>' +
                '<div class="form-group rec-element-ap">' +
                '<textarea class="form-control" id="descriptions' + i + '" name="descriptions[]"></textarea>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label for="note_cs">Amount Proposed ' + i + '</label>' +
                '<div class="form-group rec-element-ap">' +
                '<input type="text" class="form-control" id="amount' + i + '" name="amount_proposed[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-1">' +
                '<span class="input-group-btn">' +
                '<button type="button" class="btn btn-warning del-element_ap mt-4"><i class="fa fa-minus-square"></i></button>' +
                '</span>' +
                '</div>' +
                '<div class="ln_solid_ap"></div>' +
                '</div>';
            '</div>';

            $(row).insertBefore("#nextkolom_ap");
            $('#jumlahkolom_ap').val(i + 1);
            i++;
        });
        $(document).on('click', '.del-element_ap', function(e) {
            e.preventDefault()
            i--;
            //$(this).parents('.rec-element').fadeOut(400);
            $(this).parents('.rec-element-ap').remove();
            $('#jumlahkolom_ap').val(i - 1);
        });
    });
</script>


<script>
    $('body').on("click", ".browse-category", function() {
        var index = $(this).attr('data-index');


        jQuery("#selectCategory").attr("data-index", index);
        jQuery("#selectCategory").modal("toggle");
    });



    $('body').on("click", '.btn-choose', function(e) {
        id_category = $(this).attr("data-id");

        indek = $("#selectCategory").attr("data-index");


        document.getElementById("id_category" + indek + "").value = $(this).attr('data-id');


        document.getElementById("nama_kategori" + indek + "").value = $(this).attr('data-nama');
        $("#selectCategory").modal('hide');
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        const inputEl = document.getElementById("mode");
        const car = document.getElementById("car");
        $('#kat').change(function() {

            var id = $(this).val();
            if (id == 1) {
                document.getElementById("mode").style.display = "block";
            } else if (id == 3) {
                document.getElementById("car").style.display = "block";
            } else {
                inputEl.style.display = "none";
                car.style.display = "none";
            }

        });

    });

    $(document).ready(function() {
        $('#modee').change(function() {

            var id = $(this).val();
            console.log(id);

            if (id == 1) {
                document.getElementById("via").style.display = "block";
            } else {
                inputEl.style.display = "none";
            }

        });


    });
</script>

<script>
    function Cash() {
        if (document.getElementById('tf').checked) {
            document.getElementById('via').style.display = "block";
        } else {
            document.getElementById('via').style.display = "none";
        }
    }
</script>



<?php foreach ($ap as $c) {
?>

    <div class="modal fade" id="modal-bukti<?= $c['id_pengeluaran'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Attachment </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('superadmin/role/addRole') ?>" method="POST">
                        <div class="col-md-12">
                            <img src="https://tesla-smartwork.transtama.com/uploads/ap/<?= $c['attachment'] ?>" alt="attachment" width="100%" height="350">

                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?php foreach ($ap as $c) {
?>

    <div class="modal fade" id="modal-edit<?= $c['id_pengeluaran'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $c['description'] ?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('cs/ap/edit') ?>" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" value="<?= $c['description'] ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="description">Amount Proposed</label>
                            <input type="text" name="amount_proposed" class="form-control" value="<?= $c['amount_proposed'] ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="note_cs">Change Attachment</label>
                            <div class="form-group rec-element-ap">
                                <input type="file" class="form-control" name="attachment">
                                <input type="text" class="form-control" name="attachment_lama" hidden value="<?= $c['attachment'] ?>">
                                <input type="text" class="form-control" name="id_pengeluaran" hidden value="<?= $c['id_pengeluaran'] ?>">
                                <input type="text" class="form-control" name="no_pengeluaran" hidden value="<?= $c['no_pengeluaran'] ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img src="<?= base_url('uploads/ap/' . $c['attachment']) ?>" alt="attachment" width="100%">

                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>