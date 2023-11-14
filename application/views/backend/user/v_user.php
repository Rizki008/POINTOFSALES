<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Data User</h3>

			<div class="card-tools">
				<button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
					Add</button>
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
						<th>Nama User</th>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($user as $key => $value) { ?>
						<tr class="text-center">
							<td><?= $no++; ?></td>
							<td><?= $value->fullname ?></td>
							<td><?= $value->username ?></td>
							<td>********</td>
							<td><?php
								if ($value->level_user == 'kasir') {
									echo '<span class="badge bg-danger">Kasir</span>';
								} else {
									echo '<span class="badge bg-success">Admin</span>';
								} ?></td>
							<td>
								<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_user ?>"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_user ?>"><i class="fa fa-trash"></i></button>
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
				<h4 class="modal-title">Add user</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				echo form_open('admin/add');
				?>

				<div class="form-group">
					<label>Nama User</label>
					<input type="text" name="fullname" class="form-control" placeholder="Nama User" required>
				</div>

				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" required>
				</div>

				<div class="form-group">
					<label>Passowrd</label>
					<input type="text" name="password" class="form-control" placeholder="Passowrd" required>
				</div>

				<div class="form-group">
					<label>Level User</label>
					<select name="level_user" class="form-control">
						<option value="kasir" selected>Kasir</option>
						<option value="admin">Admin</option>
					</select>
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
<?php foreach ($user as $key => $value) { ?>
	<div class="modal fade" id="edit<?= $value->id_user ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit user</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
					echo form_open('admin/edit/' . $value->id_user);
					?>

					<div class="form-group">
						<label>Nama User</label>
						<input type="text" name="fullname" value="<?= $value->fullname ?>" class="form-control" placeholder="Nama User" required>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" value="<?= $value->username ?>" class="form-control" placeholder="Username" required>
					</div>

					<div class="form-group">
						<label>Passowrd</label>
						<input type="text" name="password" value="<?= $value->password ?>" class="form-control" placeholder="Passowrd" required>
					</div>

					<div class="form-group">
						<label>Level User</label>
						<select name="level_user" class="form-control">
							<option value="kasir" <?php if ($value->level_user == 1) {
														echo 'selected';
													} ?>>Kasir</option>
							<option value="admin" <?php if ($value->level_user == 2) {
														echo 'selected';
													} ?>>Admin</option>
						</select>
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
<?php foreach ($user as $key => $value) { ?>
	<div class="modal fade" id="delete<?= $value->id_user ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete <?= $value->fullname ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5>Apakah Anda Yakin Akan Hapus Data ini?</h5>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="<?= base_url('admin/delete/' . $value->id_user) ?> " class="btn btn-primary">Delete</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>