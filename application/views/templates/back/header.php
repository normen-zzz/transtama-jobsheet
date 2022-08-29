<?php $this->load->helper('role_user'); ?>
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between" style="background-color: #091E29;">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <blockquote class="blockquote">
                    </blockquote>
                    <li class="menu-item menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                        <a href="#" class="menu-link menu-toggle">
                            <span class="menu-text text-light">Welcome, <?= $this->session->userdata('nama_user') ?></span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::User-->
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto px-2" id="kt_quick_user_toggle">
                    <span class="text-light font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-light font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $this->session->userdata('nama_user') ?></span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold"><?php echo substr($this->session->userdata('nama_user'), 0, 1)  ?></span>
                    </span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>