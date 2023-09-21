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
                                <?php $jabatan = $this->session->userdata('id_jabatan'); ?>
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
                                                    <!-- Kalau jabatan dia sm -->
                                                    <?php if ($jabatan == 10 && $j['status_revisi'] == 3) { ?>
                                                        <tr>
                                                            <td class="text-danger"><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td class="text-danger"><?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?php foreach ($no_do as $do) {
                                                                                        echo $do['no_do'] . ',';
                                                                                    } ?></td>
                                                            <td class="text-danger">SO-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger">JS-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?= $j['shipper'] ?></td>
                                                            <td class="text-danger"><?= $j['tree_consignee'] ?></td>
                                                            <td class="text-danger"><?= $j['tgl_so_new'] ?></td>
                                                            <td class="text-danger"><?= $j['nama_user'] ?></td>
                                                            <td><small>Jobsheet Approve By GM</small> <br></td>
                                                            <td>
                                                                <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>

                                                            </td>
                                                        </tr>
                                                        <!-- kalau jabatan dia gm -->
                                                    <?php } elseif ($jabatan == 11 && $j['status_revisi'] == 2) { ?>
                                                        <tr>
                                                            <td class="text-danger"><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td class="text-danger"><?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?php foreach ($no_do as $do) {
                                                                                        echo $do['no_do'] . ',';
                                                                                    } ?></td>
                                                              <td class="text-danger">SO-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger">JS-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?= $j['shipper'] ?></td>
                                                            <td class="text-danger"><?= $j['tree_consignee'] ?></td>
                                                            <td class="text-danger"><?= $j['tgl_so_new'] ?></td>
                                                            <td class="text-danger"><?= $j['nama_user'] ?></td>
                                                            <td><small>Jobsheet Approve By Manager CS</small> <br></td>
                                                            <td>
                                                                <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>

                                                            </td>
                                                        </tr>
                                                    <?php } elseif ($jabatan == 2 && $j['status_revisi'] == 1) {  ?>
                                                        <tr>
                                                            <td class="text-danger"><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td class="text-danger"><?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?php foreach ($no_do as $do) {
                                                                                        echo $do['no_do'] . ',';
                                                                                    } ?></td>
                                                              <td class="text-danger">SO-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger">JS-<?= $j['shipment_id'] ?></td>
                                                            <td class="text-danger"><?= $j['shipper'] ?></td>
                                                            <td class="text-danger"><?= $j['tree_consignee'] ?></td>
                                                            <td class="text-danger"><?= $j['tgl_so_new'] ?></td>
                                                            <td class="text-danger"><?= $j['nama_user'] ?></td>
                                                            <td><small> <small>Jobsheet Approve By Pic Js</small> <br></small> <br></td>
                                                            <td>
                                                                <a href="<?= base_url('cs/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
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