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
							<div class="card-body bg-danger">
								<p class="">Anda sudah pernah mengajukan permintaan bebas laboratorium, anda tidak dapat mengajukan kembali !</p>
							</div>
						</div>
					<?php } else { ?>
						<div class="card">
							<div class="card-header">
								<h5>Pengajuan Bebas Laboratorium</h5>
							</div>
							<div class="card-body">
								<p>Dalam rangka memberikan pelayanan terbaik kepada mahasiswa tingkat akhir yang sedang mempersiapkan kelulusan, Laboratorium memberikan layanan daring terkait permohonan Surat Keterangan Bebas Perpustakaan dan Laboratorium.</p>
								<p class="text-danger">* Pastikan mahasiswa tidak mempunyai tanggungan laboratorium/ peminjaman alat laboratorium</p>

							</div>
							<div class="card-body">
								<?php if ($cek_bebas_lab_belum->num_rows() > 0) { ?>
									<div class="card-body bg-dark text-center text-lg-left d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
										<p class="m-0">Permohonan anda telah diajukan, harap tunggu atau</p>
										<button class="btn btn-danger btn-batalkan" type="button" id="<?= $id ?>" data-bs-toggle="modal" data-bs-target="#modal-batalkan-permohonan">Batalkan Permohonan</button>
									</div>
								<?php } else { ?>
									<div class="card-body bg-primary text-center text-lg-left d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3 gap-lg-5">
										<p class="m-0">Ajukan Permohonan Bebas Laboratorium disini</p>
										<button class="btn btn-light btn-ajukan" type="button" data-bs-toggle="modal" data-bs-target="#modal-ajukan-permohonan">Ajukan</button>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-ajukan-permohonan" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Ajukan Permohonan Bebas Laboratorium</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form enctype="multipart/form-data" id="form-index">
				<div class="modal-body grid-showcase">
					<div class="mb-3">
						<div class="col">
							<label class="col-form-label text-danger">*Cantumkan Surat Berita Acara Sidang Komprehensif</label>
							<input class="form-control" type="file" name="gambar" id="gambar" required>
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

<div class="modal fade" id="modal-batalkan-permohonan" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Batalkan Permohonan Bebas Laboratorium</h6>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form>
				<div class="modal-body grid-showcase">
					<p>Permohonan belum diproses, anda yakin ingin membatalkan permohonan ?</p>
					<div class="notif"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tidak</button>
					<button class="btn btn-primary ya-batalkan" type="button">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>