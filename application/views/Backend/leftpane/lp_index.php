<div id="leftpane" class="midShadow">
	<div style="margin:10px auto; width: 95%;">
		<div class="search">
			<form name='search' action='<?php echo base_url()?>home/searchtrainee' method='post'>
			<table style="width:100%; color:#fff" >
				<tr>
					<td style="width:70px">Last Name</td>
					<td><input name='txtlname' type='text' style="float:right" /></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><input name='txtfname' type='text' style="float:right"/></td>		
				</tr>
				</tr>
					<td></td>
					<td style="text-align:right"><input type='submit' class ='fadein' name='search' value='Submit' style="float:right"/></td>
				</tr>
			</table>
			</form>
		</div>

	</div>
	<div id="leftoption">
		<ul>
			<li><a href="<?php echo base_url()?>trainee/newtrainee">Register</a></li>
			<li><a href="#">Training Records</a></li>
			<li><a href="<?php echo base_url()?>schedule/add">Add Schedule</a></li>
		</ul>
	</div>
</div>