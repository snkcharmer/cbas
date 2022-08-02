<?php if ($this->session->userdata("user_level") == 3) { ?>
	<div id='cssmenu' class='midShadow'>
		<ul>
			<li class='has-sub'><a href='#'>Menu</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/index'>Home</a></li>
					<li><a href='<?php echo base_url()?>cash/allpayments'>All Payments</a></li>
					<li><a href='<?php echo base_url()?>cash/advancedsearch'>Advanced Search</a></li>
					<li><a href='<?php echo base_url()?>home/logoff'>Logout</a></li>
				</ul>
			</li>		
			<li><a href='<?php echo base_url()?>home/about'>About</a></li>
		</ul>
	</div>
<?php }
else #-----------------For userlevel 1 and 2
{
	?>
	<div id='cssmenu' class='midShadow'>
		<ul>
			<li class='has-sub'><a href='#'>Menu</a>
				<ul>
					<li class='has-sub'><a href='#'>Registration</a>
						<ul>
						   <li><a href='#'>Training</a></li>
						   <li><a href='#'>Assessment</a></li>
						</ul>
					</li>
					<li><a href='<?php echo base_url()?>schedule'>Schedule</a></li>
					<li><a href='<?php echo base_url()?>home/logoff'>Logout</a></li>
				</ul>
			</li>	
			<li class='has-sub'><a href='#'>Administration</a>
				<ul>
					<li class='has-sub'><a href='<?php echo base_url()?>modules/search'>Modules</a>
						<ul>
						   <li><a href='<?php echo base_url()?>modules/add'>Add Modules</a></li>
						   <li><a href='<?php echo base_url()?>modules/search'>Search Module</a></li>
						</ul>
					</li>
					<li class='has-sub'><a href='<?php echo base_url()?>submodules/search'>Sub Module</a>
						<ul>
						   <li><a href='<?php echo base_url()?>submodules/add'>Add Submodules</a></li>
						   <li><a href='<?php echo base_url()?>submodules/search'>Search Submodule</a></li>
						</ul>
					</li>
					<li><a href='<?php echo base_url()?>home/course'>Courses</a></li>
					<li><a href='<?php echo base_url()?>home/license'>Licenses</a></li>
					<li><a href='<?php echo base_url()?>home/rank'>Ranks</a></li>
					<li><a href='<?php echo base_url()?>home/trainer'>Trainers</a></li>
				</ul>
			</li>
			<li><a href='<?php echo base_url()?>home/about'>About</a></li>
		</ul>
	</div>
<?php } ?>