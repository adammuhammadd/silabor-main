<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>laboran/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item">Pengembalian Alat</li>
					<li class="breadcrumb-item active">Detail</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="container-fluid">

					<div class="card-body table-responsive p-0">
						<table class="table-striped table table-bordered" class="display">
							<tr>
								<td colspan="2" class="bg-primary text-center">
									<h5>DATA PEMINJAM ALAT</h5>
								</td>
							</tr>
							<tr>
								<td class="col-3">
									<h6>Nama</h6>
								</td>
								<td class="col-9">
									<h6><?= $user->nama_lengkap ?></h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>NIM</h6>
								</td>
								<td>
									<h6><?= $user->nim ?></h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>Level</h6>
								</td>
								<td>
									<h6><?= $user->is_level ?></h6>
								</td>
							</tr>
						</table>
						<div class="d-flex justify-content-end px-3 mt-3">
							<div class="d-flex gap-3">
								<button class="btn btn-primary btn-terima" type="button" data-bs-toggle="modal" data-bs-target="#modal-terima">Alat telah dikembalikan?</button>
							</div>
						</div>
					</div>

					<hr>

					<div class="card mt-5">
						<div class="card-header">
							<div class="d-flex justify-content-between">
								<h5 class="left-0">Daftar Alat Yang Ingin Dikembalikan</h5>
							</div>
						</div>
						<div class="card-body table-responsive">
							<table class="table table-striped table-bordered dataTables " class="display">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-6">Nama Alat</th>
										<th class="col-2">Jumlah Alat</th>
										<th class="col-3">Kondisi</th>
									</tr>
								</thead>
								<tbody>

									<?php $no = 1;
									foreach ($data as $list_alat) { ?>
										<tr class="alat">
											<td><?= $no++ ?></td>
											<td><?= $list_alat->nama_alat ?></td>
											<td><?= $list_alat->jml_alat ?></td>
											<td>
												<div>
													<input type="text" name="id_pinjam" class="id_pinjam" hidden value="<?= $list_alat->id_pinjam ?>">
													<select class="form-select col-sm-12 kondisi" name="kondisi" required>
														<option disabled selected value> -- pilih -- </option>
														<option value="Baik">Baik</option>
														<option value="Rusak">Rusak</option>
														<option value="Hilang">Hilang</option>
													</select>
												</div>
											</td>
										</tr>
									<?php	} ?>

								</tbody>
							</table>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modal-terima" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Terima Pengajuan</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form id="form-index">
				<div class="modal-body grid-showcase">
					<div id="body-modal"></div>
				</div>
				<div class="notif mx-3"></div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary ya-terima" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>