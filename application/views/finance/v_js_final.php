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
                                    <form action="<?= base_url('finance/jobsheet/createInvoice') ?>" method="POST">
                                        <div class="table-responsive">
                                            <button type="submit" class="btn btn-success mb-2"> <i class="fa fa-plus"></i> Create Invoice</button>
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
                                                        <th>PIC Invoice</th>
                                                        <!-- <th>Colly</th> -->
                                                        <th>Sales</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($js as $j) {
                                                        $get_revisi_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $j['id']])->row_array();
                                                        $get_invoice = $this->db->get_where('tbl_invoice', ['shipment_id' => $j['id']])->row_array();
                                                        $no_do = $this->db->get_where('tbl_no_do', array('shipment_id' => $j['shipment_id']))->result_array();
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php if ($get_invoice) {
                                                                ?>
                                                                <?php } else {
                                                                ?>
                                                                    <input type="checkbox" class="form-control" name="shipment_id[]" value="<?= $j['id'] ?>">
                                                                <?php    } ?>
                                                            </td>
                                                            <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <!-- No shipment -->
                                                            <td><?= $j['shipment_id'] ?></td>
                                                            <!-- No DO -->
                                                            <td style="max-width:100px;"><?php foreach ($no_do as $do) {
                                                                                                echo $do['no_do'] . ',';
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
                                                            <td><?= $j['pic_invoice'] ?></td>
                                                            <td><?= $j['nama_user'] ?></td>
                                                            <td><?php if ($j['status_so'] == 2) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Approve PIC JS</span>';
                                                                } elseif ($j['status_so'] == 3) {
                                                                    echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Manager CS</span>';
                                                                } elseif ($j['status_so'] == 4) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                                    if ($get_invoice) {
                                                                        echo '<span class="label label-primary label-inline font-weight-lighter mt-1" style="width: 150px;">Invoice Created</span>';
                                                                    }
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
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Approve By Pic Js</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 2) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Approve By Manager CS</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 3) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Approve By GM</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 4) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Decline By Pic Js</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 5) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Decline By Manager CS</small><br>
                                                                    <?php } elseif ($get_revisi_so['status_revisi'] == 6) {
                                                                    ?>
                                                                        <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">View Approved</a> <br>
                                                                        <small>Jobsheet Decline By GM</small> <br>
                                                                    <?php }
                                                                    ?>
                                                                <?php }
                                                                $id_atasan = $this->session->userdata('id_atasan');
                                                                // kalo dia atasan sales
                                                                if ($id_atasan == 0 || $id_atasan == NULL) {
                                                                ?>
                                                                    <a href="<?= base_url('finance/jobsheet/detail/' . $j['id'] . '/' . $j['id_so']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                            </td>
                                                        <?php   } else {
                                                        ?>
                                                            <a href="<?= base_url('finance/jobsheet/detail/' . $j['id'] . '/' . $j['id_so']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                            <a href="<?= base_url('finance/jobsheet/Exportexcel/' . $j['id']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;"><span class="fa fa-download"></span></a>
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