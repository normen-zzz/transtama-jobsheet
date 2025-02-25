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
                                <?php $jabatan = $this->session->userdata('id_jabatan'); ?>
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
                                                    <th>No. Do</th>
                                                    <th>No. SO</th>
                                                    <th>Js Id</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <th>Request Revisi</th>
                                                    <th>Sales</th>
                                                    <th>Last Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                    $no_do = $this->db->get_where('tbl_no_do', array('shipment_id' => $j['shipment_id']))->result_array();
                                                ?>
                                                    <tr>
                                                       
                                                            <!-- kalau jabatan dia Director -->
                                                        <?php  if ($jabatan == 11 && $j['status_revisi'] == 3) { ?>
                                                            <td class="text-danger"><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td class="text-danger"><?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?php foreach ($no_do as $do) {
                                                                                        echo $do['no_do'] . ',';
                                                                                    } ?></td>
                                                            <td class="text-danger"><?= $j['so_id'] ?></td>
                                                            <td class="text-danger"><?= $j['jobsheet_id'] ?></td>
                                                            <td class="text-danger"><?= $j['shipper'] ?></td>
                                                            <td class="text-danger"><?= $j['tree_consignee'] ?></td>
                                                            <td class="text-danger"><?= $j['tgl_so_new'] ?></td>
                                                            <td class="text-danger"><?= $j['nama_user'] ?></td>
                                                        <?php } elseif ($jabatan == 2 && $j['status_revisi'] == 1) {  ?>
                                                            <td class="text-danger"><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td class="text-danger"><?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?php foreach ($no_do as $do) {
                                                                                        echo $do['no_do'] . ',';
                                                                                    } ?></td>
                                                            <td class="text-danger"><?= $j['so_id'] ?></td>
                                                            <td class="text-danger"><?= $j['jobsheet_id'] ?></td>
                                                            <td class="text-danger"><?= $j['shipper'] ?></td>
                                                            <td class="text-danger"><?= $j['tree_consignee'] ?></td>
                                                            <td class="text-danger"><?= $j['tgl_so_new'] ?></td>
                                                            <td class="text-danger"><?= $j['nama_user'] ?></td>
                                                        <?php } else { ?>
                                                            <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td><?= $j['shipment_id'] ?></td>
                                                            <td><?php foreach ($no_do as $do) {
                                                                    echo $do['no_do'] . ',';
                                                                } ?></td>
                                                            <td><?= $j['so_id'] ?></td>
                                                            <td><?= $j['jobsheet_id'] ?></td>
                                                            <td><?= $j['shipper'] ?></td>
                                                            <td><?= $j['tree_consignee'] ?></td>
                                                            <td><?= $j['tgl_so_new'] ?></td>
                                                            <td><?= $j['nama_user'] ?></td>
                                                        <?php } ?>
                                                        <td>
                                                            <?php
                                                            if ($j['status_revisi'] == 0) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>New Price Revision</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 1) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Approved By Pic Js</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 2) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Approved By Manager CS</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 3) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Approved By SM</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 4) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Declined By Pic Js</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 5) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Declined By Manager CS</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 6) {
                                                            ?>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br> -->
                                                                <small>Jobsheet Decline By Director</small> <br>
                                                            <?php } elseif ($j['status_revisi'] == 7) { ?>
                                                                <small>Jobsheet Approved By Director</small> <br>
                                                            <?php }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>

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