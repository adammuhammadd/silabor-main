<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">History</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-header">
				<h5>History</h5>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
					<li class="nav-item"><a class="nav-link active" id="pills-warninghome-tab" data-bs-toggle="pill" href="#pills-warninghome" role="tab" aria-controls="pills-warninghome" aria-selected="true"><i class="icofont icofont-tools"></i>Alat Yang Dipinjam</a></li>
					<li class="nav-item"><a class="nav-link" id="pills-warningprofile-tab" data-bs-toggle="pill" href="#pills-warningprofile" role="tab" aria-controls="pills-warningprofile" aria-selected="false"><i class="icofont icofont-tools"></i>Alat Yang Dikembalikan</a></li>
					<li class="nav-item"><a class="nav-link" id="pills-warningcontact-tab" data-bs-toggle="pill" href="#pills-warningcontact" role="tab" aria-controls="pills-warningcontact" aria-selected="false"><i class="icofont icofont-book"></i>Bebas Lab (Sudah Divalidasi)</a></li>
					<li class="nav-item"><a class="nav-link" id="pills-belum-tab" data-bs-toggle="pill" href="#pills-belum" role="tab" aria-controls="pills-belum" aria-selected="false"><i class="icofont icofont-book"></i>Bebas Lab (Belum Divalidasi)</a></li>
				</ul>
				<div class="tab-content" id="pills-warningtabContent">
					<div class="tab-pane fade show active" id="pills-warninghome" role="tabpanel" aria-labelledby="pills-warninghome-tab">
						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-3">Nama</th>
										<th class="col-3">Kode Permohonan</th>
										<th class="col-2">Level User</th>
										<th class="col-3">Tanggal Peminjaman</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($peminjam_alat->result() as $row_peminjam_alat) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row_peminjam_alat->nama_lengkap ?></td>
											<td><?= $row_peminjam_alat->kode_pinjam ?></td>
											<td><?= $row_peminjam_alat->is_level ?></td>
											<td><?= $row_peminjam_alat->tgl_peminjaman ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-warningprofile" role="tabpanel" aria-labelledby="pills-warningprofile-tab">
						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-3">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-3">Nama</th>
										<th class="col-3">Kode Permohonan</th>
										<th class="col-2">Level User</th>
										<th class="col-3">Tanggal Dikembalikan</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($dikembalikan->result() as $row_dikembalikan) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row_dikembalikan->nama_lengkap ?></td>
											<td><?= $row_dikembalikan->kode_pinjam ?></td>
											<td><?= $row_dikembalikan->is_level ?></td>
											<td><?= $row_dikembalikan->tgl_pengembalian ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-warningcontact" role="tabpanel" aria-labelledby="pills-warningcontact-tab">
						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-4">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-3">Nama</th>
										<th class="col-3">Kode Permohonan</th>
										<th class="col-2">Level User</th>
										<th class="col-3">Tanggal Disetujui</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($bebas_lab->result() as $row_bebas_lab) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row_bebas_lab->nama_lengkap ?></td>
											<td><?= $row_bebas_lab->kode_permohonan ?></td>
											<td><?= $row_bebas_lab->is_level ?></td>
											<td><?= $row_bebas_lab->tgl_penerimaan ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-belum" role="tabpanel" aria-labelledby="pills-belum-tab">
						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-6">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-3">Nama</th>
										<th class="col-3">Kode Permohonan</th>
										<th class="col-2">Level User</th>
										<th class="col-3">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($belum_bebas_lab->result() as $row_belum_bebas_lab) { ?>
										<tr>
											<td class="col-1"><?= $no++ ?></td>
											<td class="col-4"><?= $row_belum_bebas_lab->nama_lengkap ?></td>
											<td class="col-3"><?= $row_belum_bebas_lab->kode_permohonan ?></td>
											<td class="col-3"><?= $row_belum_bebas_lab->is_level ?></td>
											<td class="col-1"><a class="btn btn-primary" href="<?= base_url('admin/history/detail_belum_bebas_lab/') . $row_belum_bebas_lab->id_permohonan_bebas_lab ?>">Detail</a></td>
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