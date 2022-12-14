<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>kepala_upt_lab/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item">Bebas Lab</li>
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
									<h5>DATA PERMOHONAN BEBAS LAB</h5>
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
								<td class="col-3">
									<h6>Fakultas</h6>
								</td>
								<td class="col-9">
									<h6><?= $user->fakultas ?></h6>
								</td>
							</tr>
							<td>
								<h6>Kode Permohonan</h6>
							</td>
							<td>
								<h6><?= $user->kode_permohonan ?></h6>
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
							<tr>
								<td>
									<h6>Status</h6>
								</td>
								<td>
									<h6><?= $user->status_kepala_upt ?></h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>File</h6>
								</td>
								<td>
									<a target="<?= base_url('upload/file_kompre/') . $user->file ?>" href="<?= base_url('upload/file_kompre/') . $user->file ?>">
										<img src="<?= base_url('upload/file_kompre/') . $user->file ?>" class="img img-thumbnail" width="70px">
									</a>
								</td>
							</tr>
						</table>
						<div class="d-flex justify-content-between px-3 mt-3">
							<div>
								<a class="btn btn-warning" href="<?= base_url('kepala_upt_lab/bebas_lab/form_bebas_lab/') . $user->id_permohonan_bebas_lab; ?>">Lihat Form Pengajuan</a>
							</div>
						</div>
					</div>

					<hr>

					<form enctype="multipart/form-data" id="form-index">
						<div class="modal-body grid-showcase">
							<div class="mb-3 d-flex flex-column gap-3">
								<div class="col">
									<label class="col-form-label">Nomor Surat:</label>
									<input class="form-control" name="nomor_surat" id="nomor_surat" type="text" required>
								</div>

							</div>
							<div class="notif"></div>
						</div>
					</form>

					<div class="d-flex gap-3">
								<button class="btn btn-danger btn-tolak" type="button" data-bs-toggle="modal" data-bs-target="#modal-tolak">Tolak Pengajuan</button>
								<button class="btn btn-primary btn-terima" type="button" data-bs-toggle="modal" data-bs-target="#modal-terima">Terima Pengajuan</button>
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
					<div id="body-modal">
						<p>Anda yakin ingin menerima pengajuan ?</p>
					</div>
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


<div class="modal fade" id="modal-tolak" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Tolak Pengajuan</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form>
				<div class="modal-body grid-showcase">
					<p>Anda yakin ingin menolak pengajuan ?</p>
				</div>
				<div class="notif mx-3"></div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary ya-tolak" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>