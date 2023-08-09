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
                        <h3 class="title text-center"><i class="fa fa-dollar-sign"></i>PAID AP</h3>
                    </center>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="overflow: auto;">
                        <form action="<?= base_url('finance/apExternal/bulkPaid') ?>" method="POST">
                            <div class="col-12">
                                <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-separate table-head-custom table-checkable" id="myTable">
                                                <thead>
                                                    <tr>

                                                        <th>No AP</th>
                                                        <th>Created By</th>
                                                        <th>Purpose</th>
                                                        <th>Date</th>
                                                        <th>Amount Proposed</th>
                                                        <th>Amount Approved</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $total = 0;
                                                    foreach ($ap as $c) {
                                                    ?>
                                                        <tr>
                                                            <input type="text" name="no_pengeluaran[]" value="<?= $c['no_pengeluaran'] ?>" hidden>
                                                            <td><?= $c['no_pengeluaran'] . '<br>';
                                                                echo ($c['id_kat_ap'] == 3)  ? '<b>' . $c['no_ca'] . '</b>' : ''
                                                                ?> </td>
                                                            <td><?= $c['nama_user'] ?></td>
                                                            <td><?= $c['purpose'] ?></td>
                                                            <td><?= bulan_indo($c['date']) ?></td>
                                                            <td><?= rupiah($c['total']) ?></td>
                                                            <td><?= ($c['status'] == 2 ? 'Wait Received' : rupiah($c['total_approved'])) ?></td>
                                                            <td><?= statusAp($c['status'], $c['is_approve_sm']) ?>

                                                            </td>


                                                        </tr>
                                                    <?php $total += $c['total_approved'];
                                                    } ?>
                                                    <tr>
                                                        <td style="text-align: right;" colspan="4"><b>Total Approved :</b></td>
                                                        <td><b><?= rupiah($total) ?></b></td>
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
                                    <input type="date" class="form-control" name="paymentDate" required>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 text-center">
                                    <label for="due_date" class="font-weight-bold">Type Payment</label>
                                    <select required class="form-control" name="typePayment" id="typePayment">
                                        <option value="cash">Cash</option>
                                        <option value="klikbca">Klik Bca</option>
                                    </select>

                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">PAID AP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>