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
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<h5>Pilih alat yang ingin dipinjam</h5>
							<div id="button-cover"><button class="right-0 btn btn-primary btn-tambah" id="ajukan" type="button" data-bs-toggle="modal" data-bs-target="#modal-ajukan-permohonan">Ajukan Permohonan</button></div>
						</div>
						<div class="card-body">
							<div class="order-history table-responsive wishlist">

								<table class="table table-bordered dataTable" id="table-1">
									<thead>
										<tr>
											<th>Bidang Lab</th>
											<th>Gambar Alat</th>
											<th>Nama Alat</th>
											<th>Jumlah Yang Tersedia</th>
											<th>Jumlah Yang Ingin Dipinjam</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data->result() as $alat) { ?>
											<?php if ($alat->jumlah_alat_sisa > 0) { ?>
												<tr class="alat">
													<td><?= $alat->bidang_lab ?></td>
													<td><img class="img-fluid img-40" src="<?= base_url('upload/alat/') . $alat->gambar ?>"></td>
													<td>
														<div class="id_alat" hidden><?= $alat->id_alat ?></div>
														<h6 class="nama_alat"><?= $alat->nama_alat ?></h6>
													</td>
													<td class="sisa"><?= $alat->jumlah_alat_sisa ?></td>
													<td>
														<input class="text-center jml_alat" type="number" value="0" min="0" max="<?= $alat->jumlah_alat_sisa ?>">
													</td>
												</tr>
											<?php } ?>
										<?php } ?>

									</tbody>
								</table>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Zero Configuration  Ends-->
	</div>
</div>


<div class="modal fade" id="modal-ajukan-permohonan" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Alat yang akan anda pinjam</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form id="form-index">
				<div class="modal-body grid-showcase">
					<div id="body-modal" class="row"></div>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-danger ya-ajukan" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>