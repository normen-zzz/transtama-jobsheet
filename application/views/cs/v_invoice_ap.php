<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title"><?= $title; ?></h3>
                            <div class="d-inline-block align-items-center">

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

                                        <table id="table" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Vendor/Agent</th>
                                                    <!-- <th>No Invoice</th> -->
                                                    <th>Date Created</th>
                                                    <!-- <th>Due Date</th> -->
                                                    <!-- <th>Time Line</th> -->
                                                    <th>Invoice</th>
                                                    <th>PPN</th>
                                                    <th>PPH</th>
                                                    <th>Total Invoice</th>
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
                                                    <tr>
                                                        <td><?= $j['vendor'] ?> <br>
                                                            <a href="<?= base_url('cs/apExternal/print/' . $j['no_po'] . '/' . $j['id_vendor'] . '/' . $j['unique_invoice']) ?>"><?= $j['no_invoice'] ?></a>
                                                        </td>
                                                        <td><?= bulan_indo($j['date']) ?></td>

                                                        <td><?= rupiah($j['total_ap']) ?></td>
                                                        <td><?= rupiah($j['ppn']) ?></td>
                                                        <td><?= rupiah($j['pph']) ?></td>
                                                        <td><?= rupiah(($j['total_ap']) - $j['pph'] - $j['ppn']) ?></td>

                                                        <td>
                                                            <?= statusAp($j['status'], 1) ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            $jabatan = $this->session->userdata('id_jabatan');
                                                            $id_atasan = $this->session->userdata('id_atasan');

                                                            if ($jabatan == 10) {
                                                                if ($j['status'] == 1) {
                                                            ?>
                                                                    <a href="<?= base_url('cs/apExternal/approveSm/' . $j['unique_invoice']) ?>" class=" btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>
                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <?php   } else {
                                                                ?>
                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                <?php  }

                                                                ?>
                                                                <?php  } else {
                                                                if ($id_atasan == NULL || $id_atasan == 0) {
                                                                    if ($j['status'] == 0) {
                                                                ?>
                                                                        <a href="<?= base_url('cs/apExternal/approveAtasan/' . $j['unique_invoice']) ?>" class=" btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>

                                                                    <?php }
                                                                    ?>

                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                    <?php  } else {
                                                                    if ($j['status'] == 0) {
                                                                    ?>
                                                                        <a href="<?= base_url('cs/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit</a>

                                                                    <?php  } else {
                                                                    ?>
                                                                        <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                    <?php  }
                                                                    ?>

                                                                <?php }
                                                                ?>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>



<?php foreach ($proforma as $j) {
?>
    <div class="modal fade" id="modal-paid<?= $j['id_invoice'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proof of Payment with no <b><?= $j['no_invoice'] ?></b> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/apExternal/paid') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" required>
                            <input type="text" hidden class="form-control" name="unique_invoice" value="<?= $j['unique_invoice'] ?>" required>

                        </div>
                        <!-- <div class="form-group">
                            <label for="due_date" class="font-weight-bold">Payment Time</label>
                            <input type="time" class="form-control" name="payment_time" required>

                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-lg-right font-weight-bold">Upload Proof</label>
                            <input type="file" id="input-file-now" name="ktp[]" accept="image/*" multiple />
                        </div> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>