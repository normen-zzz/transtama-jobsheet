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
                            <h3 class="page-title"><?= $title . ' ' . bulan($month) . ' ' . $year; ?></h3>

                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/report/soaFilter') ?>" method="POST">
                        <h6 class="page-title">Filter By Month</h6>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Month</label><br>
                                <select name="month" class="form-control" style="width: 200px; height:100px" required>
                                    <option value="">Pilih</option>
                                    <option <?php if ($month == "01") {
                                                echo "selected";
                                            } ?> value="01">Januari</option>
                                    <option <?php if ($month == "02") {
                                                echo "selected";
                                            } ?> value="02">Februari</option>
                                    <option <?php if ($month == "03") {
                                                echo "selected";
                                            } ?> value="03">Maret</option>
                                    <option <?php if ($month == "04") {
                                                echo "selected";
                                            } ?> value="04">April</option>
                                    <option <?php if ($month == "05") {
                                                echo "selected";
                                            } ?> value="05">Mei</option>
                                    <option <?php if ($month == "06") {
                                                echo "selected";
                                            } ?> value="06">Juni</option>
                                    <option <?php if ($month == "07") {
                                                echo "selected";
                                            } ?> value="07">Juli</option>
                                    <option <?php if ($month == "08") {
                                                echo "selected";
                                            } ?> value="08">Agustus</option>
                                    <option <?php if ($month == "09") {
                                                echo "selected";
                                            } ?> value="09">September</option>
                                    <option <?php if ($month == "10") {
                                                echo "selected";
                                            } ?> value="10">Oktober</option>
                                    <option <?php if ($month == "11") {
                                                echo "selected";
                                            } ?> value="11">November</option>
                                    <option <?php if ($month == "12") {
                                                echo "selected";
                                            } ?> value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Year</label> <br>
                                <select name="year" class="form-control" style="width: 200px; height:100px" required>
                                    <option selected="selected">Pilih</option>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                        if ($i == $year) {
                                            echo "<option value='$i' selected> $i </option>";
                                        } else {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group"> <br>
                                <button type="submit" class="btn btn-success ml-3 mt-2">Show</button>
                                <a href="<?= base_url('finance/report/soa') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
                                <a target="blank" href="<?= base_url('finance/report/exportSoaFilter/' . $month . '/' . $year) ?>" class="btn ml-3 mt-2 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>

                            </div>
                        </div>
                    </form>
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
                                                    <th>Customers</th>
                                                    <th>No Invoice</th>
                                                    <th>Shipment</th>
                                                    <!-- <th>Date Created</th> -->
                                                    <th>Due Date</th>
                                                    <th>Tagihan(Rp)</th>
                                                    <th>Invoice</th>
                                                    <th>PPN</th>
                                                    <th>PPH 23</th>
                                                    <th>Total After PPH</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($proforma as $j) {

                                                ?>
                                                    <tr>

                                                        <td><?= $j['customer'] ?></td>
                                                        <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td>
                                                        <td><?= bulan($j['shipment']) ?></td>
                                                        <td><?php
                                                            echo  bulan_indo($j['due_date']);
                                                            ?>
                                                        </td>
                                                        <td><?= rupiah($j['total_invoice']) ?></td>
                                                        <td><?= rupiah($j['invoice']) ?></td>
                                                        <td><?= rupiah($j['ppn']) ?></td>
                                                        <td><?= rupiah($j['pph']) ?></td>
                                                        <td><?php $total = $j['total_invoice'] - $j['pph'];
                                                            echo rupiah($total) ?></td>
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



