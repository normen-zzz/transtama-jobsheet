<link rel="stylesheet" href="<?php echo base_url() ?>assets/scans/css/style.css">
<?php
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, "id_ID.UTF8");
?>
<!-- Main content -->
<section class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12">
                <div class="card card-custom card-stretch">
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Resi Tracking</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Input Shipment Number</span>
                        </div>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="<?= base_url('finance/Jobsheet/cekResi') ?>" method="POST">


                                    <label for="shipment_id">Shipment ID</label>
                                    <input type="text" class="form-control" name="shipment_id" <?php if ($resi != NULL) { ?> value="<?= $resi ?>" <?php } ?>>
                                    <button type="submit" class="btn btn-success mt-2">View</button>
                                    <!-- <div class="navbar-form navbar-center">
										<select class="form-control" id="selectCamCs" style="width: 80%;"></select>
									</div>
									<canvas class="mt-2" id="cobascanCS" width="400" height="400"></canvas> -->
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col text-center">
                                        <h2>RESI TRACKING <?php if ($resi != NULL) {
                                                                echo $resi;
                                                            } ?></h2>

                                        <?php if ($resi != NULL) { ?>
                                            <table class="table table-borderless table-striped" style="border-top: none;">
                                                <tr>
                                                    <td>
                                                        <h5>Customer :</h5>
                                                    </td>
                                                    <td>
                                                        <h6><?= $shipment['shipper'] ?></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5>Consignee :</h5>
                                                    </td>
                                                    <td>
                                                        <h6><?= $shipment['consigne'] ?></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5>Request Pickup :</h5>
                                                    </td>
                                                    <td>
                                                        <h6><?php if ($shipment['tgl_pickup'] != NULL) {
                                                                echo date('d F Y', strtotime($shipment['tgl_pickup']));
                                                            } else {
                                                                echo 'Belum Diterima';
                                                            }  ?></h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5>Tgl Barang Diterima :</h5>
                                                    </td>
                                                    <td>
                                                        <h6><?php if ($shipment['tgl_diterima'] != NULL) {
                                                                echo date('d F Y', strtotime($shipment['tgl_diterima']));
                                                            } else {
                                                                echo 'Belum Diterima';
                                                            }  ?></h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5>Status : </h5>
                                                    </td>
                                                    <td>
                                                        <?php switch ($shipment['status_so']) {
                                                            case '0':
                                                                echo 'Belum Submit SO';
                                                                break;
                                                            case '1':
                                                                echo 'Sudah Masuk CS';
                                                                break;
                                                            case '2':
                                                                echo 'Sudah di Approve Oleh PIC JS';
                                                                break;
                                                            case '3':
                                                                echo 'Sudah di Approve Oleh Manager CS';
                                                                break;
                                                            case '4':
                                                                echo 'Sudah di Approve Oleh Manager Finance';
                                                                break;
                                                            case '5':
                
                                                                if ($invoice['status'] == 0) {
                                                                    echo 'On Proforma';
                                                                } elseif ($invoice['status'] == 1) {
                                                                    echo 'On Invoice (Pending)';
                                                                } elseif ($invoice['status'] == 2) {
                                                                      echo 'On Invoice (Paid) '. date('d-m-Y',strtotime($invoice['payment_date'])) ;
                                                                } elseif ($invoice['status'] == 3) {
                                                                    echo 'On Invoice (UnPaid)';
                                                                }
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <?php if ($shipment['status_so'] == 5) {
                                                   
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <h5>No Invoice : </h5>
                                                        </td>
                                                        <td>
                                                            <?= $invoice['no_invoice'] ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if (isset($Po)) {
                                                    
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <h5>No PO : </h5>
                                                            </td>
                                                            <td>
                                                                <?php foreach ($Po as $Po1) { ?>
                                                                    <a target="_blank" href="<?= base_url('cs/ApExternal/detailInvoice/'.$Po1['unique_invoice']."/" . encrypt_url($Po1['id_vendor'])) ?>" ><?= $Po1['no_po'] ?> (<?= $Po1['vendor'] ?>)</a><br>
                                                                    <?php } ?>
                                                                
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                            </table>
                                        <?php
                                        } ?>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->