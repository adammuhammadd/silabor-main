<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>kepala_upt_lab/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Bebas Lab</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body d-flex">
				<div class="container-fluid d-flex flex-column">

					<div class="card">
						<div class="card-header">
							<h5>Permintaan Bebas Lab Yang Belum Dikonfirmasi Kepala UPT Lab</h5>
						</div>

						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-4">Nama</th>
										<th class="col-4">Kode Permohonan</th>
										<th class="col-1 text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($bebas_lab->result() as $list_bebas_lab) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $list_bebas_lab->nama_lengkap ?></td>
											<td><?= $list_bebas_lab->kode_permohonan; ?></td>
											<td>
													<div class="d-flex justify-content-center gap-1">
														<a href="<?= base_url('kepala_upt_lab/bebas_lab/detail/') . $list_bebas_lab->id_permohonan_bebas_lab ?>">
															<button class="btn btn-primary detail" name="bebas-lab" id="<?= $list_bebas_lab->id_permohonan_bebas_lab ?>">Detail</button>
														</a>
													</div>
											</td>
										</tr>
									<?php } ?>

								</tbody>
							</table>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>