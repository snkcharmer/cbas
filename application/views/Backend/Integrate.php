<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Integrate &nbsp;>&nbsp; Search Schedule</p></div>
				<form name='search' action='<?php echo base_url()?>admin/integratesearch' method='post'>
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
						<thead>
							<tr>
								<td style="width:20px; background-color:#777; color:#fff">#</td>
								<td style="background-color:#777; color:#fff">License</td>
								<td style="background-color:#777; color:#fff">Rank</td>
								<td style="width:100px; background-color:#777; color:#fff">Last Name</td>
								<td style="width:100px; background-color:#777; color:#fff">First Name</td>
								<td style="width:100px; background-color:#777; color:#fff">Middle Name</td>
								<td style="width:20px; background-color:#777; color:#fff">Sfx</td>
								<td style="width:100px; background-color:#777; color:#fff">BirthDate</td>
								<td style="background-color:#777; color:#fff">Sponsor</td>
								<td style="width:100px; background-color:#777; color:#fff">ID</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>