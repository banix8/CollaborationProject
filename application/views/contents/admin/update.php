<div class="container">
	<form action="<?= base_url('dashboard/updateAccount'); ?>" method="POST">
		<div class="panel-primary">
			<div class="panel-heading text-center">
				<h4><?= $pagename; ?> : SIS</h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<input type="text" placeholder="Username" class="form-control" name="username" value="<?= $useraccount[0]->username; ?>" required>
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" name="password" value="<?= $useraccount[0]->password; ?>" required>
				</div>
				<div class="form-group">
					<input type="hidden" name="userid" value="<?= $useraccount[0]->userid; ?>">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="<?= base_url('dashboard'); ?>" class="btn btn-danger">Go Back!</a>
				</div>
			</div>
		</div>
	</form>
</div