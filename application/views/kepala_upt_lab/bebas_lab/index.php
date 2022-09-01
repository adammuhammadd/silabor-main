<!-- Page Sidebar Ends-->
<div class="page-body">

	<div class="container-fluid">
		<div class="card">
			<div class="card-header pb-0">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>kepala_upt_lab/home" data-bs-original-title="" title=""><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active">Bebas Lab</li>
				</ol>
			</div>

			<hr class="m-0">

			<div class="card-body d-flex">
				<div class="container-fluid d-flex flex-column">

					<div class="card">
						<div class="card-header">
							<h5>Daftar Mahasiswa Yang Telah Mengambil Bebas Lab</h5>
						</div>

						<div class="card-body table-responsive">
							<table class="table-striped table table-bordered dataTables " class="display" id="basic-1">
								<thead>
									<tr>
										<th class="col-1">No</th>
										<th class="col-4">Nama</th>
										<th class="col-4">Kode Permohonan</th>
										<th class="col-3">Tanggal Penerimaan</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($bebas_lab->result() as $list_bebas_lab) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $list_bebas_lab->nama_lengkap ?></td>
											<td><?= $list_bebas_lab->kode_permohonan; ?></td>
											<td><?= $list_bebas_lab->tgl_penerimaan ?></td>
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