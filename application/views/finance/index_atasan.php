<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Dashboard-->
		<!--begin::Row-->

		<div class="row">
			<div class="col-xl-6">
				<!--begin::Stats Widget 30-->
				<a href="<?= base_url('finance/jobsheet') ?>">
					<div class="card" style="background-image: url(<?= base_url('assets/layout/br_cs1.png') ?>); background-size:cover;">
						<!--begin::Body-->
						<div class="card-body" style="height: 300px; width:300" style="background-size: cover;">
							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 m-10 d-block"><?= $so; ?></span>
							<!-- <span class="font-weight-bold text-white font-size-sm">SO Masuk</span> -->
							<!-- style="margin-top: 243px; margin-left:295px" -->
						</div>
						<!--end::Body-->
					</div>
				</a>
				<!--end::Stats Widget 30-->
			</div>
			<div class="col-xl-6">
				<!--begin::Stats Widget 30-->
				<a href="<?= base_url('finance/jobsheet/final') ?>">
					<div class="card" style="background-image: url(<?= base_url('assets/layout/br_cs2.png') ?>); background-size:cover;">
						<!--begin::Body-->
						<div class="card-body" style="height: 300px; width:300">
							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 m-10 d-block"><?= $js; ?></span>
							<!-- <span class="font-weight-bold text-white font-size-sm">SO Masuk</span> -->
						</div>
						<!--end::Body-->
					</div>
				</a>
				<!--end::Stats Widget 30-->
			</div>

		</div>

		<div class="row mt-4">
			<div class="col-xl-4">
				<!--begin::Stats Widget 16-->
				<a href="<?= base_url('finance/invoice') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $proforma ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Proforma Invoice</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 16-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 17-->
				<a href="<?= base_url('finance/invoice/final') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-dollar-sign text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $invoice ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Invoice</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 17-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 18-->
				<a href="<?= base_url('finance/invoice/final') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-check text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $invoice_paid ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Paid Invoice</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 18-->
			</div>

		</div>


		<div class="row mt-4">
			<div class="col-xl-3">
				<!--begin::Stats Widget 16-->
				<a href="<?= base_url('finance/ap') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $po ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Payment Order</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 16-->
			</div>
			<div class="col-xl-3">
				<!--begin::Stats Widget 16-->
				<a href="<?= base_url('finance/apExternal/created') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $po_ex ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Payment Order Agent/Vendor</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 16-->
			</div>
			<div class="col-xl-3">
				<!--begin::Stats Widget 17-->
				<a href="<?= base_url('finance/ap/ca') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $ca ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Cash Advance</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 17-->
			</div>
			<div class="col-xl-3">
				<!--begin::Stats Widget 18-->
				<a href="<?= base_url('finance/ap/car') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $car ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Cash Advance Report</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 18-->
			</div>
			<div class="col-xl-3">
				<!--begin::Stats Widget 18-->
				<a href="<?= base_url('finance/ap/re') ?>" class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
							<i class="fa fa-arrow-right text-danger"></i>
						</span>
						<div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5"><?= $re ?></div>
						<div class="font-weight-bold text-inverse-white font-size-sm">Reimbursment</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 18-->
			</div>

		</div>



	</div>
	<!--end::Container-->
</div>