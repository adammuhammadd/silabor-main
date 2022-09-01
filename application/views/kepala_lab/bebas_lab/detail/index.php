<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>kepala_lab/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item">Bebas Lab</li>
					<li class="breadcrumb-item">Detail</li>
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
									<h6><?= $data->nama_lengkap ?></h6>
								</td>
							</tr>
							<td>
								<h6>Kode Permohonan</h6>
							</td>
							<td>
								<h6><?= $data->kode_permohonan ?></h6>
							</td>
							</tr>
							<tr>
								<td>
									<h6>NIM</h6>
								</td>
								<td>
									<h6><?= $data->nim ?></h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>Level</h6>
								</td>
								<td>
									<h6><?= $data->is_level ?></h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>Status</h6>
								</td>
								<td>
									<h6><?= $data->status ?></h6>
								</td>
							</tr>
						</table>
						<div class="d-flex justify-content-end px-3 mt-3">
							<div class="d-flex gap-3">
								<button class="btn btn-danger btn-tolak" type="button" data-bs-toggle="modal" data-bs-target="#modal-tolak">Tolak Pengajuan</button>
								<button class="btn btn-primary btn-terima" type="button" data-bs-toggle="modal" data-bs-target="#modal-terima">Terima Pengajuan</button>
							</div>
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