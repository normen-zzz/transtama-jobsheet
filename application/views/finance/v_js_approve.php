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
				    
                <hr>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="<?= base_url('finance/jobsheet/download') ?>" method="POST">
                                        <div class="table-responsive">
                                              <!-- <button type="submit" class="btn btn-success mb-2"> <i class="fa fa-download"></i> Download</button> -->
                                        <table id="tableEnterJobsheet" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
													  
                                                     <th>Pickup Date</th>
                                                        <th>Shipment ID</th>
                                                       
                                                        <th>No. SO</th>
                                                        <th>Js Id</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <!-- <th>Colly</th> -->
                                                    <th>Sales</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            

                                        </table>
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