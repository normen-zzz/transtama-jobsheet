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
                        <h3><?= $title; ?></h3>
                    </center>

                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/report/ap2') ?>" method="POST">
                        <h6 class="page-title">Filter Report</h6>
                        <br>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Start</label><br>
                                <input type="date" class="form-control" name="awal">
                            </div>
                            <div class="form-group mr-2">
                                <label>End</label><br>
                                <input type="date" class="form-control" name="akhir">
                            </div>
                            <div class="form-group"> <br>
                                <button type="submit" class="btn btn-success ml-3 mt-2">Show</button>
                                <a href="<?= base_url('finance/report/exportApExcell') ?>" class="btn btn-danger ml-2 mt-2">Export Excell</a>
                                <!-- <a href="<?= base_url('finance/report/exportApPdf') ?>" class="btn btn-danger ml-2 mt-2">Export PDF</a> -->
                                <a href="<?= base_url('finance/report/ap2') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="card-body" style="overflow: auto;">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="myTable">
                            <thead>
                                <tr>
                                    <th>No AP</th>
                                    <th>Created By</th>
                                    <!-- <th>Purpose</th> -->
                                    <th>Date</th>
                                    <!-- <th>Address</th> -->
                                    <th>Amount Proposed</th>
                                    <th>Amount Approved</th>
                                    <th>Status</th>
                                    <!-- <th>Join At</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ap as $c) {
                                ?>
                                    <tr>
                                        <td> <a target="blank" href="<?= base_url('finance/ap/print/' . $c['no_pengeluaran']) ?>"> <?= $c['no_pengeluaran'] ?></a> </td>
                                        <td><?= $c['nama_user'] ?></td>
                                        <!-- <td><?= $c['purpose'] ?></td> -->
                                        <td><?= bulan_indo($c['date']) ?></td>
                                        <td><?= rupiah($c['total']) ?></td>
                                        <td><?= ($c['status'] == 2 ? 'Wait Received' : rupiah($c['total_approved'])) ?></td>
                                        <td><?= statusAp($c['status'], $c['is_approve_sm']) ?>

                                        </td>
                                        <td>
                                            <a href="<?= base_url('finance/ap/detail/' . $c['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Detail</a>


                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>