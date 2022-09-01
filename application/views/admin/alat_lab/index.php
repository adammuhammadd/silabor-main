<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Alat Lab</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h5 class="left-0">Daftar Alat Lab</h5>
						<button class="right-0 btn btn-primary btn-tambah" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">Tambah</button>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
						<thead>
							<tr>
								<th class="col-1 text-center">No</th>
								<th class="col-1">Bidang Lab</th>
								<th class="col-1">Nama Alat</th>
								<th class="col-1">Gambar Alat</th>
								<th class="col-1">Jumlah Alat</th>
								<th class="col-1 text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $alat) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $alat->bidang_lab ?></td>
									<td><?= $alat->nama_alat ?></td>
									<td class="text-center">
										<a target="<?= base_url('upload/alat/') . $alat->gambar ?>" href="<?= base_url('upload/alat/') . $alat->gambar ?>">
											<img src="<?= base_url('upload/alat/') . $alat->gambar ?>" class="img img-thumbnail" width="70px">
										</a>
									</td>
									<td class="text-center"><?= $alat->jumlah_alat ?></td>
									<td>
										<div class="d-flex flex-row gap-1">
											<button class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#modal-tambah-data" id="<?= $alat->id_alat ?>">Edit</button>
											<button class="btn btn-sm btn-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-hapus-data" id="<?= $alat->id_alat ?>">Hapus</button>
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
				<h6 class="modal-title">Tambah Alat</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form enctype="multipart/form-data" id="form-index">
				<div class="modal-body grid-showcase">
					<div class="mb-3 d-flex flex-column gap-3">
						<input type="hidden" name="aksi" id="aksi">
						<input type="hidden" name="id_alat" id="id_alat">

						<div class="col">
							<label class="col-form-label">Bidang Lab:</label>
							<select class="js-example-basic-single col-sm-12" id="bidang_lab" name="bidang_lab" required>
								<option disabled selected value> -- pilih -- </option>
								<?php foreach ($bidang_lab as $row_bidang_lab) { ?>
									<option value="<?= $row_bidang_lab->id_bidang_lab ?>"><?= $row_bidang_lab->bidang_lab ?></option>
								<?php } ?>
							</select>
						</div>


						<div class="col">
							<label class="col-form-label">Nama Alat:</label>
							<input class="form-control" name="nama_alat" id="nama_alat" type="text" required>
						</div>

						<div class="col">
							<label class="col-form-label">Upload Gambar Alat:</label>
							<input class="form-control" type="file" name="gambar" id="gambar" required>
						</div>

						<div class="col">
							<label class="col-form-label">Jumlah Alat:</label>
							<input class="form-control" name="jumlah_alat" id="jumlah_alat" type="number" required>
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