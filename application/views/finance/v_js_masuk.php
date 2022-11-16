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
                                                    <th>No. SO</th>
                                                    <th>Shipment ID</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <!-- <th>Colly</th> -->
                                                    <th>Sales</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($js as $j) {
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <td><?= $j['so_id'] ?></td>
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?= $j['tree_consignee'] ?></td>
                                                        <!-- <td><?= $j['koli'] ?></td> -->
                                                        <td><?= $j['nama_user'] ?></td>
                                                        <!-- <td><?= $j['id_user'] ?></td> -->
                                                        <td>
                                                            <a href="<?= base_url('cs/salesOrder/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Create Jobsheet</a>
                                                            <!-- <a href="<?= base_url('cs/jobsheet/edit/' . $j['id']) ?>" class=" btn btn-success text-light mt-1">Edit</a> -->
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