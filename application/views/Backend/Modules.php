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
				<div id="generalinfo_header"><p>Modules</p></div>

				 
				<div style="clear:both"></div>
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<table cellspacing="0" cellpadding="0" style="width:99%">
						<thead>
							<th style="width:30px;">No.</th>
							<th style="width:200px;">Module Name</th>
							<th style="width:400px">Description</th>
							<th>No. of Questions on Exam</th>
							<th>Duration</th>
							<th>Total # of Questions</th>
							<th style="width:160px" colspan="2">Status</th>
						</thead>
						<?php 
						$x = 0;
						foreach ($modules->result_array() as $rows) {?>
						<tbody>
							<tr>
								<td><?php echo ++$x; ?></td>
								<td><?php echo $rows['item']?></td>
								<td><?php echo $rows['dscrptn']?></td>
								<td><?php echo $rows['quantity']?></td>
								<td><?php echo $rows['duration']?></td>
								<td class="tdques"><a href="<?php echo base_url()?>admin/questions/all/<?php echo $rows['id']?>" class="aques"><?php echo $rows['totalques']?></a></td>
								<td class="tdques"><a href="<?php echo base_url()?>admin/modules/edit/<?php echo $rows['id']?>" class="aques">Edit</a></td>
								<td>
								<?php if ($rows["active"] == 1) { ?> 
									<a href="<?php echo base_url()?>admin/changestatusmodule/<?php echo $rows["id"] ?>/0">
										<img src="<?php echo base_url()?>images/active.gif">
									</a>
								<?php } else { ?>
									<a href="<?php echo base_url()?>admin/changestatusmodule/<?php echo $rows["id"] ?>/1">
										<img src="<?php echo base_url()?>images/inactive.gif">
									</a>
								<?php } ?>
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