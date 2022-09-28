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
                                <!-- <button data-toggle="modal" data-target="#modal-add" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"> <i class="fa fa-plus"></i> Add</button> -->
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
                                    <div class="table-responsive">

                                        <table id="table" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Vendor</th>
                                                    <th>PIC</th>
                                                    <!-- <th>Alamat</th> -->
                                                    <!-- <th>No. Rekening</th> -->
                                                    <th>Type</th>
                                                    <th>Total Invoice</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($vendors as $j) {
                                                    $total_invoice = $this->db->get_where('tbl_invoice_ap', ['id_vendor' => $j['id_vendor'], 'status' => 0])->num_rows();
                                                ?>
                                                    <tr>
                                                        <td><?= $j['nama_vendor'] ?></td>
                                                        <td><?= $j['pic'] ?></td>
                                                        <!-- <td><?= $j['alamat'] ?></td> -->
                                                        <!-- <td><?= $j['no_rekening'] ?></td> -->

                                                        <td><?php if ($j['type'] == 0) {
                                                                echo '<span class="label label-success label-inline font-weight-lighter">Vendor</span>';
                                                            } else {

                                                                echo '<span class="label label-danger label-inline font-weight-lighter">Agent</span>';
                                                            } ?>
                                                        </td>
                                                        <td><?= $total_invoice ?></td>
                                                        <td>
                                                            <a href="<?= base_url('finance/ap/detailAp/' . encrypt_url($j['id_vendor'])) ?>" class="btn btn-sm text-light" style="background-color: #9c223b;"><i class="fa fa-eye"></i></a>

                                                        </td>

                                                    </tr>

                                                <?php } ?>

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