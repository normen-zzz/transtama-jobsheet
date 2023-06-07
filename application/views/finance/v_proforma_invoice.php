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
                                                    <th>No Invoice</th>
                                                    <th>Date Created</th>
                                                    <th>Due Date</th>
                                                    <!-- <th>Time Line</th> -->
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($proforma as $j) {
                                                    // $due_date = new DateTime($j['due_date']);
                                                    // $date = date('Y-m-d');
                                                    // $date = new DateTime($date);
                                                    // $perbedaan = $due_date->diff($date)->format("%a");
                                                ?>
                                                    <tr>

                                                        <!-- <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td> -->
                                                        <td><a target="blank" href="<?=  'https://tesla-smartwork.transtama.com/Invoice/printProforma/'. $j['no_invoice'] ?>"><?= $j['no_invoice'] ?></a> </td>
                                                        <td><?= bulan_indo($j['date']) ?></td>
                                                        <td><?= bulan_indo($j['due_date']) ?></td>
                                                        <!-- <td> <span class="text-danger"><?= $perbedaan ?> Days Again</span></td> -->
                                                        <td><?= $j['shipper'] ?></td>
                                                        <td><?php if ($j['status'] == 0) {
                                                                echo '<span class="label label-danger label-inline font-weight-lighter" style="width: 150px;">Proforma Invoice</span>';
                                                            } elseif ($j['status'] == 1) {
                                                                echo '<span class="label label-primary label-inline font-weight-lighter" style="width: 150px;">Approve Finance</span>';
                                                            }  ?></td>

                                                        <td>
                                                                                               <!-- <a target="blank" href="<?= base_url('finance/invoice/printProformaExcell/' . $j['no_invoice']) ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a> -->
                                                            <a target="blank" href="<?= 'https://tesla-smartwork.transtama.com/Invoice/printProformaExcell/'.$j['no_invoice'] ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
                                                            <a href="<?= base_url('finance/invoice/edit/' . $j['id_invoice'] . '/' . $j['no_invoice']) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
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