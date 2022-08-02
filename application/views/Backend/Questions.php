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
				<div id="generalinfo_header"><p>Questions > <?php echo $module["item"]." - ".$module["dscrptn"] ?></p></div>
				<div style="height:20px;margin:-5px 5px 5px 5px; background:#2967b8; font-size:15px; padding: 5px 0 8px 50px; text-align:left; color:#fff;"><p><a id="mybutt2" style="height:20px; width:100px; display:inline-block; vertical-align:center; text-align: center; line-height:20px; font-size: 12px; text-decoration:none; margin:0 0 10 10;" href="<?php echo base_url()?>admin/questions/add/<?php echo $id ?>">Add Question</a></p></div>
				 
				<div style="clear:both"></div>
				<div style="margin:10px 0 0 5px;  background-color:#ddd; overflow: hidden;">
					<table cellspacing="0" cellpadding="0" style="width:99%">
						<thead>
							<th style="width:30px;">No.</th>
							<th style="width:300px;">Question</th>
							<th>Option 1</th>
							<th>Option 2</th>
							<th>Option 3</th>
							<th>Option 4</th>
							<th>Correct Answer:</th>
							<th>Picture</th>
							<th style="width:160px" colspan="2">Manage</th>
						</thead>
						
						<tbody>
							<?php 
							$x = 0;
							foreach ($questions->result_array() as $rows) {?>
							<tr>
								<td><?php echo ++$x; ?></td>
								<td><?php echo $rows['item']?></td>
								<td><?php echo $rows['opt1']?></td>
								<td><?php echo $rows['opt2']?></td>
								<td><?php echo $rows['opt3']?></td>
								<td><?php echo $rows['opt4']?></td>
								<td><?php echo $rows['answer']?></td>
								<td><?php echo $rows['banner']?></td>
								<td class="tdques"><a href="<?php echo base_url()?>admin/questions/edit/<?php echo $rows['id']?>" class="aques">Edit</a></td>
								<td>
								<?php if ($rows["active"] == 1) { ?> 
									<a href="<?php echo base_url()?>admin/changestatusquestion/<?php echo $rows["module_id"]."/".$rows["id"] ?>/0">
										<img src="<?php echo base_url()?>images/active.gif">
									</a>
								<?php } else { ?>
									<a href="<?php echo base_url()?>admin/changestatusquestion/<?php echo $rows["module_id"]."/".$rows["id"] ?>/1">
										<img src="<?php echo base_url()?>images/inactive.gif">
									</a>
								<?php } ?>
								</td>
							</tr>
							<?php } ?>
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