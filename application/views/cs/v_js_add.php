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
                                    <form action="<?= base_url('cs/jobsheet/addMsrAction') ?>" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Pickup Date (<span class="text-danger">*</span>)</label>
                                                            <input type="date" class="form-control" required name="tgl_pickup">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">STP Number (<span class="text-danger">*</span>)</label>
                                                            <input type="text" class="form-control" required name="no_stp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Customer (<span class="text-danger">*</span>)</label>
                                                            <input type="text" class="form-control" required name="customer">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Address</label>
                                                            <textarea name="alamat_customer" class="form-control" rows="4"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Phone Number</label>
                                                            <input type="text" class="form-control" name="no_telp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Consignee (<span class="text-danger">*</span>)</label>
                                                            <input type="text" class="form-control" required name="consigne">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Destination (<span class="text-danger">*</span>)</label>
                                                            <textarea name="destination" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="font-weight-bold">Service (<span class="text-danger">*</span>)</label>
                                                            <select name="service" class="form-control" required>
                                                                <?php foreach ($service as $s) { ?>
                                                                    <option value="<?= $s['nama_service'] ?>"><?= $s['nama_service'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1" class="font-weight-bold">Comm (<span class="text-danger">*</span>)</label>
                                                            <input type="text" class="form-control" required name="comm">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="font-weight-bold">Shipper (<span class="text-danger">*</span>)</label>
                                                        <select name="petugas" class="form-control" required>
                                                            <?php foreach ($driver as $s) { ?>
                                                                <option value="<?= $s['nama_user'] ?>"><?= $s['nama_user'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">Flight Number (<span class="text-danger">*</span>)</label>
                                                        <input type="text" class="form-control" required name="no_flight">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">SMU Number (<span class="text-danger">*</span>)</label>
                                                        <input type="text" class="form-control" required name="no_smu">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">Colly (<span class="text-danger">*</span>)</label>
                                                        <input type="number" class="form-control" required name="colly">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">MSR Weight (<span class="text-danger">*</span>)</label>
                                                        <input type="number" class="form-control" required name="berat_msr">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">JS Weight (<span class="text-danger">*</span>)</label>
                                                        <input type="number" class="form-control" required name="berat_js">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">Freight/KG (<span class="text-danger">*</span>)</label>
                                                        <input type="text" class="form-control" required name="freight_kg">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="font-weight-bold">Marketing (<span class="text-danger">*</span>)</label>
                                                        <select name="sales" class="form-control" required>
                                                            <?php foreach ($marketing as $s) { ?>
                                                                <option value="<?= $s['nama_user'] ?>"><?= $s['nama_user'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">Description</label>
                                                        <textarea name="keterangan" class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="font-weight-bold">Kode Mile/AWB (<span class="text-danger">*</span>)</label>
                                                        <input type="text" class="form-control" required name="kode">
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('cs/jobsheet') ?>" class="text-dark">Cancel</a>
                                            <button type="submit" class="btn text-light" style="background-color: #9c223b;">Submit</button>
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