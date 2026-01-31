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
                                        <table id="tableApproveJs" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Pickup Date</th>
                                                    <th>Shipment ID</th>

                                                    <th>No. SO</th>
                                                    <th>JS ID</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <!-- <th>Colly</th> -->
                                                    <th>Sales</th>
                                                    <th>Status</th>
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
            <form action="<?= base_url('cs/Jobsheet/addRequestAktivasi') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label text-lg-right font-weight-bold">Reason <span class="text-danger">*</span> </label>
                        <textarea type="text" name="reason" class="form-control" required></textarea>
                        <input type="text" name="shipment_id" hidden>
                        <input type="text" name="type" value="manager" hidden>
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
        tabel = $('#tableApproveJs').DataTable({
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
                "url": "<?= base_url('cs/Jobsheet/getDataPicJs'); ?>", // URL file untuk proses select datanya
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
                    "data": "shipment_id",
                    "render": function(data, type, row, meta) {
                        return 'JS-' + data;
                    }
                },
                {
                    "data": "shipper"
                },
                {
                    "data": "tree_consignee"
                },
                {
                    "data": "deadline_manager_cs",
                    "render": function(data, type, row, meta) {
                        var tgl1 = new Date();
                        tgl1.setHours(0, 0, 0, 0);
                        var tgl2 = new Date(data);
                        tgl2.setHours(0, 0, 0, 0);

                        var jarak = tgl2 - tgl1;

                        var perbedaan = jarak / 60 / 60 / 24 / 1000;


                        if (row['status_so'] == 2) {
                            if (perbedaan > 0) {
                                return '<small class="label label-success label-inline font-weight-lighter" style="width: 150px;"> ' + perbedaan + ' Days Again To Check</small> ';
                            } else if (perbedaan == 0) {
                                return '<small class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Last Day To Check</small>';
                            } else {
                                return '<small>You Late Check</small>';
                            }
                        } else if (row['status_so'] == 3) {
                            return '<small class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approved by Manager CS</small>';
                        } else if (row['status_so'] == 4) {
                            return '<small class="label label-success label-inline font-weight-lighter" style="width: 150px;">Jobsheet Created</small>';
                        } else if (row['status_so'] == 0) {
                            return '<small class="label label-danger label-inline font-weight-lighter" style="width: 150px;">So Created By Sales</small>';
                        }
                    }
                },
                {
                    "data": "nama_user"
                },
                {
                    "data": "id",
                    "render": function(data, type, row, meta) {

                    var id_atasan = <?= $this->session->userdata('id_atasan') ? $this->session->userdata('id_atasan') : 'null'; ?>;
                        var type_aktivasi = row['type'];
                        if (type_aktivasi === 'manager') {
                            var aktivasi = row['id_aktivasi'];
                        } else {
                            var aktivasi = null;
                        }
                        var tgl1 = new Date();
                        tgl1.setHours(0, 0, 0, 0);
                        var tgl2 = new Date(row['deadline_manager_cs']);
                        tgl2.setHours(0, 0, 0, 0);
                        var jarak = tgl2 - tgl1;
                        var perbedaan = jarak / 1000 / 60 / 60 / 24;
                        if (row['status_so'] == 2) {
                            if (perbedaan < 0) {
                                if (aktivasi === null) {
                                    if (id_atasan === null) {
                                        return '<button class="btn btn-danger btn-sm btnAktivasiJs" data-shipment_id="' + row['shipment_id'] + '" data-toggle="modal" data-target="#modalAktivasiJs"> Request Aktivasi</button>';
                                    } else {
                                        return '-';
                                    }
                                  
                                } else {
                                    return '<small class="label label-info label-inline font-weight-lighter" style="width: 200px;">Request Aktivation On Process</small>';
                                }
                            } else {
                                return '<a href="<?= base_url('cs/jobsheet/detail/') ?>' + data + '" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>';
                            }
                        } else {
                            return '-';
                        }
                    }
                }
            ]
        });
    });
</script>