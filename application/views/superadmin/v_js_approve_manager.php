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
                                                    <th>No. SO</th>
                                                    <th>Shipment ID</th>
                                                    <th>Jobsheet ID</th>
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
                                                    $get_revisi_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $j['id']])->row_array();
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('superadmin/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>" class="text-danger"><?= $j['so_id'] ?> </a>
                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('superadmin/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>"><?= $j['so_id'] ?> </a>
                                                            <?php   }  ?>
                                                        </td>
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('superadmin/jobsheet/cetakMsr/' . $j['id']) ?>" class="text-danger"><?= $j['jobsheet_id'] ?> </a>

                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('superadmin/jobsheet/cetakSo/' . $j['id']) ?>"><?= $j['jobsheet_id'] ?> </a>
                                                            <?php }  ?>
                                                        </td>
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?= $j['tree_consignee'] ?></td>
                                                        <td><?= $j['nama_user'] ?></td>
                                                        <td><?php if ($j['status_so'] == 2) {
                                                                echo '<span class="label label-purple label-inline font-weight-lighter" style="width: 150px;">Approve PIC JS</span>';
                                                            } elseif ($j['status_so'] == 3) {
                                                                echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Manager CS</span>';
                                                            } elseif ($j['status_so'] == 4) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                            } elseif ($j['status_so'] == 0) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">SO Create By Sales</span>';
                                                            } elseif ($j['status_so'] == 5) {
                                                                echo '<span class="label label-warning label-inline font-weight-lighter" style="width: 150px;">Invoice Created</span>';
                                                            } ?></td>
                                                        <td>

                                                            <a href="<?= base_url('superadmin/jobsheet/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
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