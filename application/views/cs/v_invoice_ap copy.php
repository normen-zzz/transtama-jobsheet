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

                                        <table id="tablePoCreatedCs" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Vendor/Agent</th>
                                                    <th>No PO</th>
                                                    <!-- <th>No Invoice</th> -->
                                                    <th>Date Created</th>
                                                    <!-- <th>Due Date</th> -->
                                                    <!-- <th>Time Line</th> -->
                                                    <th>Invoice</th>
                                                    <!-- <th>PPN</th>
                                                    <th>PPH</th> -->
                                                    <th>Total Invoice</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($proforma as $j) {
                                                   
                                                ?>
                                                    <tr>
                                                        <td><?= $j['vendor'] ?> <br>
                                                            <a href="<?= base_url('cs/apExternal/print/' . $j['no_po'] . '/' . $j['id_vendor'] . '/' . $j['unique_invoice']) ?>"><?= $j['no_invoice'] ?></a>
                                                        </td>
                                                        <td><?= $j['no_po'] ?></td>
                                                        <td><?= bulan_indo($j['date']) ?></td>

                                                        <td><?= rupiah($j['total_ap']) ?></td>
                                                        
                                                        <td><?= rupiah(($j['total_ap'])) ?></td>

                                                        <td>
                                                            <?= statusAp($j['status'], 1) ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            $jabatan = $this->session->userdata('id_jabatan');
                                                            $id_atasan = $this->session->userdata('id_atasan');

                                                            if ($jabatan == 10) {
                                                                if ($j['status'] == 1) {
                                                            ?>
                                                                    <a href="<?= base_url('cs/apExternal/approveSm/' . $j['unique_invoice']) ?>" class=" btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>
                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>
                                                                <?php   } else {
                                                                ?>
                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                <?php  }

                                                                ?>
                                                                <?php  } else {
                                                                if ($id_atasan == NULL || $id_atasan == 0) {
                                                                    if ($j['status'] == 0) {
                                                                ?>
                                                                        <a href="<?= base_url('cs/apExternal/approveAtasan/' . $j['unique_invoice']) ?>" class=" btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>

                                                                    <?php }
                                                                    ?>

                                                                    <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                    <?php  } else {
                                                                    if ($j['status'] == 0) {
                                                                    ?>
                                                                        <a href="<?= base_url('cs/apExternal/editInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit</a>

                                                                    <?php  } else {
                                                                    ?>
                                                                        <a href="<?= base_url('cs/apExternal/detailInvoice/' . $j['unique_invoice'] . '/' . encrypt_url($j['id_vendor'])) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a>

                                                                    <?php  }
                                                                    ?>

                                                                <?php }
                                                                ?>
                                                            <?php } ?>
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



