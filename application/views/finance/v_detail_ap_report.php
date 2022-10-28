<style type="text/css">
	.txtedit {
		display: none;
		width: 98%;
	}
</style>
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
							<!-- <a target="blank" href="<?= base_url('finance/ap/print/' . $info['no_pengeluaran']) ?>" class="btn btn-sm mb-1 text-light" style="background-color: #9c223b;"> <i class="fa fa-print text-light"></i> Print</a> -->
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
													<textarea class="form-control" required disabled name="purpose"><?= $info['purpose'] ?></textarea>
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
														<th>Amount</th>
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
															<td>
																<span class="edit"><?= rupiah($c['amount_approved']) ?></span>
																<input type="text" name="amount_approved[]" data-id="<?= $c['id_pengeluaran'] ?>" data-url='<?= base_url() ?>/finance/Report/editApSatuanAjax' data-field='amount_approved' id='amount_approvedtxt_<?= $c['amount_approved'] ?>' value='<?= $c['amount_approved'] ?>' class="form-control txtedit">
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


												</table>
											</div>
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