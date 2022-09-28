<!--begin::Content-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="pb-5 pb-md-10">
                                    <h2 class="display-5 font-weight-boldest mb-2"><?= $pengumuman['judul'] ?></h2>
                                    <p class="d-flex flex-column opacity-70">
                                        <span><?= $pengumuman['nama_user'] ?>, <?= $pengumuman['created_at'] ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 offset-2">
                                <a href="#" class="mb-5">
                                    <img src="<?= base_url('uploads/pengumuman/' . $pengumuman['gambar']) ?>" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-5">
                                <p class="font-size-lg"><?= $pengumuman['pengumuman'] ?></p>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex justify-content-between pt-6">
                            <div class="d-flex flex-column flex-root">

                            </div>
                            <div class="d-flex flex-column flex-root">

                            </div>
                            <div class="d-flex flex-column flex-root">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice action-->

                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->