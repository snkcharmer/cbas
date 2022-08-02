<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){     
			$('#zip').change(function(){ 
				$("#region > option").remove();
				var module_id = $('#zip').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getaddress/"+module_id, 
					success: function(data) 
					{
						$.each(data,function(max,fee) 
						{
							$("#region").val(fee.region);
						});

					}
				});
				 
			});
		});
		
			$('#region').change(function(){
				document.getElementById('town').options.length = 0;
				
				var catid = $('#region').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/gettown/"+catid, 
					success: function(data) 
					{
						//$("#suffix").val(JSON.stringify(data.category));
						var opt = jQuery('<option />'); 
						opt.val('#');
						opt.text('Please Select');
						jQuery('#town').append(opt); 
						
						$.each(data.zip, function() {
							var opt = jQuery('<option />'); 
							  opt.val(this.code);
							  opt.text(this.municipal);
							  jQuery('#town').append(opt); 
						});
					}
				});
			});
		// ]]>
	</script>
	<div id="mid">
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Register New Trainee</p></div>
				<form name='search' action='<?php echo base_url()?>trainee/addtrainee' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="txtcontainer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><input name='lname' type='text' value='<?php echo set_value('lname'); ?>' /></div></div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo set_value('fname'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name: </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo set_value('mname'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Suffix: </div><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo set_value('suffix'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Sex: </div>
						<div class="placeholdertb">
							<?php 
							$sex['M'] = 'Male';
							$sex['F'] = 'Female';
							$sex['#'] = 'Please Select';
							echo form_dropdown('sex', $sex, '#','id="sex" required style="width: 170px;"'); 
							?>
						</div>
					</div>
					<div class="txtcontainer"><div class="anchortext">Civil Status: </div>
						<div class="placeholdertb">
							<?php 
							$civlstat['1'] = 'Single';
							$civlstat['2'] = 'Married';
							$civlstat['3'] = 'Devorced';
							$civlstat['4'] = 'Widowed';
							echo form_dropdown('civlstat', $civlstat, '1','id="civlstat" required style="width: 170px;"'); 
							?>
						</div>
					</div>
					<div class="txtcontainer"><div class="anchortext">Religion: </div>
						<div class="placeholdertb">
							<?php 
							foreach($religion->result_array() as $row)
							{
								$rel[$row["relid"]] = $row["religion"];
							}
							echo form_dropdown('religion', $rel, '1','id="religion" required style="width: 170px;"'); 
							?>
						</div>
					</div>
					<div class="txtcontainer"><div class="anchortext">Birth Date: </div><div class="placeholdertb"><input name='bdate' type='date'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Birth Place: </div><div class="placeholdertb"><input name='bplace' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Citizenship: </div>
						<div class="placeholdertb">
							<?php 
							foreach($citizenship->result_array() as $row)
							{
								$cit[$row["citid"]] = $row["citizen"];
							}
							echo form_dropdown('citizenship', $cit, '1','id="citizenship" required style="width: 170px;"'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Address: </div><div class="placeholdertb"><input name='address' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Postal Code </div><div class="placeholdertb"><input name='zip' type='text' id='zip' /></div></div>
					<div class="txtcontainer"><div class="anchortext">Region: </div><div class="placeholdertb"><input name='region' type='text' id='region'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Highest Educ: </div><div class="placeholdertb"><input name='course' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">School Grad: </div><div class="placeholdertb"><input name='school' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Sch Address: </div><div class="placeholdertb"><input name='schaddr' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Email Address: </div><div class="placeholdertb"><input name='eadd' type='text'/></div></div>
					<div class="spacer"><p>Contact Person In Case of Emergency</p></div>
					<div class="txtcontainer"><div class="anchortext">Name: </div><div class="placeholdertb"><input name='emname' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Address: </div><div class="placeholdertb"><input name='emaddr' type='text'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Phone: </div><div class="placeholdertb"><input name='emphone' type='text'/></div></div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>