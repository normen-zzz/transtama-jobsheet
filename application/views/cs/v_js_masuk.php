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
                                <!-- <div class="box-header with-border">
                                    <h4 class="box-title with-border">
                                        <div class="box-controls">
                                            <a href="<?= base_url('cs/jobsheet/add') ?>" type="button" class="btn btn-rounded align-middle text-light" style="background-color: #9c223b;">
                                                <i class="fas fa-plus"></i>
                                                Single Add
                                            </a>
                                            <a href="<?= base_url('cs/jobsheet/add') ?>" type="button" class="btn btn-rounded align-middle text-light" style="background-color: #9c223b;">
                                                <i class="fas fa-plus"></i>
                                                Bulk Add
                                            </a>
                                        </div>
                                    </h4>

                                </div> -->
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tableJsMasuk" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Pickup Date</th>
                                                    <th>Shipment ID</th>

                                                    <th>No. SO</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <th>Deadline</th>
                                                    <th>Sales</th>
                                                    <!-- <th>Status</th> -->
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


<div class="modal fade" id="modalAktivasiJs">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request Aktivation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('cs/salesOrder/addRequestAktivasi') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label text-lg-right font-weight-bold">Reason <span class="text-danger">*</span> </label>
                        <textarea type="text" name="reason" class="form-control" required></textarea>
                        <input type="text" name="shipment_id" hidden>
                        <input type="text" name="type" value="staff" hidden>
                    </div>
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
    $(document).on("click", ".btnAktivasiJs", function() {
        var shipment_id = $(this).data('shipment_id');
        $("#modalAktivasiJs input[name='shipment_id']").val(shipment_id);
    });
</script>

<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#tableJsMasuk').DataTable({
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
                "url": "<?= base_url('cs/SalesOrder/getDataJsMasuk'); ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "pageLength": 100,
            "aLengthMenu": [
                [5, 10, 50, 100],
                [5, 10, 50, 100]
            ], // Combobox Limit
            "columns": [{
                    "data": "tgl_pickup"
                },
                {
                    "data": "shipment_id"
                },

                {
                    "data": "shipment_id",
                    "render": function(data, type, row, meta) {
                        return 'SO-' + data;
                    }
                },
                {
                    "data": "shipper"
                },
                {
                    "data": "tree_consignee"
                },
                {
                    "data": "deadline_pic_js",
                    "render": function(data, type, row, meta) {
                        var tgl1 = new Date();
                        tgl1.setHours(0, 0, 0, 0);
                        var tgl2 = new Date(data);
                        tgl2.setHours(0, 0, 0, 0);

                        var jarak = tgl2 - tgl1;

                        var perbedaan = jarak / 60 / 60 / 24 / 1000;


                        if (perbedaan > 0) {
                            return '<small class="label label-success label-inline font-weight-lighter" style="width: 150px;"> ' + Math.ceil(perbedaan) + ' Days Again To Check</small>';
                        } else if (perbedaan == 0) {
                            return '<small class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Last Day To Check</small>';
                        } else {
                            return '<small>You Late Check</small>';
                        }
                    }
                },
                {
                    "data": "nama_user"
                },
                {
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        var aktivasi = row['id_aktivasi'];
                        var tgl1 = new Date();
                        tgl1.setHours(0, 0, 0, 0);
                        var tgl2 = new Date(row['deadline_pic_js']);
                        tgl2.setHours(0, 0, 0, 0);
                        var jarak = tgl2 - tgl1;
                        var perbedaan = jarak / 1000 / 60 / 60 / 24;
                        if (perbedaan < 0) {
                            if (aktivasi === null) {
                                return "<a href='#' class='btn btn-sm mb-1 btn-secondary text-dark mt-1 btnAktivasiJs' data-toggle='modal' data-target='#modalAktivasiJs' data-shipment_id='" + row['shipment_id'] + "'>Request Aktivasi</a>";
                            } else {
                                return ' <br>Wait Approve SM';
                            }
                        } else {
                            return "<a href='<?= base_url('cs/salesOrder/detail/') ?>" + data + "' class=' btn btn-sm text-light' style='background-color: #9c223b;'>Create Jobsheet</a>";
                        }
                    }
                }
            ]
        });
    });
</script>