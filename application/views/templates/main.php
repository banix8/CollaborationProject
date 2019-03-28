<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= $pagename.' : '; ?>Student Information System</title>
		<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('assets/plugins/pace/pace.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">		
		
	</head>
	<body>
		
		
		<?php 
			if(isset($contents)){
				$this->load->view($contents);
			}else{
				echo "No Page to Loads";
			}
		?>

		<script type="text/javascript" src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/plugins/pace/pace.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/js/script.js'); ?> "></script>
	</body>
</html>