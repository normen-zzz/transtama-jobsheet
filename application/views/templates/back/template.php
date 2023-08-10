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
	<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.0.2/css/searchPanes.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	
	<!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<!-- Modal -->
<div class="modal fade" id="modalLoading" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="mx-auto spinner-border text-danger" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
	</div>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <a href="index.html">
            <img class="pt-2" style="width: 14%;height: 82%;margin-bottom: 2%;" alt="Logo" src="<?= base_url('uploads/') ?>LogoRaw.png" />
            <span class="text-bold p-3" style="color: #707070;font-weight: bold;">E-INVOICE</span>
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->

            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:<?= base_url('assets/back/metronic2/') ?>media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <?php $this->load->view('templates/back/aside') ?>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <?php $this->load->view('templates/back/header') ?>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->

                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <?= $_content; ?>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <?php $this->load->view('templates/back/footer') ?>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
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
        <?php $id_user = $this->session->userdata('id_user');
        $foto = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        ?>
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
        <!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script> -->
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/gmaps/gmaps.js"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="<?= base_url('assets/') ?>back/metronic2/js/pages/widgets.js"></script>
        <script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="https://cdn.datatables.net/searchpanes/2.0.2/js/dataTables.searchPanes.min.js"></script>
        <!--end::Page Scripts-->
        <!-- Select2 -->
        <script src="<?= base_url('assets/back/') ?>plugins/select2/js/select2.min.js"></script>

        <script src="<?= base_url('assets/assets/backend/') ?>vendor_plugins/bootstrap-slider/bootstrap-slider.js"></script>
        <script src="<?= base_url('assets/assets/backend/') ?>vendor_components/OwlCarousel2/dist/owl.carousel.js"></script>
        <script src="<?= base_url('assets/assets/backend/') ?>vendor_components/flexslider/jquery.flexslider.js"></script>
        <script src="<?= base_url('assets/assets/') ?>js/sweetalert2.all.min.js"></script>
        <script src="//cdn.ckeditor.com/4.13.1/basic/ckeditor.js"></script>

        <!-- compress foto  -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.0/dist/browser-image-compression.js"></script>
        <script src="<?= base_url('assets/compress/tracker.js') ?>"></script>

</body>
<!--end::Body-->

</html>
<!-- untuk edit ap -->
<script type="text/javascript">
    $(document).ready(function() {


        // On text click
        $('.edit').click(function() {
            // Hide input element
            $('.txtedit').hide();

            // Show next input element
            $(this).next('.txtedit').show().focus();

            // Hide clicked element
            $(this).hide();
        });


        // Focus out from a textbox
        $('.txtedit').focusout(function() {
            // Get edit id, field name and value
            var edit_id = $(this).data('id');
            var fieldname = $(this).data('field');
            var url = $(this).data('url');
            var value = $(this).val();

            // assign instance to element variable
            var element = this;

            // Send AJAX request
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    field: fieldname,
                    value: value,
                    id: edit_id
                },
                success: function(response) {
                    // console.log(response);

                    // Hide Input element
                    $(element).hide();

                    // Update viewing value and display it
                    $(element).prev('.edit').show();
                    if (fieldname == 'amount_approved') {
                        $(element).prev('.edit').text('Rp. ' + value);
                    } else {
                        $(element).prev('.edit').text(value);
                    }

                }
            });
        });
    });
</script>
<!-- ========= FORMAT RUPIAH ============ -->
<script type="text/javascript">
    const collection = document.getElementsByClassName("amount_proposed");
    for (let i = 0; i < collection.length; i++) {
        collection[i].addEventListener('keyup', function(e) {
            collection[i].value = formatRupiah(this.value, 'Rp. ');
        });
    }

    /* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e) {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }



    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        // console.log(typeof(angka))
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    <?= $this->session->flashdata('messageAlert'); ?>
</script>
	<script type="text/javascript">
    $('select').select2({
        allowClear: true,
    });
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

        var myTable = $('#myTable').DataTable({"pageLength": 100});
    });
</script>

<script>
    $(document).ready(function() {

        var myTable = $('#myTableAp').DataTable({
            "pageLength": 100,
            "order": [],
            searchPanes: {
                columns: [7],
                layout: 'columns-4'
            },

            dom: 'Pfrtip',
        });
        $('#myTableAp').DataTable().searchPanes.rebuildPane();
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
		"pageLength": 100,
        "ordering": false,
		dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
</script>
<script>
    $('#tableInvoice').DataTable({
		"bPaginate": false,
        "ordering": false,
		dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
</script>

<script>
    $('#example1').DataTable({
		"pageLength": 100,
        "ordering": false
    });
</script>

<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#myTableMsr').DataTable({
			"pageLength": 100,
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
