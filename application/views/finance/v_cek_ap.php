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
                            <h3 class="card-label font-weight-bolder text-dark">AP Tracking</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Input AP Number</span>
                        </div>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="<?= base_url('finance/ap/cekAp') ?>" method="POST">


                                    <label for="shipment_id">AP Number (ex: PO-223344)</label>
                                    <input type="text" class="form-control" name="no_pengeluaran" <?php if ($no_pengeluaran != NULL) { ?> value="<?= $no_pengeluaran ?>" <?php } ?>>
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
                                        <h2>AP TRACKING <?php if ($no_pengeluaran != NULL) {
                                                                echo $no_pengeluaran;
                                                            } ?></h2>

                                        <?php if ($pengeluaran != NULL) { ?>
                                            <table class="table table-borderless table-striped" style="border-top: none;">
                                                <tr>
                                                    <td>
                                                        <h5>Pengajuan Oleh :</h5>
                                                    </td>
                                                    <td>
                                                        <?php $user = $this->db->query("SELECT nama_user FROM tb_user WHERE id_user = ".$pengeluaran['id_user']." ")->row_array() ?>
                                                        <h6><?= $user['nama_user'] ?></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5>Tanggal Pengajuan :</h5>
                                                    </td>
                                                    <td>
                                                        <?php if ($is == 0) { ?>
                                                            <h6><?= date('d-M-Y H:i:s',strtotime($pengeluaran['created']))  ?></h6>
                                                       <?php  } else{ ?>
                                                        <h6><?= date('d-M-Y H:i:s',strtotime($pengeluaran['created_at']))  ?></h6>
                                                        <?php } ?>
                                                        
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                        <h5>Jenis : </h5>
                                                    </td>
                                                    <td>
                                                    <?php if ($is == 0) { ?>
                                                   <p><b>INTERNAL</b></p>
                                                    <?php } else{ ?>
                                                        <p><b>EKSTERNAL</b></p>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                

                                                <tr>
                                                    <td>
                                                        <h5>Status : </h5>
                                                    </td>
                                                    <td>
                                                    <?php if ($is == 0) { ?>
                                                    <?= statusAp($pengeluaran['status'], $pengeluaran['is_approve_sm']) ?>
                                                    <?php } else{ ?>
                                                        <?= statusAp($pengeluaran['status'], 1) ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                

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