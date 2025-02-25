<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Dashboard-->
		<!--begin::Row-->
		<div class="card card-custom gutter-b example example-compact">
			<form action="<?= base_url('cs/apExternal/createAp') ?>" method="POST">
				<input type="text" hidden name="id_vendor" value="<?= $vendor['id_vendor'] ?>">
				<div class="card-body">
					<div class="content-header">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<center>
									<h3 class="page-title text-center">AP <?= $vendor['nama_vendor']
																			?> </h3>
								</center>
								<div class="d-inline-block align-items-center">
									<a href="<?= base_url('cs/apExternal') ?>" class="btn text-light" style="background-color: #9c223b;">
										<i class="fa fa-arrow-left"></i>
										Back</a>

									<button type="submit" class="btn btn-sm text-light mb-1" style="background-color: #9c223b;">
										<span class="fa fa-plus">
										</span> Add Shipment</button>
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
											<table class="table table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>#</th>
														<th>AWB</th>
														<th>DATE</th>
														<th>DEST</th>
														<th>FLIGHT SMU</th>
														<!-- <th>Sewa Gudang</th> -->
														<!-- <th>Wrapping</th> -->
														<!-- <th>Refund %</th> -->
														<!-- <th>Insurance</th> -->
														<!-- <th>Surcharge</th> -->
														<!-- <th>Hand CGK</th> -->
														<!-- <th>Hand Pickup/Delivery</th> -->
														<th>HD Daerah</th>
														<!-- <th>PPH %</th> -->
														<!-- <th>SDM</th> -->
														<th>Others</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$total_koli = 0;
													$total_weight = 0;
													$total_special_weight = 0;
													$total_amount = 0;
													$amount = 0;
													// $pph = 0;
													foreach ($invoice as $inv) {
														$total_sales = 0;
														$no = 1;

													?>
														<tr>

															<td><input type="checkbox" name="shipment_id[]" value="<?= $inv['id'] ?>" class="form-control"> </td>
															<td><?= $inv['resi'] ?></td>
															<td><?= bulan_indo($inv['tgl_pickup']) ?></td>
															<td><?= $inv['tree_consignee'] ?></td>
															<td><?= rupiah($inv['flight_msu2']) ?></td>
															<!-- <td><?= rupiah($inv['ra2']) ?></td>
                                                            <td><?= rupiah($inv['packing2']) ?></td> -->
															<!-- <td><?= rupiah($inv['refund2']) ?></td> -->
															<!-- <td><?= rupiah($inv['insurance2']) ?></td>
                                                            <td><?= rupiah($inv['surcharge2']) ?></td> -->
															<!-- <td><?= rupiah($inv['hand_cgk2']) ?></td> -->
															<!-- <td><?= rupiah($inv['hand_pickup2']) ?></td> -->
															<td><?= rupiah($inv['hd_daerah2']) ?></td>
															<!-- <td><?= rupiah($inv['pph2']) ?></td> -->
															<!-- <td><?= rupiah($inv['sdm2']) ?></td> -->
															<td><?= rupiah((int)$inv['others2']) ?></td>

															<td> <a href="<?= base_url('cs/ApExternal/editCapitalCost/' . $inv['id'] . '/' . $this->uri->segment(4)) ?>" class=" btn btn-sm text-light" style="background-color: #9c223b;">Edit Capital Cost</a></td>

														</tr>

													<?php
														$total_koli = $total_koli + $inv['koli'];
														$total_weight = $total_weight + $inv['berat_js'];
														$total_special_weight = $total_special_weight + $inv['berat_msr'];
														$amount = $amount + $total_sales;
														$no++;
													} ?>


												</tbody>


											</table>

										</div>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
					</section>
				</div>
			</form>
		</div>
	</div>
</div>