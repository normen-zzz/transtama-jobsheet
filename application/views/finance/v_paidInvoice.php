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
                        <h3 class="title text-center"><i class="fa fa-dollar-sign"></i>PAID INVOICE</h3>
                    </center>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="overflow: auto;">
                        <form action="<?= base_url('finance/Invoice/bulkPaid') ?>" method="POST">
                            <div class="col-12">
                                <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                       
                                                        <th>No Invoice</th>
                                                        <th>Date Created</th>
                                                        <th>Due Date</th>
                                                        <th>Time Line</th>
                                                        <th>Customer Invoice</th>
                                                        <th>Customer Pickup</th>
                                                        <th>Payment Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                    foreach ($noInvoice as $j) {
                                                        $total_mepet = 0;

                                                        $tgl1 = strtotime(date('Y-m-d'));
                                                        $tgl2 = strtotime($j['due_date']);

                                                        $jarak = $tgl2 - $tgl1;

                                                        $perbedaan = $jarak / 60 / 60 / 24;

                                                        if ($perbedaan <= 7) {
                                                            $total_mepet = $total_mepet + 1;
                                                        }
                                                        // echo $total_mepet;
                                                    ?>
                                                    <input type="text" name="no_invoice[]" value="<?= $j['no_invoice'] ?>" hidden>
                                                        <tr>

                                                            <!-- <td><a target="blank" href="<?= base_url('finance/invoice/printProforma/' . $j['no_invoice']) ?>"><?= $j['no_invoice'] ?></a> </td> -->

                                                            <td><?= $j['no_invoice'] ?></td>
                                                            <td><?= bulan_indo($j['date']) ?></td>
                                                            <td><?php if ($j['status'] == 2) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                                } else {
                                                                    echo  bulan_indo($j['due_date']);
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($j['status'] == 2) {
                                                                    echo '<span class="text-success">Paid</span> ';
                                                                } else {
                                                                    if ($perbedaan <= 7) {
                                                                        $total_mepet = $total_mepet + 1;
                                                                ?>
                                                                        <span data-perbedaan="<?= $total_mepet ?>" id="the-span"></span>
                                                                    <?php   }


                                                                    if ($perbedaan < 0) {
                                                                        $total_mepet += 1;
                                                                        echo '<span class="text-danger">Expired</span> 
																	<br> Please Follow up This invoice';
                                                                    ?>
                                                                <?php
                                                                    } elseif ($perbedaan <= 7 || $perbedaan >= 0) {
                                                                        echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                    } else {
                                                                        echo "<span class='text-danger'>$perbedaan Days Again</span>";
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $j['customer'] ?></td>
                                                            <td><?= $j['customer_pickup'] ?></td>
                                                            <td>
                                                                <?php if ($j['status'] == 1) {
                                                                    echo '<span class="label label-danger label-inline font-weight-lighter">Pending</span>';
                                                                } elseif ($j['status'] == 2) {
                                                                    echo '<span class="label label-success label-inline font-weight-lighter">Paid</span>';
                                                                } elseif ($j['status'] == 3) {
                                                                    echo '<span class="label label-purple label-inline font-weight-lighter">Unpaid</span>';
                                                                }  ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
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
                                    <input type="date" class="form-control" name="datePaid" required>
                                
                                </div>
                            </div>
                            <br><br>                    
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success mt-6 ml-4" onclick="return confirm('Are you sure ?')">PAID Invoice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>