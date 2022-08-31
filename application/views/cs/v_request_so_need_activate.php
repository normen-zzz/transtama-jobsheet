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
                                                    <th>Customer</th>
                                                    <th>Sales</th>
                                                    <th>Reason</th>
                                                    <th>Request Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                ?>
                                                    <?php if ($j['status'] == 0) {
                                                    ?>
                                                        <tr>
                                                            <td <?php if ($j['status'] == 0) { ?> class="text-danger" <?php } ?>><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td <?php if ($j['status'] == 0) { ?> class="text-danger" <?php } ?>><?= $j['shipper'] ?></td>
                                                            <td <?php if ($j['status'] == 0) { ?> class="text-danger" <?php } ?>><?= $j['request_by'] ?></td>
                                                            <td <?php if ($j['status'] == 0) { ?> class="text-danger" <?php } ?>><?= $j['reason'] ?></td>
                                                            <td <?php if ($j['status'] == 0) { ?> class="text-danger" <?php } ?>><?= $j['created'] ?></td>
                                                            <td>
                                                                <?php
                                                                if ($j['status'] == 0) {
                                                                ?>
                                                                    <span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Request</span>
                                                                <?php } elseif ($j['status'] == 1) {
                                                                ?>
                                                                    <span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Request Approved</span>
                                                                <?php } elseif ($j['status'] == 2) {
                                                                ?>
                                                                    <span class="label label-decline label-inline font-weight-lighter" style="width: 150px;">Request Rejected</span>

                                                                <?php }   ?>
                                                            </td>
                                                            <td>
                                                                <!-- <?php if ($j['status'] == 0) {
                                                                        ?>
                                                                <a href="<?= base_url('cs/salesOrder/approveAktivasi/' . $j['id_aktivasi'] . '/' . $j['id_so']) ?>" class="btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Aktivate</a> <br>
                                                            <?php } ?> -->

                                                                <a href="<?= base_url('cs/salesOrder/approveAktivasi/' . $j['id_aktivasi'] . '/' . $j['id_so']) ?>" class="btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Aktivate</a> <br>


                                                            </td>


                                                        </tr>

                                                <?php }
                                                } ?>

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