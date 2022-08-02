<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Settings</p></div>
				<form name='search' action='<?php echo base_url()?>home/confirmadduser' method='post'>
					<input type="checkbox" name="connection" value="1" <?php if ($rows["connection"]!=0){ ?>checked<?php } ?> />
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px; margin-left: 160px;" value="Save" /></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>