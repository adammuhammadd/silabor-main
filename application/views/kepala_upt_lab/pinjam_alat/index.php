<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>mahasiswa/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body d-flex">
				<div class="container-fluid">

					<div class="card">
						<div class="card-header">
							<h5>Permintaan Pinjam Alat Yang Belum Dikonfirmasi Kepala UPT Lab</h5>
						</div>

						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-3">Nama</th>
										<th class="col-3">Kode Permohonan</th>
										<th class="col-1">Level User</th>
										<th class="col-1 text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($data as $list_data) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $list_data->nama_lengkap ?></td>
											<td><?= $list_data->kode_pinjam; ?></td>
											<td><?= $list_data->is_level ?></td>
											<td>
												<div class="d-flex justify-content-center gap-1">
													<a href="<?= base_url('kepala_upt_lab/pinjam_alat/detail/') . $list_data->id_permohonan_pinjam_alat ?>">
														<button class="btn btn-primary detail" name="bebas-lab">Detail</button>
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