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
                    <form action="<?= base_url('finance/invoice/final') ?>" method="POST">
                        <h6 class="page-title">Check Invoice</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Shipment ID/DO Number" name="shipment_id">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success">Submit</button>
                                <a href="<?= base_url('finance/jobsheet') ?>" class="btn btn-primary"> Reset Filter</a>

                            </div>
                            <?php if (isset($invoice)) {
                            ?>
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td style="font-weight: bold;">No Invoice</td>
                                            <td>: <?= $invoice['no_invoice'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Shipment ID/DO Number</td>
                                            <td>: <?= $shipment_id ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Due Date</td>
                                            <td>: <?= $invoice['due_date'] ?> </td>
                                        </tr>
                                    </table>

                                </div>

                            <?php  }  ?>
                        </div>
                    </form>
                </div>
                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tableInvoiceFinal" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>

                                                    <th>No Invoice</th>
                                                    <th>Date Created</th>
                                                    <th>Due Date</th>
                                                    <th>Time Line</th>
                                                    <th>Customer Invoice</th>
                                                    <th>Customer Pickup</th>
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

<div class="modal fade" id="modal-paid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/invoice/paid') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">

                        <div id="content-paid-invoice">

                        </div>
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






<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#tableInvoiceFinal').DataTable({
            "processing": true,
            // "responsive": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "dom": "<'row'<'col-lg-10 col-md-10 col-xs-12'fpl>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                "<'row'<'col-lg-10 col-md-10 col-xs-12'l>>",
            "order": [
                [0, 'desc']
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax": {
                "url": "<?= base_url('finance/Invoice/getDataInvoiceFinal'); ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "pageLength": 100,
            "aLengthMenu": [
                [5, 10, 50, 100],
                [5, 10, 50, 100]
            ], // Combobox Limit
            "columns": [{
                    "data": "no_invoice",
                    "render": function(data, type, row, meta) {
                        return '<a target="blank" href="<?= base_url('finance/invoice/printProforma/') ?>' + row.no_invoice + '">' + data + '</a>';
                    }


                },
                {
                    "data": "date",

                },
                {
                    "data": "due_date",

                },
                {
                    "data": "date",
                    "render": function(data, type, row, meta) {
                        function formatDate(date) {
                            var d = new Date(date),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear();

                            if (month.length < 2)
                                month = '0' + month;
                            if (day.length < 2)
                                day = '0' + day;

                            return [year, month, day].join('-');
                        }
                        var start = new Date(row.due_date);
                        var end = new Date();
                        var diff = new Date(start - end);
                        var days = diff / 1000 / 60 / 60 / 24;
                        if (days > 0) {
                            return "<span class='text-danger'>" + Math.ceil(days) + " Days Again</span>";
                        } else {
                            return '<span class="text-danger">Expired</span><br> Please Follow up This invoice';
                        }
                    }

                },
                {
                    "data": "customer",

                },
                {
                    "data": "customer_pickup",

                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        if (data == 1) {
                            return '<span class="label label-danger label-inline font-weight-lighter">Pending</span>';
                        } else if (data == 2) {
                            return '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                        } else if (data == 3) {
                            return '<span class="label label-purple label-inline font-weight-lighter">Unpaid</span>';

                        }
                    }

                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        if (data == 2) {
                            return '<a href="<?= base_url('finance/invoice/detailInvoice/') ?>' + row.id_invoice + '/' + row.no_invoice + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<a target="blank" href="<?= base_url('finance/invoice/printProformaFull/') ?>' + row.no_invoice + '" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i>PDF </a>' +
                                '<a target="blank" href="<?= base_url('finance/invoice/printProformaExcell/') ?>' + row.no_invoice + '" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>';
                        } else {
                            return '<a href="<?= base_url('finance/invoice/detailInvoice/') ?>' + row.id_invoice + '/' + row.no_invoice + '" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>' +
                                '<a href="<?= base_url('finance/invoice/editInvoice/') ?>' + row.id_invoice + '/' + row.no_invoice + '" class="btn btn-sm text-light mt-1" style="background-color: #9c223b;">Edit</a>' +
                                '<button type="button" href="#" data-toggle="modal" data-target="#modal-paid" data-no_invoice="' + row.no_invoice + '" class="btn btn-sm text-light mt-1 paidInvoice" id="paidInvoice" style="background-color: #9c223b;">Paid</button>' +
                                '<a target="blank" href="<?= base_url('finance/invoice/printProformaFull/') ?>' + row.no_invoice + '" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i>PDF </a>' +
                                '<a target="blank" href="<?= base_url('finance/invoice/printProformaExcell/') ?>' + row.no_invoice + '" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>';
                        }
                    }

                },


            ],
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.paidInvoice', function() {
            var no_invoice = $(this).data('no_invoice'); // Mendapatkan ID dari atribut data-id tombol yang diklik
            // Memuat data menggunakan AJAX dengan mengirimkan ID sebagai parameter
            $('#content-paid-invoice').html('');
            $.ajax({
                url: '<?php echo base_url("finance/Invoice/getNoInvoice"); ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    no_invoice: no_invoice,

                },
                success: function(response) {
                    // Menampilkan data ke dalam modal

                    var content = '<h4 class="modal-title">Proof of Payment ' + response.no_invoice + '</b> </h4>' +
                        '<label for="due_date" class="font-weight-bold">Payment Date</label>' +
                        '<input type="date" class="form-control" name="payment_date" required>' +
                        '<input type="text" hidden class="form-control" name="no_invoice" value="' + response.no_invoice + '" required>';
                    $('#content-paid-invoice').html(content);

                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });
        });

    })
</script>