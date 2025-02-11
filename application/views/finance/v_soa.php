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
                            <!-- <div class="d-inline-block align-items-center">
                                <a target="blank" href="<?= base_url('finance/invoice/exportSoa/') ?>" class="btn btn-sm mt-1 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
                            </div> -->
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
                                <select name="year" class="form-control" style="width: 200px; height:100px" required>
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
                                <!-- <a href="<?= base_url('finance/report/ap') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a> -->
                                <a target="blank" href="<?= base_url('finance/invoice/exportSoa/') ?>" class="btn ml-2 mt-2 text-light" style="background-color: #9c223b;"><i class="fa fa-print text-light"></i> Excell </a>
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



