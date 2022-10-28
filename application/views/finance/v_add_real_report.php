	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">

							<h2 class="card-title"><?= $title ?> <?php if ($this->uri->segment(4) == "detailCostOfFreight") {
																		echo "Cost Of Freight";
																	} elseif ($this->uri->segment(4) == "detailHandlingCharges") {
																		echo "Handling Charges";
																	} elseif ($this->uri->segment(4) == "detailHumanResource") {
																		echo "Human Resource";
																	} elseif ($this->uri->segment(4) == "detailMaterial") {
																		echo "Material";
																	} ?></h2>
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
										<form action="<?= base_url('finance/report/processAddReal') ?>" method="POST" enctype="multipart/form-data">
											<input type="text" name="uri" id="uri" value="<?= $uri ?>" hidden>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Description <span class="text-danger">*</span></label>
														<textarea class="form-control" required name="description"></textarea>
													</div>
												</div>
												<input type="text" name="bagian" id="bagian" value="<?php if ($this->uri->segment(4) == "detailCostOfFreight") {
																										echo "Cost Of Freight";
																									} elseif ($this->uri->segment(4) == "detailHandlingCharges") {
																										echo "Handling Charges";
																									} elseif ($this->uri->segment(4) == "detailHumanResource") {
																										echo "Human Resource";
																									} elseif ($this->uri->segment(4) == "detailMaterial") {
																										echo "Material";
																									} ?>" hidden>

												<div class="col-md-4">
													<label for="note_cs">Operation</label>
													<div class="form-group">
														<select name="operation" class="form-control" id="operation">
															<option value="penambahan">Penambahan</option>
															<option value="pengurangan">Pengurangan</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Date</label>
													<div class="form-group">
														<input type="date" class="form-control" name="date" id="date">
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Amount</label>
													<div class="form-group">
														<input type="text" class="amount_proposed form-control" id="amount1" required name="amount">
													</div>
												</div>




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