
<div id='cssmenu' class='midShadow'>
	<ul>
		<li class='has-sub'><a href='#'>Menu</a>
			<ul>
				<?php /*<li><a href="">Change Password</a></li> */ ?>
				<li><a href='<?php echo base_url()?>admin/logoff'>Logout</a></li>
			</ul>
		</li>
		<?php if ($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 2){ ?>
		<li>
			<a href='<?php echo base_url()?>admin/integrate'>Integrate</a>
		</li>
		<?php } ?>
		
		<?php // For Assessor unta-----------------------  ?>
		<li>
			<a href='<?php echo base_url()?>admin/grades'>Grades</a>
		</li>
		<li class='has-sub'><a href='<?php echo base_url()?>admin/tcroa'>Comptency/TCROA</a>
			<ul>
				<li><a href='<?php echo base_url()?>admin/tcroa'>Search</a></li>
				<li><a href='<?php echo base_url()?>admin/tcroa/modules/main'>Main Category</a></li>
				<li><a href='<?php echo base_url()?>admin/tcroa/modules/specific'>Specific Category</a></li>
			</ul>
		</li>
		<?php // For Assessor unta-----------------------  ?>
		
		<li class='has-sub'><a href='<?php echo base_url()?>admin/modules'>Modules</a>
			<ul>
				<li><a href="<?php echo base_url()?>admin/modules">Search</a></li>
				<li><a href='<?php echo base_url()?>admin/modules/add'>Add</a></li>
			</ul>
		</li>

		<?php if ($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 99){ ?>
		<li class='has-sub'><a href='<?php echo base_url()?>admin/users'>Users</a>
			<ul>
				<li><a href='<?php echo base_url()?>admin/users'>All Users</a></li>
				<li><a href='<?php echo base_url()?>admin/users/add'>Add</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<li><a href='<?php echo base_url()?>admin/assessor'>Assessor</a></li>
<li><a href='<?php echo base_url()?>admin/traineeresults'>Results</a></li>
	</ul>
</div>
