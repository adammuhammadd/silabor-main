<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>laboran/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body d-flex">
				<div class="container-fluid d-flex flex-column">
					<div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
						<div class="card rounded shadow p-3 bg-primary flex-fill">
							<div class="text-center">
								<h6>Total Peminjam Alat</h6>
								<h5><?= $peminjam_alat->num_rows() ?></h5>
								<p>Orang</p>
							</div>
						</div>
						<div class="card rounded shadow p-3 bg-primary flex-fill">
							<div class="text-center">
								<h6>Permintaan Peminjaman Alat</h6>
								<h5><?= $pinjam_alat->num_rows() ?></h5>
								<p>Orang</p>
							</div>
						</div>
						<div class="card rounded shadow p-3 bg-primary flex-fill">
							<div class="text-center">
								<h6>Permintaan Bebas Lab</h6>
								<h5><?= $bebas_lab->num_rows() ?></h5>
								<p>Mahasiswa</p>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h5>Permintaan Yang Belum Dikonfirmasi Laboran</h5>
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
									foreach ($pinjam_alat->result() as $list_pinjam_alat) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $list_pinjam_alat->nama_lengkap ?></td>
											<td><?= $list_pinjam_alat->kode_pinjam; ?></td>
											<td><?= $list_pinjam_alat->is_level ?></td>
											<td>
												<div class="d-flex justify-content-center gap-1">
													<a class="btn btn-primary detail" name="bebas-lab" href="<?= base_url('laboran/pengajuan_pinjam_alat/detail/') . $list_pinjam_alat->id_permohonan_pinjam_alat ?>">Detail</a>
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