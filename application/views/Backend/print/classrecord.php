<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <title>NMP | Computer-based Assessment System</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="robots" content="all"/>
    <meta name="description" lang="en" content=""/>
    <meta name="keywords" lang="en" content=""/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/classrecord-screen.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/assessment-print.css" media="print">
</head>
<body>
    <div class="no-print">
        <i>Right Click->Print</i><br />
        <br />
        <i>Be sure to set page layout to landscape</i><br />
        <br />
    </div>
    <div class="page">

        <table cellpadding="0" cellspacing="0" style="">
            <tr>
			<td class="td4" align="top">
				<p class="title4">
					NMP Form No: MAS-04<br />
					Issue No: 01<br />
					Rev. No.: 02 September 7, 2017<br />
					Approved by: ED
				</p><br /><br /><br />
			</td>
			<td class="td3"></td>
            <td class="td2">
                    <p class="title1">Republic of the Philippines</p>
					<p class="title1">Department of Labor and Employment</p>
                    <p class="title2">NATIONAL MARITIME POLYTECHNIC</p>
					<p class="title1">Tacloban City</p><br />
                    <p class="title2">TRAINEES' CLASS RECORD FOR COMPETENCE-BASED ASSESSMENT</p>
                </td>	
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="data">
            <tr>
                <td class="field-data">Course/Module:</td>
                <td align="right" class="td2 .title3">Code:</td>
                <td align="right" class="td2 .title3">Batch No.:</td>
                <td align="right" class="td2 .title3">Total Number of Trainees Enrolled</td>
		<td align="right" class="td2 .title3">Duration</td>
            </tr>
            <tr>
                <td align="center" class="field-data"><?php echo $schedinfo["module"]. " " . $schedinfo["submodule"]?></td>
				<td align="center" class="td2 .title3"><?php echo $schedinfo["code"] ?></td>
				<td align="center" class="td2 .title3"><?php echo $schedinfo["batch"]; ?></td>
				<td align="center" class="td2 .title3"><?php echo $schedinfo["size"]; ?></td>
                <td align="center" class="td2 .title3"><?php echo date('M d, Y', strtotime($schedinfo["start"])). " - " . date('M d, Y', strtotime($schedinfo["end"])); ?></td>
            </tr>
        </table>
		
        <table cellpadding="0" cellspacing="0" class="data">
            <tr>
                <td align="left" class="theader-name" rowspan="2" style="width:40px;"><strong>&nbsp;&nbsp;Trainee No.</strong></td>
				<td align="center" class="theader-name" rowspan="2"><strong>Trainee's Name</strong></td>
                <td align="center" class="theader" colspan="2"><strong>Theoretical Assessment</strong></td>

            </tr>
            <tr>
                <td align="center" class="theader-score">Grade</td>
                <td align="center" class="theader-pass">Remarks</td>

            </tr>
			<?php 
				if ($records->num_rows() > 0) {
				$x = 1; $xx = 1;
				foreach ($records->result_array() as $rows){ ?>
			<tr>
				<td align="left" class="field-data">&nbsp;&nbsp; <?php echo $rows["trid"]; ?></td>
				<td align="left" class="field-data">&nbsp;&nbsp;<?php echo $xx .". ". $rows["fullname"]; $xx++; ?></td>
				<td align="center" class="field-data"><?php 
							if(empty($rows["date3"]))
							{
								if (empty($rows["date2"]))
								{
									$rate99 = round($rows["rate1"],2);
									echo $rate99;
									#$rate99 = $rows["rate1"];
								}
								else
								{
									$rate99 = round($rows["rate2"],2);
									echo $rate99;
									#$rate99 = $rows["rate2"];
								}
							}
							else
							{
								$rate99 = round($rows["rate3"],2); 
								#$rate99 = $rows["rate3"];
								echo $rate99;
							}
						?></td>
				<td align="center" class="field-data">
					<?php 
						if ($rows["dna"] == 1) { echo "DNA "; } else { echo ""; }
						if ($rows["inc"] == 1) { echo "INC "; } else { echo ""; }
						if ($rate99 >= 75) 
						{ 
							echo "Passed"; 
						} 
						elseif  ($rate99 >= 40 and $rate99 <= 74.999999)
						{ 
							echo "Failed"; 
						}
						else
						{
							echo "";
						}
					?>
				</td>
				<?php /*<td align="center" class="field-data"><?php echo $rows["prac"]; ?></td>
				<td align="center" class="field-data"><?php if ($rows["prac"] >= 75) { echo "Competent"; } else { echo "Failed"; }?></td> */ ?>
			</tr>
				<?php } } ?>
        </table>
        <i>Note: This is a computer generated document.</i>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td align="left" style="width: 270px">
                    Number of Trainees:&nbsp;<?php echo $schedinfo["size"]; ?><br/>
                    <?php /*Run Date/Run Time:&nbsp;<?=date('m-d-Y h:i:s A');?><br/>*/ ?>
                </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <div align="center" class="signature-element">
                            <div align="left">Prepared by:<br /><br /><br /></div>
								<strong>
								<u>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								</u>
							</strong>
								<br />
                            <em>Assessment Staff</em><br />
                        </div>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <div align="center" class="signature-element">
                            <div align="left">Assessed by:<br /><br /><br /></div>
                            <strong>
								<u>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								</u>
							</strong><br />
                            <em>Assessor</em><br />
                        </div>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <div align="center" class="signature-element">
                            <div align="left">Attested by:<br /><br /><br /></div>
                            
			    <strong><u>&nbsp;&nbsp;&nbsp;<?php echo $head["name"] ?>&nbsp;&nbsp;&nbsp;</u></strong><br />
                            <em>Head, Maritime Assessment Section</em><br />
                        </div>
                    </td>
            </tr>
        </table>
    </div>
</body>
</html>
