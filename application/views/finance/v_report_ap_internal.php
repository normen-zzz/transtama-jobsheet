<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">


                    <center>
                        <h3><?= $title; ?></h3>
                    </center>

                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/report/ap2') ?>" method="POST">
                        <h6 class="page-title">Filter Report</h6>
                        <br>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Start</label><br>
                                <input type="date" class="form-control" name="awal">
                            </div>
                            <div class="form-group mr-2">
                                <label>End</label><br>
                                <input type="date" class="form-control" name="akhir">
                            </div>
                            <div class="form-group"> <br>
                                <button type="submit" class="btn btn-success ml-3 mt-2">Show</button>
                                <a href="<?= base_url('finance/report/exportApExcell') ?>" class="btn btn-danger ml-2 mt-2">Export Excell</a>
                                <!-- <a href="<?= base_url('finance/report/exportApPdf') ?>" class="btn btn-danger ml-2 mt-2">Export PDF</a> -->
                                <a href="<?= base_url('finance/report/ap2') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="col">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> <b> Internal</b></a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b> External</b></a>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <!--begin: Datatable-->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-separate table-head-custom table-checkable" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No AP</th>
                                            <th>Created By</th>
                                            <!-- <th>Purpose</th> -->
                                            <th>Date Created</th>
                                            <th>Payment Date</th>

                                            <!-- <th>Address</th> -->
                                            <th>Amount Proposed</th>
                                            <th>Amount Approved</th>
                                            <th>Status</th>
                                            <!-- <th>Join At</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ap as $c) {
                                        ?>
                                            <tr>
                                                <td> <a target="blank" href="<?= base_url('finance/ap/print/' . $c['no_pengeluaran']) ?>"> <?= $c['no_pengeluaran'] ?></a> </td>
                                                <td><?= $c['nama_user'] ?></td>
                                                <!-- <td><?= $c['purpose'] ?></td> -->
                                                <td><?= bulan_indo($c['date']) ?></td>
                                                <td><?= date('d F Y', strtotime($c['payment_date'])) ?></td>
                                                <td><?= rupiah($c['total']) ?></td>
                                                <td><?= ($c['status'] == 2 ? 'Wait Received' : rupiah($c['total_approved'])) ?></td>
                                                <td><?= statusAp($c['status'], $c['is_approve_sm']) ?>

                                                </td>
                                                <td>
                                                    <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>


                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table id="table" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Vendor/Agent</th>
                                            <!-- <th>No Invoice</th> -->
                                            <th>Date Created</th>
                                            <th>Due Date</th>
                                            <!-- <th>Time Line</th> -->
                                            <th>Invoice</th>
                                            <th>PPN</th>
                                            <th>PPH</th>
                                            <th>Total Invoice</th>
                                            <th>PO Status</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($proforma as $j) {
                                            $total_mepet = 0;

                                            $tgl1 = strtotime(date('Y-m-d'));
                                            $tgl2 = strtotime($j['due_date']);

                                            $jarak = $tgl2 - $tgl1;

                                            $perbedaan = $jarak / 60 / 60 / 24;

                                            if ($perbedaan <= 7) {
                                                $total_mepet = $total_mepet + 1;
                                            }
                                            // echo $perbedaan;
                                        ?>
                                            <?php if ($j['status'] >= 2) { ?>
                                                <tr>
                                                    <td><?= $j['vendor'] ?> <br>
                                                        <a href="<?= base_url('finance/apExternal/print/' . $j['no_po'] . '/' . $j['id_vendor'] . '/' . $j['unique_invoice']) ?>"><?= $j['no_invoice'] ?></a>
                                                    </td>
                                                    <td><?= bulan_indo($j['date']) ?></td>
                                                    <td><?php if ($j['status'] == 4) {
                                                            echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                        } else {
                                                            if ($j['due_date'] == NULL) {
                                                                echo "Due Date Not Setting";
                                                            } else {
                                                                echo  bulan_indo($j['due_date']);
                                                            }
                                                        }
                                                        ?>

                                                    </td>

                                                    <td><?= rupiah($j['total_ap']) ?></td>
                                                    <td><?= rupiah($j['ppn']) ?></td>
                                                    <td><?= rupiah($j['pph']) ?></td>
                                                    <td><?= rupiah(($j['total_ap']) + $j['pph'] + $j['ppn']) ?></td>

                                                    <td><?= statusAp($j['status'], 1) ?></td>
                                                    <td>
                                                        <?php if ($j['status'] == 4) {
                                                            echo "<span class='label label-success label-inline font-weight-lighter'>Paid</span> <br>";
                                                            echo bulan_indo($j['payment_date']);
                                                        } else {
                                                            echo "<span class='label label-secondary label-inline font-weight-lighter'>Pending</span>";
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                        $id_atasan = $this->session->userdata('id_atasan');
                                                        // kalo dia atasan

                                                        if ($id_atasan == NULL || $id_atasan == 0) {
                                                            // jika manager finance
                                                            if ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 2) {
                                                                $url = $this->uri->segment(3);

                                                                // jika statusnya received finance
                                                                if ($j['status'] == 3) { ?>
                                                                    <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                    <a href="<?= base_url('finance/apExternal/approveMgrFinance/' . $j['unique_invoice']) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a>

                                                                <?php   } else {
                                                                ?>
                                                                    <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                <?php  }
                                                                // jika GM
                                                            } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {
                                                                // jika statusnya received finance
                                                                if ($j['status'] == 3) { ?>
                                                                    <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                    <!-- jika sudah di approve mgr finance -->
                                                                <?php   } elseif ($j['status'] == 7) {
                                                                ?>
                                                                    <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                    <a href="<?= base_url('finance/apExternal/approveGM/' . $j['unique_invoice']) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a>

                                                                <?php  } else { ?>
                                                                    <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <?php }
                                                            }
                                                            ?>


                                                            <!-- jika staff finance -->
                                                        <?php  } else {
                                                        ?>
                                                            <!-- jika recevied finance -->
                                                            <?php if ($j['status'] == 3) {
                                                            ?>
                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <?php  } elseif ($j['status'] == 4) {
                                                            ?>
                                                                <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <!-- <button data-toggle="modal" data-target="#modal-paid<?= $j['id_invoice'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Paid</button> -->
                                                            <?php } elseif ($j['status'] == 5) {
                                                            ?>
                                                                <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <button data-toggle="modal" data-target="#modal-paid<?= $j['id_invoice'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Paid</button>

                                                            <?php  } elseif ($j['status'] == 7) { ?>
                                                                <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                            <?php } else { ?>
                                                                <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                        <?php }
                                                        } ?>


                                                    </td>

                                                </tr>
                                            <?php } ?>

                                        <?php } ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <!--end: Datatable-->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>