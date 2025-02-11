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
                                                    <?php foreach ($js as $j) : ?>
                                                        <tr>
                                                            <td>
                                                                <?php if (!$j['invoice_id']) : // Cek apakah invoice sudah dibuat 
                                                                ?>
                                                                    <input type="checkbox" class="form-control" name="shipment_id[]" value="<?= $j['id'] ?>" <?= (isset($j['status_revisi']) && $j['status_revisi'] != 7 && !in_array($j['status_revisi'], [4, 5, 6, 8])) ? 'disabled' : '' ?>>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= bulan_indo($j['tgl_pickup']) ?></td>
                                                            <td><?= $j['shipment_id'] ?></td>
                                                            <td><?= $j['no_do_list'] ?? '-' ?></td> <!-- Pastikan no_do_list tidak undefined -->
                                                            <td><?= isset($j['shipment_id']) ? "SO - $j[shipment_id]" : '-' ?></td>
                                                            <td><?= isset($j['shipment_id']) ? "JS - $j[shipment_id]" : '-' ?></td>
                                                            <td><?= $j['shipper'] ?? '-' ?></td>
                                                            <td><?= $j['tree_consignee'] ?? '-' ?></td>
                                                            <td><?= $j['pic_invoice'] ?? '-' ?></td>
                                                            <td><?= $j['nama_user'] ?? '-' ?></td>
                                                            <td>
                                                                <?php
                                                                $status_labels = [
                                                                    2 => "Approve PIC JS",
                                                                    3 => "Approve Manager CS",
                                                                    4 => "Approve Finance"
                                                                ];
                                                                echo '<span class="label label-inline font-weight-lighter" style="width: 150px;">' . ($status_labels[$j['status_so']] ?? '-') . '</span>';

                                                                if (isset($j['invoice_id'])) {
                                                                    echo '<span class="label label-primary label-inline font-weight-lighter mt-1" style="width: 150px;">Invoice Created</span>';
                                                                }
                                                                if (isset($j['status_revisi'])) {
                                                                    echo ($j['status_revisi'] == 7) ?
                                                                        '<span class="label label-success label-inline font-weight-lighter mt-1" style="width: 150px;">Revisi So (DONE)</span>' :
                                                                        '<span class="label label-primary label-inline font-weight-lighter mt-1" style="width: 150px;">On Progress Revisi So</span>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if (isset($j['status_revisi'])) : ?>
                                                                    <a href="<?= base_url('finance/jobsheet/detailRevisi/' . $j['id']) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">
                                                                        View <?= $j['status_revisi'] < 4 ? 'Approved' : 'Declined' ?>
                                                                    </a>
                                                                    <br><small>Jobsheet <?= $j['status_revisi'] < 4 ? 'Approved' : 'Declined' ?> By <?= ['PIC JS', 'Manager CS', 'GM', 'SM'][$j['status_revisi'] - 1] ?? '-' ?></small><br>
                                                                <?php endif; ?>

                                                                <a href="<?= base_url('finance/jobsheet/detail/' . $j['id'] . '/' . $j['id_so']) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <?php if ($this->session->userdata('id_atasan') !== null) : ?>
                                                                    <a href="<?= base_url('finance/jobsheet/Exportexcel/' . $j['id']) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;">
                                                                        <span class="fa fa-download"></span>
                                                                    </a>
                                                                <?php endif; ?>
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