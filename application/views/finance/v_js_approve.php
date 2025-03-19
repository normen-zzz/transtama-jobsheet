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
                                            <table id="tableEnterJobsheett" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>

                                                        <th>Pickup Date</th>
                                                        <th>Shipment ID</th>

                                                        <th>No. SO</th>
                                                        <th>Js Id</th>
                                                        <th>Customer</th>
                                                        <th>Destination</th>
                                                        <!-- <th>Colly</th> -->
                                                        <th>Sales</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($jobsheet as $data) : ?>
                                                        <tr>
                                                            <td><?= $data['tgl_pickup'] ?></td>
                                                            <td><?= $data['shipment_id'] ?></td>
                                                            <td>SO - <?= $data['shipment_id'] ?></td>
                                                            <td>JS - <?= $data['shipment_id'] ?></td>
                                                            <td><?= $data['shipper'] ?></td>
                                                            <td><?= $data['tree_consignee'] ?></td>

                                                            <td><?= $data['nama_user'] ?></td>
                                                            <td>
                                                                <?php if ($data['status_so'] == 1) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">SO Create By Sales</span>';
                                                                } else if ($data['status_so']  == 2) {
                                                                    echo '<span class="label label-warning label-inline font-weight-lighter" style="width: 150px;">Approve PIC JS</span>';
                                                                } else if ($data['status_so']  == 3) {
                                                                    echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Manager CS</span>';
                                                                } else if ($data['status_so']  == 4) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($data['status_revisi'] == 0 && $data['status_revisi'] != NULL) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet New</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 1) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Approve By Pic Js</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 2) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Approve By Manager CS</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 3) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Approve By GM</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 4) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Decline By PIC JS</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2 " style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 5) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Decline By Manager CS</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } elseif ($data['status_revisi'] == 6) {
                                                                    echo '<a href="' . base_url('finance/jobsheet/detailRevisi/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Revision</a> <br><small>Jobsheet Decline By GM</small><br>' . ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mt-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . ' ' . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                } else {
                                                                    echo ' <a href="' . base_url('finance/jobsheet/detail/') . $data['id'] . '/' . $data['id_so'] . ' " class=" btn btn-sm text-light mr-2" style="background-color: #9c223b;">Detail</a><a href="' . base_url('finance/jobsheet/Exportexcel/') . $data['id'] . '" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>';
                                                                }
                                                                ?>


                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
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

<script>
    // tableEnterJobsheett
    $(document).ready(function() {
        $('#tableEnterJobsheett').DataTable({
            "scrollX": true
        });
    });
</script>