	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">

							<h2 class="card-title"><?= $title ?></h2>
						</div>

						<!-- /.card-header -->
						<div class="card-body" style="overflow: auto;">
							<div class="card-toolbar">
								<a href="<?= base_url('finance/Report/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6)) ?>" class="btn mr-2 text-light" style="background-color: #9c223b;">
									<i class="fas fa-chevron-circle-left text-light"> </i>
									Back
								</a>
							</div>
							<div class="card-body p-0">
								<!--begin: Wizard-->

								<div class="row justify-content-center">
									<div class="col-xl-12 col-xxl-7">
										<!--begin: Wizard Form-->
										<form action="<?= base_url('finance/report/processAddAp') ?>" method="POST" enctype="multipart/form-data">
											<input type="text" name="uri" id="uri" value="<?= $uri ?>" hidden>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
														<textarea class="form-control" required name="purpose"></textarea>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Date</label>
														<input type="date" name="date" id="date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Choose AP</label>
													<div class="form-group">
														<select name="id_kategori_pengeluaran" required class="form-control" id="kat">
															<?php foreach ($kategori_ap as $kat) {
															?>
																<option value="<?= $kat['id_kategori_ap'] ?>" <?php if ($kat['id_kategori_ap'] == 4) {
																													echo 'selected';
																												} ?>><?= $kat['nama_kategori'] ?></option>

															<?php	} ?>
														</select>
													</div>
												</div>
												<div class="col-md-4" style="display: none;" id="mode">
													<label for="note_cs">Payment Mode</label>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="mode" value="0" onclick="javascript:Cash();" id="cash">
														<label class="form-check-label" for="mode1">
															Cash
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="mode" value="1" onclick="javascript:Cash();" id="tf">
														<label class="form-check-label" for="mode2">
															Bank Transfer
														</label>
													</div>
												</div>

												<div class="col-md-4" style="display:none;" id="via">
													<div class="form-group">
														<label for="exampleInputEmail1">Via</label>
														<input type="text" name="via" class="form-control">
													</div>
												</div>
												<div class="col-md-4" style="display: none;" id="car">
													<label for="note_cs">NO CA</label>
													<div class="form-check">
														<input class="form-control" type="text" name="no_ca">
													</div>
												</div>

											</div>
											<!--begin: Wizard Step 1-->
											<label for="exampleInputEmail1"><button type="button" class="btn btn-info tambah-ap"> Add Details </button> </label>
											<?= $this->session->userdata('message') ?>
											<!--begin::Input-->
											<div class="row">
												<div class="col-md-2">
													<label for="note_cs">Choose Category 1</label>
													<div class="form-group rec-element-ap">
														<input type="text" class="form-control" hidden id="id_category1" name="id_category[]">
														<input type="text" class="browse-category form-control" readonly data-index="1" id="nama_kategori1" name="nama_kategori_pengeluaran[]">
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Description 1</label>
													<div class="form-group rec-element-ap">
														<textarea class="form-control" id="descriptions1" required name="descriptions[]"></textarea>
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Amount Proposed 1</label>
													<div class="form-group rec-element-ap">
														<input type="text" class="form-control" id="amount1" required name="amount_proposed[]">
													</div>
												</div>
												<!-- <div class="col-md-4">
													<label for="note_cs">Attachment 1</label>
													<div class="form-group rec-element-ap">
														<input type="file" class="form-control" id="attachment1" name="attachment[]" accept="image/*" capture>
													</div>
												</div> -->

												<div class="ln_solid_ap"></div>
												<div id="nextkolom_ap" name="nextkolom_ap"></div>
												<button type="button" id="jumlahkolom_ap" value="1" style="display:none"></button>


											</div>

											<!--end: Wizard Step 1-->

											<!--begin: Wizard Actions-->
											<div class="d-flex justify-content-between border-top mt-5 pt-10">
												<div>
													<button type="submit" class="btn btn font-weight-bolder text-uppercase px-9 py-4 text-light" data-wizard-type="action-submit" style="background-color: #9c223b;">Submit</button>
												</div>
											</div>
											<!--end: Wizard Actions-->
										</form>
										<!--end: Wizard Form-->
									</div>
								</div>
								<!--end: Wizard Body-->

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



	<div class="modal" id="selectCategory" data-index="">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largeModalLabel">Pilih Kategori</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>



				<div class="modal-body">

					<!-- <h6 class="p-2">Cari kATEGORI</h6> <br>
					<div class="row">

						<div class="col-3">
							<div class="form-group">
								<label for="formGroupExampleInput">CUSITD</label>

								<input type="text" type="text" id="keyword" class="form-control form-control-sm">
							</div>
						</div>



						<div class="col-3">
							<div class="form-group">
								<label for="formGroupExampleInput">ProdukID</label>
								<input type="text" type="text" id="produkid" class="form-control form-control-sm">
							</div>
						</div>



						<div class="col-3">
							<div class="form-group">
								<br>
								<button type="button" class="form-control form-control-sm" id="btn-search">Search</button>

								</select>
							</div>
						</div>

					</div> -->
					<div id="view">

						<?php $this->load->view('finance/view', array('siswa' => $kategori_pengeluaran)); // Load file view.php dan kirim data siswanya 
						?>
					</div>


				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal-lg">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Signature</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('superadmin/role/addRole') ?>" method="POST">
						<div class="col-md-12">
							<label style="font-weight:bold">Signature</label>
							<div id="signature" style="height: 300%; width:100%;   border: 1px solid black;"></div><br />
						</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" id="click" class="btn text-light" data-dismiss="modal" style="background-color: #9c223b;">Submit</button>
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->