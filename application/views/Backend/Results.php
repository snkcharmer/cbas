<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Result of Exam</p></div>
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
							<td style="width:30px; background-color:#777; color:#fff">Answer</td>
							<td style="width:30px; background-color:#777; color:#fff">Correct Answer</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>