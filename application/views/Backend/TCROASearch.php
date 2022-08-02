<?php $this->load->view("Backend/include/header") ?>
<?php $this->load->view("Backend/include/navmenu") ?>
<style>
	.vertical-orient {
		padding: 0 .5em;
		writing-mode: tb-rl;
		filter: flipv fliph;
		-webkit-transform:rotate(-90deg); 
		white-space:wrap; 
		display:block;
}
</style>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>TCROA > Search</p></div>
				<?php  echo $this->session->flashdata('message'); ?>
				<form name='search' action='<?php echo base_url()?>admin/tcroa/search/' method='post'>
					<div style="margin-left:5px; background-color:#ddd; overflow:hidden; height:50px;padding-bottom:5px;">
						<div class="anchortext" style="margin-left:10px; width:150px">Enter Schedule Code: </div>
						<div class="placeholdertb">
							<input name='code' type='text' value=""style="float:left;" /> 
							<input class="fadein" type="submit" style="height:25px;width:80px; float:left; font-size:15px; margin:5px 0 0 10px; " value="Search"/>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>