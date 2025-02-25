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
                <div class="content-header">
                    <form action="<?= base_url('cs/jobsheet/final') ?>" method="POST">
                        <h6 class="page-title">Check DO Number</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="DO Number" name="shipment_id">

                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success">Submit</button>
                                <a href="<?= base_url('cs/jobsheet/final') ?>" class="btn btn-primary"> Reset Filter</a>

                            </div>
                            <?php if (isset($invoice)) {
                            ?>
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td style="font-weight: bold;">Shipment ID</td>
                                            <td>: <?= $invoice['shipment_id'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">DO Number</td>
                                            <td>: <?= $invoice['note_cs'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Customer</td>
                                            <td>: <?= $invoice['shipper'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Destination</td>
                                            <td>: <?= $invoice['tree_consignee'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Pickup Date</td>
                                            <td>: <?= bulan_indo($invoice['tgl_pickup']) ?> </td>
                                        </tr>
                                    </table>

                                </div>

                            <?php  }  ?>
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
                                                    $get_revisi_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $j['id']])->row_array();
                                                    $no_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $j['id']])->result_array();
                                                ?>
                                                    <tr>
                                                        <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                        <!-- shipment -->
                                                        <td><?= $j['shipment_id'] ?></td>
                                                        <!-- Do -->
                                                        <td><?php foreach ($no_do as $do) {
                                                                $do['no_do'] + ' , ';
                                                            } ?></td>
                                                        <!-- SO -->
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>" class="text-danger"><?= 'SO-'. $j['shipment_id'] ?> </a>
                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id'] . '/' . $j['id_so']) ?>"><?= 'SO-'. $j['shipment_id'] ?> </a>
                                                            <?php   }  ?>
                                                        </td>

                                                        <!-- Jobsheet -->
                                                        <td><?php if ($get_revisi_so) {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakMsr/' . $j['id']) ?>" class="text-danger"><?= 'JS-'. $j['shipment_id'] ?> </a>

                                                            <?php  } else {
                                                            ?>
                                                                <a target="blank" href="<?= base_url('cs/jobsheet/cetakSo/' . $j['id']) ?>"><?= 'JS-'.$j['shipment_id'] ?> </a>
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
                                                            } ?></td>
                                                        <td>
                                                            <?php
                                                            $id_atasan = $this->session->userdata('id_atasan');
                                                            // kalo dia atasan sales
                                                            if ($id_atasan == 0 || $id_atasan == NULL) {
                                                            ?>
                                                                <a href="<?= base_url('cs/jobsheet/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <!-- <a href="<?= base_url('cs/jobsheet/edit/' . $j['id']) ?>" class=" btn btn-success text-light mt-1">Edit</a> -->
                                                        </td>
                                                    <?php   } else {
                                                    ?>
                                                        <a href="<?= base_url('cs/jobsheet/detail/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                    <?php  }

                                                    ?>

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