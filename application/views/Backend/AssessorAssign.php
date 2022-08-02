<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Assign Assessor to [Code: <?php echo $this->session->userdata("code") ."-". $this->session->userdata("submodid")?>]</p></div>
				<form name='search' action='<?php echo base_url()?>admin/assessor/assignconfirm' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer">
						<div class="anchortext">Assessor Name: </div>
						<div class="placeholdertb">
						<?php 
						foreach ($assessors->result_array() as $key)
						{
							$assessor[$key['assessorid']] = $key['lname'].", ".$key['fname']." ".$key['mname'];
						}
						
						$assessor['#'] = 'Please Select';
						echo form_dropdown('assessor', $assessor, "#", 'id="assessor" style="width:500px"'); 
						?>
						</div>
					</div>
					
					<div class="spacer floatright" style="margin-top: 10px;">
						<input type="submit" class="fadein" style="height:40px;width:200px;float:left; font-size:25px;" value="Assign"/>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>