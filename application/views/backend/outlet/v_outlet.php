<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Data Outlet</h3>

			<div class="card-tools">
				<button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
					Tambah Outlet</button>
			</div>
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<?php
			if ($this->session->flashdata('pesan')) {
				echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
				echo $this->session->flashdata('pesan');
				echo '</h5></div>';
			}
			?>
			<table class="table table-bordered" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>Nama Outlet</th>
						<td>Nama User</td>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($outlet as $key => $value) { ?>
						<tr class="text-center">
							<td><?= $no++; ?></td>
							<td><?= $value->nama_outlet ?></td>
							<td><?= $value->fullname ?></td>
							<td>
								<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_outlet ?>"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_outlet ?>"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>


<!-- /.modal Add -->
<div class="modal fade" id="add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Outlet</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				echo form_open('outlet/add');
				?>

				<div class="form-group">
					<label>Nama Outlet</label>
					<input type="text" name="nama_outlet" class="form-control" placeholder="Nama Outlet" required>
				</div>
				<?php $user = $this->m_outlet->user(); ?>
				<div class="form-group">
					<label>Nama User</label>
					<select name="id_user" class="form-control">
						<?php foreach ($user as $key => $user) { ?>
							<option value="<?= $user->id_user ?>"><?= $user->fullname ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>No Hp</label>
					<input type="number" name="no_hp" class="form-control" placeholder="NO HP Outlet" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" placeholder="Email Outlet" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" placeholder="Alamat Outlet" required>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			<?php
			echo form_close();
			?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal Edit -->
<?php foreach ($outlet as $key => $value) { ?>
	<div class="modal fade" id="edit<?= $value->id_outlet ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Outlet</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
					echo form_open('outlet/edit/' . $value->id_outlet);
					?>

					<div class="form-group">
						<label>Nama Outlet</label>
						<input type="text" name="nama_outlet" value="<?= $value->nama_outlet ?>" class="form-control" placeholder="Nama Outlet" required>
					</div>
					<?php $user = $this->m_outlet->user(); ?>
					<div class="form-group">
						<label>Nama User</label>
						<select name="id_user" class="form-control">
							<option value="<?= $value->id_user ?>"><?= $value->fullname ?></option>
							<?php foreach ($user as $key => $user) { ?>
								<option value="<?= $user->id_user ?>"><?= $user->fullname ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input type="number" name="no_hp" value="<?= $value->no_hp ?>" class="form-control" placeholder="No Hp Outlet" required>
					</div>
					<div class="form-group">
						<label>Nama Outlet</label>
						<input type="email" name="email" value="<?= $value->email ?>" class="form-control" placeholder="Email Outlet" required>
					</div>
					<div class="form-group">
						<label>Nama Outlet</label>
						<input type="text" name="alamat" value="<?= $value->alamat ?>" class="form-control" placeholder="Alamat Outlet" required>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				<?php
				echo form_close();
				?>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>


<!-- /.modal Delete -->
<?php foreach ($outlet as $key => $value) { ?>
	<div class="modal fade" id="delete<?= $value->id_outlet ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete <?= $value->nama_outlet ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5>Apakah Anda Yakin Akan Hapus Data ini?</h5>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="<?= base_url('outlet/delete/' . $value->id_outlet) ?> " class="btn btn-primary">Delete</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>