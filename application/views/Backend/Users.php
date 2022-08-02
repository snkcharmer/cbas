<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<div id="container">
	<div id="mid">
	<style>
		.tdques:hover{
			background-color: #0072bc;
			color: #fff;
			text-decoration: none;
		}
		.aques:hover{
			color:#fff;
			text-decoration: none;
		}
	</style>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p> All User Accounts</p></div>
				
				 
				<div style="clear:both"></div>
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<table cellspacing="0" cellpadding="0" style="width:99%">
						<thead>
							<th style="width:30px;">No.</th>
							<th style="width:300px;">Full Name</th>
							<th style="width:200px">Username</th>
							<th>Created</th>
							<th>Last Activity</th>
							<th style="width:160px">Status</th>
						</thead>
						<?php 
						$x = 0;
						foreach ($users->result_array() as $rows) {?>
						<tbody>
							<tr>
								<td><?php echo ++$x; ?></td>
								<td><?php echo $rows['fulllname']?></td>
								<td><?php echo $rows['username']?></td>
								<td><?php echo $rows['created']?></td>
								<td><?php echo $rows['lastlog']?></td>
								<td>
								<?php 
									if ($rows["active"] == 0)
									{
										echo "<a href='".base_url()."admin/users/activate/".$rows['empid']."'><img src='".base_url()."images/inactive.gif' /></a>";
									} else {
										echo "<a href='".base_url()."admin/users/inactivate/".$rows['empid']."'><img src='".base_url()."images/active.gif' /></a>";
									}
								?>
								</td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>