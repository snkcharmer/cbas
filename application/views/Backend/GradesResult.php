<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Grades &nbsp;&nbsp; > &nbsp;&nbsp;<?php 
					if (!empty($schedinfo["module"]))
					{
						echo $schedinfo["module"]." - ".$schedinfo["submodule"]." - ".$schedinfo["code"];
					}
					else
					{
						echo "No Schedule Found";
					}
					 ?>
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>admin/showgrades' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; padding:10px;">
						<div class="anchortext" style="width:150px">Enter Schedule Code: </div>
						<div class="placeholdertb">
							<input name='code' type='text' value=""style="float:left;" /> 
							<input class="fadein" type="submit" style="height:25px;width:80px; float:left; font-size:15px; margin:2px 0 0 10px;" value="Search"/>
							<?php #<input class="fadein" type="button" style="height:25px;width:160px; float:left; font-size:15px; margin:2px 0 0 10px;" value="Create Submodule"/> ?>
						</div>
						<div id="clear"></div>
					</div>
				</form>
				
				
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<table cellspacing="0" cellpadding="0" style="width:99.5%; margin-left:8px; background-color:#eee">
						<tr>
							<td style="width:1.5%; background-color:#777; color:#fff">#</td>
							<td style="width:30px; background-color:#777; color:#fff">Trainee's ID</td>
							<td style="width:100px; background-color:#777; color:#fff">Trainee's Name</td>
							<td style="width:100px; background-color:#777; color:#fff">Place of Birth</td>
							<td style="width:50px; background-color:#777; color:#fff">Final Exam</td>
							<td style="width:50px; background-color:#777; color:#fff">Practical Exam</td>
							<td style="width:40px; background-color:#777; color:#fff">Inc</td>
							<td style="width:40px; background-color:#777; color:#fff">DNA</td>
							<td style="width:40px; background-color:#777; color:#fff">Locked</td>
							<td style="width:40px; background-color:#777; color:#fff">Saved</td>
							<?php /*<td style="width:30px; background-color:#777; color:#fff">Final Grade</td> */ ?>
						</tr>
							<?php 
							if ($records->num_rows() > 0) {
							$x = 1;
							foreach ($records->result_array() as $rows){ ?>
						<tr>
							<td><?php echo $x++;?></td>
							<td><?php echo $rows["trid"] ?></td>
							<td style="text-align:left"><?php echo $rows["fullname"] ?></td>
							<td style="text-align:left"><?php echo $rows["bplace"] ?></td>
							<td>
								<?php 
								if(empty($rows["date3"]))
								{
									if (empty($rows["date2"]))
									{
										echo $rows["rate1"];
									}
									else
									{
										echo $rows["rate2"];
									}
								}
								else
								{
									echo $rows["rate3"]; 
								}
							?>
							</td>
							<td><?php echo $rows["prac"] ?></td>
							<td><input type="checkbox" name="inc[]" <?php if ($rows["inc"]!=0){ ?>checked<?php } ?> /></td>
							<td><input type="checkbox" name="dna[]" <?php if ($rows["dna"]!=0){ ?>checked<?php } ?> /></td>
							<td><input type="checkbox" name="locked[]" <?php if ($rows["locked"]!=0){ ?>checked<?php } ?> /></td>
							<td><input type="checkbox" name="locked[]" <?php if ($rows["saved"]!=0){ ?>checked<?php } ?> /></td>
							<?php /* <td><?php echo $rows["fgrade"] ?></td> */ ?>
						</tr>
						<?php }
							} else { ?>
						<tr>
							<td colspan="8">-------------------- No Results Found --------------------</td>
						</tr>
						<?php
							}
						?>
							
					</table>
					
					<?php if ($this->session->userdata("user_level") <> 2)
					{ ?>
						<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/editgrades/<?php echo $this->session->userdata('code')."/".$this->session->userdata('submodid')?>">Edit</a>
					<?php }	 ?>
					
					<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/print_grades/<?php echo $this->session->userdata('code')."/".$this->session->userdata('submodid')?>" target="_blank"><img src="<?php echo base_url()?>images/printer.png" style="width:30px; vertical-align: text-top;">&nbsp;&nbsp;Print</a>
					
					<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/print_grades2/<?php echo $this->session->userdata('code')."/".$this->session->userdata('submodid')?>" target="_blank">Print Trail</a>
					
					<a id="mybutt" style="height:50px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:50px; font-size: 20px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/print_tcroalist/<?php echo $this->session->userdata('code')."/".$this->session->userdata('submodid')?>" target="_blank">TCROA List</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>