	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">
								<center><?= $title ?> <?= $info['no_pengeluaran'] ?></center>
							</h2>
							<div class="card-toolbar">
								<?php $redirect = $this->uri->segment(2);
								?>
								<button onclick="history.back()" class="btn mr-2 text-light" style="background-color: #9c223b;">
									<i class="fas fa-chevron-circle-left text-light"> </i>
									Back
								</button>
								<a target="blank" href="<?= base_url('finance/ap/print/' . $info['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body" style="overflow: auto;">
							<div class="card-body p-0">
								<!--begin: Wizard-->

								<div class="row justify-content-center">
									<div class="col-xl-12 col-xxl-7">
										<!--begin: Wizard Form-->
										<form action="<?= base_url('finance/ap/processAddDetail') ?>" method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Purpose <span class="text-danger">*</span></label>
														<textarea class="form-control" required name="purpose"><?= $info['purpose'] ?></textarea>
														<input type="text" class="form-control" name="no_pengeluaran1" hidden value="<?= $info['no_pengeluaran'] ?>">
														<input type="text" class="form-control" name="id_kategori_pengeluaran1" hidden value="<?= $info['id_kat_ap'] ?>">
													</div>
												</div>
												<div class="col-md-4">
													<label for="note_cs">Choose AP</label>
													<div class="form-group">
														<select name="id_kategori_pengeluaran" disabled required class="form-control">
															<?php foreach ($kategori_ap as $kat) {
															?>
																<option value="<?= $kat['id_kategori_ap'] ?>" <?php if ($kat['id_kategori_ap'] == $info['id_kat_ap']) {
																													echo 'selected';
																												} ?>><?= $kat['nama_kategori'] ?></option>

															<?php	} ?>
														</select>
													</div>
												</div>

												<div class="col-md-4" id="mode">
													<label for="note_cs">Payment Mode</label>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="mode" value="0" <?php if ($info['payment_mode'] == 0) {
																																echo 'checked';
																															} ?>>
														<label class="form-check-label" for="mode1">
															Cash
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="mode" value="1" <?php if ($info['payment_mode'] == 1) {
																																echo 'checked';
																															} ?>>
														<label class="form-check-label" for="mode2">
															Bank Transfer
														</label>
													</div>
												</div>

												<?php if ($info['payment_mode'] == 1) {
												?>
													<div class="col-md-4">
														<div class="form-group">
															<label for="exampleInputEmail1">Via</label>
															<input type="text" name="via" class="form-control" value="<?= $info['via_transfer'] ?>">
														</div>
													</div>
												<?php	} ?>

												<?php if ($info['no_ca'] != NULL) {
												?>
													<div class="col-md-4">
														<div class="form-group">
															<label for="exampleInputEmail1">NO. CA</label>
															<input type="text" name="no_ca" class="form-control" value="<?= $info['no_ca'] ?>">
														</div>
													</div>
												<?php	} ?>


											</div>

											<!--begin: Wizard Step 1-->


											<div class="card-body" style="overflow: auto;">
												<center>
													<h3>DETAIL <?= $info['keterangan'] ?></h3>
												</center>
												<div class="row">
													<table class="table table-separate table-head-custom table-checkable" id="myTable3">
														<tr>
															<th>Category</th>
															<th>Description</th>
															<th>Amount Proposed</th>
															<th>Amount Approved</th>
															<th>Attachment</th>
														</tr>
														<?php
														$total = 0;
														$total_approved = 0;
														foreach ($ap as $c) {
														?>
															<tr>
																<td><?= $c['nama_kategori'] ?></td>
																<td><?= $c['description'] ?></td>
																<td><?= rupiah($c['amount_proposed']) ?></td>
																<td>
																	<input type="text" name="amount_approved[]" value="<?= $c['amount_approved'] ?>" class="form-control">
																	<input type="text" name="id_pengeluaran[]" hidden value="<?= $c['id_pengeluaran'] ?>" class="form-control">
																</td>
																<td>
																	<?php if ($info['status'] <= 0) {
																	?>
																		<a data-toggle="modal" data-target="#modal-bukti<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Attacment</a>
																		<a data-toggle="modal" data-target="#modal-edit<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"> <i class="fa fa-edit text-light"></i> Edit</a>
																	<?php	} else {
																	?>
																		<a data-toggle="modal" data-target="#modal-bukti<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Attacment</a>

																	<?php	} ?>
																</td>
															</tr>

														<?php
															$total = $total + $c['amount_proposed'];
															$total_approved = $total_approved + $c['amount_approved'];
														} ?>
														<tr style="border-top:2px solid black">
															<td colspan="2">
																TOTAL
															</td>
															<td>
																<?= rupiah($total) ?>

															</td>
															<td>
																<?= rupiah($total_approved) ?>

															</td>
															<td></td>
														</tr>

													</table>
												</div>
											</div>
											<div class="d-flex justify-content-between border-top mt-5 pt-10">
												<?php if ($info['status'] == 2) {
												?>
													<div>
														<button type="submit" class="btn btn-sm text-light" onclick="return confirm('Are You Sure ?')" style="background-color: #9c223b;">Approve</button>
														<a href="#" data-toggle="modal" data-target="#modal-decline" class="btn btn-sm text-light" style="background-color: #9c223b;">Void</a>
													</div>

												<?php	} elseif ($info['status'] == 3) {
												?>

													<?php $is_atasan = $this->session->userdata('id_jabatan');
													if ($is_atasan == 2) {
													?>
														<div>
															<a href="<?= base_url('finance/ap/approveFinance/' . $info['no_pengeluaran']) ?>" class="btn btn-sm text-light tombol-konfirmasi" style="background-color: #9c223b;">Approve</a>
															<a href="#" data-toggle="modal" data-target="#modal-decline" class="btn btn-sm text-light" style="background-color: #9c223b;">Void</a>
														</div>
													<?php	} else {
													?>

														<span>
															<span class="fa fa-check-circle text-success"></span>
															This <?= $info['no_pengeluaran'] ?> has been Received, Please Wait Manager Finance To Check
														</span>
													<?php	}
													?>



												<?php } elseif ($info['status'] == 6) {
												?>

													<span>
														<span class="fa fa-window-close text-danger"></span>
														This <b><?= $info['no_pengeluaran'] ?></b> has been Void At <b><?= $info['void_date'] ?></b> Because <b><?= $info['reason_void'] ?></b> <br>

													</span>

												<?php } elseif ($info['status'] == 5) {
												?>

													<span>
														<span class="fa fa-check-circle text-success"></span>
														This <b><?= $info['no_pengeluaran'] ?></b> has been <b> Approve GM</b> Please to pay according to the Approved Amount

													</span>
												<?php } elseif ($info['status'] == 4) {
												?>

													<span>
														<span class="fa fa-check-circle text-success"></span>
														This <b><?= $info['no_pengeluaran'] ?></b> has been Paid At <b><?= bulan_indo($info['payment_date']) ?> <a target="blank" href="<?= base_url('uploads/ap_proof/' . $info['payment_proof']) ?>">View Proof</a> </b>

													</span>
												<?php } else {

												?>
													<span>
														<span class="fa fa-check-circle text-success"></span>
														This <?= $info['no_pengeluaran'] ?> has been Approve By Manager CS, Please Wait GM To Check
													</span>

												<?php } ?>
											</div>

											<!--end: Wizard Step 1-->

											<!--begin: Wizard Actions-->

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



	<?php foreach ($ap as $c) {
	?>

		<div class="modal fade" id="modal-bukti<?= $c['id_pengeluaran'] ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Attachment </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- <form action="<?= base_url('superadmin/role/addRole') ?>" method="POST"> -->
						<div class="col-md-12">
							<img src="https://tesla-smartwork.transtama.com/uploads/ap/<?= $c['attachment'] ?>" alt="attachment" width="100%">

						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<!-- </form> -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<?php } ?>

	<?php foreach ($ap as $c) {
	?>

		<div class="modal fade" id="modal-edit<?= $c['id_pengeluaran'] ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edit <?= $c['description'] ?> </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('finance/ap/edit') ?>" method="POST" enctype="multipart/form-data">
							<div class="col-md-12">
								<label for="description">Description</label>
								<input type="text" name="description" class="form-control" value="<?= $c['description'] ?>">
							</div>
							<div class="col-md-12">
								<label for="description">Amount Proposed</label>
								<input type="text" name="amount_proposed" class="form-control" value="<?= $c['amount_proposed'] ?>">
							</div>

							<div class="col-md-6">
								<label for="note_cs">Change Attachment</label>
								<div class="form-group rec-element-ap">
									<input type="file" class="form-control" name="attachment">
									<input type="text" class="form-control" name="attachment_lama" hidden value="<?= $c['attachment'] ?>">
									<input type="text" class="form-control" name="id_pengeluaran" hidden value="<?= $c['id_pengeluaran'] ?>">
									<input type="text" class="form-control" name="no_pengeluaran" hidden value="<?= $c['no_pengeluaran'] ?>">
								</div>
							</div>

							<div class="col-md-6">
								<img src="<?= base_url('uploads/ap/' . $c['attachment']) ?>" alt="attachment" width="100%">
							</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<?php } ?>

	<div class="modal fade" id="modal-decline">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Void <?= $info['no_pengeluaran'] ?> </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('finance/ap/void') ?>" method="POST">
						<div class="col-md-12">
							<label for="reason">Void Reason</label>
							<textarea name="reason" class="form-control"></textarea>
							<input type="text" class="form-control" name="no_pengeluaran" hidden value="<?= $info['no_pengeluaran'] ?>">
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