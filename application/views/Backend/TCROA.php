<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<style>
	.vertical-orient {
		padding: 0 .5em;
		writing-mode: tb-rl;
		filter: flipv fliph;
		-webkit-transform:rotate(-90deg); 
		white-space:wrap; 
		display:block;
}
</style>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>TCROA</p></div>
				<?php  echo $this->session->flashdata('message'); ?>
				<form name='search' action='<?php echo base_url()?>admin/tcroa/search/' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; height:50px;">
						<div class="anchortext" style="margin-left:10px; width:150px">Enter Schedule Code: </div>
						<div class="placeholdertb">
							<input name='code' type='text' value=""style="float:left;" /> 
							<input class="fadein" type="submit" style="height:25px;width:80px; float:left; font-size:15px; margin:5px 0 0 10px;" value="Search"/>
						</div>
					</div>
				</form>
				
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<div style="text-align: left; padding-top:10px; padding-left: 10px">Assessor: 
						<?php 
							if (!empty($assessor))
							{
								echo $assessor["lname"].", ".$assessor["fname"]." ".$assessor["mname"]; 
							}
						?>
					</div>
					<div style="text-align: left; padding-left: 10px">Schedule: 
						<?php 
							if (!empty($schedule))
							{
								echo $schedule["module"];
								echo "-".$schedule["submodule"];
								echo " ".$schedule["start"]." to ".$schedule["end"];
							}
						?>
					</div>
					<table cellspacing="0" cellpadding="0" style="width:99.5%; margin-left:8px; background-color:#eee; font-size:8px;">
						
						<!------------ For Name ------------->
						<?php 
							if ($main->num_rows() > 0) { //Kun waray meada main category
						?>
						<tr>
							<th rowspan="2" style="width:200px">Name</th>
							<?php foreach($main->result() as $rows){ ?>
								<th colspan="<?php echo $rows->col ?>" style="border:1px solid #fff"><?php echo $rows->competency; ?></th>
							<?php $row = $main->next_row(); 
								} 
							?>
						</tr>
						<tr>
							<?php foreach($specific->result() as $rows){?>
								<th style="border:1px solid #fff; height:200px; font-size:10px;"><?php echo $rows->speccompetency ?></th>
							<?php } ?>
						</tr>
						<?php 
						} ?>
						
						<?php //Kun waray main category
							if ($main->num_rows() == 0) {   ?>
								<th>Name</th>
								<?php foreach($specific->result() as $rows){?>
								<th style="border:1px solid #fff; height:200px; font-size:10px;"><?php echo $rows->speccompetency ?></th>
								<?php } ?>
						<?php } ?>
						
						<?php /*
							<tr>
								<?php foreach($specific->result() as $rows){?>
								<th style="border:1px solid #fff; height:200px; font-size:10px;"><?php echo $rows->speccompetency ?></th>
								<?php } ?>
							</tr>
						<?php } ?>  */?>
						
						<?php if (!empty($name)){//check if records ?>
						<?php foreach($name as $row) { ?>
							<tr>
								<td><?php echo $row["name"]; ?></td>
								<?php foreach($row["grades"] as $rows){?>
									<td>
										<input type="checkbox" name="inc[]" <?php if ($rows["competent"] !=0){ ?>checked<?php } ?>  onclick="return false" />
									</td>
								<?php } ?>
							</tr>
						<?php } }?>
						
					</table>
					
					<?php if ($this->session->userdata("user_level") <> 2)
					{ ?>
						<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/tcroaedit/<?php echo $this->session->userdata('code')."/".$this->session->userdata('submodid')?>">Edit</a>
						<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/assessor/assign/">Assessor</a>
					<?php }	 ?>
					
					<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/tcroa/print/<?php echo $this->session->userdata('code')."-".$this->session->userdata('submodid')?>" target="_blank"><img src="<?php echo base_url()?>images/printer.png" style="width:30px; vertical-align: text-top;">&nbsp;&nbsp;Print</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>