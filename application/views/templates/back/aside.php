<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="#" class="brand-logo">
            <img class="pt-2" style="width:50%;height:100%;" alt="Logo" src="<?= base_url('uploads/') ?>LogoRaw.png" />
            <?php if ($this->session->userdata('id_role') == 6) {
            ?>
                <span class="text-bold p-3" style="color: #707070;font-weight: bold;">E-Invoice</span>

            <?php } else {
            ?>
                <span class="text-bold p-3" style="color: #707070;font-weight: bold;">Jobsheet</span>

            <?php } ?>
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <?php $role = $this->session->userdata('id_role'); ?>
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <!-- jika dia superadmin -->
                <?php if ($role == 1) {
                ?>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('superadmin/dashboard') ?>" class="menu-link">
                            <i class="fa fa-home mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-text">JOBSHEET</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('superadmin/jobsheet') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Jobsheet</span>
                        </a>
                    </li>

                <?php } elseif ($role == 6) {
                    $total_revisi = $this->db->get_where('tbl_revisi_so', ['status_revisi' => 2])->num_rows(); ?>
                    <!-- keuangan -->
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/dashboard') ?>" class="menu-link">
                            <i class="fa fa-home mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-text">JOBSHEET</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/jobsheet') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Enter Jobsheet</span>
                        </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/jobsheet/final') ?>" class="menu-link">
                            <i class="fa fa-check mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Approve Jobsheet</span>
                        </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/jobsheet/viewRevisiSo') ?>" class="menu-link">
                            <i class="fa fa-pen mt-3 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Revisi Jobsheet
                                <pre class="badge badge-danger ml-1"> <?= $total_revisi ?></pre>
                            </span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-text">INVOICE</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-dollar-sign mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">AR</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/invoice') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Proforma Invoice</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/invoice/final') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Invoice</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/invoice/invoicePaid') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Invoice Paid</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-file-invoice mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">AP</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/ap') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">PO - Payment Order</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/apExternal/created') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">PO - External</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/ap/ca') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">CA - Cash Advance</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/ap/car') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">CAR - Cash Advance Report</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/ap/re') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">RE - Reimbursment</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    <!-- <li class="menu-section">
                        <h4 class="menu-text">REPORT</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li> -->

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-chart-bar mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">REPORT</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/soa') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">SOA</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/ap') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">MSR</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/ap2') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">AP</span>
                                    </a>
                                </li>
                                <!-- <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/profitLoss') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Profit</span>
                                    </a>
                                </li> -->


                            </ul>
                        </div>
                    </li>

                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/jobsheet/cekResi') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Cek Resi</span>
                        </a>
                    </li>

                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('finance/ap/cekAp') ?>" class="menu-link">
                            <i class="fa fa-search mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Cek Ap</span>
                        </a>
                    </li>

                    <li class="menu-section">
                        <h4 class="menu-text">MASTER DATA</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-cog mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">List</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/ap/list_pengeluaran') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">List Pengeluaran</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="menu-section">
                        <h4 class="menu-text">Profit/Loss</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fas fa-chart-bar mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">PROFIT/LOSS</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/profitLossHpp') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">HPP</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('finance/report/profitLoss') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">REAL</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                <?php } elseif ($role == 3) {

                    $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
                    $total_aktivasi = $this->db->get_where('tbl_aktivasi_so', ['status' => 0])->num_rows();
                    $total_aktivasi_sales = $this->db->get_where('tbl_aktivasi_cs', ['status' => 0])->num_rows();
                    // $total_aktivasi = 0;
                    // $total_aktivasi_sales = 0;

                    $total_revisi = $this->db->get_where('tbl_request_revisi', ['status' => 0])->num_rows();
                    $total_so_cs = $this->db->get_where('tbl_revisi_so', ['status_revisi' => 0])->num_rows();
                    $total_so_mgr = $this->db->get_where('tbl_revisi_so', ['status_revisi' => 1])->num_rows();
                    $total_so_gm = $this->db->get_where('tbl_revisi_so', ['status_revisi' => 3])->num_rows();
                    $total_ap = $this->db->group_by('a.no_pengeluaran')->get_where('tbl_pengeluaran a', ['a.status' => 1, 'a.is_approve_sm' => 1])->num_rows();

                ?>
                    <!-- cs -->
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/dashboard') ?>" class="menu-link">
                            <i class="fa fa-home mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-text">Sales Order</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/salesOrder') ?>" class="menu-link">
                            <i class="fa fa-dollar-sign mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">List Sales Order</span>
                        </a>
                    </li>
                    <li class="d-flex ml-8 mb-2" aria-haspopup="true">
                        <a href="<?= base_url('cs/SalesOrder/revisiSo') ?>" class="menu-link text-dark">
                            <i class="fa fa-book mt-3 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Request Revisi SO

                                <pre class="badge badge-<?php if ($total_revisi == 0) {
                                                            echo "success";
                                                        } else {
                                                            echo "secondary";
                                                        } ?> ml-1"><a class="text-<?php if ($total_revisi == 0) {
                                                                                        echo "white";
                                                                                    } else {
                                                                                        echo "dark";
                                                                                    } ?>" href="<?= base_url('cs/SalesOrder/revisiSoNeedApprove') ?> "><?= $total_revisi ?></a> </pre>
                            </span>
                        </a>
                    </li>
                    <li class="d-flex ml-8" aria-haspopup="true">
                        <a href="<?= base_url('cs/salesOrder/viewRevisiSo') ?>" class="menu-link text-dark">
                            <i class="fa fa-pen mt-3 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Revisi Sales Order
                                <?php $id_atasan = $this->session->userdata('id_atasan');
                                $jabatan = $this->session->userdata('id_jabatan');
                                // kalo dia SM
                                if ($jabatan == 10) {
                                ?>

                                    <pre class="badge badge-<?php if ($total_so_gm == 0) {
                                                                echo "success";
                                                            } else {
                                                                echo "secondary";
                                                            } ?> ml-1"><a class="text-<?php if ($total_so_gm  == 0) {
                                                                                            echo "white";
                                                                                        } else {
                                                                                            echo "dark";
                                                                                        } ?>" href="<?= base_url('cs/SalesOrder/viewRevisiSoNeedApprove') ?> "><?= $total_so_gm  ?></a></pre>
                                <?php   } else {
                                ?>
                                    <pre class="badge badge-<?php if ($total_so_mgr == 0 || $total_so_cs == 0) {
                                                                echo "success";
                                                            } else {
                                                                echo "secondary";
                                                            } ?> ml-1">
                                      <?php
                                        if ($id_atasan == NULL || $id_atasan == 0) { ?>
                                            <a class="text-<?php if ($total_so_mgr  == 0) {
                                                                echo "white";
                                                            } else {
                                                                echo "dark";
                                                            } ?>" href="<?= base_url('cs/SalesOrder/viewRevisiSoNeedApprove') ?> "><?= $total_so_mgr  ?></a>
                                       <?php } else { ?>
                                        <a class="text-<?php if ($total_so_cs  == 0) {
                                                            echo "white";
                                                        } else {
                                                            echo "dark";
                                                        } ?>" href="<?= base_url('cs/SalesOrder/viewRevisiSoNeedApprove') ?> "><?= $total_so_cs  ?></a>
                                       <?php }

                                        ?>
                                    </pre>
                                <?php  }
                                ?>
                            </span>
                        </a>
                    </li>

                    <li class="menu-section">
                        <h4 class="menu-text">Track</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet') ?>" class="menu-link">
                            <i class="fa fa-glass mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Jobsheet Approve PIC</span>
                        </a>
                    </li>

                    <li class="menu-section">
                        <h4 class="menu-text">JOBSHEET</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Jobsheet Approve PIC</span>
                        </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet/final') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Jobsheet Approve Manager</span>
                        </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet/approveMgrFinance') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Jobsheet Approve Mgr Finance</span>
                        </a>
                    </li>

                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet/approveInvoice') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Jobsheet (In Invoice)</span>
                        </a>
                    </li>

                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('cs/jobsheet/cekResi') ?>" class="menu-link">
                            <i class="fa fa-book mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">Cek Resi</span>
                        </a>
                    </li>

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-chart-bar mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">REPORT</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('cs/report/msr') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">MSR</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>



                    <?php $id_atasan = $this->session->userdata('id_atasan');
                    $jabatan = $this->session->userdata('id_jabatan');
                    // kalo di SM
                    if ($jabatan == 10) {
                    ?>
                        <li class="menu-section">
                            <h4 class="menu-text">REQUEST</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="d-flex ml-8" aria-haspopup="true">
                            <a href="<?= base_url('cs/ap') ?>" class="menu-link text-dark">
                                <i class="fa fa-dollar-sign mt-3 fa-1x mr-2 text-danger"></i>
                                <span class="menu-text" style="font-size:11px">Request AP
                                    <pre class="badge badge-<?php if ($total_ap == 0) {
                                                                echo "success";
                                                            } else {
                                                                echo "secondary";
                                                            } ?> ml-1"> <a class="text-<?php if ($total_ap == 0) {
                                                                                            echo "white";
                                                                                        } else {
                                                                                            echo "dark";
                                                                                        } ?>" href="<?= base_url('cs/Ap/apNeedApprove') ?> "><?= $total_ap ?></a> </pre>
                                </span>
                            </a>
                        </li>
                        <li class="d-flex ml-8 mb-4" aria-haspopup="true">
                            <a href="<?= base_url('cs/salesOrder/requestAktivasi') ?>" class="menu-link text-dark">
                                <i class="fa fa-book mt-3 fa-1x mr-2 text-danger"></i>
                                <span class="menu-text" style="font-size:11px">Aktivasi SO
                                    <pre class="badge badge-<?php if ($total_aktivasi == 0) {
                                                                echo "success";
                                                            } else {
                                                                echo "secondary";
                                                            } ?> ml-1"><a class="text-<?php if ($total_aktivasi == 0) {
                                                                                            echo "white";
                                                                                        } else {
                                                                                            echo "dark";
                                                                                        } ?>" href="<?= base_url('cs/SalesOrder/requestAktivasiNeedActivate') ?> "><?= $total_aktivasi ?></a> </pre>
                                </span>
                            </a>
                        </li>
                        <li class="d-flex ml-8" aria-haspopup="true" style="margin-top:-15px;">
                            <a href="<?= base_url('cs/jobsheet/requestAktivasi') ?>" class="menu-link text-dark">
                                <i class="fa fa-book mt-3 fa-1x mr-2 text-danger"></i>
                                <span class="menu-text" style="font-size:11px">Aktivasi Jobsheet
                                    <pre class="badge badge-<?php if ($total_aktivasi_sales == 0) {
                                                                echo "success";
                                                            } else {
                                                                echo "secondary";
                                                            } ?> ml-1"> <a class="text-<?php if ($total_aktivasi_sales == 0) {
                                                                                            echo "white";
                                                                                        } else {
                                                                                            echo "dark";
                                                                                        } ?>" href="<?= base_url('cs/Jobsheet/requestAktivasiNeedActivate') ?> "><?= $total_aktivasi_sales ?></a> </pre>
                                </span>
                            </a>
                        </li>
                    <?php
                    } ?>
                    <li class="menu-section">
                        <h4 class="menu-text">Payment Order</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fa fa-chart-bar mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text" style="font-size:11px">AGENT/VENDOR</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('cs/apExternal') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">CREATE PO</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('cs/apExternal/created') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">PO Created</span>
                                    </a>
                                </li>

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= base_url('cs/vendor') ?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">DATA AGENT/VENDOR</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>


                <?php } elseif ($role == 4) { ?>
                    <!-- marketing -->
                    <li class="menu-item" aria-haspopup="true">
                        <a href="<?= base_url('marketing/dashboard') ?>" class="menu-link">
                            <i class="fa fa-home mt-2 fa-1x mr-2 text-danger"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>