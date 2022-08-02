<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add Module</p></div>
				<div style="margin-left:20px;">
					<form name='search' action='<?php echo base_url()?>admin/modules/save20' method='post'>
						<?php  echo $this->session->flashdata('message'); ?>
						<?php echo validation_errors();?>
						<div class="spacer"><div class="anchortext">Module Name: </div>
							<div class="placeholdertb">
								<input id='module' name='module' type='text' style='width: 400px;' value='<?php echo set_value('module'); ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Module Code: </div>
							<?php 
							foreach ($modules->result_array() as $key)
							{
								$mod[$key['modcode']] = $key['modcode']." - ".$key["module"];
							}
							?>
							<div class="placeholdertb">
								<?php 
								$mod['#'] = 'Please Select';
								echo form_dropdown('modcode', $mod, '#','id="mod" style="width:414px"'); 
								?>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Description: </div>
							<div class="placeholdertb">
								<input id='description' name='description' type='text' style='width: 400px;' value='<?php echo set_value('description'); ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Quantity: </div>
							<div class="placeholdertb">
								<input id='quantity' name='quantity' type='text' style='width: 400px;' value='<?php echo set_value('quantity'); ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Duration:</div>
							<div class="placeholdertb">
								<input id='duration' name='duration' type='text' style='width: 400px;' value='<?php echo set_value('duration'); ?>' required/>
							</div>
						</div>
						<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px; margin-left: 160px;" value="Save" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>