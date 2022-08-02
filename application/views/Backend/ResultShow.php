<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<?php 
	$x = intval($res->num_rows());
	$y = $x;
	if ($res->num_rows() > 0){
	foreach ($res->result_array() as $rows)
	{
		if ($rows["status"] == "incorrect")
		{
			$y--;
		}
	}
} ?>
<div id="container"><?php $rows = $records->row_array(); ?>
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Result of Exam for <?php echo $rows["item"] . " - " . $rows["lname"] . ", " . $rows["fname"] . " ". $rows["mname"]; ?></p></div>
				<?php  echo $this->session->flashdata('message'); ?>
				<form name='search' action='<?php echo base_url()?>admin/showscore' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; height:50px;">
						<div class="anchortext" style="margin-left:10px; width:80px">Trainee ID: </div>
						<div class="placeholdertb">
							<input name='trid' type='text' value=""style="float:left;" /> 
						</div>
						
						<div class="anchortext" style="margin-left:10px; width:100px">Schedule Code: </div>
						<div class="placeholdertb">
							<input name='code' type='text' value=""style="float:left;" /> 
							<input class="fadein" type="submit" style="height:25px;width:80px; float:left; font-size:15px; margin:5px 0 0 10px;" value="Search"/>
						</div>
					</div>
					
				</form>
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<table cellspacing="0" cellpadding="0" style="width:99.5%; margin-left:8px; background-color:#eee">
						<tr>
							<td style="width:1.5%; background-color:#777; color:#fff">#</td>
							<td style="width:80px; background-color:#777; color:#fff">Question</td>
							<td style="width:20px; background-color:#777; color:#fff">Option1</td>
							<td style="width:20px; background-color:#777; color:#fff">Option2</td>
							<td style="width:20px; background-color:#777; color:#fff">Option3</td>
							<td style="width:20px; background-color:#777; color:#fff">Option4</td>
							<td style="width:20px; background-color:#777; color:#fff">Answer</td>
							<td style="width:20px; background-color:#777; color:#fff">Correct Answer</td>
						</tr>
						<?php $x = 0; 
							foreach ($records->result_array() as $row){ 
							$x++; ?>
						<tr>
							<td><?php echo $x; ?></td>
							<td><?php echo $row["ques"] ?></td>
							<td><?php echo $row["opt1"] ?></td>
							<td><?php echo $row["opt2"] ?></td>
							<td><?php echo $row["opt3"] ?></td>
							<td><?php echo $row["opt4"] ?></td>
							<td><?php echo $row["answer_code"] ?></td>
							<td><?php echo $row["ans"] ?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden; padding-bottom: 20px;">
						<table style="margin:20px 0 0 0; width:8.5in">
						<tr>
							<td>No. of Correct Answers: </td>
							<td style="width:4in"><b><?php echo $y ?></b></td>
						</tr> 
						<tr>
							<td>No. of Wrong Answers: </td>
							<td style="width:4in"><b><?php echo $x - $y?></b></td>
						</tr>
					</table>
					<hr />
					Numerical Equivalent Rating: 
					<?php echo round((($y * 50 / ($x)) + 50) * .95) ."%"; ?> <br>
					((No. of Correct * 50 / No. of Items) + 50 ) * .95
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>
