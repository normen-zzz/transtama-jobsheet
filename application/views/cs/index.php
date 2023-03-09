<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Dashboard-->
		<!--begin::Row-->

		<div class="row">
			<div class="col-xl-6">
				<!--begin::Stats Widget 30-->
				<a href="<?= base_url('cs/salesOrder') ?>">
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
				<a href="<?= base_url('cs/jobsheet') ?>">
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

		<div class="row">

			<div class="col">
				<div>
					<canvas id="chartDashboard"></canvas>
				</div>



				<script>
					const ctx = document.getElementById('chartDashboard');

					new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],

							datasets: [{
								label: '# of Votes',
								data: [12, 19, 3, 5, 2, 3],
								borderWidth: 1,
								backgroundColor: ["red", "blue", "green"],
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				</script>
			</div>

		</div>


	</div>
	<!--end::Container-->
</div>