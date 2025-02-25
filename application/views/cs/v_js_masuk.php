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
                                        <table id="table" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Pickup Date</th>
                                                    <th>Shipment ID</th>
                                                    <th>No. Do</th>
                                                    <th>No. SO</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <th>Deadline</th>
                                                    <th>Sales</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                    $tgl1 = strtotime(date('Y-m-d'));
                                                    $tgl2 = strtotime($j['deadline_pic_js']);

                                                    $jarak = $tgl2 - $tgl1;

                                                    $perbedaan = $jarak / 60 / 60 / 24;
                                                    $no_do = $this->db->get_where('tbl_no_do', array('shipment_id' => $j['shipment_id']))->result_array();
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <td><?php foreach ($no_do as $do) {
                                                                echo $do['no_do'] . ',';
                                                            } ?></td>
                                                        <td>SO-<?= $j['shipment_id'] ?></td>
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?= $j['tree_consignee'] ?></td>
                                                        <td><?php

                                                            if ($perbedaan > 0) {
                                                                echo '<small class="label label-success label-inline font-weight-lighter" style="width: 150px;"> ' . $perbedaan . ' Days Again To Check</small> ';
                                                            } elseif ($perbedaan == 0) {
                                                                echo  '<small class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Last Day To Check</small>';
                                                            } else {
                                                                echo '<small>You Late Check</small>';
                                                            } ?></td>
                                                        <td><?= $j['nama_user'] ?></td>
                                                        <!-- <td><?= $j['id_user'] ?></td> -->
                                                        <td>

                                                            <?php if ($perbedaan < 0) {
                                                                $cek_request_aktivasi = $this->db->get_where('tbl_aktivasi_cs', ['shipment_id' => $j['shipment_id']])->num_rows();
                                                                if ($cek_request_aktivasi <= 0) {
                                                            ?>
                                                                    <a href="#" class='btn btn-sm mb-1 btn-secondary text-dark mt-1' data-toggle='modal' data-target='#modal-request<?= $j['id'] ?>'>Request Aktivasi</a>
                                                                <?php } else {
                                                                    echo '<br>Wait Approve SM';
                                                                }
                                                            } else {
                                                                ?>
                                                                <a href="<?= base_url('cs/salesOrder/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Create Jobsheet</a>
                                                            <?php  } ?>
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

<?php foreach ($js as $j) {
?>
    <div class="modal fade" id="modal-request<?= $j['id'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Request Aktivation <?= $j['shipment_id'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('cs/salesOrder/addRequestAktivasi') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label text-lg-right font-weight-bold">Reason <span class="text-danger">*</span> </label>
                            <textarea type="text" name="reason" class="form-control" required></textarea>
                            <input type="text" name="shipment_id" hidden value="<?= $j['shipment_id'] ?>">
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

<?php } ?>