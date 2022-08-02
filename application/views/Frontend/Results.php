
<?php 
	$x = intval($results->num_rows());
	$y = $x;
	if ($results->num_rows() > 0){
	foreach ($results->result_array() as $rows)
	{
		if ($rows["status"] == "incorrect")
		{
			$y--;
		}
	}
} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>Computer Based Assessment System - National Maritime Polytechnic</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="ICON" href="<?php echo base_url()?>images/NMP.ico" />
        <link href="<?php echo base_url()?>css/backend.css" rel="stylesheet" type="text/css" media="screen" />
        
        <script language="javascript">
			function displayMessage(printContent) 
			{
				var inf = printContent;
				win = window.open("", 'popup', 'toolbar = no, status = no');
				win.document.write(inf);
				win.window.innerWidth='1228';
				win.document.close(); // new line
			}
			
			function printMe(PrintBodyContainer) 
			{				
				var inf = PrintBodyContainer;
				win = window.open("", 'popup', 'toolbar = no, status = no');
				win.document.write(inf);
				win.window.innerWidth='1228';
				win.window.print();
			}
		</script>
    </head>
    
    <body style="background:none;"> 
		<div id="PrintContainer" style="margin-top:5px; width:8.5in; margin-bottom:-35px; text-align:right; z-index:555555">  
			<?php /*<a href="javascript:void(0);" onclick="displayMessage(PrintBodyContainer.innerHTML)" title="Print Preview"><img src="<?php echo base_url()?>/images/printpreview.png" style="margin-bottom:-10px;">Print Preview</a> */ ?>
			<a href="#" onclick="printMe(PrintBodyContainer.innerHTML)" title="Print"><img src="<?php echo base_url()?>/images/print.png" style="margin-bottom:-10px;">Print</a>
			
		</div>
		<div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:8.5in;">        	
			<div style="text-align:center; width:8.5in; margin:0 auto;">
				<font style="font-size:15px;">Republic of the Philippines</font><br />
				<font style="font-size:13px;">Department of Labor and Employment</font><br />
				<font style="font-size:18px; text-transform:uppercase;">National Maritime Polytechnic</font><br />
				<font style="font-size:13px; font-style:italic;">Cabalawan, Tacloban City</font><br />
				<br>
				<font style="font-size:20px; font-weight:bold; text-decoration: underline">EXAMINATION RESULT</font>
			</div>
			<table style="margin:20px 0 0 0; width:8.5in">
				<tr>
					<td>Trainee Name: </td>
					<td style="width:4in"><b><?php echo $records["fullname"]; ?></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Module: </td>
					<td><b><?php echo $records["module"]." ".$records["submodule"]; ?></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Module Code: </td>
					<td><b><?php echo $records["code"] ?></b></td>
					<td>Trainee ID: </td>
					<td><b><?php echo $records["trid"] ?></b></td>
				</tr>
				<tr>
					<td>Duration: </td>
					<td><b><?php echo $records["start"]." to ".$records["end"] ?></b></td>
					<td>Test Performed:</td>
					<td>
						<?php 
							if(empty($records["date3"]))
							{
								if (empty($records["date2"]))
								{
									echo $records["date1"];
									$ctr = $records["rate1"];
									$lols = 1;
								}
								else
								{
									echo $records["date2"];
									$ctr = $records["rate2"];
									$lols = 2;
								}
							}
							else
							{
								echo $records["date3"]; 
								$ctr = $records["rate3"];
								$lols = 3;
							}
						?>
					</td>
				</tr>
			</table>
			<hr />
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
			Numerical Equivalent Rating: <?php 
				if($lols > 1 && $ctr >= 75) 
				{
					echo "75% (retake)";
				}
				else
				{
					echo round((($y * 50 / ($x)) + 50) * .95) ."%"; 
				}
				?>
			<table style="margin:20px 0 0 0; width:8.5in;">
				<tr>
					<td style="text-align: center">
						<u>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</u>
						<br />
						Trainee Signature
					</td>
					<td style="text-align: center">
						<u>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</u>
						<br />
						Signature of Assessor
					</td>
				</tr> 
			</table>
		</div>
