<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">Account Payable</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Take Easy To Create Ap</span>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?= base_url('cs/ap/history') ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">History</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">

                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="myTable">
                        <thead>
                            <tr>
                                <th>No AP</th>
                                <th>Created By</th>
                                <!-- <th>Purpose</th> -->
                                <th>Date</th>
                                <!-- <th>Address</th> -->
                                <th>Total</th>
                                <th>Status</th>
                                <!-- <th>Join At</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ap as $c) {
                            ?>
                                <tr>
                                    <td <?php if ($c['status'] <= 1) { ?> class="text-danger" <?php } ?>><?= $c['no_pengeluaran'] ?></td>
                                    <td <?php if ($c['status'] <= 1) { ?> class="text-danger" <?php } ?>><?= $c['nama_user'] ?></td>
                                    <!-- <td><?= $c['purpose'] ?></td> -->
                                    <td <?php if ($c['status'] <= 1) { ?> class="text-danger" <?php } ?>><?= bulan_indo($c['date']) ?></td>
                                    <td <?php if ($c['status'] <= 1) { ?> class="text-danger" <?php } ?>><?= rupiah($c['total']) ?></td>
                                    <td <?php if ($c['status'] <= 1) { ?> class="text-danger" <?php } ?>><?= statusAp($c['status'], $c['is_approve_sm']) ?></td>
                                    <td>
                                        <?php

                                        $id_atasan = $this->session->userdata('id_atasan');
                                        // kalo dia atasan

                                        if ($c['status'] <= 1) {
                                        ?>
                                            <a href="<?= base_url('cs/ap/approve/' . $c['no_pengeluaran']) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Approve</a>
                                            <a href="<?= base_url('cs/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                            <a target="blank" href="<?= base_url('cs/ap/print/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>
                                        <?php  } else {
                                        ?>
                                            <a href="<?= base_url('cs/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                            <a target="blank" href="<?= base_url('cs/ap/print/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>

                                        <?php  }

                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>