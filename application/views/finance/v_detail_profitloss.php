<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="card-toolbar">
                    <a href="<?= base_url('Finance/report/profitLoss/' . '/' . $bulan . '/' . $tahun) ?>" class="btn mr-2 text-light" style="background-color: #9c223b;">
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
                    <form action="<?= base_url('finance/report/' . $this->uri->segment(3) . '/' . $bulan . '/' . $tahun) ?>" method="POST">
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
                                <!-- <a href="<?= base_url('finance/report/ap') ?>" class="btn btn-primary ml-2 mt-2">Reset Filter</a> -->
                                <a data-toggle="modal" data-target="#modal-addReal" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Add</a>

                            </div>
                            <!-- <div class="col">
                                <div class="text-right">
                                    <h2 style="color: #0FB800;">Total : Rp. 1.250.000</h2>
                                </div>

                            </div> -->
                        </div>
                    </form>
                </div>
                <?php if ($this->uri->segment(3) != "detailCostOfFreight") { ?>
                    <!-- <div class="card-toolbar">
                        <a href="<?= base_url('finance/Report/addAp/' . $this->uri->segment(3)) ?>" class="btn mr-2 text-light" style="background-color: #9c223b;">
                            <i class="fas fa-plus text-light"> </i>
                            Add Ap
                        </a>
                    </div> -->
                <?php } ?>
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
                                                                    <th>Shipment Id</th>
                                                                    <th>Type</th>
                                                                    <th>Description</th>
                                                                    <th>Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <!-- menggunakan tbl real untuk adjust nilai di dalam profit loss yang diisi oleh Finance -->
                                                                <?php $totalAdjust = 0;
                                                                foreach ($adjust as $adjust) { ?>
                                                                    <tr bgcolor="#9fb6cd">
                                                                        <td>-</td>
                                                                        <td>Adjust <?php if ($this->uri->segment(4) == "detailCostOfFreight") {
                                                                                        echo "Cost Of Freight";
                                                                                    } elseif ($this->uri->segment(4) == "detailHandlingCharges") {
                                                                                        echo "Handling Charges";
                                                                                    } elseif ($this->uri->segment(4) == "detailHumanResource") {
                                                                                        echo "Human Resource";
                                                                                    } elseif ($this->uri->segment(4) == "detailMaterial") {
                                                                                        echo "Material";
                                                                                    } ?></td>
                                                                        <td><?= $adjust['description'] ?></td>
                                                                        <td><?= $adjust['date'] ?></td>
                                                                        <td><?php if ($adjust['operation'] == "penambahan") {
                                                                                echo "(+) ";
                                                                            } else {
                                                                                echo "(-) ";
                                                                            } ?><?= rupiah($adjust['amount']) ?></td>
                                                                        <td><a href="<?= base_url('Finance/report/deleteReal/' . $adjust['id_real']) ?>" onclick="confirm('Apakah Anda Yakin?')" class="btn mr-2 text-light" style="background-color: #9c223b;">
                                                                                <i class="fas fa-eraser text-light"> </i>
                                                                                Delete
                                                                            </a><button data-toggle="modal" data-target="#modal-editReal<?= $adjust['id_real'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"><i class="fa fa-pen"></i></button></td>
                                                                    </tr>
                                                                <?php if ($adjust['operation'] == "penambahan") {
                                                                        $totalAdjust += $adjust['amount'];
                                                                    } else {
                                                                        $totalAdjust -= $adjust['amount'];
                                                                    }
                                                                } ?>
                                                                <?php $total = 0;
                                                                foreach ($ap as $ap) {
                                                                ?>

                                                                    <tr>
                                                                        <td><?= $ap['kode'] ?></td>
                                                                        <td><?php if ($this->uri->segment(3) == "detailCostOfFreight") {
                                                                                echo "Cost Of Freight";
                                                                            } elseif ($this->uri->segment(3) == "detailHandlingCharges") {
                                                                                echo "Handling Charges";
                                                                            } elseif ($this->uri->segment(3) == "detailHumanResource") {
                                                                                echo "Human Resource";
                                                                            } elseif ($this->uri->segment(3) == "detailMaterial") {
                                                                                echo "Material";
                                                                            } ?></td>
                                                                        <td style="text-align: center;">-</td>
                                                                        <td><?= $ap['tgl_pickup'] ?></td>
                                                                        <?php if ($this->uri->segment(3) == "detailMaterial") { ?>
                                                                            <td><?= rupiah($ap['packing2']) ?></td>
                                                                        <?php $total += $ap['packing2'];
                                                                        } elseif ($this->uri->segment(3) == "detailCostOfFreight") {

                                                                            $totalCostOfFreight = 0;

                                                                            $service =  $ap['service_name'];
                                                                            if ($service == 'Charter Service') {
                                                                                $packing = $ap['packing'];
                                                                                $total_sales = ((int)$ap['freight_kg'] + $packing +  (int)$ap['special_freight'] +  (int)$ap['others'] + (int)$ap['surcharge'] + (int)$ap['insurance']);
                                                                            } else {
                                                                                $disc = $ap['disc'];
                                                                                // kalo gada disc
                                                                                if ($disc == 0) {
                                                                                    $freight  = (int)$ap['berat_js'] * (int)$ap['freight_kg'];
                                                                                    $special_freight  = (int)$ap['berat_msr'] * (int)$ap['special_freight'];
                                                                                } else {
                                                                                    $freight_discount = $ap['freight_kg'] * $disc;
                                                                                    $special_freight_discount = $ap['special_freight'] * $disc;

                                                                                    $freight = $freight_discount * $ap['berat_js'];
                                                                                    $special_freight  = $special_freight_discount * $ap['berat_msr'];
                                                                                }

                                                                                $packing = (int)$ap['packing'];
                                                                                $total_sales = ($freight + $packing + $special_freight +  (int)$ap['others'] + (int)$ap['surcharge'] + (int)$ap['insurance']);
                                                                                $total_sales = $total_sales;
                                                                            }

                                                                            if ($ap['refund2'] == 0) {
                                                                                $refund = $ap['specialrefund2'];
                                                                            } elseif ($ap['specialrefund2'] == 0) {
                                                                                $refund = $total_sales * ($ap['refund2'] / 100);
                                                                            }
                                                                            $totalCostOfFreight += ((int)$ap['flight_msu2'] + (int)$ap['insurance2'] + $refund);

                                                                        ?>
                                                                            <td><?= rupiah($totalCostOfFreight) ?></td>


                                                                            <!-- Untuk Total DIbawah -->
                                                                        <?php $total += $totalCostOfFreight;
                                                                        } elseif ($this->uri->segment(3) == "detailHandlingCharges") { ?>
                                                                            <td><?= rupiah((int)$ap['hand_cgk2'] + (int)$ap['hand_pickup2'] + (int)$ap['hd_daerah2'] + (int)$ap['ra2']) ?></td>
                                                                        <?php $total += (int)$ap['hand_cgk2'] + (int)$ap['hand_pickup2'] + (int)$ap['hd_daerah2'] + (int)$ap['ra2'];
                                                                        } elseif ($this->uri->segment(3) == "detailHumanResource") { ?>
                                                                            <td><?= rupiah($ap['sdm2']) ?></td>
                                                                        <?php $total += $ap['sdm2'];
                                                                        } ?>
                                                                        <td></td>

                                                                        <!-- <td><a href="#" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td> -->

                                                                    </tr>
                                                                <?php } ?>



                                                            </tbody>
                                                            <tfoot>
                                                                <tr>

                                                                    <td colspan="4" style="text-align: right;"><b>Total: </b></td>

                                                                    <td><b><?= rupiah($total + $totalAdjust) ?></b></td>

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

<?php foreach ($adjust2 as $a) {
?>
    <div class="modal fade" id="modal-editReal<?= $a['id_real'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('finance/Report/editReal/' . $a['id_real']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="font-weight-bold">Description</label>
                                        <textarea class="form-control" required name="description"><?= $a['description'] ?></textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="font-weight-bold">Amount</label>
                                        <input type="text" class="amount_proposed form-control" id="amount" value="<?= $a['amount'] ?>" required name="amount">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="font-weight-bold">Operasi</label>
                                        <select name="operation" class="form-control" id="operation">
                                            <option <?php if ($a['operation'] == "penambahan") {
                                                        echo "selected";
                                                    } ?> value="penambahan">Penambahan</option>
                                            <option <?php if ($a['operation'] == "pengurangan") {
                                                        echo "selected";
                                                    } ?> value="pengurangan">Pengurangan</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>

<div class="modal fade" id="modal-addReal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/Report/processAddReal') ?>" method="POST" enctype="multipart/form-data">
                <input type="text" name="bagian" id="bagian" value="<?php if ($this->uri->segment(3) == "detailCostOfFreight") {
                                                                        echo "Cost Of Freight";
                                                                    } elseif ($this->uri->segment(3) == "detailHandlingCharges") {
                                                                        echo "Handling Charges";
                                                                    } elseif ($this->uri->segment(3) == "detailHumanResource") {
                                                                        echo "Human Resource";
                                                                    } elseif ($this->uri->segment(3) == "detailMaterial") {
                                                                        echo "Material";
                                                                    } ?>" hidden>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold">Description</label>
                                    <textarea class="form-control" required name="description"></textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_date" class="font-weight-bold">Amount</label>
                                    <input type="text" class="amount_proposed form-control" id="amount" required name="amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="font-weight-bold">Date</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_date" class="font-weight-bold">Operasi</label>
                                    <select name="operation" class="form-control" id="operation">
                                        <option value="penambahan">Penambahan</option>
                                        <option value="pengurangan">Pengurangan</option>
                                    </select>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->