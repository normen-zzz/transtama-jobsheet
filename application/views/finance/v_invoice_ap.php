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

                                        <table id="tableApExternalFinance" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
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
    $(document).ready(function() {
        $("#tableApExternalFinance").on('click', '.mod', function() {
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
            $('#selectField').select2();


        });
    });
</script>

<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#tableApExternalFinance').DataTable({
            "processing": true,
            // "responsive": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "dom": "<'row'<'col-lg-10 col-md-10 col-xs-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                "<'row'<'col-lg-10 col-md-10 col-xs-12'l>>",
            "order": [
                [0, 'desc']
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax": {
                "url": "<?= base_url('finance/ApExternal/getDataTableApExternal'); ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [
                [5, 10, 50],
                [5, 10, 50]
            ], // Combobox Limit
            "columns": [{
                    "data": "id_so",
                    "render": function(data, type, row, meta) {
                        return row.no_invoice + `<br>` + row.vendor;
                    }
                }, {
                    "data": "no_po",
                },
                {
                    "data": "date",
                },
                {
                    "data": "status",
                    "render": function(data, type, row, metaphone) {
                        if (data == 4) {
                            return '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                        } else {
                            if (row.due_date == NULL) {
                                return "Due Date Not Setting";
                            } else {
                                return row.due_date;
                            }
                        }

                    }
                },
                {
                    "data": "destination",
                },
                {
                    "data": "pu_poin",
                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="label label-danger label-inline font-weight-lighter" style="width: 100px;">Request Pickup</span>';
                        } else if (data == 5) {
                            return '<span class="label label-secondary label-inline font-weight-lighter" style="width: 100px;">Cancel</span>';

                        } else {
                            return '<span class="label label-success label-inline font-weight-lighter" style="width: 100px;">Pickuped</span>';

                        }
                    }
                },
                {
                    "data": "total_ap",
                },
                {
                    "data": "ppn",
                    "render": function(data, type, row, metaphone) {
                        return data + row.special_ppn;

                    }
                },

                {
                    "data": "pph",
                    "render": function(data, type, row, metaphone) {
                        return data + row.special_pph;

                    }
                },

                {
                    "data": "total_ap",
                    "render": function(data, type, row, metaphone) {
                        return (data) - row.pph + row.ppn + row.special_ppn + row.special_pph

                    }
                },

                {
                    "data": "status",
                    "render": function(data, type, row, metaphone) {
                        return `hehe`;

                    }
                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        if (data == 4) {
                            return "<span class='label label-success label-inline font-weight-lighter'>Paid</span> <br>" + row.payment_date;

                        } else {
                            return "<span class='label label-secondary label-inline font-weight-lighter'>Pending</span>";
                        }

                    }
                },
                

                // {
                //     "data": "id_so",
                //     "render": function(data, type, row, meta) {
                //         return `<a onclick='$("#modalLoading").modal("show");' href="<?= base_url('cs/salesOrder/detail/') ?>` + data + `" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>`;

                //     }
                // },
            ],
        });
    });
</script>