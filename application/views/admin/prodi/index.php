<!-- Page Sidebar Ends-->
<div class="page-body dashboard-2-main">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Prodi</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h5>Daftar Prodi</h5>
						<button class=" right-0 btn btn-primary btn-tambah" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">Tambah</button>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
						<thead>
							<tr>
								<th class="col-1 text-center">No</th>
								<th class="col-4">Fakultas</th>
								<th class="col-3">Prodi</th>
								<th class="col-1 text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $prodi) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $prodi->fakultas ?></td>
									<td><?= $prodi->prodi ?></td>
									<td class="text-center">
										<div class="d-flex flex-row gap-1">
											<button class="btn btn-sm btn-warning btn-edit flex-fill" data-bs-toggle="modal" data-bs-target="#modal-tambah-data" id="<?= md5($prodi->id_prodi) ?>">Edit</button>
											<button class="btn btn-sm btn-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-hapus-data" id="<?= md5($prodi->id_prodi) ?>">Hapus</button>
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





<div class="modal fade" id="modal-tambah-data" role="dialog">
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
						<input type="hidden" name="id_prodi" id="id_prodi">

						<div class="col">
							<label class="col-form-label">Fakultas:</label>
							<select class="js-example-basic-single col-sm-12" id="fakultas" name="fakultas" required>
								<option disabled selected value> -- pilih -- </option>
								<?php foreach ($fakultas as $row_fakultas) { ?>
									<option value="<?= $row_fakultas->id_fakultas ?>"><?= $row_fakultas->fakultas ?> </option>
								<?php } ?>
							</select>
						</div>

						<div class="col">
							<label class="col-form-label">Prodi:</label>
							<input class="form-control" name="prodi" id="prodi" type="text" required>
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