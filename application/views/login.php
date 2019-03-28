
<div class="container">
	 <div class="card card-login mx-auto mt-5">
      <div class="card-header" align="center">LOGIN</div>
     <div class="card-body">
	<form action="<?= base_url('app/login'); ?>" method="POST">
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
					<input type="text" placeholder="Username" class="form-control" required name="username">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" required name="password">
				</div>
				<div class="form-group" align="center">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="<?= base_url('app/register'); ?>" class="btn btn-success">Register Here!</a>
				</div>
			</div>
		</div>
	</form>
</div>