<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="card-toolbar">
                    <a href="<?= base_url('Finance/report/profitLoss/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)) ?>" class="btn mr-2 text-light" style="background-color: #9c223b;">
                        <i class="fas fa-chevron-circle-left text-light"> </i>
                        Back
                    </a>
                </div>
                <div class="content-header">
                    <center>
                        <h3><?= $heading; ?></h3>
                    </center>

                </div>
                <div class="content-header">
                    <form action="<?= base_url('finance/report/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)) ?>" method="POST">
                        <h6 class="page-title">Filter By Month</h6>
                        <div class="row">
                            <div class="form-group mr-2">
                                <label>Month</label><br>
                                <select name="bulan" class="form-control" style="width: 200px; height:100px" required>
                                    <option value="">Pilih</option>
                                    <option <?php if ($bulan == NULL && date('m') == "01") {
                                                echo 'selected';
                                            } elseif ($bulan == 01) {
                                                echo 'selected';
                                            } ?> value="01">Januari</option>

                                    <option <?php if ($bulan == NULL && date('m') == "02") {
                                                echo 'selected';
                                            } elseif ($bulan == 02) {
                                                echo 'selected';
                                            }  ?> value="02">Februari</option>

                                    <option <?php if ($bulan == NULL && date('m') == "03") {
                                                echo 'selected';
                                            } elseif ($bulan == 03) {
                                                echo 'selected';
                                            }  ?> value="03">Maret</option>

                                    <option <?php if ($bulan == NULL && date('m') == "04") {
                                                echo 'selected';
                                            } elseif ($bulan == 04) {
                                                echo 'selected';
                                            }  ?> value="04">April</option>

                                    <option <?php if ($bulan == NULL && date('m') == "05") {
                                                echo 'selected';
                                            } elseif ($bulan == 05) {
                                                echo 'selected';
                                            } ?> value="05">Mei</option>

                                    <option <?php if ($bulan == NULL && date('m') == "06") {
                                                echo 'selected';
                                            } elseif ($bulan == 06) {
                                                echo 'selected';
                                            }  ?> value="06">Juni</option>

                                    <option <?php if ($bulan == NULL && date('m') == "07") {
                                                echo 'selected';
                                            } elseif ($bulan == 07) {
                                                echo 'selected';
                                            } ?> value="07">Juli</option>

                                    <option <?php if ($bulan == NULL && date('m') == "08") {
                                                echo 'selected';
                                            } elseif ($bulan == "08") {
                                                echo 'selected';
                                            }  ?> value="08">Agustus</option>

                                    <option <?php if ($bulan == NULL && date('m') == "09") {
                                                echo 'selected';
                                            } elseif ($bulan == "09") {
                                                echo 'selected';
                                            } ?> value="09">September</option>

                                    <option <?php if ($bulan == NULL && date('m') == "10") {
                                                echo 'selected';
                                            } elseif ($bulan == 10) {
                                                echo 'selected';
                                            } ?> value="10">Oktober</option>

                                    <option <?php if ($bulan == NULL && date('m') == "11") {
                                                echo 'selected';
                                            } elseif ($bulan == 11) {
                                                echo 'selected';
                                            }  ?> value="11">November</option>

                                    <option <?php if ($bulan == NULL && date('m') == "12") {
                                                echo 'selected';
                                            } elseif ($bulan == 12) {
                                                echo 'selected';
                                            } ?> value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Year</label> <br>
                                <select name="tahun" class="form-control" style="width: 200px; height:100px" required>
                                    <option selected="selected">Pilih</option>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                        if ($i == date('Y')) {
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
                                <a href="<?= base_url('finance/Report/addAp/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)) ?>" class="btn ml-3 mt-2 text-light" style="background-color: #9c223b;">
                                    <i class="fas fa-plus text-light"> </i>
                                    Add Ap
                                </a>
                                <!-- <a href="<?= base_url('finance/report/ap') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a> -->
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
                                                                    <th>No AP</th>
                                                                    <th>Description</th>
                                                                    <th>Notes</th>
                                                                    <th>Category</th>
                                                                    <th>Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Action</th>
                                                                    <!-- <th>Action</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $total = 0;
                                                                foreach ($ap as $ap) {
                                                                    $categoryAp = $this->db->get_where('tbl_list_pengeluaran', array('kode_kategori' => $ap['id_kategori_pengeluaran']))->row_array(); ?>

                                                                    <tr>
                                                                        <td><?= $ap['no_pengeluaran'] ?></td>
                                                                        <td><?= $ap['purpose'] ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                                echo $ap['vendor'];
                                                                            } else {
                                                                                echo   $ap['description'];
                                                                            }
                                                                            ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                                echo 'External';
                                                                            } else {
                                                                                echo  $categoryAp['nama_kategori_pengeluaran'];
                                                                            }
                                                                            ?></td>
                                                                        <td><?= $ap['date'] ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == 'detailCostOfFreight') {
                                                                                echo rupiah($ap['total_ap'] + $ap['pph'] + $ap['ppn']);
                                                                            } else {
                                                                                echo rupiah($ap['total_approved']);
                                                                            }
                                                                            ?></td>
                                                                        <td><a href="<?= base_url('finance/Report/detailAp/' . $ap['no_pengeluaran'] . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit</a></td>

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
                                                                    <td colspan="4"></td>
                                                                    <td><b>Total:</b></td>
                                                                    <td><b> <?= rupiah($total) ?></b></td>
                                                                    <!-- <td></td> -->
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