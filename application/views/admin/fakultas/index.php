<!-- Page Sidebar Ends-->
<div class="page-body dashboard-2-main">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Fakultas</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h5>Daftar Fakultas</h5>
						<button class=" right-0 btn btn-primary btn-tambah" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">Tambah</button>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
						<thead>
							<tr>
								<th class="col-1 text-center">No</th>
								<th class="col-10">Fakultas</th>
								<th class="col-1 text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $fakultas) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $fakultas->fakultas ?></td>
									<td>
										<div class="d-flex flex-row gap-1">
											<button class="btn btn-sm btn-warning btn-edit flex-fill" data-bs-toggle="modal" data-bs-target="#modal-tambah-data" id="<?= md5($fakultas->id_fakultas) ?>">Edit</button>
											<button class="btn btn-sm btn-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-hapus-data" id="<?= md5($fakultas->id_fakultas) ?>">Hapus</button>
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



<div class="modal fade" id="modal-tambah-data" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Tambah Fakultas</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form enctype="multipart/form-data" id="form-index">
				<div class="modal-body grid-showcase">
					<div class="mb-3 d-flex flex-column gap-3">
						<input type="hidden" name="aksi" id="aksi">
						<input type="hidden" name="id_fakultas" id="id_fakultas">

						<div class="col">
							<label class="col-form-label">Fakultas:</label>
							<input class="form-control" name="fakultas" id="fakultas" type="text" required>
						</div>

					</div>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-secondary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-hapus-data" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Hapus Data</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form id="form-index">
				<div class="modal-body grid-showcase">
					<p>Apakah anda yakin akan menghapus data ini?</p>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-danger ya-hapus" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>