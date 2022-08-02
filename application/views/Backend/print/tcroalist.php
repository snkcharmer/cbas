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
    <div class="page"  style="width:297mm;">

        <table cellpadding="0" cellspacing="0" style="width:297mm;">
            <tr>

            <td class="td2">
                    <p class="title1">Republic of the Philippines</p>
					<p class="title1">Department of Labor and Employment</p>
                    <p class="title2">NATIONAL MARITIME POLYTECHNIC</p>
					<p class="title1">Tacloban City</p>
					<p class="title1"></p>
					<p class="title2" style="">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</p>
					<p class="title2">TCROA ISSUANCE LOG</p>
                    <p class="title2" style="">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</p>
                </td>	
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="data"  style="width:297mm;">
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
		
        <table cellpadding="0" cellspacing="0" class="data"  style="width:297mm;">
            <tr>
                <td align="left" class="" style="width:100px;"><strong>&nbsp;&nbsp;Trainee No.</strong></td>
				<td align="center" class="thea"  ><strong>Trainee's Name</strong></td>
				<td align="center" class="theaore" style="text-align:center"><strong>Sex</strong></td>
				<td align="center" class="thre" colspan="2" style="width:120px;"><strong>Date/Time</strong></td>
                <td align="center" class="thes"><strong>Signature</strong></td>
            </tr>
            <tr>
               

            </tr>
			<?php 
				if ($records->num_rows() > 0) {
				$x = 1; $xx = 1;
				foreach ($records->result_array() as $rows){ ?>
			<tr>
				<td align="left" class="field-data" style=" height:20px;">&nbsp;&nbsp; <?php echo $rows["trid"]; ?></td>
				<td align="left" class="field-data">&nbsp;&nbsp;<?php echo $xx .". ". $rows["fullname"]; $xx++; ?></td>
				<td align="left" class="field-data" style="text-align:center"><?php echo ($rows["sex"] == "M" ? "Male" : ($rows["sex"] == "F" ? "Female" : "")); ?></td>
				<td align="center" class="field-data"></td>
				<td align="center" class="field-data"></td>
				<td align="center" class="field-data"></td>

			</tr>
				<?php } } ?>
        </table>
        <i>Note: This is a computer generated document.</i>
    </div>
</body>
</html>
