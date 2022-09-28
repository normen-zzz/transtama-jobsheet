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
                            <center>
                                <h2 class="page-title"><?= $title; ?></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/jobsheet') ?>" method="POST">
                        <h6 class="page-title">Filter Customer</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="customer" class="form-control" style="margin-top: 10px;">
                                    <option value="null">Choose Customer</option>
                                    <?php foreach ($customers as $cust) {
                                    ?>
                                        <option value="<?= $cust['nama_pt'] ?>"><?= $cust['nama_pt'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success">Submit</button>
                                <a href="<?= base_url('finance/jobsheet/downloadByCustomer/' . $customer) ?>" class="btn btn-danger"> <i class="fa fa-download"></i> Download</a>
                                <a href="<?= base_url('finance/jobsheet') ?>" class="btn btn-primary"> Reset Filter</a>

                            </div>
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
                                    <form action="<?= base_url('finance/jobsheet/download') ?>" method="POST">
                                        <div class="table-responsive">
                                            <!-- <button type="submit" class="btn btn-success mb-2"> <i class="fa fa-download"></i> Download</button> -->
                                            <table id="table" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Pickup Date</th>
                                                        <th>Shipment ID</th>
                                                        <th>No. Do</th>
                                                        <th>No. SO</th>
                                                        <th>Js Id</th>
                                                        <th>Customer</th>
                                                        <th>Destination</th>
                                                        <th>Deadline</th>
                                                        <!-- <th>Colly</th> -->
                                                        <th>Sales</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($js as $j) {
                                                        $tgl1 = strtotime(date('Y-m-d'));
                                                        $tgl2 = strtotime($j['deadline_finance']);

                                                        $jarak = $tgl2 - $tgl1;

                                                        $perbedaan = $jarak / 60 / 60 / 24;
                                                        $get_revisi_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $j['id']])->row_array();
                                                        $no_do = $this->db->get_where('tbl_no_do', array('shipment_id' => $j['shipment_id']))->result_array();
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" class="form-control" name="shipment_id[]" value="<?= $j['id'] ?>">
                                                            </td>

                                                            <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <!-- No shipment -->
                                                            <td><?= $j['shipment_id'] ?></td>
                                                            <!-- No DO -->
                                                            <td><?php foreach ($no_do as $do) {
                                                                    echo $do['no_do'] + ',';
                                                                } ?></td>
                                                            <!-- Nomor SO -->
                                                            <td><?php if ($get_revisi_so) {
                                                                    echo "<span class='text-danger'>$j[so_id]</span>";
                                                                } else {
                                                                    echo $j['so_id'];
                                                                }  ?></td>

                                                            <!-- //No Js -->
                                                            <td><?php if ($get_revisi_so) {
                                                                    echo "<span class='text-danger'>$j[jobsheet_id]</span>";
                                                                } else {
                                                                    echo $j['jobsheet_id'];
                                                                }  ?></td>

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
                                                            <td><?php if ($j['status_so'] == 2) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Approve PIC JS</span>';
                                                                } elseif ($j['status_so'] == 3) {
                                                                    echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Manager CS</span>';
                                                                } elseif ($j['status_so'] == 4) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                                } elseif ($j['status_so'] == 1) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">SO Create By Sales</span>';
                                                                } ?></td>
                                                            <td>
                                                                <?php
                                                                if ($get_revisi_so) {
                                                                    if ($get_revisi_so['status_revisi'] == 0) {
                                                                ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet New</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 1) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Approve By Pic Js</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 2) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Approve By Manager CS</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 3) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Approve By GM</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 4) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Decline By Pic Js</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 5) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Decline By Manager CS</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 6) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>
                                                                        <small>Jobsheet Decline By GM</small> <br>
                                                                    <?php }
                                                                    ?>
                                                                <?php }
                                                                $id_atasan = $this->session->userdata('id_atasan');
                                                                // kalo dia atasan sales
                                                                if ($id_atasan == 0 || $id_atasan == NULL) {
                                                                ?>
                                                                    <a href="<?= base_url('finance/jobsheet/detail/' . $j['id'] . '/' . $j['id_so']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                    <!-- <a href="<?= base_url('cs/jobsheet/edit/' . $j['id'] . '/' . $j['id_so']) ?>" class=" btn btn-success text-light mt-1">Edit</a> -->
                                                            </td>
                                                        <?php   } else {
                                                        ?>
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
                                                                <a href="<?= base_url('finance/jobsheet/detail/' . $j['id'] . '/' . $j['id_so']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <?php  } ?>

                                                        <?php  }

                                                        ?>

                                                        </tr>

                                                    <?php } ?>

                                                </tbody>

                                            </table>

                                        </div>
                                    </form>

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
                <form action="<?= base_url('finance/jobsheet/addRequestAktivasi') ?>" method="POST" enctype="multipart/form-data">
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