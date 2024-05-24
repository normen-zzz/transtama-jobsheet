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

                                        <table id="tablePoCreatedFinance" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>

                                                    <th>Vendor/Agent</th>
                                                    <th>No PO</th>
                                                    <th>Date Created</th>
                                                    <th>Due Date</th>
                                                    <th>Invoice</th>
                                                    <th>PPN</th>
                                                    <th>PPH</th>
                                                    <th>Total Invoice</th>
                                                    <th>PO Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


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
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#tablePoCreatedFinance').DataTable({
            
            "processing": true,

            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "dom": "<'row'<'col-lg-10 col-md-10 col-xs-12'f p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                "<'row'<'col-lg-10 col-md-10 col-xs-12'l>>",
            "order": [
                [1, 'desc']
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax": {
                "url": "<?= base_url('finance/ApExternal/getDataPoCreated'); ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,

            "pageLength": 10,
            "aLengthMenu": [
                [10, 50, 100],
                [10, 50, 100]
            ], // Combobox Limit
            "columns": [{
                    "data": 'vendor',
                    "render": function(data, type, row, meta) {
                        return row.vendor + ' <br><a href="<?= base_url('finance/apExternal/print/') ?>' + row.no_po + '/' + row.id_vendor + '/' + row.unique_invoice + '">' + row.no_invoice + '</a>';
                    }
                },
                {
                    "data": 'no_po',

                },
                {
                    "data": 'date',

                },
                {
                    "data": 'due_date',

                },
                {
                    "data": 'total_ap',
                    "render": function(data, type, row, meta) {
                        var number_string = data.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.' + rupiah;
                    }

                },
                {
                    "data": 'ppn',
                    "render": function(data, type, row, meta) {
                        var ppn = parseInt(data) + parseInt(row.special_ppn)
                        var number_string = ppn.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.' + rupiah;
                    }

                },
                {
                    "data": 'pph',
                    "render": function(data, type, row, meta) {
                        var pph = parseInt(data) + parseInt(row.special_pph)
                        var number_string = pph.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.' + rupiah;
                    }

                },


                {
                    "data": 'total_ap',
                    "render": function(data, type, row, meta) {
                        var totalInvoice = parseInt(data) + parseInt(row.ppn) + parseInt(row.special_ppn) - parseInt(row.pph) - parseInt(row.special_pph);
                        var number_string = totalInvoice.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.' + rupiah;
                    }

                },
                {
                    "data": 'status',
                    "render": function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="label label-danger label-inline font-weight-lighter" style="height:50px; ">Request Ap</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 1) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px;background-color:#00a9bf;">Approved By Manager</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 2) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px; background-color:#ff4d00">Approved By SM</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 3) {
                            return '<span class="label label-warning label-inline font-weight-lighter" style="height:50px">Received By Finance</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 6) {
                            return '<span class="label label-secondary label-inline font-weight-lighter">Void</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 5) {
                            return '<span class="label label-success label-inline font-weight-lighter" style="height:50px; background-color:#7c4dff;">Approved By GM</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else if (data == 7) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px">Approved By Mgr Finance</span><br><span class="label label-secondary label-inline font-weight-lighter mt-2">Pending</span>';
                        } else {
                            return '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                        }
                    }

                },

               

                {
                    "data": 'status',
                    "render": function(data, type, row, meta) {
                        if (data == 3) {
                            return '<?php if ($this->session->userdata('id_atasan') == NULL || $this->session->userdata('id_atasan') == 0) { ?>' +
                                //jika MGR FINANCE
                                '<?php if ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 2) { ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<a href="<?= base_url('finance/apExternal/approveMgrFinance/') ?>' + row.unique_invoice + '" class=" btn btn-sm text-light mt-2 tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>' +
                                //JIKA GM
                                '<?php } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {  ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                //JIKA STAFF FINANCE
                                '<?php }
                                    } else { ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                            '<?php } ?>';
                        } else if (data == 4) {
                            return '<?php if ($this->session->userdata('id_atasan') == NULL || $this->session->userdata('id_atasan') == 0) { ?>' +
                                //jika MGR FINANCE
                                '<?php if ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 2) { ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                //JIKA GM
                                '<?php } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {  ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                //JIKA STAFF FINANCE
                                '<?php }
                                    } else { ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                            '<?php } ?>';
                        } else if (data == 5) {
                            return '<?php if ($this->session->userdata('id_atasan') == NULL || $this->session->userdata('id_atasan') == 0) { ?>' +
                                //jika MGR FINANCE
                                '<?php if ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 2) { ?>' +
                                '<a href="<?= base_url('finance/apExternal/editInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>'+
                            '<button type="button" class="btn btn-sm text-light mt-2 mod" data-toggle="modal" data-unique_invoice="' + row.unique_invoice + '" data-no_po="' + row.no_po + '" data-target="#modal-paid-external" style="background-color: #9c223b;">Paid</button>' +
                                //JIKA GM
                                '<?php } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {  ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                //JIKA STAFF FINANCE
                                '<?php }
                                    } else { ?>' +
                                '<a href="<?= base_url('finance/apExternal/editInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>'+
                            '<button type="button" class="btn btn-sm text-light mt-2 mod" data-toggle="modal" data-unique_invoice="' + row.unique_invoice + '" data-no_po="' + row.no_po + '" data-target="#modal-paid-external" style="background-color: #9c223b;">Paid</button>' +
                            '<?php } ?>';
                        } else if (data == 7) {
                            return '<?php if ($this->session->userdata('id_atasan') == NULL || $this->session->userdata('id_atasan') == 0) { ?>' +
                                //jika MGR FINANCE
                                '<?php if ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 2) { ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                //JIKA GM
                                '<?php } elseif ($this->session->userdata('id_role') == 6 && $this->session->userdata('id_jabatan') == 11) {  ?>' +
                                '<a href="<?= base_url('finance/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<a href="<?= base_url('finance/apExternal/approveGM/') ?>' + row.unique_invoice + '" class=" btn btn-sm text-light mt-2 tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>' +
                                //JIKA STAFF FINANCE
                                '<?php }
                                    } else { ?>' +
                                '<a href="<?= base_url('finance/apExternal/editInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                            '<?php } ?>';
                        } else {
                            return '<a href="<?= base_url('finance/apExternal/editInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                        }
                    }

                },




            ],
        });
        $('#tablePoCreatedFinance').DataTable().searchPanes.rebuildPane();
    });
</script>

<script>
    $(document).ready(function() {
        $('body').on('click', '.mod', function() {
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

