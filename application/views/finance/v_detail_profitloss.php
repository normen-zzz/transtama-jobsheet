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
                        <h3><?= $heading; ?></h3>
                    </center>

                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/report/' . $this->uri->segment(3)) ?>" method="POST">
                        <h6 class="page-title">Filter By Month</h6>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Month</label><br>
                                <select name="bulan" class="form-control" style="width: 200px; height:100px" required>
                                    <option value="">Pilih</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Year</label> <br>
                                <select name="tahun" class="form-control" style="width: 200px; height:100px" required>
                                    <option selected="selected">Pilih</option>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                        echo "<option value='$i'> $i </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group"> <br>
                                <button type="submit" class="btn btn-success ml-3 mt-2">Show</button>
                                <a href="<?= base_url('finance/report/ap') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
                            </div>
                            <!-- <div class="col">
                                <div class="text-right">
                                    <h2 style="color: #0FB800;">Total : Rp. 1.250.000</h2>
                                </div>

                            </div> -->
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


                                    <!-- <div class="row">
                                        <a href="<?= base_url('finance/report/Exportexcel') ?>" target="blank" class="badge badge-primary ml-2">Excell</a>
                                        <a target="blank" href="<?= base_url('finance/report/exportPdf/') ?>" class="badge badge-sm btn-danger ml-1">PDF</a>

                                    </div> -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="box">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="table-responsive">

                                                        <table id="table" class="table table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Description</th>
                                                                    <th>Notes</th>
                                                                    <th>Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $total = 0;
                                                                foreach ($ap as $ap) { ?>
                                                                    <tr>
                                                                        <td><?= $ap['purpose'] ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                                echo $ap['vendor'];
                                                                            } else {
                                                                                echo   $ap['description'];
                                                                            }
                                                                            ?></td>
                                                                        <td><?= $ap['date'] ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                                echo rupiah($ap['total_ap'] + $ap['pph'] + $ap['ppn']);
                                                                            } else {
                                                                                echo rupiah($ap['total']);
                                                                            }
                                                                            ?></td>
                                                                        <td><a href="#" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>

                                                                    </tr>
                                                                <?php
                                                                    if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                        $total += ($ap['total_ap'] + $ap['pph'] + $ap['ppn']);
                                                                    } else {
                                                                        $total += $ap['total'];
                                                                    }
                                                                } ?>



                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><b>Total:</b></td>
                                                                    <td><b> <?= rupiah($total) ?></b></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>

                                                        </table>

                                                    </div>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    </div>
                                    <!-- <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="float-right">
                                                <h2 style="color: #0FB800;">Total: 200000</h2>
                                            </div>
                                            
                                        </div>
                                    </div> -->

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