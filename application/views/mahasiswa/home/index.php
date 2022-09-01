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

					<?php if ($cek_bebas_lab_sudah->num_rows() > 0) { ?>
						<div class="card">
							<div class="card-body bg-danger d-flex justify-content-between align-items-center">
								<p class="m-0">Anda sudah pernah mengajukan permintaan bebas laboratorium, silahkan download form disini</p>
								<a class="btn btn-light" href="<?= base_url('mahasiswa/bebas_lab/form_bebas_lab/') . $cek_bebas_lab_sudah->row()->id_permohonan_bebas_lab; ?>">Download Form</a>
							</div>
						</div>
					<?php } else { ?>
						<?php if ($alat_dipinjam->num_rows() > 0) { ?>
							<div class="card">
								<div class="card-header">
									<h5>Alat yang sedang dipinjam</h5>
								</div>
								<div class="card-body">
									<table class="table-striped table table-bordered dataTables" class="display">
										<thead>
											<tr>
												<th colspan="4">KODE : <?= $alat_dipinjam->row()->kode_pinjam ?></th>
											</tr>
											<tr>
												<th class="col-1 text-center">No</th>
												<th class="col-4">Nama Alat</th>
												<th class="col-4 text-center">Gambar Alat</th>
												<th class="col-3">Tanggal Peminjaman</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($alat_dipinjam->result() as $alat) { ?>
												<tr>
													<td class="text-center"><?= $no++ ?></td>
													<td><?= $alat->nama_alat ?></td>
													<td class="text-center"><img class="img-fluid img-80" src="<?= base_url('upload/alat/') . $alat->gambar ?>"></td>
													<td><?= $alat->tgl_peminjaman ?></td>
												</tr>
											<?php	} ?>


										</tbody>
									</table>
								</div>
							</div>
						<?php } ?>

						<?php if (count($penolakan) > 0) { ?>
							<div class="card">
								<div class="card-header">
									<h5>Pengajuan Ditolak</h5>
								</div>
								<div class="card-body">
									<table class="table-striped table table-bordered dataTables " class="display">
										<thead>
											<tr>
												<th class="col-1">No</th>
												<th class="col-3">Tipe Permohonan</th>
												<th class="col-3">Kode Permohonan</th>
												<th class="col-3">Status</th>
												<th class="col-2">Tanggal</th>
											</tr>
										</thead>
										<tbody>

											<?php $no = 1;
											foreach ($penolakan as $list_ditolak) {
												if (isset($list_ditolak->kode_pinjam)) { ?>
													<tr>
														<td><?= $no++ ?></td>
														<td>Peminjaman Alat</td>
														<td><?= $list_ditolak->kode_pinjam ?></td>
														<td>
															Permohonan Ditolak
														</td>
														<td>
															<?php
															$date = new \DateTime($data->row()->date_created);
															$tanggal = $date->format('d/m/Y');
															echo $tanggal;
															?>
														</td>
													</tr>
												<?php } ?>

												<?php if (isset($list_ditolak->kode_permohonan)) { ?>
													<tr>
														<td><?= $no++ ?></td>
														<td>Bebas Lab</td>
														<td><?= $list_ditolak->kode_permohonan ?></td>
														<td>
															Permohonan Ditolak
														</td>
														<td>
															<?php
															$date = new \DateTime($list_ditolak->date_created);
															$tanggal = $date->format('d/m/Y');
															echo $tanggal;
															?>
														</td>
													</tr>
												<?php } ?>
											<?php } ?>

										</tbody>
									</table>
								</div>
							</div>
						<?php } ?>

						<?php if ($peminjaman->num_rows() > 0) { ?>
							<div class="card-body table-responsive p-0">
								<table class="table-striped table table-bordered" class="display">
									<tr>
										<td colspan="2" class="bg-primary text-center">
											<h5>PENGAJUAN DITERIMA</h5>
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
									<tr>
										<td>
											<h6>Status</h6>
										</td>
										<td>
											<h6><?= $user->status_laboran ?></h6>
										</td>
									</tr>
								</table>
								<div class="mt-3">
									<div class="mb-3 mb-lg-0 gap-3 d-flex align-items-center bg-danger flex-column flex-lg-row justify-content-between p-3">
										<p class="m-0">Pengajuan anda telah diterima, harap download surat untuk mengambil alat yang akan di pinjam</p>
										<a href="<?= base_url('mahasiswa/pinjam_alat/form_pinjam_alat/') . $peminjaman->row()->id_permohonan_pinjam_alat ?>" class="btn btn-light">Download Surat Disini !</a>
									</div>
								</div>
							</div>

							<hr>

							<div class="card mt-5">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<h5 class="left-0">Daftar Alat Yang Telah Di Ajukan</h5>
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
											foreach ($peminjaman->result() as $list_alat) { ?>
												<tr class="alat">
													<td><?= $no++ ?></td>
													<td><?= $list_alat->nama_alat ?></td>
													<td><?= $list_alat->jml_alat ?></td>
													<td><?= $list_alat->kondisi_awal ?></td>
												</tr>
											<?php	} ?>

										</tbody>
									</table>
								</div>
							</div>
						<?php } ?>


						<?php if ($permohonan == 'Pinjam Alat') { ?>

							<div class="card">
								<div class="card-header">
									<h5>Pengajuan yang sedang di proses</h5>
								</div>
								<div class="card-body table-responsive">
									<table class="table-striped table table-bordered dataTables " class="display">
										<thead>
											<tr>
												<th class="col-5">Kode Pinjam</th>
												<th class="col-5">Status</th>
												<th class="col-1 text-center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $data->row()->kode_pinjam ?></td>
												<td>
													<img class="me-3" src="<?= base_url('assets_viho/assets/images/loading-buffering.gif') ?>" width="20px">Menunggu Validasi
												</td>
												<td>
													<div class="d-flex justify-content-center gap-1">
														<button class="btn btn-info" id="detail">Detail</button>
														<button class="btn btn-danger btn-batal-permohonan-pinjam" id="<?= $data->row()->id_permohonan_pinjam_alat ?>" data-bs-toggle="modal" data-bs-target="#modal-batalkan-permohonan-pinjam">Batalkan</button>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<hr>
							<div class="card" id="card-detail">
								<div class="card-header">
									<h5>Detail Peminjaman</h5>
								</div>
								<div class="card-body table-responsive">
									<table class="table-striped table table-bordered dataTables " class="display" id="basic-2">
										<thead>
											<tr>
												<th class="col-1">No</th>
												<th class="col-4">Nama Alat</th>
												<th class="col-3">Jumlah Alat</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($data->result() as $list_alat) { ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $list_alat->nama_alat ?></td>
													<td><?= $list_alat->jml_alat ?></td>
												</tr>
											<?php	} ?>

										</tbody>
									</table>
								</div>
							</div>

						<?php } else if ($permohonan == 'Bebas Lab') { ?>
							<?php if ($data->row()->status == 'Belum diizinkan') { ?>
								<div class="card">
									<div class="card-header">
										<h5>Status Pengajuan</h5>
									</div>
									<div class="card-body table-responsive">
										<table class="table-striped table table-bordered dataTables " class="display">
											<thead>
												<tr>
													<th class="col-5">Kode Permohonan</th>
													<th class="col-5">Status</th>
													<th class="col-1 text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?= $data->row()->kode_permohonan ?></td>
													<td>
														<img class="me-3" src="<?= base_url('assets_viho/assets/images/loading-buffering.gif') ?>" width="20px">Menunggu Konfirmasi
													</td>
													<td>
														<div class="d-flex justify-content-center gap-1">
															<button class="btn btn-danger btn-batal-permohonan-pinjam" id="<?= $data->row()->id_permohonan_bebas_lab ?>" data-bs-toggle="modal" data-bs-target="#modal-batalkan-bebas-lab">Batalkan</button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					<?php } ?>


				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-batalkan-permohonan-pinjam" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Batalkan Permohonan Peminjaman Alat</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form id="form-index">
				<div class="modal-body grid-showcase">
					<p>Permohonan belum diproses, anda yakin ingin membatalkan permohonan ?</p>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary ya-batalkan-permohonan-pinjam" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-batalkan-bebas-lab" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Batalkan Permohonan Bebas Laboratorium</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form id="form-index">
				<div class="modal-body grid-showcase">
					<p>Permohonan belum diproses, anda yakin ingin membatalkan permohonan ?</p>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary ya-batalkan-bebas-lab" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>