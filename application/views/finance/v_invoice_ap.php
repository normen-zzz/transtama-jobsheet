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
                                                        <th>#</th>
                                                        <th>Vendor/Agent</th>
                                                        <th>No PO</th>
                                                        <th>Date Created</th>
                                                        <th>Due Date</th>
                                                        <th>Invoice</th>
                                                        <th>PPN</th>
                                                        <th>PPH</th>
                                                        <th>Total Invoice</th>
                                                        <th>PO Status</th>
                                                        <th>Payment Status</th>
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



<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#tablePoCreatedFinance').DataTable({
            "processing": true,

            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "dom": "<'row'<'col-lg-10 col-md-10 col-xs-12'f>>" +
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

            "pageLength": 50,
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
                        return 'Rp.'+rupiah;
                    }

                },
                {
                    "data": 'ppn',
                    "render": function(data, type, row, meta) {
                        var ppn = data+row.special_ppn
                        var number_string = ppn.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.'+rupiah;
                    }

                },
                {
                    "data": 'pph',
                    "render": function(data, type, row, meta) {
                        var pph = data+row.special_pph
                        var number_string = pph.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.'+rupiah;
                    }

                },
                
               
                {
                    "data": 'total_ap',
                    "render": function(data, type, row, meta) {
                        var totalInvoice = data+row.ppn+row.special_ppn+pph+row.special_pph;
                        var number_string = totalInvoice.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        return 'Rp.'+rupiah;
                    }

                },
                {
                    "data": 'status',
                    "render": function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="label label-danger label-inline font-weight-lighter" style="height:50px; ">Request Ap</span>';
                        } else if (data == 1) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px;background-color:#00a9bf;">Approved By Manager</span>';
                        } else if (data == 2) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px; background-color:#ff4d00">Approved By SM</span>';
                        } else if (data == 3) {
                            return '<span class="label label-warning label-inline font-weight-lighter" style="height:50px">Received By Finance</span>';
                        } else if (data == 6) {
                            return '<span class="label label-secondary label-inline font-weight-lighter">Void</span>';
                        } else if (data == 5) {
                            return '<span class="label label-success label-inline font-weight-lighter" style="height:50px; background-color:#7c4dff;">Approved By GM</span>';
                        } else if (data == 7) {
                            return '<span class="label label-primary label-inline font-weight-lighter" style="height:50px">Approved By Mgr Finance</span>';
                        } else {
                            return '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                        }
                    }

                },

                {
                    "data": 'status',
                    "render": function(data, type, row, meta) {
                         if (data == 4) {
                            return '<span class="label label-success label-inline font-weight-lighter">Paid</span> <br>';
                        } else {
                            return '<span class="label label-secondary label-inline font-weight-lighter">Pending</span>';
                        }
                    }

                },

                {
                    "data": 'status',
                    "render": function(data, type, row, meta) {
                        if (data == 3) {
                            return  ' <a href="<?= base_url('cs/apExternal/editInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Edit</a>' +
                                '<?php $id_atasan = $this->session->userdata('id_atasan');
                                    if ($id_atasan == NULL || $id_atasan == 0) { ?>  <a href="<?= base_url('cs/apExternal/approveAtasan/') ?>' + row.unique_invoice + '" class=" btn btn-sm mt-2 text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a> <?php } ?>';
                        } else if (data == 4) {
                            return '<a href="<?= base_url('cs/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<?php $jabatan = $this->session->userdata('id_jabatan');
                                    if ($jabatan == 10) { ?> <a href="<?= base_url('cs/apExternal/approveSm/') ?>' + row.unique_invoice + '" class=" btn btn-sm text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a> <?php } ?>';
                        }else if (data == 5) {
                            return '<a href="<?= base_url('cs/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<?php $jabatan = $this->session->userdata('id_jabatan');
                                    if ($jabatan == 10) { ?> <a href="<?= base_url('cs/apExternal/approveSm/') ?>' + row.unique_invoice + '" class=" btn btn-sm text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a> <?php } ?>';
                        }else if (data == 7) {
                            return '<a href="<?= base_url('cs/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<?php $jabatan = $this->session->userdata('id_jabatan');
                                    if ($jabatan == 10) { ?> <a href="<?= base_url('cs/apExternal/approveSm/') ?>' + row.unique_invoice + '" class=" btn btn-sm text-light tombol-konfirmasi mt-2" style="background-color: #9c223b;">Approve</a> <?php } ?>';
                        } else {
                            return '<a href="<?= base_url('cs/apExternal/detailInvoice/') ?>' + row.unique_invoice + '/' + row.id_vendor + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                        }
                    }

                },




            ],
        });
        $('#tablePoCreatedFinance').DataTable().searchPanes.rebuildPane();
    });
</script>