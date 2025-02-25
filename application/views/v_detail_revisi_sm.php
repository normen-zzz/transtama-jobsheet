<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<meta name="description" content="Shipper Apps Transtama Logistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?= base_url('assets/') ?>back/metronic2/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/back/') ?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/') ?>back/metronic2/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="<?= base_url('uploads/') ?>LogoRaw.png" />
	<style>
		/* @media (max-width: 575.98px) { ... } */
		@media screen and (max-width: 600px) {
			#chat {
				display: none;
			}
		}

		.select2-selection__rendered {
			line-height: 31px !important;
		}

		.select2-container .select2-selection--single {
			height: 40px !important;
		}

		.select2-selection__arrow {
			height: 34px !important;
		}
	</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!--begin::Main-->
	<!--begin::Header Mobile-->

	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->


		<!-- Main content -->

		<section class="content">
			<div class="container-fluid">
				<div class="card card-custom gutter-b example example-compact">
					<div class="card-body">
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-12">
									<div class="box">
										<div class="box-header with-border text-center">
											<h2 class="box-title with-border font-weight-bold">
												DETAIL REQUEST REVISION
											</h2>
											<h4 class="box-title with-border font-weight-bold">
												<?= $title; ?>
											</h4>
										</div>
										<!-- /.box-header -->
										<div class="box-body">
											<div class="table-responsive">
												<table class="table table-bordered" style="width:100%">
													<thead>
														<tr>
															<th>Pickup Date</th>
															<th>Shipment ID</th>
															<th>SO Number</th>
															<th>Customer</th>
															<th>Consignee</th>
															<!-- <th>Destination</th> -->
															<th>Service</th>
															<th>Comm</th>
															<!-- <th>Shipper</th> -->
															<!-- <th>No. Flight</th>
                                                    <th>No. SMU</th> -->
															<th>Colly</th>
															<th>Destination</th>
															<!-- <th>WEIGHT JS(Kg)</th> -->
															<!-- <th>Freight</th> -->
															<th>Sales</th>
															<!-- <th>Status</th> -->
															<!-- <th>Note</th> -->
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?= bulan_indo($msr['tgl_pickup']) ?></td>
															<td><?= $msr['shipment_id'] ?></td>
															<td>SO-<?= $msr['shipment_id'] ?></td>
															<td><?= $msr['shipper'] ?></td>
															<td><?= $msr['consigne'] ?></td>
															<!-- <td><?= $msr['destination'] ?></td> -->
															<td><?= $msr['service_name'] ?></td>
															<td><?= $msr['pu_commodity'] ?></td>
															<!-- <td><?= $msr['id_user'] ?></td> -->
															<!-- <td> <input type="text" class="form-control" value="<?= $msr['no_flight'] ?>"> </td>
                                                    <td> <input type="text" class="form-control" value="<?= $msr['no_smu'] ?>"> </td> -->
															<!-- <td></td> -->
															<td><?= $msr['koli'] ?></td>
															<td><?= $msr['destination'] ?></td>
															<!-- <td><?= $msr['berat_msr'] ?></td> -->
															<!-- <td><?= $msr['berat_js'] ?></td> -->
															<!-- <td><?= rupiah($msr['freight_kg']) ?></td> -->

															<td><?= $msr['nama_user'] ?></td>
															<!-- <td><?= $msr['pu_note'] ?></td> -->
														</tr>

													</tbody>

												</table>
											</div>

											<div class="table-responsive">
												<form action="<?= base_url('cs/jobsheet/updateso') ?>" method="POST">
													<table class="table table-bordered" style="width:100%">
														<thead>
															<tr>

																<th>WEIGHT JS/MSR</th>
																<th>WEIGHT SPECIAL HD</th>
															</tr>
														</thead>
														<tbody>
															<tr>



<td><?= $msr['berat_js'] ?></td>
																<td><?= $msr['berat_msr'] ?></td>
																
															</tr>

														</tbody>

													</table>
													<?php if ($msr['status_so'] == 2) {
													?>
														<!-- <button class="btn btn-success">Submit</button> -->
													<?php } ?>
												</form>
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

				<?php if ($so_lama) {
				?>
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-body">
							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-12">
										<div class="box">
											<div class="box-header with-border">
												<h4 class="box-title with-border text-success text-center">
													<i class="fas fa-dollar-sign text-success"></i> Old Sales Order
												</h4>

											</div>
											<!-- /.box-header -->
											<div class="box-body">
												<div class="table-responsive">
													<table class="table table-bordered" style="width:100%">
														<thead>
															<tr>
																<th><b>Description</b> </th>
																<th>Freight/KG</th>
																<th>Special Freight</th>
																<th>Packing</th>
																<th>Others</th>
																<th>Surcharge</th>
																<th>Insurance</th>
																<th>Disc.</th>
																<th>Cn</th>
																<th>Special Cn</th>
																<th>Action</th>

															</tr>
														</thead>
														<tbody>
															<!--berart js = weight js/msr-->
															<!--berat_msr= special_freight-->
															<?php
															$service =  $msr['service_name'];
															if ($service == 'Charter Service') {
																$packing = $so_lama['packing_lama'];
																$total_sales = ($so_lama['freight_lama'] + $packing +  $so_lama['special_freight_lama'] +  $so_lama['others_lama'] + $so_lama['surcharge_lama'] + $so_lama['insurance_lama']);
															} else {
																$disc = $so_lama['disc_lama'];
																// kalo gada disc
																if ($disc == 0) {
																	$freight  = $msr['berat_js'] * $so_lama['freight_lama'];
																	$special_freight  = $msr['berat_msr'] * $so_lama['special_freight_lama'];
																} else {
																	$freight_discount = $so_lama['freight_lama'] * $disc;
																	$special_freight_discount = $so_lama['special_freight_lama'] * $disc;

																	$freight = $freight_discount * $msr['berat_js'];
																	$special_freight  = $special_freight_discount * $msr['berat_msr'];
																}

																$packing = $so_lama['packing_lama'];
																$total_sales = ($freight + $packing + $special_freight +  $so_lama['others_lama'] + $so_lama['surcharge_lama'] + $so_lama['insurance_lama']);
																$total_sales = $total_sales;
															}
															?>
															<tr>
																<td>
																	<i><b> Value</b></i>
																</td>
																<td>
																	<?= rupiah($so_lama['freight_lama']) ?>
																</td>
																<td>
																	<?= rupiah($so_lama['packing_lama']) ?>
																</td>
																<td>
																	<?= rupiah($so_lama['special_freight_lama']) ?>
																</td>
																<td>
																	<?= rupiah($so_lama['others_lama']) ?>
																</td>
																<td>
																	<?= rupiah($so_lama['surcharge_lama']) ?>
																</td>
																<td>
																	<?= rupiah($so_lama['insurance_lama']) ?>
																</td>
																<td>
																	<?= $so_lama['disc_lama'] ?> / <?= $so_lama['disc_lama'] * 100 ?> %
																</td>
																<td>
																	<?= $so_lama['cn_lama'] ?> / <?= $so_lama['cn_lama'] * 100 ?> %
																</td>
																<td>
																	<?= rupiah($so_lama['special_cn_lama']) ?>
																</td>
																<td></td>
															</tr>
															<tr>
																<td>
																	<i><b> Total Sales</b></i>
																</td>
																<td colspan="7"> <?= rupiah($total_sales) ?> </td>

															</tr>

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
				<?php  } else {
				?>

					<div class="card card-custom gutter-b example example-compact">
						<div class="card-body">
							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-12">
										<div class="box">
											<div class="box-header with-border">
												<h4 class="box-title with-border text-success text-center">
													<i class="fas fa-dollar-sign text-success"></i> Old Sales Order
												</h4>

											</div>
											<!-- /.box-header -->
											<div class="box-body">
												<div class="table-responsive">
													<table class="table table-bordered" style="width:100%">
														<thead>
															<tr>
																<th><b>Description</b> </th>
																<th>Freight/KG</th>
																<th>Special Freight</th>
																<th>Packing</th>
																<th>Others</th>
																<th>Surcharge</th>
																<th>Insurance</th>
																<th>Disc.</th>
																<th>Cn</th>
																<th>Special Cn</th>
																<th>Action</th>

															</tr>
														</thead>
														<tbody>
															<!--berart js = weight js/msr-->
															<!--berat_msr= special_freight-->
															<?php
															$service =  $msr['service_name'];
															if ($service == 'Charter Service') {
																$packing = $msr['packing'];
																$total_sales = ($msr['freight_kg'] + $packing +  $msr['special_freight'] +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
															} else {
																$disc = $msr['disc'];
																// kalo gada disc
																if ($disc == 0) {
																	$freight  = $msr['berat_js'] * $msr['freight_kg'];
																	$special_freight  = $msr['berat_msr'] * $msr['special_freight'];
																} else {
																	$freight_discount = $msr['freight_kg'] * $disc;
																	$special_freight_discount = $msr['special_freight'] * $disc;

																	$freight = $freight_discount * $msr['berat_js'];
																	$special_freight  = $special_freight_discount * $msr['berat_msr'];
																}

																$packing = $msr['packing'];
																$total_sales = ($freight + $packing + $special_freight +  $msr['others'] + $msr['surcharge'] + $msr['insurance']);
																$total_sales = $total_sales;
															}
															?>
															<tr>
																<td>
																	<i><b> Value</b></i>
																</td>
																<td>
																	<?= rupiah($msr['freight_kg']) ?>
																</td>
																<td>
																	<?= rupiah($msr['special_freight']) ?>
																</td>
																<td>
																	<?= rupiah($msr['packing']) ?>
																</td>
																<td>
																	<?= rupiah($msr['others']) ?>
																</td>
																<td>
																	<?= rupiah($msr['surcharge']) ?>
																</td>
																<td>
																	<?= rupiah($msr['insurance']) ?>
																</td>
																<td>
																	<?= $msr['disc'] ?> / <?= $msr['disc'] * 100 ?> %
																</td>
																<td>
																	<?= $msr['cn'] ?> / <?= $msr['cn'] * 100 ?> %
																</td>
																<td>
																	<?= rupiah($msr['special_cn']) ?>
																</td>
																<td></td>
															</tr>
															<tr>
																<td>
																	<i><b> Total Sales</b></i>
																</td>
																<td colspan="7"> <?= rupiah($total_sales) ?> </td>

															</tr>

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
				<?php  } ?>


				<div class="card card-custom gutter-b example example-compact">
					<div class="card-body">
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-12">
									<div class="box">
										<div class="box-header with-border">
											<h4 class="box-title with-border text-danger text-center">
												<i class="fas fa-dollar-sign text-danger"></i> New Sales Order
											</h4>

										</div>
										<!-- /.box-header -->
										<div class="box-body">
											<div class="table-responsive">
												<table class="table table-bordered" style="width:100%">
													<thead>
														<tr>
															<th><b>Description</b> </th>
															<th>Freight/KG</th>
															<th>Special Freight</th>
															<th>Packing</th>
															<th>Others</th>
															<th>Surcharge</th>
															<th>Insurance</th>
															<th>Disc.</th>
															<th>Cn</th>
															<th>Special Cn</th>
															<th>Action</th>

														</tr>
													</thead>
													<tbody>
														<!--berart js = weight js/msr-->
														<!--berat_msr= special_freight-->
														<?php
														$service =  $msr['service_name'];
														// if ($service == 'Charter Service') {
														//     $total_sales_new = $request['freight_baru'];
														// } else {
														//     $disc = $request['disc_baru'];
														//     // kalo gada disc
														//     if ($disc == 0) {
														//         $freight  = $msr['berat_js'] * $request['freight_baru'];
														//         $special_freight  = $msr['berat_msr'] * $request['special_freight_baru'];
														//     } else {
														//         $freight_discount = $request['freight_baru'] * $disc;
														//         $special_freight_discount = $request['special_freight_baru'] * $disc;

														//         $freight = $freight_discount * $msr['berat_js'];
														//         $special_freight  = $special_freight_discount * $msr['berat_msr'];
														//     }

														//     // var_dump($freight);
														//     // die;

														//     $packing = $request['packing_baru'] * $msr['berat_js'];
														//     $total_sales_new = ($freight + $packing + $special_freight +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
														//     $total_sales_new = $total_sales_new;

														$service =  $msr['service_name'];
														if ($service == 'Charter Service') {
															$packing = $request['packing_baru'];
															$total_sales_new = ($request['freight_baru'] + $packing +  $request['special_freight_baru'] +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
														} else {
															$disc = $request['disc_baru'];
															// kalo gada disc
															if ($disc == 0) {
																$freight  = $msr['berat_js'] * $request['freight_baru'];
																$special_freight  = $msr['berat_msr'] * $request['special_freight_baru'];
															} else {
																$freight_discount = $request['freight_baru'] * $disc;
																$special_freight_discount = $request['special_freight_baru'] * $disc;

																$freight = $freight_discount * $msr['berat_js'];
																$special_freight  = $special_freight_discount * $msr['berat_msr'];
															}

															$packing = $request['packing_baru'];
															$total_sales_new = ($freight + $packing + $special_freight +  $request['others_baru'] + $request['surcharge_baru'] + $request['insurance_baru']);
															$total_sales_new = $total_sales_new;
														}
														?>
														<tr>
															<td>
																<i><b> Value</b></i>
															</td>
															<td>
																<?= rupiah($request['freight_baru']) ?>
															</td>
															<td>
																<?= rupiah($request['special_freight_baru']) ?>
															</td>
															<td>
																<?= rupiah($request['packing_baru']) ?>
															</td>
															<td>
																<?= rupiah($request['others_baru']) ?>
															</td>
															<td>
																<?= rupiah($request['surcharge_baru']) ?>
															</td>
															<td>
																<?= rupiah($request['insurance_baru']) ?>
															</td>
															<td>
																<?= $request['disc_baru'] ?> / <?= $request['disc_baru'] * 100 ?> %
															</td>
															<td>
																<?= $request['cn_baru'] ?> / <?= $request['cn_baru'] * 100 ?> %
															</td>
															<td>
																<?= rupiah($request['special_cn_baru']) ?>
															</td>
															<td></td>
														</tr>
														<tr>
															<td>
																<i><b> Total Sales</b></i>
															</td>
															<td colspan="5"> <?= rupiah($total_sales_new) ?> </td>

														</tr>
														<tr>
															<td>
																<i><b>Reason</b></i>
															</td>
															<td colspan="12">
																<?= $request['alasan'] ?>
															</td>
														</tr>

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

				<div class="card card-custom gutter-b example example-compact">
					<div class="card-body">
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-12">
									<div class="box">
										<div class="box-header with-border text-danger text-center">
											<h4 class="box-title with-border">
												<i class="fas fa-dollar-sign text-danger"></i> Capital Cost OLD
											</h4>

										</div>
										<!-- /.box-header -->
										<div class="box-body">




											<div class="table-responsive">
												<table class="table table-bordered" style="width:100%">
													<thead>
														<tr>
															<th><b>Description</b> </th>
															<th>Flight SMU</th>
															<th>Sewa Gudang</th>
															<th>Wrapping</th>
															<th>Refund %</th>
															<th>Special Refund (Rp.)</th>
															<th>Insurance</th>
															<th>Surcharge</th>
															<th>Hand CGK</th>
															<th>Hand Pickup/Delivery</th>
															<th>HD Daerah</th>
															<th>PPH %</th>
															<th>SDM</th>
															<th>Others</th>
															<th>Vendor/Agent</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$flight_smu = 0;
														$ra2 = 0;
														$packing2 = 0;
														$refund2 = 0;
														$special_refund2 = 0;
														$insurance2 = 0;
														$surcharge2 = 0;
														$handcgk2 = 0;
														$handpickup2 = 0;
														$pph2 = 0;
														$sdm2 = 0;
														$others2 = 0;

														$total_cost_old = 0;
														$hd_daerah2 = 0;
														if ($modal) {
															foreach ($modal as $m) {
																$vendoragent = $this->db->get_where('tbl_vendor', array('id_vendor' => $m['id_vendor']))->row_array();
														?>
																<tr>
																	<td> <i><b>Variabel</b></i> </td>
																	<td><?= rupiah($m['flight_msu2']) ?></td>
																	<td><?= rupiah($m['ra2']) ?></td>
																	<td><?= rupiah($m['packing2']) ?></td>
																	<td><?= $m['refund2'] ?> / <?= $m['refund2'] / 100 ?></td>
																	<td><?= rupiah($m['specialrefund2']) ?></td>
																	<td><?= rupiah($m['insurance2']) ?></td>
																	<td><?= rupiah($m['surcharge2']) ?></td>
																	<td><?= rupiah($m['hand_cgk2']) ?></td>
																	<td><?= rupiah($m['hand_pickup2']) ?></td>
																	<td><?= rupiah($m['hd_daerah2']) ?></td>
																	<td><?= $m['pph2'] ?></td>
																	<td><?= rupiah($m['sdm2']) ?></td>
																	<td><?= rupiah($m['others2']) ?></td>
																	<td><?php if ($vendoragent != NULL) {
																			echo $vendoragent['nama_vendor'];
																		}  ?></td>

																	<td>

																	</td>
																</tr>
																<?php
																if ($modal) {
																	$refund = $m['refund2'] / 100;
																	$pph = $m['pph2'] / 100;
																	$service =  $msr['service_name'];

																	$hd_daerah2 += $m['hd_daerah2'];
																	$flight_smu += $m['flight_msu2'];
																	$ra2 += $m['ra2'];
																	$packing2 += $m['packing2'];
																	$refund2 += $m['refund2'] / 100;
																	$special_refund2 += $m['specialrefund2'];
																	$insurance2 += $m['insurance2'];
																	$surcharge2 += $m['surcharge2'];
																	$handcgk2 += $m['hand_cgk2'];
																	$handpickup2 += $m['hand_pickup2'];
																	$pph2  += $m['pph2'];
																	$sdm2 += $m['sdm2'];
																	$others2 += $m['others2'];

																	if ($service == 'Charter Service') {
																		$total_cost_old += $m['flight_msu2'] + ($m['ra2']) + ($m['packing2']) +
																			($total_sales * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr'])  + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2']) +
																			($m['hand_pickup2']) + ($m['hd_daerah2']) + ($total_sales * $pph) +
																			$m['sdm2'] + $m['others2'];
																	} else {

																		// sdm
																		$sdm_biasa  = $msr['berat_js'] * $m['sdm2'];
																		$sdm_special  = $msr['berat_msr'] * $m['sdm2'];
																		$sdm = $sdm_biasa + $sdm_special;
																		// ra
																		$ra_biasa  = $msr['berat_js'] * $m['ra2'];
																		$ra_special  = $msr['berat_msr'] * $m['ra2'];
																		$ra = $ra_biasa + $ra_special;
																		// packing
																		$packing_biasa  = $msr['berat_js'] * $m['packing2'];
																		$packing_special  = $msr['berat_msr'] * $m['packing2'];
																		$packing = $packing_biasa + $packing_special;
																		// hand cgk
																		$hand_cgk_biasa  = $msr['berat_js'] * $m['hand_cgk2'];
																		$hand_cgk_special  = $msr['berat_msr'] * $m['hand_cgk2'];
																		$hand_cgk = $hand_cgk_biasa + $hand_cgk_special;
																		// hand pickup
																		$hand_pickup_biasa  = $msr['berat_js'] * $m['hand_pickup2'];
																		$hand_pickup_special  = $msr['berat_msr'] * $m['hand_pickup2'];
																		$hand_pickup = $hand_pickup_biasa + $hand_pickup_special;

																		$total_cost_old += $m['flight_msu2'] + $ra + $packing +
																			($total_sales * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr']) + $m['insurance2'] + $m['surcharge2'] + $hand_cgk +
																			$hand_pickup + $m['hd_daerah2'] + ($total_sales * $pph) +
																			$sdm + $m['others2'];
																	}
																} else {
																	$total_cost_old = 0;
																}

																?>
														<?php }
														} ?>




														<?php if ($modal) {
														?>

															<tr>
																<td>
																	<i><b> Accumulation</b></i>
																</td>
																<td>
																	<?= rupiah($flight_smu) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($ra2);
																	} else {
																		// ra
																		$ra_biasa  = $msr['berat_js'] * $ra2;
																		$ra_special  = $msr['berat_msr'] * $ra2;
																		$ra = $ra_biasa + $ra_special;
																		echo rupiah($ra);
																	}
																	?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($packing2);
																	} else {
																		$packing_biasa  = $msr['berat_js'] * $packing2;
																		$packing_special  = $msr['berat_msr'] * $packing2;
																		$packing = $packing_biasa + $packing_special;
																		echo rupiah($packing);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah($total_sales * $refund2) ?>
																</td>
																<td>
																	<?= rupiah(($special_refund2 * $msr['berat_js']) + ($special_refund2 * $msr['berat_msr'])) ?>
																</td>
																<td>
																	<?= rupiah($insurance2) ?>
																</td>
																<td>
																	<?= rupiah($surcharge2) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($handcgk2);
																	} else {
																		$hand_cgk_biasa  = $msr['berat_js'] * $handcgk2;
																		$hand_cgk_special  = $msr['berat_msr'] * $handcgk2;
																		$hand_cgk = $hand_cgk_biasa + $hand_cgk_special;
																		echo rupiah($hand_cgk);
																	}
																	?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($handpickup2);
																	} else {
																		$hand_pickup_biasa  = $msr['berat_js'] * $handpickup2;
																		$hand_pickup_special  = $msr['berat_msr'] * $handpickup2;
																		$hand_pickup = $hand_pickup_biasa + $hand_pickup_special;
																		echo rupiah($hand_pickup);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah(($hd_daerah2)) ?>
																</td>
																<td>
																	<?= rupiah($total_sales * ($pph2 / 100)) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($sdm2);
																	} else {
																		$sdm_biasa  = $msr['berat_js'] * $sdm2;
																		$sdm_special  = $msr['berat_msr'] * $sdm2;
																		$sdm = $sdm_biasa + $sdm_special;
																		echo rupiah($sdm);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah(($others2)) ?>
																</td>
																<td></td>
															</tr>
														<?php   } else {
														?>

															<tr>
																<td>
																	<i><b> Accumulation</b></i>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td></td>
															</tr>
														<?php  } ?>

														<?php if ($modal) {
														?>
															<tr>
																<td>
																	<i><b> Total Cost</b></i>
																</td>
																<td colspan="14"> <?= rupiah($total_cost_old) ?> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note PIC Jobsheet</b></i>
																</td>
																<td colspan="14"> <?= $m['note'] ?> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note Manager CS</b></i>
																</td>
																<td colspan="14"> <?= $m['note_mgr_cs'] ?> </td>

															</tr>
														<?php } else { ?>
															<tr>
																<td>
																	<i><b> Total Cost</b></i>
																</td>
																<td colspan="14"> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note PIC Jobsheet</b></i>
																</td>
																<td colspan="14"> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note Manager CS</b></i>
																</td>
																<td colspan="14"> </td>

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

				<div class="card card-custom gutter-b example example-compact">
					<div class="card-body">
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-12">
									<div class="box">
										<div class="box-header with-border text-danger text-center">
											<h4 class="box-title with-border">
												<i class="fas fa-dollar-sign text-danger"></i> Capital Cost New
											</h4>

										</div>
										<!-- /.box-header -->
										<div class="box-body">




											<div class="table-responsive">
												<table class="table table-bordered" style="width:100%">
													<thead>
														<tr>
															<th><b>Description</b> </th>
															<th>Flight SMU</th>
															<th>Sewa Gudang</th>
															<th>Wrapping</th>
															<th>Refund %</th>
															<th>Special Refund (Rp.)</th>
															<th>Insurance</th>
															<th>Surcharge</th>
															<th>Hand CGK</th>
															<th>Hand Pickup/Delivery</th>
															<th>HD Daerah</th>
															<th>PPH %</th>
															<th>SDM</th>
															<th>Others</th>
															<th>Vendor/Agent</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$flight_smu = 0;
														$ra2 = 0;
														$packing2 = 0;
														$refund2 = 0;
														$special_refund2 = 0;
														$insurance2 = 0;
														$surcharge2 = 0;
														$handcgk2 = 0;
														$handpickup2 = 0;
														$pph2 = 0;
														$sdm2 = 0;
														$others2 = 0;

														$total_cost = 0;
														$hd_daerah2 = 0;
														if ($modal) {
															foreach ($modal as $m) {
																$vendoragent = $this->db->get_where('tbl_vendor', array('id_vendor' => $m['id_vendor']))->row_array();
														?>
																<tr>
																	<td> <i><b>Variabel</b></i> </td>
																	<td><?= rupiah($m['flight_msu2']) ?></td>
																	<td><?= rupiah($m['ra2']) ?></td>
																	<td><?= rupiah($m['packing2']) ?></td>
																	<td><?= $m['refund2'] ?> / <?= $m['refund2'] / 100 ?></td>
																	<td><?= rupiah($m['specialrefund2']) ?></td>
																	<td><?= rupiah($m['insurance2']) ?></td>
																	<td><?= rupiah($m['surcharge2']) ?></td>
																	<td><?= rupiah($m['hand_cgk2']) ?></td>
																	<td><?= rupiah($m['hand_pickup2']) ?></td>
																	<td><?= rupiah($m['hd_daerah2']) ?></td>
																	<td><?= $m['pph2'] ?></td>
																	<td><?= rupiah($m['sdm2']) ?></td>
																	<td><?= rupiah($m['others2']) ?></td>
																	<td><?php if ($vendoragent != NULL) {
																			echo $vendoragent['nama_vendor'];
																		}  ?></td>

																	<td>

																	</td>
																</tr>
																<?php
																if ($modal) {
																	$refund = $m['refund2'] / 100;
																	$pph = $m['pph2'] / 100;
																	$service =  $msr['service_name'];

																	$hd_daerah2 += $m['hd_daerah2'];
																	$flight_smu += $m['flight_msu2'];
																	$ra2 += $m['ra2'];
																	$packing2 += $m['packing2'];
																	$refund2 += $m['refund2'] / 100;
																	$special_refund2 += $m['specialrefund2'];
																	$insurance2 += $m['insurance2'];
																	$surcharge2 += $m['surcharge2'];
																	$handcgk2 += $m['hand_cgk2'];
																	$handpickup2 += $m['hand_pickup2'];
																	$pph2  += $m['pph2'];
																	$sdm2 += $m['sdm2'];
																	$others2 += $m['others2'];

																	if ($service == 'Charter Service') {
																		$total_cost += $m['flight_msu2'] + ($m['ra2']) + ($m['packing2']) +
																			($total_sales * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr'])  + $m['insurance2'] + $m['surcharge2'] + ($m['hand_cgk2']) +
																			($m['hand_pickup2']) + ($m['hd_daerah2']) + ($total_sales_new * $pph) +
																			$m['sdm2'] + $m['others2'];
																	} else {

																		// sdm
																		$sdm_biasa  = $msr['berat_js'] * $m['sdm2'];
																		$sdm_special  = $msr['berat_msr'] * $m['sdm2'];
																		$sdm = $sdm_biasa + $sdm_special;
																		// ra
																		$ra_biasa  = $msr['berat_js'] * $m['ra2'];
																		$ra_special  = $msr['berat_msr'] * $m['ra2'];
																		$ra = $ra_biasa + $ra_special;
																		// packing
																		$packing_biasa  = $msr['berat_js'] * $m['packing2'];
																		$packing_special  = $msr['berat_msr'] * $m['packing2'];
																		$packing = $packing_biasa + $packing_special;
																		// hand cgk
																		$hand_cgk_biasa  = $msr['berat_js'] * $m['hand_cgk2'];
																		$hand_cgk_special  = $msr['berat_msr'] * $m['hand_cgk2'];
																		$hand_cgk = $hand_cgk_biasa + $hand_cgk_special;
																		// hand pickup
																		$hand_pickup_biasa  = $msr['berat_js'] * $m['hand_pickup2'];
																		$hand_pickup_special  = $msr['berat_msr'] * $m['hand_pickup2'];
																		$hand_pickup = $hand_pickup_biasa + $hand_pickup_special;

																		$total_cost += $m['flight_msu2'] + $ra + $packing +
																			($total_sales_new * $refund) + ($m['specialrefund2'] * $msr['berat_js']) + ($m['specialrefund2'] * $msr['berat_msr']) + $m['insurance2'] + $m['surcharge2'] + $hand_cgk +
																			$hand_pickup + $m['hd_daerah2'] + ($total_sales_new * $pph) +
																			$sdm + $m['others2'];
																	}
																} else {
																	$total_cost = 0;
																}

																?>
														<?php }
														} ?>




														<?php if ($modal) {
														?>

															<tr>
																<td>
																	<i><b> Accumulation</b></i>
																</td>
																<td>
																	<?= rupiah($flight_smu) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($ra2);
																	} else {
																		// ra
																		$ra_biasa  = $msr['berat_js'] * $ra2;
																		$ra_special  = $msr['berat_msr'] * $ra2;
																		$ra = $ra_biasa + $ra_special;
																		echo rupiah($ra);
																	}
																	?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($packing2);
																	} else {
																		$packing_biasa  = $msr['berat_js'] * $packing2;
																		$packing_special  = $msr['berat_msr'] * $packing2;
																		$packing = $packing_biasa + $packing_special;
																		echo rupiah($packing);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah($total_sales_new * $refund2) ?>
																</td>
																<td>
																	<?= rupiah(($special_refund2 * $msr['berat_js']) + ($special_refund2 * $msr['berat_msr'])) ?>
																</td>
																<td>
																	<?= rupiah($insurance2) ?>
																</td>
																<td>
																	<?= rupiah($surcharge2) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($handcgk2);
																	} else {
																		$hand_cgk_biasa  = $msr['berat_js'] * $handcgk2;
																		$hand_cgk_special  = $msr['berat_msr'] * $handcgk2;
																		$hand_cgk = $hand_cgk_biasa + $hand_cgk_special;
																		echo rupiah($hand_cgk);
																	}
																	?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($handpickup2);
																	} else {
																		$hand_pickup_biasa  = $msr['berat_js'] * $handpickup2;
																		$hand_pickup_special  = $msr['berat_msr'] * $handpickup2;
																		$hand_pickup = $hand_pickup_biasa + $hand_pickup_special;
																		echo rupiah($hand_pickup);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah(($hd_daerah2)) ?>
																</td>
																<td>
																	<?= rupiah($total_sales_new * ($pph2 / 100)) ?>
																</td>
																<td>
																	<?php
																	if ($service == 'Charter Service') {
																		echo  rupiah($sdm2);
																	} else {
																		$sdm_biasa  = $msr['berat_js'] * $sdm2;
																		$sdm_special  = $msr['berat_msr'] * $sdm2;
																		$sdm = $sdm_biasa + $sdm_special;
																		echo rupiah($sdm);
																	}
																	?>
																</td>
																<td>
																	<?= rupiah(($others2)) ?>
																</td>
																<td></td>
															</tr>
														<?php   } else {
														?>

															<tr>
																<td>
																	<i><b> Accumulation</b></i>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td>
																	<?= rupiah(0) ?>
																</td>
																<td></td>
															</tr>
														<?php  } ?>

														<?php if ($modal) {
														?>
															<tr>
																<td>
																	<i><b> Total Cost</b></i>
																</td>
																<td colspan="14"> <?= rupiah($total_cost) ?> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note PIC Jobsheet</b></i>
																</td>
																<td colspan="14"> <?= $m['note'] ?> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note Manager CS</b></i>
																</td>
																<td colspan="14"> <?= $m['note_mgr_cs'] ?> </td>

															</tr>
														<?php } else { ?>
															<tr>
																<td>
																	<i><b> Total Cost</b></i>
																</td>
																<td colspan="14"> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note PIC Jobsheet</b></i>
																</td>
																<td colspan="14"> </td>

															</tr>
															<tr>
																<td>
																	<i><b> Note Manager CS</b></i>
																</td>
																<td colspan="14"> </td>

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



				<div class="row">
					<div class="col-md-6">
						<div class="card card-custom gutter-b example example-compact">
							<div class="card-body">
								<section class="content">
									<div class="row">
										<div class="col-12">
											<div class="box">
												<h1 class="title text-success">Old Profit</h1>
												<div class="box-body">
													<div class="row">
														<div class="col-md-6">
															<h3><?php $profit = $total_sales - $total_cost_old;
																echo rupiah($profit);
																?></h3>

														</div>
														<div class="col-md-6">
															<?php if ($modal) {
															?>
																<h3><i class="fas fa-file-invoice-dollar text-primary"></i> <?= round($profit / $total_sales * 100, 0) ?> % </h3>

															<?php  } ?>
														</div>
													</div>

												</div>

											</div>

										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-custom gutter-b example example-compact">
							<div class="card-body">

								<section class="content">
									<div class="row">
										<div class="col-12">
											<div class="box">
												<div class="box-body">
													<h1 class="title text-danger">New Profit</h1>
													<div class="row">
														<div class="col-md-6">
															<h3><?php $profit_new = $total_sales_new - $total_cost;
																echo rupiah($profit_new);
																?></h3>
														</div>
														<div class="col-md-6">
															<?php if ($modal) {
															?>
																<h3><i class="fas fa-file-invoice-dollar text-primary"></i> <?= round($profit_new / $total_sales_new * 100, 0) ?> % </h3>

															<?php  } ?>
														</div>
													</div>

												</div>

											</div>

										</div>
									</div>
								</section>
							</div>
						</div>

					</div>
				</div>

				<div class="row">
					<?php
					$tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
					if ($request['status_revisi'] == 5 || $request['status_revisi'] == 6) {
					?>
						<div class="col-md-3">
							<div class="card card-custom gutter-b example example-compact" style="height:100px;">
								<h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
								<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
							</div>
						</div>
						<div class="col-md-3">
							<?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
							?>
								<div class="card card-custom gutter-b example example-compact" style="height:100px;">
									<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
									<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
								</div>
							<?php  } else {
							?>
								<div class="card card-custom gutter-b example example-compact" style="height:100px;">
									<?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
									?>
										<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
									<?php  } else {
									?>
										<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
									<?php  } ?>
									<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
								</div>
							<?php  } ?>
						</div>

						<div class="col-md-3">
							<?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
							?>
								<div class="card card-custom gutter-b example example-compact" style="height:100px;">
									<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
									<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
								</div>
							<?php  } else {
							?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
									<?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
									?>
										<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
									<?php  } else {
									?>
										<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By By GM</h3> <br>
									<?php  } ?>
									<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
								</div>

							<?php  } ?>
						</div>

						<?php  } else {
						$id_atasan = $this->session->userdata('id_atasan');
						// kalo dia atasan cs
						if ($id_atasan == 0 || $id_atasan == NULL) {
							$cek_approve_cs = $this->db->select('id_user_mgr')->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
							$tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
							// kalo dia ada
							if ($cek_approve_cs['id_user_mgr'] == NULL) {
						?>
								<div class="col-md-6">
									<div class="card card-custom gutter-b example example-compact" style="height:100px;">
										<div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/approveRevisiMgrCs/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
									</div>
								</div>
								<div class="col-md-6">
									<form action="<?= base_url('cs/jobsheet/declineRevisiMgrCs/') ?>" method="POST">
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<div class="row">
												<div class="col-md-7 ml-2">
													<label for="note_mgr font-weight-bold">Reason</label>
													<input type="text" name="id" hidden value="<?= $msr['id'] ?>">
													<textarea name="note_mgr" class="form-control"></textarea>
												</div>
												<div class="col-md-4 mt-8 ml-2">
													<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Decline Revision</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							<?php } else {
							?>
								<div class="col-md-4">
									<div class="card card-custom gutter-b example example-compact" style="height:100px;">
										<h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
										<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
									</div>
								</div>
								<div class="col-md-4">
									<?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
											<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
										</div>
									<?php  } else {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
											<?php  } else {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
											<?php  } ?>
											<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
										</div>
									<?php  } ?>
								</div>

								<div class="col-md-4">
									<?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
											<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
										</div>
									<?php  } else {
									?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
											<?php  } else {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h3> <br>
											<?php  } ?>
											<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
										</div>

									<?php  } ?>
								</div>



							<?php  } ?>

							<?php } else {
							// kalo dia pic jobsheet
							$cek_approve_cs = $this->db->select('id_user_cs')->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
							$tgl_approve_revisi = $this->db->get_where('tbl_approve_revisi_so', ['shipment_id' => $request['shipment_id']])->row_array();
							// kalo dia ada
							// var_dump($cek_approve_cs);
							// die;
							if ($cek_approve_cs['id_user_cs'] == NULL) {
							?>
								<div class="col-md-6">
									<div class="card card-custom gutter-b example example-compact" style="height:100px;">
										<div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/approveRevisiCs/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
									</div>
								</div>
								<!-- <div class="col-md-6">
                            <div class="card card-custom gutter-b example example-compact" style="height:100px;">
                                <div class="col-md-12 mt-8"> <a href="<?= base_url('cs/jobsheet/declineRevisiCs/' . $msr['id']) ?>" class="btn btn-danger tombol-konfirmasi">Decline Revision</a> </div>
                            </div>
                        </div> -->

							<?php } else {
							?>
								<div class="col-md-4">
									<div class="card card-custom gutter-b example example-compact" style="height:100px;">
										<h3 class="text-title text-center mt-2"> <i class="fa fa-check text-success"></i> Request Approve By PIC Jobsheet</h3> <br>
										<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_cs'] ?></h4>
									</div>
								</div>
								<div class="col-md-4">
									<?php if ($tgl_approve_revisi['id_user_mgr'] == NULL) {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait you to check request</h3> <br>
											<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
										</div>
									<?php  } else {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<?php if ($tgl_approve_revisi['status_approve_cs'] == 0) {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By Manager Cs</h3> <br>
											<?php  } else {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By Manager Cs</h3> <br>
											<?php  } ?>
											<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_mgr_cs'] ?> / <?= $tgl_approve_revisi['note_mgr_cs'] ?></h4>
										</div>
									<?php  } ?>
								</div>

								<div class="col-md-4">
									<?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
									?>
										<div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
											<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
										</div>
									<?php  } else {
									?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
											<?php if ($tgl_approve_revisi['status_approve_gm'] == 0) {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By GM</h3> <br>
											<?php  } else {
											?>
												<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By GM</h3> <br>
											<?php  } ?>
											<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4>
										</div>

									<?php  } ?>
								</div>





							<?php  } ?>

					<?php }
					}
					?>
					<div class="col-md-6">
						<?php if ($tgl_approve_revisi['id_sm'] == NULL) {
						?>
							<div class="card card-custom gutter-b example example-compact" style="height:100px;">
								<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait Senior Manager To Check Request</h3> <br>
								<!-- <h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_gm'] ?></h4> -->
							</div>
						<?php  } else {
						?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
								<?php if ($tgl_approve_revisi['status_approve_sm'] == 0) {
								?>
									<h3 class="text-title text-center mt-2"><i class="fa fa-window-close text-danger"></i> Request Decline By SM</h3> <br>
								<?php  } else {
								?>
									<h3 class="text-title text-center mt-2"><i class="fa fa-check text-success"></i> Request Approve By SM</h3> <br>
								<?php  } ?>
								<h4 class="text-title text-center"><?= $tgl_approve_revisi['tgl_approve_sm'] ?></h4>
							</div>

						<?php  } ?>
					</div>
					<div class="col-md-6">
						<?php if ($tgl_approve_revisi['id_user_gm'] == NULL) {
						?>
							<div class="card card-custom gutter-b example example-compact" style="height:100px;">
								<h3 class="text-title text-center mt-2"><i class="fa fa-calendar text-warning"></i> Wait GM Check Request</h3> <br>
							</div>
						<?php  } else {
						?> <div class="card card-custom gutter-b example example-compact" style="height:100px;">
								<?php if ($tgl_approve_revisi['id_sm'] == NULL) {
								?>
									<div class="row">
										<div class="col-md-6">
											<div class="card card-custom gutter-b example example-compact" style="height:100px;">
												<div class="col-md-12 mt-8"> <a href="<?= base_url('approval/approveRevisiSm/' . $msr['id']) ?>" class="btn btn-success tombol-konfirmasi">Approve Revision</a> </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="card card-custom gutter-b example example-compact" style="height:100px;">
												<div class="col-md-12 mt-8"> <a href="<?= base_url('approval/declineRevisiSm/' . $msr['id']) ?>" class="btn btn-danger tombol-konfirmasi">Decline Revision</a> </div>
											</div>
										</div>
									</div>
								<?php  }  ?>

							</div>

						<?php  } ?>
					</div>


				</div>

			</div>
			<!--/. container-fluid -->
		</section>
		<!-- /.content -->

	</div>
	<!--end::Content-->
	<!--begin::Footer-->
	<?php $this->load->view('templates/back/footer') ?>



	<!--begin::Chat Panel-->
	<div class="modal modal-sticky modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:<?= base_url('assets/back/metronic2/') ?>media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>
			var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1400
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#3699FF",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#8950FC",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#E4E6EF",
							"dark": "#181C32"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#E1F0FF",
							"secondary": "#EBEDF3",
							"success": "#C9F7F5",
							"info": "#EEE5FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#3F4254",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#EBEDF3",
						"gray-300": "#E4E6EF",
						"gray-400": "#D1D3E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#7E8299",
						"gray-700": "#5E6278",
						"gray-800": "#3F4254",
						"gray-900": "#181C32"
					}
				},
				"font-family": "Poppins"
			};
		</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<!-- jQuery 3 -->
		<script src="<?= base_url('assets/'); ?>back/plugins/jquery/jquery.js"></script>
		<script src="<?= base_url('assets/') ?>back/metronic2/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?= base_url('assets/') ?>back/metronic2/js/scripts.bundle.js"></script>
		<script src="<?= base_url('assets/back/metronic2/') ?>js/pages/crud/forms/editors/summernote.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>
		<script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/gmaps/gmaps.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url('assets/') ?>back/metronic2/js/pages/widgets.js"></script>
		<script src="<?= base_url('assets/') ?>back/metronic2/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Scripts-->
		<!-- Select2 -->
		<script src="<?= base_url('assets/back/') ?>plugins/select2/js/select2.min.js"></script>

		<script src="<?= base_url('assets/assets/backend/') ?>vendor_plugins/bootstrap-slider/bootstrap-slider.js"></script>
		<script src="<?= base_url('assets/assets/backend/') ?>vendor_components/OwlCarousel2/dist/owl.carousel.js"></script>
		<script src="<?= base_url('assets/assets/backend/') ?>vendor_components/flexslider/jquery.flexslider.js"></script>
		<script src="<?= base_url('assets/assets/') ?>js/sweetalert2.all.min.js"></script>
		<script src="//cdn.ckeditor.com/4.13.1/basic/ckeditor.js"></script>

</body>
<!--end::Body-->

</html>
<script type="text/javascript">
	$('select').select2({
		allowClear: true,
	});
</script>
<script>
	<?= $this->session->flashdata('messageAlert'); ?>
</script>



<?php
$dataflash = json_encode($this->session->flashdata('message'));
?>

<script>
	var flashData = <?= $dataflash ?>;
	if (flashData) {
		Swal.fire(flashData)
	}

	$('.tombol-hapus').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		const data = $(this).data('flashdata');
		Swal.fire({
			title: 'Apakah anda yakin',
			text: 'data ' + data + ' akan dihapus ?',
			showCancelButton: true,
			confirmButtonColor: '#0095cc',
			// confirmationButtonColor: '#0095cc',
			cancelButtonColor: '#ff562f',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.value) {
				document.location.href = href
			}
		})
	})

	$('.tombol-update').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		const data = $(this).data('flashdata');
		Swal.fire({
			title: 'Apakah anda yakin',
			text: 'data ' + data + ' akan diupdate ?',
			showCancelButton: true,
			confirmButtonColor: '#0095cc',
			// confirmationButtonColor: '#0095cc',
			cancelButtonColor: '#ff562f',
			confirmButtonText: 'Update'
		}).then((result) => {
			if (result.value) {
				document.location.href = href
			}
		})
	})
	$('.tombol-konfirmasi').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		const data = $(this).data('flashdata');
		Swal.fire({
			title: 'Apakah anda yakin',
			text: 'data ' + data + ' akan Proses ?',
			showCancelButton: true,
			confirmButtonColor: '#0095cc',
			// confirmationButtonColor: '#0095cc',
			cancelButtonColor: '#ff562f',
			confirmButtonText: 'Update'
		}).then((result) => {
			if (result.value) {
				document.location.href = href
			}
		})
	})

	$(document).ready(function() {

		var myTable = $('#myTable').DataTable({});
	});
</script>

<script>
	var flashData = <?= $dataflash ?>;
	if (flashData) {
		Swal.fire(flashData)
	}

	$('.tombol-konfirmasi').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		const data = $(this).data('flashdata');
		Swal.fire({
			title: 'Are you sure ?',
			// text: 'data ' + data + ' akan dihapus ?',
			showCancelButton: true,
			confirmButtonColor: '#0095cc',
			// confirmationButtonColor: '#0095cc',
			cancelButtonColor: '#ff562f',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				document.location.href = href
			}
		})
	})
</script>

<script>
	$('#table').DataTable({
		"ordering": false
	});
</script>

<script>
	$('#example1').DataTable({
		"ordering": false
	});
</script>





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