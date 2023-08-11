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
                    <form action="<?= base_url('finance/Ap/multiPaid/'.$this->uri->segment(3)) ?>" method="POST">
                        <button type="submit" class="btn btn-success ml-3 mt-2 mb-2" id="submitPaid" style="display: none;">Paid</button>
                        <table class="table table-separate table-head-custom table-checkable" id="myTableAp">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                    $id_jabatan = $this->session->userdata('id_jabatan');
                                    $userAp = $this->db->get_where('tb_user', array('id_user' => $c['id_user']))->row_array();
                                ?>
                                    <tr>
                                        <td>

                                            <?php if ($this->session->userdata('id_jabatan') != 11) {

                                                if ($c['id_role'] == 2 || $c['id_role'] == 3 || $c['id_role'] == 5) {
                                                    if ($c['status'] == 7) { ?>
                                                        <input type="checkbox" name="no_pengeluaran[]" value="<?= $c['no_pengeluaran'] ?>" id="no_pengeluaran">
                                                    <?php }
                                                } elseif ($c['id_role'] == 4 || $c['id_role'] == 6) {
                                                    if ($c['status'] == 5) { ?>
                                                        <input type="checkbox" name="no_pengeluaran[]" value="<?= $c['no_pengeluaran'] ?>" id="no_pengeluaran">
                                                        <?php } else {
                                                        if ($userAp['id_jabatan'] == 11 && $c['status'] == 7) { ?>
                                                            <input type="checkbox" name="no_pengeluaran[]" value="<?= $c['no_pengeluaran'] ?>" id="no_pengeluaran">

                                            <?php }
                                                    }
                                                }
                                            } ?>



                                        </td>
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
                                                <?php if ($c['id_role'] == 2 || $c['id_role'] == 3 || $c['id_role'] == 5) {
                                                    // jika diapprove manager finance
                                                    if ($c['status'] == 7) { ?>
                                                        <button href="#" data-toggle="modal" data-target="#modal-paid" class="btn btn-sm mb-1 text-light modalPaid" data-no_pengeluaran="<?= $c['no_pengeluaran'] ?>" data-url="<?= $url ?>" style="background-color: #9c223b;" type="button">Pay</button>
                                                    <?php } ?>
                                                    <!-- jika rolenya ka/sales -->
                                                <?php } elseif ($c['id_role'] == 4 || $c['id_role'] == 6) { ?>
                                                    <?php // jika diapprove GM
                                                    if ($c['status'] == 5) { ?>
                                                        <button href="#" data-toggle="modal" data-target="#modal-paid" class="btn btn-sm mb-1 text-light modalPaid" data-no_pengeluaran="<?= $c['no_pengeluaran'] ?>" data-url="<?= $url ?>" style="background-color: #9c223b;" type="button">Pay</button>
                                                        <?php } else {
                                                        // jika dia untuk bensin atau transport maka bisa langsung di acc setelah approve manager 
                                                        if ($userAp['id_jabatan'] == 11 && $c['status'] == 7) { ?>
                                                            <button href="#" data-toggle="modal" data-target="#modal-paidLangsung" class="btn btn-sm mb-1 text-light modalPaidLangsung" data-no_pengeluaran="<?= $c['no_pengeluaran'] ?>" data-url="<?= $url ?>" style="background-color: #9c223b;" type="button">Pay</button>
                                                    <?php }
                                                    } ?>
                                                <?php } ?>
                                            <?php  } ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </form>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<div class="modal fade" id="modal-paid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay </b> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('finance/ap/paid') ?>" method="POST" enctype="multipart/form-data">
                    <div id="modal-content-paid">

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

<div class="modal fade" id="modal-paidLangsung">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay</h4>
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

                    <div id="modalContentPaidLangsung">

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


<script>
    $(document).ready(function() {
        $('.modalPaid').click(function() {
            var no_pengeluaran = $(this).data('no_pengeluaran'); // Mendapatkan ID dari atribut data-id tombol yang diklik
            var url = $(this).data('url');
            $('#modal-content-paid').html('');
            // Memuat data menggunakan AJAX dengan mengirimkan ID sebagai parameter
            $.ajax({
                url: '<?php echo base_url("finance/Ap/getModalPaid"); ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    no_pengeluaran: no_pengeluaran,
                    url: url
                },
                success: function(response) {
                    // Menampilkan data ke dalam modal

                    var content =
                        '<p>NO Pengeluaran : ' + response.no_pengeluaran + ' </p>' +
                        '<div class="form-group">' +
                        '<label for="due_date" class="font-weight-bold">Proof Payment</label>' +
                        '<input type="file" class="form-control" name="ktp" required>' +

                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="due_date" class="font-weight-bold">Payment Date</label>' +
                        '<input type="date" class="form-control" name="payment_date" required>' +
                        '<input type="text" hidden class="form-control" name="no_invoice" value="' + response.no_pengeluaran + '" required>' +
                        '<input type="text" hidden class="form-control" name="url" value="' + response.url + '">' +

                        '</div>';
                    $('#modal-content-paid').html(content);
                    $('#selectField').select2();

                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });
        });
    })
</script>

<script>
    $(document).ready(function() {
        $('.modalPaidLangsung').click(function() {
            var no_pengeluaran = $(this).data('no_pengeluaran'); // Mendapatkan ID dari atribut data-id tombol yang diklik
            var url = $(this).data('url');
            $('#modal-content-paid-langsung').html('');
            // Memuat data menggunakan AJAX dengan mengirimkan ID sebagai parameter
            $.ajax({
                url: '<?php echo base_url("finance/Ap/getModalPaidLangsung"); ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    no_pengeluaran: no_pengeluaran,
                    url: url
                },
                success: function(response) {
                    // Menampilkan data ke dalam modal

                    var content = '';
                    for (var i = 0; i < response.length; i++) {
                        var data = response[i];
                        content +=
                            '<p>NO Pengeluaran : ' + no_pengeluaran + ' </p>' +
                            '<div class="form-group">' +
                            '<div class="row">' +
                            '<div class="col">' +
                            '<input type="text" name="id_pengeluaran[]" value="' + data.id_pengeluaran + '" hidden>' +
                            '<label for="">Amount Proposed</label>' +
                            '<input type="text" name="amount_proposed" class="form-control" id="amount_proposed" value="' + data.amount_proposed + '" disabled>' +
                            '</div>' +
                            '<div class="col">' +
                            '<label for="">Amount Approved</label>' +
                            '<input type="number" name="amount_approved[]" class="form-control" id="amount_approved" value="' + data.amount_approved + '">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="due_date" class="font-weight-bold">Payment Date</label>' +
                            '<input type="date" class="form-control" name="payment_date" required>' +
                            '<input type="text" hidden class="form-control" name="no_invoice" value="' + no_pengeluaran + '" required>' +
                            '<input type="text" hidden class="form-control" name="url" value="' + url + '">' +

                            '</div>';
                    }
                    $('#modalContentPaidLangsung').html(content);
                    $('#selectField').select2();

                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });
        });
        $cbs = $('input[name="no_pengeluaran[]"]').click(function() {
            $("#submitPaid").toggle($cbs.is(":checked"));
        });
    })
</script>