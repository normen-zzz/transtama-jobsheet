<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduadmin-template.multipurposethemes.com/bs4/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Sep 2021 22:33:02 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title>Wan University - Ubah password </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/skin_color.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script> -->

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(<?= base_url('assets/assets/backend/') ?>images/auth-bg/bg-1.jpg)">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded30 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="ttext-fade text-bold">Ubah Password</h2>
                                <p class="mb-0">Sistem Informasi Akademik dan Learning Management System</p>
                            </div>
                            <div class="p-40">
                                <form action="<?= base_url('Auth/changePassword'); ?>" method="post">
                                    <div class="form-group">
                                        <?= $this->session->flashdata('message'); ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control pl-15 bg-transparent" placeholder="Password" name="password1" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control pl-15 bg-transparent" placeholder="Repeat Password" name="password2" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-danger mt-10">Ubah Password</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <!-- <p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-5">Sign Up</a></p> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="<?= base_url('assets/assets/backend/') ?>js/vendors.min.js"></script>
    <script src="<?= base_url('assets/assets/backend/') ?>js/pages/chat-popup.js"></script>
    <script src="<?= base_url('assets/assets/backend/') ?>icons/feather-icons/feather.min.js"></script>

</body>



</html>