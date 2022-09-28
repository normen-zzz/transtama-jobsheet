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
                                                    <th>No. Do</th>
                                                    <th>No. SO</th>
                                                    <th>Js Id</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <th>Request Revisi</th>
                                                    <th>Sales</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                    $no_do = $this->db->get_where('tbl_no_do', array('shipment_id' => $j['shipment_id']))->result_array();
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <td><?php foreach ($no_do as $do) {
                                                                echo $do['no_do'];
                                                            } ?></td>
                                                        <td><?= $j['so_id'] ?></td>
                                                        <td><?= $j['jobsheet_id'] ?></td>
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?= $j['tree_consignee'] ?></td>
                                                        <td><?= $j['tgl_pengajuan'] ?></td>
                                                        <td><?= $j['nama_user'] ?></td>
                                                        <td><?php if ($j['status_pengajuan'] == 0) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Request Revisi</span>';
                                                            } elseif ($j['status_pengajuan'] == 1) {
                                                                echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Request</span>';
                                                            } elseif ($j['status_pengajuan'] == 2) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                            } elseif ($j['status_pengajuan'] == 4) {
                                                                echo '<span class="label label-secondary label-inline font-weight-lighter" style="width: 150px;">Decline</span>';
                                                            } ?></td>
                                                        <td>
                                                            <?php if ($j['status_pengajuan'] == 1 || $j['status_pengajuan'] == 4) {
                                                            ?>

                                                            <?php  } else {
                                                            ?>
                                                                <a href="<?= base_url('cs/salesOrder/approve/' . $j['id_request']) ?>" onclick="return confirm('Are you sure ?')" class="btn btn-sm text-light" style="background-color: #9c223b;">Approve</a>
                                                                <a href="<?= base_url('cs/salesOrder/decline/' . $j['id_request']) ?>" onclick="return confirm('Are you sure ?')" class="btn btn-sm mt-2 text-light" style="background-color: #9c223b;">Decline</a>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/edit/' . $j['id']) ?>" class=" btn btn-success text-light mt-1">Edit</a> -->

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