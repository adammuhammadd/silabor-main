<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>laboran/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Pengajuan Pinjam Alat</li>
				</ol>
			</div>

			<hr class="m-0">


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
						foreach ($pengajuan->result() as $list_pengajuan) { ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $list_pengajuan->nama_lengkap ?></td>
								<td><?= $list_pengajuan->kode_pinjam; ?></td>
								<td><?= $list_pengajuan->is_level ?></td>
								<td>
									<a class="btn btn-primary detail" name="bebas-lab" href="<?= base_url('laboran/pengajuan_pinjam_alat/detail/') . $list_pengajuan->id_permohonan_pinjam_alat ?>">Detail</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>

		</div>
		<!-- Zero Configuration  Ends-->
	</div>
</div>