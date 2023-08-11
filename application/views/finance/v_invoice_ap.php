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
                <div class="content-header">
                    <form action="<?= base_url('finance/apExternal/created') ?>" method="POST">
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
                                <a href="<?= base_url('finance/report/exportApExternalExcell/' . $awal . '/' . $akhir) ?>" class="btn btn-danger ml-2 mt-2">Export Excell</a>
                                <!-- <a href="<?= base_url('finance/report/exportApPdf') ?>" class="btn btn-danger ml-2 mt-2">Export PDF</a> -->
                                <a href="<?= base_url('finance/apExternal/created') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <form action="<?= base_url('finance/apExternal/multiPaid') ?>" method="POST">
                                            <button type="submit" class="btn btn-success ml-3 mt-2 mb-2" id="submitPaid" style="display: none;">Paid</button>
                                            <table id="tableApExternal" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Vendor/Agent</th>
                                                        <th>No PO</th>
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

                                                    ?>
                                                        <?php if ($j['status'] >= 2) { ?>
                                                            <tr>
                                                                <td><?php if ($j['status'] == 5) { ?><input type="checkbox" name="no_po[]" id="no_po" value="<?= $j['no_po'] ?>" class="noPo"> <?php } ?></td>
                                                                <td><?= $j['vendor'] ?> <br>
                                                                    <a href="<?= base_url('finance/apExternal/print/' . $j['no_po'] . '/' . $j['id_vendor'] . '/' . $j['unique_invoice']) ?>"><?= $j['no_invoice'] ?></a>
                                                                </td>
                                                                <td><?= $j['no_po'] ?></td>
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
                                                                <td><?= rupiah($j['ppn'] + $j['special_ppn']) ?></td>
                                                                <td><?= rupiah($j['pph'] + $j['special_pph']) ?></td>
                                                                <td><?= rupiah(($j['total_ap']) - $j['pph'] + $j['ppn'] + $j['special_ppn'] - $j['special_pph']) ?></td>

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
                                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                                <a href="<?= base_url('finance/apExternal/approveMgrFinance/' . $j['unique_invoice']) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a>

                                                                            <?php   } elseif ($j['status'] == 5) {
                                                                            ?>
                                                                                <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                                <button type="button" class="btn btn-sm text-light mt-2 mod" data-toggle="modal" data-unique_invoice="<?= $j['unique_invoice'] ?>" data-no_po="<?= $j['no_po'] ?>" data-target="#modal-paid-external" style="background-color: #9c223b;">Paid 1</button>

                                                                            <?php  } else {
                                                                            ?>
                                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                            <?php  }
                                                                            // jika GM
                                                                        } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {
                                                                            // jika statusnya received finance
                                                                            if ($j['status'] == 3) { ?>
                                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                                <!-- jika sudah di approve mgr finance -->
                                                                            <?php   } elseif ($j['status'] == 7) {
                                                                            ?>
                                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                                <a href="<?= base_url('finance/apExternal/approveGM/' . $j['unique_invoice']) ?>" class="btn btn-sm mb-1 text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a>

                                                                            <?php  } else { ?>
                                                                                <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                        <?php }
                                                                        }
                                                                        ?>


                                                                        <!-- jika staff finance -->
                                                                    <?php  } else {
                                                                    ?>
                                                                        <!-- jika recevied finance -->
                                                                        <?php if ($j['status'] == 3) {
                                                                        ?>
                                                                            <a href="<?= base_url('finance/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                        <?php  } elseif ($j['status'] == 4) {
                                                                        ?>
                                                                            <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                            <!-- <button data-toggle="modal" data-target="#modal-paid<?= $j['id_invoice'] ?>" class="btn btn-sm text-light mt-1" style="background-color: #9c223b;">Paid</button> -->
                                                                        <?php } elseif ($j['status'] == 5) {
                                                                        ?>
                                                                            <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                            <button type="button" class="btn btn-sm text-light mt-2 mod" data-toggle="modal" data-unique_invoice="<?= $j['unique_invoice'] ?>" data-no_po="<?= $j['no_po'] ?>" data-target="#modal-paid-external" style="background-color: #9c223b;">Paid 2</button>

                                                                        <?php  } elseif ($j['status'] == 7) { ?>
                                                                            <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                        <?php } else { ?>
                                                                            <a href="<?= base_url('finance/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                    <?php }
                                                                    } ?>


                                                                </td>

                                                            </tr>
                                                        <?php } ?>

                                                    <?php } ?>

                                                </tbody>

                                            </table>
                                        </form>

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




<div class="modal fade" id="modal-paid-external">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Proof of Payment</b> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/apExternal/paid') ?>" method="POST" enctype="multipart/form-data">
                <div id="mod">

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

<script>
    $(document).ready(function() {
        $(".mod").click(function() {
            console.log('Tombol diklik');
            var no_po = $(this).data('no_po'); // Mendapatkan ID dari atribut data-id tombol yang diklik
            var unique_invoice = $(this).data('unique_invoice');
            $('#mod').html('');
            // Memuat data menggunakan AJAX dengan mengirimkan ID sebagai parameter

            // Menampilkan data ke dalam modal
            var content = '<div class="modal-body">' +
                '<p> No PO : ' + no_po + ' </p>' +
                '<div class="form-group">' +
                '<label for="due_date" class="font-weight-bold">Payment Date</label>' +
                '<input type="date" class="form-control" name="payment_date" required>' +
                '<input type="text" hidden class="form-control" name="unique_invoice" value="' + unique_invoice + '" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label class="col-form-label text-lg-right font-weight-bold">Upload Proof</label>' +
                '<input type="file" id="input-file-now" name="ktp" />' +
                '</div>' +
                '</div>';
            $('#mod').html(content);



        });

        $cbs = $('input[name="no_po[]"]').click(function() {
            $("#submitPaid").toggle($cbs.is(":checked"));
        });
    });
</script>