<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url()?>css/welcome.css" />
<body>
<?php /*<body style="background-color: #eee; background:url('<?php echo base_url()?>images/bg.jpg'); background-size:cover;"> */?>
<div id="container">
	<div style="height:200px; margin:0 auto; background:#ddd; padding:10px; border:10px solid #005186; font-size:20px">
	<?php echo form_open('assessment/questions'); ?>
	Name: <b><?php echo $rows["lname"]. ", " . $rows["fname"]. " ". $rows["mname"]?></b> <br />
	Module: <?php echo $rows["module"] . " - ". $rows["submodule"] ?> <br />
	Rank: <?php echo $rows["rank"] ?> <br />
	Birthdate: <?php echo $rows["bdate"] ?> <br /><br />
	<input type="text" name="trainingid" value="<?php echo $rows["trainingid"]; ?>"  hidden />
	<input type="text" name="mcbasid" value="<?php echo $rows["id"]; ?>" hidden />
	<input type="text" name="code" value="<?php echo $rows["code"]; ?>" hidden />
	<input type="text" name="submodid" value="<?php echo $rows["submodid"]; ?>" hidden />
	<input type="text" name="retake" value="<?php echo $retake; ?>" hidden />
		<br /><br />
		<input type="submit" value="Start Exam" style="height:30px"/><br>
	<?php echo form_close(); ?>
	</div>
</div>
</body>