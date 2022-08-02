<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Grades</p></div>
				<?php  echo $this->session->flashdata('message'); ?>
				<form name='search' action='<?php echo base_url()?>admin/showgrades' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; height:50px;">
						<div class="anchortext" style="margin-left:10px; width:150px">Enter Schedule Code: </div>
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
							<td style="width:80px; background-color:#777; color:#fff">Trainee's Name</td>
							<td style="width:30px; background-color:#777; color:#fff">Quizzes</td>
							<td style="width:30px; background-color:#777; color:#fff">Final Exam</td>
							<td style="width:30px; background-color:#777; color:#fff">Practical Exam</td>
							<td style="width:30px; background-color:#777; color:#fff">Inc</td>
							<td style="width:30px; background-color:#777; color:#fff">DNA</td>
							<td style="width:30px; background-color:#777; color:#fff">Final Grade</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
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