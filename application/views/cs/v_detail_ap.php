	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title"><?= $title ?></h2>
							<p class="text-black">Nomor Ap : <?= $this->uri->segment(4) ?></p>
							<?php if ($info['no_ca'] != NULL || $info['no_ca'] != '') { ?>
								<p class="text-black">Nomor CA : <a target="_blank" href="<?= base_url('cs/Ap/detail/' . $info['no_ca']) ?>"><?= $info['no_ca'] ?></a></p>
							<?php } ?>

							<div class="card-toolbar">
								<a href="<?= base_url('cs/ap') ?>" class="btn mr-2 text-light" style="background-color: #9c223b;">
									<i class="fas fa-chevron-circle-left text-light"> </i>
									Back
								</a>
								<?php $approvesm = $this->db->get_where('tbl_approve_pengeluaran', array('no_pengeluaran' => $this->uri->segment(4)))->row_array(); ?>
								<?php if ($approvesm['approve_by_sm'] == NULL && $info['is_approve_sm'] == 1) { ?>
									<a href="<?= base_url('cs/ap/approve/' . $this->uri->segment(4)) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;">Approve</a>
								<?php } ?>

							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body" style="overflow: auto;">
							<div class="card-body p-0">
								<!--begin: Wizard-->

								<div class="row justify-content-center">
									<div class="col-xl-12 col-xxl-7">
										<!--begin: Wizard Form-->
										<form action="<?= base_url('cs/ap/processAddDetail') ?>" method="POST" enctype="multipart/form-data">
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


											</div>

											<!--begin: Wizard Step 1-->
											<?php if ($info['status'] <= 0) {
											?>

												<?= $this->session->userdata('message') ?>
												<!--begin::Input-->



											<?php	} ?>

											<div class="card-body" style="overflow: auto;">
												<h3>List <?= $info['nama_kategori'] ?></h3>
												<div class="row">
													<table class="table table-separate table-head-custom table-checkable" id="myTable3">
														<tr>
															<td>Category</td>
															<td>Description</td>
															<td>Amount Proposed</td>
															<td>Attachment</td>
														</tr>
														<?php $total = 0;
														foreach ($ap as $c) {
														?>
															<tr>
																<td><?= $c['nama_kategori'] ?></td>
																<td><?= $c['description'] ?></td>
																<td><?= rupiah($c['amount_proposed']) ?></td>
																<td>
																	<?php if ($info['status'] <= 0) {
																	?>
																		<a data-toggle="modal" data-target="#modal-bukti<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Attacment</a>

																	<?php	} else {
																	?>
																		<a data-toggle="modal" data-target="#modal-bukti<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;">Attacment</a>
																		<?php if ($this->session->userdata('id_jabatan') == 10) { ?>
																			<a data-toggle="modal" data-target="#modal-edit<?= $c['id_pengeluaran'] ?>" class=" btn btn-sm text-light mt-1" style="background-color: #9c223b;"> <i class="fa fa-edit text-light"></i> Edit</a>
																		<?php } ?>

																	<?php $total += $c['amount_proposed'];
																	} ?>
																</td>
															</tr>

														<?php } ?>

													</table>
												</div>

											</div>

											<!--end: Wizard Step 1-->

											<!--begin: Wizard Actions-->

											<!--end: Wizard Actions-->
										</form>
										<div class="row">
											<div class="col-md-3" id="car3">
												<label for="note_cs">Total Proposed</label>
												<input class="form-control" type="text" name="total_expanses" disabled value="<?= rupiah($total); ?>">

											</div>

											<?php if (strtok($info['no_pengeluaran'], '-') == 'CAR') { ?>
												<div class="col-md-3" id="car3">
													<label for="note_cs">Total Approved CA</label>
													<?php $ca = $this->db->get_where('tbl_pengeluaran', array('no_pengeluaran' => $info['no_ca']))->row_array() ?>
													<input class="form-control" type="text" name="total_expanses" disabled value="<?= rupiah($ca['total_approved']); ?>">

												</div>
												<div class="col-md-3" id="car3">
													<label for="note_cs">Over/Less</label>

													<input class="form-control" type="text" name="total_expanses" disabled value="<?= rupiah($total - $ca['total_approved']); ?>">

												</div>
											<?php 	} ?>

										</div>
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
						<form action="<?= base_url('superadmin/role/addRole') ?>" method="POST">
							<div class="col-md-12">
								<img src="https://tesla-smartwork.transtama.com/uploads/ap/<?= $c['attachment'] ?>" alt="attachment" width="100%" height="350">

							</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</form>
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
						<form action="<?= base_url('cs/ap/edit') ?>" method="POST" enctype="multipart/form-data">
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
								<img src="https://tesla-smartwork.transtama.com/uploads/ap/<?= $c['attachment'] ?>" alt="attachment" width="100%">

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