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
                    <form action="<?= base_url('finance/report/profitloss') ?>" method="POST">
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
                                        <div class="col-8">
                                            <div>
                                                <!-- line chart -->
                                                <canvas id="myChart" width="200" height="100"></canvas>
                                                <script>
                                                    const labels = [
                                                        'Profit',
                                                        'Loss',
                                                    ];
                                                    const data = {
                                                        labels: labels,
                                                        label: ['Profit/Loss'],
                                                        datasets: [{

                                                            backgroundColor: ['rgb(76, 120, 168)', 'rgb(139, 50, 77)'],
                                                            borderColor: ['rgb(76, 120, 168)', 'rgb(139, 50, 77)'],
                                                            data: [<?= $totalsales ?>, <?= $allAp ?>],

                                                        }]
                                                    };

                                                    const config = {
                                                        type: 'bar',
                                                        data,
                                                        options: {
                                                            indexAxis: 'y',

                                                            plugins: {
                                                                legend: {
                                                                    display: false
                                                                },

                                                            },
                                                            tooltip: {
                                                                callbacks: {
                                                                    label: (ttItem2) => (`${ttItem2.label}: Rp. ${ttItem2.parsed}`)
                                                                }
                                                            }
                                                        }
                                                    };
                                                </script>

                                                <script>
                                                    const myChart = new Chart(
                                                        document.getElementById('myChart'),
                                                        config
                                                    );
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div>
                                                <!-- pie chart -->
                                                <canvas id="myChart2" width="100" height="100"></canvas>
                                                <script>
                                                    const labels2 = [
                                                        'Profit',
                                                        'Loss',
                                                    ];
                                                    const data2 = {
                                                        labels: [
                                                            'Cost Of Freight',
                                                            'Handling Charges',
                                                            'Human Resource',
                                                            'Material',
                                                            'Overhead',
                                                            'AM EXP'




                                                        ],
                                                        datasets: [{
                                                            label: 'My First Dataset',
                                                            data: [<?= $apCostOfFreight ?>, <?= 0 ?>, <?= $apHumanResource ?>, <?= $apMaterial ?>, <?= $apOverhead ?>, <?= $apGeneralAmExp ?>],
                                                            backgroundColor: [
                                                                'rgb(76, 120, 168)',
                                                                'rgb(28, 157, 189)',
                                                                'rgb(139, 50, 77)',
                                                                'rgb(27, 209, 82)',
                                                                'rgb(173, 209, 27)',
                                                                'rgb(173, 28, 189)'


                                                            ],
                                                            hoverOffset: 2
                                                        }]
                                                    };

                                                    const config2 = {
                                                        type: 'pie',
                                                        data: data2,
                                                        options: {
                                                            indexAxis: 'y',
                                                            plugins: {
                                                                legend: {
                                                                    position: "right",
                                                                    align: "middle"
                                                                },
                                                                tooltip: {
                                                                    callbacks: {
                                                                        label: (ttItem2) => (`${ttItem2.label}: ${ttItem2.parsed.toLocaleString("id-ID",{style:"currency", currency:"IDR"})}`)
                                                                    }
                                                                }
                                                            },




                                                        }
                                                    };
                                                </script>

                                                <script>
                                                    const myChart2 = new Chart(
                                                        document.getElementById('myChart2'),
                                                        config2
                                                    );
                                                </script>
                                            </div>
                                        </div>
                                    </div>
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
                                                                    <th>Total</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>SALES INCLUDED VAT 1,1%</td>
                                                                    <td><?= rupiah($totalsales) ?></td>
                                                                    <!-- <td><a href="<?= base_url('finance/report/detailProfitLoss') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td> -->
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>COST OF FREIGHT</td>
                                                                    <td><?= rupiah($apCostOfFreight) ?></td>
                                                                    <td><a href="<?= base_url('finance/report/detailCostOfFreight') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td> HANDLING CHARGES</td>
                                                                    <td></td>
                                                                    <td><a href="<?= base_url('finance/report/detailProfitLoss') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>OPERATIONAL HUMAN RESOURCES</td>
                                                                    <td><?= rupiah($apHumanResource) ?></td>
                                                                    <td><a href="<?= base_url('finance/report/detailHumanResource') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>COST OF MATERIAL PACKING</td>
                                                                    <td><?= rupiah($apMaterial) ?></td>
                                                                    <td><a href="<?= base_url('finance/report/detailMaterial') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>OVERHEAD COSTS</td>
                                                                    <td><?= rupiah($apOverhead) ?></td>
                                                                    <td><a href="<?= base_url('finance/report/detailOverhead') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td> GENERAL AM EXP</td>
                                                                    <td><?= rupiah($apGeneralAmExp) ?></td>
                                                                    <td><a href="<?= base_url('finance/report/detailAmExp') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr>
                                                                <!-- <tr>
                                                                    <td>PROFIT LOSS</td>
                                                                    <td>Rp. 1234567</td>
                                                                    <td><a href="<?= base_url('finance/report/detailProfitLoss') ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Detail</a></td>
                                                                </tr> -->



                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <?php if ($totalsales > ($apCostOfFreight + $apHumanResource + $apMaterial + $apOverhead + $apGeneralAmExp)) { ?>
                                                                        <td style="text-align: right">PROFIT :</td>
                                                                    <?php } else { ?>
                                                                        <td style="text-align: right">LOSS :</td>
                                                                    <?php } ?>
                                                                    <td><?= rupiah($totalsales - ($apCostOfFreight + $apHumanResource + $apMaterial + $apOverhead + $apGeneralAmExp)) ?></td>
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