<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>

<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add Main Category for TCROA</p></div>
				<form name='search' action='<?php echo base_url()?>admin/addmaincategory' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer"><div class="anchortext">Module Code: </div>
						<?php 
						foreach ($modules->result_array() as $key)
						{
							$mod[$key['id']] = $key["item"];
						}
						?>
						<div class="placeholdertb">
							<?php 
							$mod['#'] = 'Please Select';
							echo form_dropdown('module', $mod, '#','id="module" style="width:414px"'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Main Category: </div>
						<div class="placeholdertb">
							<input id='maincat' name='maincat' type='text' style='width: 400px;' value='<?php echo set_value('maincat'); ?>' />
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px; width:150px;float:left; font-size:25px; margin-left: 100px;" value="Save" /></div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php //require_once('include/footer.php'); ?>
</body>
</html>