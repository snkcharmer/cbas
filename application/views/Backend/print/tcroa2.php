<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>MTIS - Print Grade</title>
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
    	<div id="PrintContainer" style="margin-top:20px; width:1320px; margin-bottom:-35px; text-align:right; z-index:5; position:relative;">  
        	<a href="javascript:void(0);" onclick="displayMessage(PrintBodyContainer.innerHTML)" title="Print Preview"><img src="<?php echo base_url()?>/img/printpreview.png" style="margin-bottom:-10px;">Print Preview</a>
        	<a href="#" onclick="printMe(PrintBodyContainer.innerHTML)" title="Print"><img src="<?php echo base_url()?>/img/print.png" style="margin-bottom:-10px;">Print</a>
        </div>
        <div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:1251px; height:426px;">        	
        	<div style="text-align:center; width:1055px; margin:0 auto;">
            	<div style="border:1px #000000 solid; text-align:left; width:140px; padding:5px; margin-bottom:-70px; height:62px; margin-top:13px; font-size:12px; float: left">NMP Form No. REG-04<br>Issue No. 01<br>Rev. No.: 00 July 4, 2011<br>Approved by : ED</div>

                <div style="text-align:center; vertical-align: middle;"><font style="font-size:28px; font-weight:bold;">TRAINING COMPLETION AND RECORD OF ASSESSMENT REPORT</font></div>
            </div> 
            
            <div style="text-align:left; width:1055px; margin:0 auto; margin-top:60px;">
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">
                	<thead>
                    	<tr align="center">
                        	<td style="padding:3px; text-align:center" colspan="5">Name of Training Center: NATIONAL MARITIME POLYTECHNIC</td>
                            <td style="padding:3px;" colspan="4">PAGE # of #</td>
                        </tr>
                    </thead>
					<tbody>
						<tr>
							<td style="padding:3px;">COURSE <br>Advanced Training in Fire Fighting (Sample)</td>
							<td style="padding:3px;" colspan="3">Personal Data</td>
							<td style="padding:3px;" rowspan="5">Written test: % score</td>							
						</tr>
						<tr>
							<td>Class No.</td>
							<td rowspan="4">Date of Birth</td>
							<td rowspan="4">Place of Birth</td>
							<td rowspan="4">Rank</td>
						</tr>
						<tr>
							<td>Training Duration</td>
						</tr>
						<tr>
							<td>Date of Assessment</td>
						</tr>
						<tr>
							<td>Name of Trainee</td>
						</tr>
					</tbody>
                    <tfoot>
                    	<tr>
                        	<td style="padding:3px;">Description:</td>
                        </tr>
                    </tfoot>
                </table>
                                
                			
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">
					<thead style="text-align:center;">
						<tr>
							<td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">License</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Rank</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Last Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">First Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Middle Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"></td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">BirthDate</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Sponsor</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid;">ID</td>
						</tr>
					</thead>
					<?php
						$y = 0;
						if ($submodgrades) {
						foreach($submodgrades as $row => $key) { $x = 0; $total = 0; ?>
					<tr>
						<td><?php echo $key['license']?> </td>
						<td><?php echo $key['rank']?> </td>
						<td><?php echo $key['lname']?></td>
						<td><?php echo $key['fname']?></td>
						<td><?php echo $key['mname']?></td>
						<td><?php echo $key['suffix']?></td>
						<td><?php echo $key['bdate']?></td>
						<td><?php echo $key["name"]; ?></td>
						<td><?php echo $row ?></td>
						<?php /*<td><input type="text" name="remarks[]" value="<?php echo $row; ?>" style="width:80px"/></td> */?>
						
					</tr>
						<?php $x++; $y++; } } ?>
				</table>
                <div style="width:1055px;">
					<table width="600px" style="float:left;font-size:12px;">
						<tr>
							<td>NOTE: NO CERTIFICATE OF COMPLETION shall be issued to trainees not listed herein.
							</td>
						</tr>
                        <tr>
							<td>Number of Trainees = <?php echo $y;?></td>
						<tr>
					</table>
                    
					<table width="300px" style="float:left;font-size:12px;">
						<thead>
                            <tr>
                            	<td>CERTIFIED BY:</td>
							<tr>
							</tr>
								<td></td>
                            	<td>__________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;Registrar</td>
                            </tr>
                        </thead>
                    </table>
                </div> 
            </div>         
		</div> 
    </body>
</html>