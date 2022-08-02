
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Computer Based Assessment System - National Maritime Polytechnic</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="<?php echo base_url()?>bootstrap/js/jquery2.2.4.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.css">
		<script src="<?php echo base_url()?>bootstrap/js/bootstrap.js"></script>
		<link href="<?php echo base_url()?>css/dashboard.css" rel="stylesheet">
		<link href="<?php echo base_url()?>css/login.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="card card-container">
				<img id="profile-img" class="profile-img-card" src="<?php echo base_url()?>images/nmplogo2.png" />
				<p id="profile-name" class="profile-name-card">Welcome to CBAS Admin. </p>
			   <?php echo form_open('admin/validate','class="form-signin"'); ?>
					<span id="reauth-email" class="reauth-email"></span>
				   
					<input type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" style="position: relative; z-index:999; display: block;" class="form-control" required autofocus />
				   
					<input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password"/>
				   
					<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</body>
</html>