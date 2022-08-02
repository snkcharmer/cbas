<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <title>NMP | Computer-based Assessment System</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="robots" content="all"/>
    <meta name="description" lang="en" content=""/>
    <meta name="keywords" lang="en" content=""/>
</head>

<style>
	.mytable {
		border-collapse: collapse;
	}
	
	.mytable td, .mytable th {
		border:1px solid #000;
		text-align: center;
	}
	
</style>
		
<body>
    <div class="page">
	  	
        	<div style="text-align:center; width:1055px; margin:0 auto;">
				<table style="border:1px solid #000; font-size:9px;">
					<tr>	
						<td>      
						NMP Form No. REG-04<br>
						Issue No. 01<br>
						Rev No. 01 March 4, 2010<br>
						Approved by : ED
						</td>
					</tr>
				</table>
                <div style="font-size:14px; text-transform:uppercase; margin-top:-50px;"><h2>TRAINING COMPLETION AND RECORD OF ASSESSMENT REPORT</h2></div><br />
            </div> 
        
		
		<table class="mytable" cellspacing="0" cellpadding="0" style="width:99%; margin-left:8px; font-size:12px; margin-top:-20px">
			<thead>
			<tr>
				<td colspan="<?php echo $specific->num_rows() + 9 ?>" style="text-align:left; padding-left:5px; font-size:20px;">
					Name of Training Center: NATIONAL MARITIME POLYTECHNIC<br>
					&nbsp;
				</td>
			</tr>
			
			<?php #Kun Meada main category ?>
			<?php if ($main->num_rows() > 1) { ?>
			<tr>
				<td rowspan="2" style="width:200px; text-align:left; padding-left:5px; height:200px;font-size:15px;">Course: <br><?php echo $name[0]["module"]?></td>
				<td colspan="3" rowspan="2"> Personal Data </td>
				<td rowspan="6"> Written test: % score </td>
				<?php foreach($main->result() as $rows){ ?>
					<td rowspan="2" colspan="<?php echo $rows->col ?>" style="min-height:50px;"><?php echo $rows->competency; ?></th>
				<?php $row = $main->next_row(); } ?>
				<td colspan="3" rowspan="2">Result Assessment</td>
				<td rowspan="6">Training Certificate Number</td>
			<tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">Class No: <?php echo $name[0]["batch"]?></td>
				<td rowspan="4">Date of Birth</td>
				<td rowspan="4">Place of Birth</td>
				<td rowspan="4">Rank</td>
				<?php foreach($specific->result() as $rows){?>
					<td rowspan="4" style="font-size:10px;padding:1px;" class="verticalTableHeader"><?php echo $rows->speccompetency ?></td>
				<?php } ?>
				<td rowspan="4">Competent</td>
				<td rowspan="4">Not Yet Competent</td>
				<td rowspan="4">Incomplete</td>
			</tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">
					Training Duration<br>
					<?php echo $name[0]["mydate"]?>
				</td>
			</tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">Date of Assessment</td>
			</tr>
			<tr>
				<td><b>Name of Trainee</b></td>
			</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5" style="text-align:left; padding-left:5px; bottom-border:none;">
						Legend: <br><br>
							<img src="<?php echo base_url()?>images/check.jpg" style="width:30px;" /> &nbsp; = COMPETENT (C) &nbsp;
							<img src="<?php echo base_url()?>images/wrong.jpg" style="width:30px;" /> = NOT YET COMPETENT (NYC) <br>
							<img src="<?php echo base_url()?>images/inc.jpg" style="width:30px;" /> = Candidate who didn't undertake assessment or course not completed <br>
							<img src="<?php echo base_url()?>images/dna.jpg" style="width:30px;" /> = Did not attend the class / assessment
						<br> &nbsp;
					</td>
					<td colspan="<?php echo $specific->num_rows() + 4 ?>" style="text-align:left; padding-left:5px; vertical-align: text-top">
						This is to certify that the persons listed above have undergone the assessment phases and found to be qualified for the issuance of COP. 
						<br><br><br>
						<font style="font-size:15px;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<u><?php 
									if (!empty($assessor))
									{
										echo $assessor["lname"].", ".$assessor["fname"]." ".$assessor["mname"]; 
									}
								?>
							</u><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASSESSOR
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CERTIFIED CORRECT: 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Engr. PONCIANO V. TRINIDAD</u>
							
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRAINING DIRECTOR
							<hr>
						</font>
						(FOR COP ASSESSORS ONLY) <br>
						Attested to: <br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							____________________________________________
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							____________________________________________
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="font-size:15px;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COP ASSESSOR
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE</font>

							
					</td>
				</tr>
			</tfoot>
			<?php if (!empty($name)){ $s = 0;//check if records ?>
			<tbody>
			<?php foreach($name as $row) { ?>
				<tr>
					<td style="text-align: left; padding-left:10px; height:40px;"><?php echo ++$s.'. '.$row["name"]; ?></td>
					<td style="white-space:nowrap;"><?php echo $row["bdate"]; ?><br></td>
					<td><?php echo $row["bplace"]; ?></td>
					<td><?php echo $row["rankshort"]; ?></td>
					<td><?php echo (empty($row["fgradesub"]) ? $row["fgrade"] : $row["fgradesub"]); ?></td>
					<?php $y = 0; $x = 0; foreach($row["grades"] as $rows){?>
						<td align="center">
							<?php if ($rows["competent"] != 0 ){ ++$y;?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?> 
							<?php ++$x;?>
						</td>
					<?php } ?>
					<td><?php if ($x == $y ){?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?></td>
					<td><?php if ($x != $y ){?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?></td>
					<td></td>
					<td><?php echo $row["certnumber"]; ?></td>
				</tr>
			<?php } ?>
			</tbody> 
			<?php } ?>
			<?php } else { ?>
			
			
			<?php 
			#-------------------------------------------------------------------#Kun Waray main category----------------------------------
			 ?>
			<thead>
			<tr>
				<td rowspan="2" style="width:250px; text-align:left; padding-left:5px; height:200px;font-size:15px;">Course: <br><?php echo $name[0]["module"]?></td>
				<td colspan="3" rowspan="2"> Personal Data </td>
				<td rowspan="6"> Written test: % score </td>
				<?php foreach($specific->result() as $rows){?>
					<td rowspan="6" style="font-size:10px;padding:1px;min-height:50px;" class="verticalTableHeader"><?php echo $rows->speccompetency ?></td>
				<?php } ?>
				<td colspan="3" rowspan="2">Result Assessment</td>
				<td rowspan="6">Training Certificate Number</td>
			<tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">Class No: <?php echo $name[0]["batch"]?></td>
				<td rowspan="4">Date of Birth</td>
				<td rowspan="4">Place of Birth</td>
				<td rowspan="4">Rank</td>
				
				<td rowspan="4">Competent</td>
				<td rowspan="4">Not Yet Competent</td>
				<td rowspan="4">Incomplete</td>
			</tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">
					Training Duration<br>
					<?php echo $name[0]["mydate"]?>
				</td>
			</tr>
			<tr>
				<td style="text-align:left; padding-left:5px;">Date of Assessment</td>
			</tr>
			<tr>
				<td><b>Name of Trainee</b></td>
			</tr>
			</thead>
			<tfoot style="height:10%;">
				<tr>
					<td colspan="2" style="text-align:left; padding-left:5px; bottom-border:none; font-size:9px; height: 50px; vertical-align: text-top; ">
						Legend: <br><br>
							<img src="<?php echo base_url()?>images/check.jpg" style="width:20px;" /> &nbsp; = COMPETENT (C) &nbsp;
							<img src="<?php echo base_url()?>images/wrong.jpg" style="width:20px;" /> = NOT YET COMPETENT (NYC) <br>
							<img src="<?php echo base_url()?>images/inc.jpg" style="width:20px;" /> = Candidate who didn't undertake assessment or course not completed <br>
							<img src="<?php echo base_url()?>images/dna.jpg" style="width:20px;" /> = Did not attend the class / assessment
						<br> &nbsp;
					</td>
					<td colspan="<?php echo $specific->num_rows() + 7 ?>" style="text-align:left; padding-left:5px; vertical-align: text-top; font-size:9px; height: 50px;">
						This is to certify that the persons listed above have undergone the assessment phases and found to be qualified for the issuance of COP. 
						<br><br><br>
						<font style="font-size:10px;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<u><?php 
									if (!empty($assessor))
									{
										echo $assessor["lname"].", ".$assessor["fname"]." ".$assessor["mname"]; 
									}
								?>
							</u><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASSESSOR
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CERTIFIED CORRECT: 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Engr. PONCIANO V. TRINIDAD</u>
							
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRAINING DIRECTOR
							<hr>
						</font>
						(FOR COP ASSESSORS ONLY) <br>
						Attested to: <br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							____________________________________________
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							____________________________________________
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="font-size:9px;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COP ASSESSOR
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE</font>

							
					</td>
				</tr>
			</tfoot>
			<?php if (!empty($name)){ $s = 0;//check if records ?>
			<tbody>
			<?php foreach($name as $row) { ?>
				<tr>
					<td style="text-align: left; padding-left:10px; height:30px;"><?php echo ++$s.'. '.$row["name"]; ?></td>
					<td style="white-space:nowrap;"><?php echo $row["bdate"]; ?><br></td>
					<td><?php echo $row["bplace"]; ?></td>
					<td><?php echo $row["rankshort"]; ?></td>
					<td><?php echo $row["fgrade"]; ?></td>
					<?php $y = 0; $x = 0; foreach($row["grades"] as $rows){?>
						<td align="center">
							<?php if ($rows["competent"] != 0 ){ ++$y;?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?> 
							<?php ++$x;?>
						</td>
					<?php } ?>
					<td><?php if ($x == $y ){?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?></td>
					<td><?php if ($x != $y ){?><img src="<?php echo base_url()?>images/smallcheck.png"/><?php } ?></td>
					<td></td>
					<td><?php echo $row["certnumber"]; ?></td>
				</tr>
			<?php } ?> 
			</tbody>
			<?php }?>
			
			<?php } ?>
			
			
		</table>
    </div>
</body>
</html>
