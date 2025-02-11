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
                                                    <th>Pickup Date</th>
                                                    <th>Shipment ID</th>
                                                    <th>No. DO</th>
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
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                    $tgl1 = strtotime(date('Y-m-d'));
                                                    $tgl2 = strtotime($j['deadline_manager_cs']);

                                                    $jarak = $tgl2 - $tgl1;

                                                    $perbedaan = $jarak / 60 / 60 / 24;
                                                    $get_revisi_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $j['id']])->row_array();
                                                    $no_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $j['shipment_id']])->result_array();
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <!-- shipment -->
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <!-- Do -->
                                                        <td><?php foreach ($no_do as $do) {
                                                                echo $do['no_do'] . ' , ';
                                                            } ?></td>
                                                        <!-- SO -->
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>" class="text-danger">SO-<?= $j['shipment_id'] ?> </a>
                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>">SO-<?= $j['shipment_id'] ?> </a>
                                                            <?php   }  ?>
                                                        </td>

                                                        <!-- Jobsheet -->
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakMsr/' . $j['id']) ?>" class="text-danger">JS-<?= $j['shipment_id'] ?> </a>

                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id']) ?>">JS-<?= $j['shipment_id'] ?> </a>
                                                            <?php }  ?>
                                                        </td>
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?= $j['tree_consignee'] ?></td>
                                                        <td><?= $j['nama_user'] ?></td>
                                                        <td><?php if ($j['status_so'] == 2) {
                                                                echo '<span class="label label-purple label-inline font-weight-lighter" style="width: 150px;">Approve PIC JS</span> <br>';
                                                                if ($perbedaan > 0) {
                                                                    echo $perbedaan . ' <small>Days Again To Check</small>';
                                                                } elseif ($perbedaan == 0) {
                                                                    echo  '<small>Last Day To Check Untill 00:00 Pm</small>';
                                                                } else {
                                                                    echo '<small>You Late Check</small>';
                                                                }
                                                            } elseif ($j['status_so'] == 3) {
                                                                echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Manager CS</span>';
                                                            } elseif ($j['status_so'] == 4) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                            } elseif ($j['status_so'] == 0) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">SO Create By Sales</span>';
                                                            } ?></td>
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
                                                                <a href="<?= base_url('cs/jobsheet/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
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
                <form action="<?= base_url('cs/jobsheet/addRequestAktivasi') ?>" method="POST" enctype="multipart/form-data">
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