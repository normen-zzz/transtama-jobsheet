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
                            <a href="<?= base_url('finance/ap/addCar') ?>" class="btn font-weight-bolder text-light mb-4" style="background-color: #9c223b;">
                                <span class="svg-icon svg-icon-md">
                                    <i class="fa fa-plus text-light"></i>
                                </span>Add CAR</a>
                        </div>
                    <?php  }
                    ?>
                    <!-- <a href="<?= base_url('finance/ap/history' . $this->uri->segment(3)) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">History</a> -->

                </div>
                <div class="card-body" style="overflow: auto;">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="myTableAp">
                        <thead>
                            <tr>
                                <th>No AP</th>
                                <th>Created By</th>
                                <th>Purpose</th>
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
                                    <td><?= $c['purpose'] ?></td>
                                    <td><?= bulan_indo($c['date']) ?></td>
                                    <td><?= rupiah($c['total']) ?></td>
                                    <td><?= ($c['status'] == 2 ? 'Wait Received' : rupiah($c['total_approved'])) ?></td>
                                    <td><?= statusAp($c['status'], $c['is_approve_sm']) ?>


                                    </td>
                                    <td>
                                        <?php
                                        $id_jabatan = $this->session->userdata('id_jabatan');
                                        $userAp = $this->db->get_where('tb_user', array('id_user' => $c['id_user']))->row_array();
                                        // kalo dia jabatannya GM
                                        if ($id_jabatan == 11) {
                                            $url = $this->uri->segment(3);
                                            // echo $url;
                                            if ($c['status'] == 7) {
                                                if ($c['id_role'] == 4 || $c['id_role'] == 6) {
                                        ?>
                                                    <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                                    <a href="<?= base_url('finance/ap/approveGm/' . $c['no_pengeluaran'] . '/' . $url) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>

                                                <?php  } else { ?>
                                                    <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                                <?php  }
                                            } else {
                                                ?>
                                                <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                            <?php }
                                            ?>

                                        <?php  }
                                        // Jika yang buka bukan gm 
                                        else { ?>
                                            <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>
                                            <a target="blank" href="<?= base_url('finance/ap/print/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>
                                            <!-- jika yang mengajukan rolenya cs / ops -->
                                            <?php if ($c['id_role'] == 2 || $c['id_role'] == 3) {
                                                // jika diapprove GM
                                                if ($c['status'] == 7) { ?>
                                                    <a href="#" data-toggle="modal" data-target="#modal-paid<?= $c['no_pengeluaran'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Pay</a>
                                                    <?php } else {
                                                    // jika dia untuk bensin atau transport maka bisa langsung di acc setelah approve manager 
                                                    if ($c['id_kategori_pengeluaran'] == 1 && $c['status'] != 4) { ?>
                                                        <a href="#" data-toggle="modal" data-target="#modal-paidLangsung<?= $c['no_pengeluaran'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Pay</a>
                                                <?php }
                                                } ?>
                                            <?php } elseif ($c['id_role'] == 4 || $c['id_role'] == 6) { ?>
                                                <?php // jika diapprove GM
                                                if ($c['status'] == 5) { ?>
                                                    <a href="#" data-toggle="modal" data-target="#modal-paid<?= $c['no_pengeluaran'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Pay</a>
                                                    <?php } else {
                                                    // jika dia untuk bensin atau transport maka bisa langsung di acc setelah approve manager 
                                                    if ($c['id_kategori_pengeluaran'] == 1 && $c['status'] != 4) { ?>
                                                        <a href="#" data-toggle="modal" data-target="#modal-paidLangsung<?= $c['no_pengeluaran'] ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Pay</a>
                                                <?php }
                                                } ?>
                                            <?php } ?>
                                        <?php  } ?>
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

<?php foreach ($ap2 as $d) {
    $url = $this->uri->segment(3);
    $CI = &get_instance();
    $CI->load->model('ApModel');
    $detail = $CI->ApModel->getApByNo($d['no_pengeluaran'])->result_array();
?>
    <div class="modal fade" id="modal-paidLangsung<?= $d['no_pengeluaran'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pay with no <b><?= $d['no_pengeluaran'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('finance/ap/paidLangsung') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Proof Payment</label>
                            <input type="file" class="form-control" name="ktp" required>
                        </div>

                        <div class="form-group">
                            <?php foreach ($detail as $detail) { ?>

                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="id_pengeluaran[]" value="<?= $detail['id_pengeluaran'] ?>" hidden>
                                        <label for="">Amount Proposed</label>
                                        <input type="text" name="amount_proposed" class="form-control" id="amount_proposed" value="<?= $detail['amount_proposed'] ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="">Amount Approved</label>
                                        <input type="number" name="amount_approved[]" class="form-control" id="amount_approved" value="<?= $detail['amount_approved'] ?>">
                                    </div>
                                </div>


                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" required>
                            <input type="text" hidden class="form-control" name="no_invoice" value="<?= $d['no_pengeluaran'] ?>" required>
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