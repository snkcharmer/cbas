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
					</p></div>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
				<form name='search' action='<?php echo base_url()?>admin/showgrades' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; padding:10px;">
						<div class="anchortext" style="width:150px">Enter Schedule Code: </div>
						<div class="placeholdertb">
							<input name='code' type='text' value=""style="float:left;" /> 
							<input class="fadein" type="submit" style="height:25px;width:80px; float:left; font-size:15px; margin:2px 0 0 10px;" value="Search"/>
						</div>
						<div id="clear"></div>
					</div>
				</form>
				
				<form name='search' action='<?php echo base_url()?>admin/savegrades' method='post'>
					<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
						<table cellspacing="0" cellpadding="0" style="width:99.5%; margin-left:8px; background-color:#eee">
							<tr>
								<td style="width:1.5%; background-color:#777; color:#fff">#</td>
								<td style="width:100px; background-color:#777; color:#fff">Trainee's Name</td>
								<td style="width:80px; background-color:#777; color:#fff">Exam 1</td>
								<td style="width:80px; background-color:#777; color:#fff">Exam 2</td>
								<td style="width:80px; background-color:#777; color:#fff">Exam 3</td>
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
								<td style="text-align:left"><?php echo $rows["fullname"] ?>
									<input type="text" name="gradeid[]" value="<?php echo $rows["gradeid"] ?>" style="width:100%" hidden />
									<input type="text" name="trainingid[]" value="<?php echo $rows["trainingid"] ?>" style="width:100%" hidden />
									<?php if (!empty($rows["submodid"])) { ?>
										<input type="text" name="submodid[]" value="<?php echo $rows["submodid"] ?>" style="width:100%" hidden />
									<?php } ?>
								</td>
								<td>
									<input type="text" name="exam1[]" value="<?php echo $rows["rate1"] ?>" style="width:25%; text-align:center;" />
									<input type="datetime-local" name="date1[]" value="<?php echo (!empty($rows["date1"]) ? date("Y-m-d\TH:i:s", strtotime($rows["date1"])) : "") ?>" style="width:90%; text-align:center;" />
								</td>
								<td>	
									<input type="text" name="exam2[]" value="<?php echo $rows["rate2"] ?>" style="width:25%; text-align:center;" />
									<input type="datetime-local" name="date2[]" value="<?php echo (!empty($rows["date2"]) ? date("Y-m-d\TH:i:s", strtotime($rows["date2"])) : "") ?>" style="text-align:center;" />
								</td>
								<td>	
									<input type="text" name="exam3[]" value="<?php echo $rows["rate3"] ?>" style="width:25%; text-align:center;" />
									<input type="datetime-local" name="date3[]" value="<?php echo (!empty($rows["date3"]) ? date("Y-m-d\TH:i:s", strtotime($rows["date3"])) : "") ?>" style="text-align:center;" />
								</td>
								<td><input type="text" name="prac[]" value="<?php echo $rows["prac"] ?>" style="width:100%" /></td>
								<td><input type="checkbox" name="inc<?php echo $rows["gradeid"] ?>" value="1" <?php if ($rows["inc"]!=0){ ?>checked<?php } ?> /></td>
								<td><input type="checkbox" name="dna<?php echo $rows["gradeid"] ?>" value="1" <?php if ($rows["dna"]!=0){ ?>checked<?php } ?> /></td>
								<td><input type="checkbox" name="locked<?php echo $rows["gradeid"] ?>" value="1" <?php if ($rows["locked"]!=0){ ?>checked<?php } ?> /></td>
								<td><input type="checkbox" name="saved<?php echo $rows["gradeid"] ?>" value="1" <?php if ($rows["saved"]!=0){ ?>checked<?php } ?> /></td>
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
						<input type="submit" value="Save" class="fadein" style="float:left; margin:0 0 10px 10px;width:200px;font-size:30px;height:50px;" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>