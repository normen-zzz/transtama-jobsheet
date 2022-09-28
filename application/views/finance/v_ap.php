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
                        <h3 class="card-label font-weight-bolder text-dark"><?= $title ?></h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Take Easy To Create Ap</span>
                    </div>
                    <?php
                    $url = $this->uri->segment(3);

                    if ($url == "car") {
                    ?>
                        <div class="card-toolbar">
                            <a href="<?= base_url('finance/ap/addCar') ?>" class="btn font-weight-bolder text-light" style="background-color: #9c223b;">
                                <span class="svg-icon svg-icon-md">
                                    <i class="fa fa-plus text-light"></i>
                                </span>Add CAR</a>
                        </div>
                    <?php  }
                    ?>

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
                                <th>Amount Proposed</th>
                                <th>Amount Approved</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ap as $c) {
                            ?>
                                <tr>
                                    <td><?= $c['no_pengeluaran'] . '<br>';
                                        echo ($c['id_kat_ap'] == 3)  ? '<b>' . $c['no_ca'] . '</b>' : ''
                                        ?> </td>
                                    <td><?= $c['nama_user'] ?></td>
                                    <!-- <td><?= $c['purpose'] ?></td> -->
                                    <td><?= bulan_indo($c['date']) ?></td>
                                    <td><?= rupiah($c['total']) ?></td>
                                    <td><?= ($c['status'] == 2 ? 'Wait Received' : rupiah($c['total_approved'])) ?></td>
                                    <td><?= statusAp($c['status'], $c['is_approve_sm']) ?>
                                        <!-- <td><?= ($c['no_ca'] == NULL ? '<span class="label label-danger label-inline font-weight-lighter" style="height:30px">Not Created</span>' : $c['no_ca']) ?>
                                    <td><?= ($c['no_ca'] == NULL ? '<span class="label label-danger label-inline font-weight-lighter" style="height:30px">Not Created</span>' : $c['no_ca']) ?> -->

                                    </td>
                                    <td>
                                        <?php
                                        $id_jabatan = $this->session->userdata('id_jabatan');
                                        // kalo dia jabatannya GM
                                        if ($id_jabatan == 11) {
                                            $url = $this->uri->segment(3);
                                            // echo $url;
                                            if ($c['status'] == 7) {
                                        ?>
                                                <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                                <a href="<?= base_url('finance/ap/approveGm/' . $c['no_pengeluaran'] . '/' . $url) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>

                                            <?php  } else {
                                            ?>
                                                <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                            <?php }
                                            ?>

                                            <?php  } else {
                                            if ($c['status'] == 3 || $c['status'] == 5 || $c['status'] == 7) {
                                            ?>
                                                <a href="#" data-toggle="modal" data-target="#modal-paid<?= $c['no_pengeluaran'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Pay</a>
                                                <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                                <a target="blank" href="<?= base_url('finance/ap/print/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>
                                            <?php  } else {
                                            ?>
                                                <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                                <a target="blank" href="<?= base_url('finance/ap/print/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>

                                        <?php  }
                                        }


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



<?php foreach ($ap as $c) {
    $url = $this->uri->segment(3);
?>
    <div class="modal fade" id="modal-paid<?= $c['no_pengeluaran'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pay with no <b><?= $c['no_pengeluaran'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('finance/ap/paid') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Proof Payment</label>
                            <input type="file" class="form-control" name="ktp" required>

                        </div>
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" required>
                            <input type="text" hidden class="form-control" name="no_invoice" value="<?= $c['no_pengeluaran'] ?>" required>
                            <input type="text" hidden class="form-control" name="url" value="<?= $url ?>">

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>