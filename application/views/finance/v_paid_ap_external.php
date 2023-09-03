<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="content-header">
                    <center>
                        <h3 class="title text-center"><i class="fa fa-dollar-sign"></i>PAID INVOICE</h3>
                    </center>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="overflow: auto;">
                        <form action="<?= base_url('finance/Invoice/bulkPaid') ?>" method="POST">
                            <div class="col-12">
                                <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Vendor/Agent</th>
                                                        <th>No PO</th>
                                                        <th>Date Created</th>
                                                        <th>Due Date</th>
                                                        <th>Invoice</th>
                                                        <th>PPN</th>
                                                        <th>PPH</th>
                                                        <th>Total Invoice</th>
                                                        <th>PO Status</th>
                                                        <th>Payment Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php $total = 0;
                                                    foreach ($noPo as $j) {

                                                    ?>
                                                        <?php if ($j['status'] >= 2) { ?>
                                                            <tr>
                                                                <td><?= $j['vendor'] ?> <br>
                                                                    <a href="<?= base_url('finance/apExternal/print/' . $j['no_po'] . '/' . $j['id_vendor'] . '/' . $j['unique_invoice']) ?>"><?= $j['no_invoice'] ?></a>
                                                                </td>
                                                                <td><?= $j['no_po'] ?></td>
                                                                <td><?= bulan_indo($j['date']) ?></td>
                                                                <td><?php if ($j['status'] == 4) {
                                                                        echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                                    } else {
                                                                        if ($j['due_date'] == NULL) {
                                                                            echo "Due Date Not Setting";
                                                                        } else {
                                                                            echo  bulan_indo($j['due_date']);
                                                                        }
                                                                    }
                                                                    ?>

                                                                </td>

                                                                <td><?= rupiah($j['total_ap']) ?></td>
                                                                <td><?= rupiah($j['ppn'] + $j['special_ppn']) ?></td>
                                                                <td><?= rupiah($j['pph'] + $j['special_pph']) ?></td>
                                                                <td><?= rupiah(($j['total_ap']) - $j['pph'] + $j['ppn'] + $j['special_ppn'] - $j['special_pph']) ?></td>

                                                                <td><?= statusAp($j['status'], 1) ?></td>
                                                                <td>
                                                                    <?php if ($j['status'] == 4) {
                                                                        echo "<span class='label label-success label-inline font-weight-lighter'>Paid</span> <br>";
                                                                        echo bulan_indo($j['payment_date']);
                                                                    } else {
                                                                        echo "<span class='label label-secondary label-inline font-weight-lighter'>Pending</span>";
                                                                    }
                                                                    ?>

                                                                </td>
                                                                

                                                            </tr>
                                                        <?php } ?>

                                                        <?php $total += ($j['total_ap']) - $j['pph'] + $j['ppn'] + $j['special_ppn'] - $j['special_pph'];  } ?>
                                                        <tr>
                                                            <td colspan="7"><p style="text-align: right;"><b>Total </b></p></td>
                                                            <td style="text-align: center;"><b><?= rupiah($total) ?></b></td>
                                                        </tr>
                                                </tbody>
                                                
                                            </table>
                                            <br>
                                            <h3 class="title text-center"><i class="fa fa-building"></i>INFORMATION</h3>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <label for="due_date" class="font-weight-bold">Date Paid</label>
                                    <input type="date" class="form-control" name="datePaid" required>

                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">PAID AP External</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>