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
                    <form action="<?= base_url('cs/report/msr') ?>" method="POST">
                        <h6 class="page-title">Filter By Month</h6>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Month</label><br>
                                <select name="bulan" class="form-control" style="width: 200px; height:100px">
                                    <option value="">Pilih</option>
                                    <option <?php echo $bulan == '01' ? 'selected' : ''; ?> value="01">Januari</option>
                                    <option <?php echo $bulan == '02' ? 'selected' : ''; ?> value="02">Februari</option>
                                    <option <?php echo $bulan == '03' ? 'selected' : ''; ?> value="03">Maret</option>
                                    <option <?php echo $bulan == '04' ? 'selected' : ''; ?> value="04">April</option>
                                    <option <?php echo $bulan == '05' ? 'selected' : ''; ?> value="05">Mei</option>
                                    <option <?php echo $bulan == '06' ? 'selected' : ''; ?> value="06">Juni</option>
                                    <option <?php echo $bulan == '07' ? 'selected' : ''; ?> value="07">Juli</option>
                                    <option <?php echo $bulan == '08' ? 'selected' : ''; ?> value="08">Agustus</option>
                                    <option <?php echo $bulan == '09' ? 'selected' : ''; ?> value="09">September</option>
                                    <option <?php echo $bulan == '10' ? 'selected' : ''; ?> value="10">Oktober</option>
                                    <option <?php echo $bulan == '11' ? 'selected' : ''; ?> value="11">November</option>
                                    <option <?php echo $bulan == '12' ? 'selected' : ''; ?> value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Year</label> <br>
                                <select name="tahun" class="form-control" style="width: 200px; height:100px">
                                    <option selected="selected">Pilih</option>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 5; $i -= 1) { ?>
                                        <option <?php echo $tahun == $i ? 'selected' : ''; ?> value='<?= $i ?>'> <?= $i ?> </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group"> <br>
                                <button type="submit" class="btn btn-success ml-3 mt-2">Show</button>
                                <a href="<?= base_url('cs/report/msr') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a>
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
                                    <center>
                                        <h3><?= $heading; ?></h3>
                                    </center>

                                    <div class="row">
                                        <a href="<?= base_url('cs/report/Exportexcel/' . $bulan . '/' . $tahun) ?>" target="blank" class="badge badge-primary ml-2">Excell</a>
                                        <!-- <a target="blank" href="<?= base_url('finance/report/exportPdf/') ?>" class="badge badge-sm btn-danger ml-1">PDF</a> -->

                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 16-->
                                            <a href="#" class="card card-custom card-stretch bg-secondary gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-book text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $total_shipments; ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Total Shipments</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 16-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 16-->
                                            <a href="#" class="card card-custom card-stretch bg-secondary gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-book text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $total_so; ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Total SO</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 16-->
                                        </div>

                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 17-->
                                            <a href="#" class="card card-custom bg-secondary card-stretch gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-clock text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $jobsheet_pending ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Jobhseets Pending</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 17-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 17-->
                                            <a href="#" class="card card-custom bg-secondary card-stretch gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-check text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $jobsheet_approve_pic ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Jobsheets Approve PIC JS</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 17-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 17-->
                                            <a href="#" class="card card-custom bg-secondary card-stretch gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-check text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $jobsheet_approve_mgr ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Jobsheets Approve Manager</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 17-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Stats Widget 17-->
                                            <a href="#" class="card card-custom bg-secondary card-stretch gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                                        <i class="fa fa-window-close text-secondary"></i>
                                                    </span>
                                                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $total_so - ($jobsheet_pending + $jobsheet_approve_pic + $jobsheet_approve_mgr); ?></div>
                                                    <div class="font-weight-bold text-inverse-white font-size-sm">Jobsheets Reminder</div>
                                                </div>
                                                <!--end::Body-->
                                            </a>
                                            <!--end::Stats Widget 17-->
                                        </div>

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