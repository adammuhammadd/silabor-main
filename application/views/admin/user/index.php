<!-- Page Sidebar Ends-->
<div class="page-body dashboard-2-main">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">User</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h5>Daftar User</h5>
						<button class=" right-0 btn btn-primary btn-tambah" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">Tambah</button>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th>Nama Lengkap</th>
								<th>Fakultas</th>
								<th>Prodi</th>
								<th>Bidang Lab</th>
								<th>NIM</th>
								<th>Email</th>
								<th>Password</th>
								<th>Alamat</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Level</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $user) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $user->nama_lengkap ?></td>
									<td><?= $user->fakultas ?></td>
									<td><?= $user->prodi ?></td>
									<td><?= $user->bidang_lab ?></td>
									<td><?= $user->nim ?></td>
									<td><?= $user->email ?></td>
									<td>**********</td>
									<td><?= $user->alamat ?></td>
									<td><?= $user->tgl_lahir ?></td>
									<td><?= $user->jenkel ?></td>
									<td><?= $user->is_level ?></td>
									<td>
										<div class="d-flex flex-row gap-1">
											<button class="btn btn-sm btn-warning btn-edit flex-fill" data-bs-toggle="modal" data-bs-target="#modal-tambah-data" id="<?= $user->id_user ?>">Edit</button>
											<button class="btn btn-sm btn-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-hapus-data" id="<?= $user->id_user ?>">Hapus</button>
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
				<h6 class="modal-title">Data User</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form enctype="multipart/form-data" id="form-index">
				<div class="modal-body grid-showcase">
					<div class="mb-3 d-flex flex-column gap-3">
						<input type="hidden" name="aksi" id="aksi">
						<input type="hidden" name="id_user" id="id_user">

						<div class="col">
							<label class="col-form-label">Level:</label>
							<select class="js-example-basic-single col-sm-12" id="level" name="level" required>
								<option disabled selected value> -- pilih -- </option>
								<option value="Mahasiswa">Mahasiswa</option>
								<option value="Dosen">Dosen</option>
								<option value="Laboran">Laboran</option>
								<option value="Kepala Lab">Kepala Lab</option>
								<option value="Kepala UPT Lab">Kepala UPT Lab</option>
								<option value="Super Admin">Super Admin</option>
							</select>
						</div>

						<div class="col">
							<label class="col-form-label">Nama Lengkap:</label>
							<input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" required>
						</div>

						<div class="col">
							<label class="col-form-label">NIM:</label>
							<input class="form-control" id="nim" name="nim" type="number" required>
						</div>

						<div class="col">
							<label class="col-form-label">Fakultas:</label>
							<select class="js-example-basic-single col-sm-12" id="fakultas" name="fakultas" required>
								<option disabled selected value> -- pilih -- </option>
								<?php foreach ($fakultas as $row_fakultas) { ?>
									<option value="<?= $row_fakultas->id_fakultas ?>"><?= $row_fakultas->fakultas ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col">
							<label class="col-form-label">Prodi:</label>
							<select class="js-example-basic-single col-sm-12" id="prodi" name="prodi" required>
								<option disabled selected value> -- pilih -- </option>
								<?php foreach ($prodi as $row_prodi) { ?>
									<option value="<?= $row_prodi->id_prodi ?>"><?= $row_prodi->prodi ?></option>
								<?php } ?>
							</select>
						</div>

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
							<label class="col-form-label">Email:</label>
							<input class="form-control" name="email" id="email" type="email" required>
						</div>

						<div class="col">
							<label class="col-form-label">Password:</label><span class="text-danger fw-bold" id="pass-reminder"></span>
							<input class="form-control" name="password" id="password" type="password" required>
						</div>

						<div class="col">
							<label class="form-label" for="alamat">Alamat:</label>
							<textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
						</div>

						<div class="col">
							<label class="col-form-label">Tanggal Lahir:</label>
							<input class="form-control digits" id="tgl_lahir" id="tgl_lahir" name="tgl_lahir" type="date" value="1990-01-01" required>
						</div>

						<div class="col">
							<label class="col-form-label">Jenis Kelamin:</label>
							<select class="js-example-basic-single col-sm-12" id="jenkel" name="jenkel" required>
								<option disabled selected value> -- pilih -- </option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
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