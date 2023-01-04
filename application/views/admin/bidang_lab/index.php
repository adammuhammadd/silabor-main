<!-- Page Sidebar Ends-->
<div class="page-body dashboard-2-main">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Bidang Lab</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h5>Daftar Bidang Lab</h5>
						<button class=" right-0 btn btn-primary btn-tambah" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">Tambah</button>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
						<thead>
							<tr>
								<th class="col-1 text-center">No</th>
								<th class="col-3">Nama Bidang</th>
								<th class="col-1 text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $bidang_lab) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $bidang_lab->bidang_lab ?></td>
									<td>
										<div class="d-flex flex-row gap-1">
											<button class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#modal-tambah-data" id="<?= $bidang_lab->id_bidang_lab ?>">Edit</button>
											<button class="btn btn-sm btn-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-hapus-data" id="<?= $bidang_lab->id_bidang_lab ?>">Hapus</button>
										</div>
									</td>
								<?php } ?>

								</tr>
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
				<h6 class="modal-title">Tambah Bidang Lab</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form enctype="multipart/form-data" id="form-index">
				<div class="modal-body grid-showcase">
					<div class="mb-3 d-flex flex-column gap-3">
						<input type="hidden" name="aksi" id="aksi">
						<input type="hidden" name="id_bidang_lab" id="id_bidang_lab">

						<div class="col">
							<label class="col-form-label">Bidang Lab:</label>
							<input class="form-control" name="bidang_lab" id="bidang_lab" type="text" required>
						</div>

					</div>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
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
			<form>
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