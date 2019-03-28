<div class="container">
	<div class="card card-login mx-auto mt-5">
      <div class="card-header" align="center">SUPPLIER REGISTRATION</div>
     <div class="card-body">
	<form action="<?= base_url('dashboard/supplier_registration'); ?>" method="POST">
		<div class="panel-primary">
			<div class="panel-body">
				<?php 
					if($this->session->flashdata('system_msg') != null){
						$msg = $this->session->flashdata('system_msg');
						$newMsg = "";
						foreach($msg as $key => $val){
							$newMsg .= $val."<br>";
						}
				?>
					<div class="alert alert-<?= $this->session->flashdata('alertType'); ?> alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  
					
				<?php 
					   echo $newMsg;
				?>
					</div>
				<?php 
					}
				?>
				<div class="form-group">
					<table>
					<tr>
					<td><input type="text" placeholder="Username" class="form-control" name="username" required></td>
					<td><input type="text" placeholder="Contact No." class="form-control" name="contact_number" required></td>
					</tr>
					</table>
				</div>

				<div class="form-group">
					<table>
					<tr>
					<td><input type="password" placeholder="Password" class="form-control" name="password" required></td>
					<td><input type="text" placeholder="Street" class="form-control" name="supplier_street" required></td>
					</tr>
					</table>
				</div>

				<div class="form-group">
					<table>
					<tr>
					<td><input type="password" placeholder="Re-type Password" class="form-control" name="repassword" required></td>
					<td><input type="text" placeholder="City" class="form-control" name="supplier_city" required></td>
					</tr>
					</table>
				</div>

				<div class="form-group">
					<table>
					<tr>
					<td><input type="text" placeholder="Company Name" class="form-control" name="supplier_companyname" required></td>
					<td><input type="text" placeholder="Province" class="form-control" name="supplier_province" required></td>
					</tr>
					</table>
				</div>
				<div class="form-group">
					<table>
					<tr>
					<td><input type="text" placeholder="Postal Code" class="form-control" name="supplier_postal" required></td>
					<td><input type="text" placeholder="Email address" class="form-control" name="supplier_email" required></td>
					</tr>
					</table>
				</div>

				<div class="form-group" align="center">
					<button type="submit" class="btn btn-primary">Register</button>
					<a href="<?= base_url(); ?>" class="btn btn-danger">Cancel</a>
				</div>
			</div>
		</div>
	</form>
</div>