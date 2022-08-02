<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<script src="<?php echo base_url()?>js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{     
		$('#module').change(function(){ //any select change on the dropdown with id module trigger this code     
			var module_id = $('#module').val();  // here we are taking module id of the selected one.
			//alert(module_id);
			$("#maincat option").remove();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>admin/tcroamaincategory/"+module_id, //here we are calling our user controller and get_fee method with the module_id
				success: function(data) //we're calling the response json array 'fee'
				{
					//alert(JSON.stringify(data));
					//alert(data.maincat.length);
					
					$.each(data.maincat,function(code,batch)
					{
						$('#maincat')
						.append($("<option></option>")
						.attr("value",batch.mainid)
						.text(batch.competency)); 
					});
					
				}
			});
			 
		});
	});
</script>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add Main Category for TCROA</p></div>
				<form name='search' action='<?php echo base_url()?>admin/addspeccategory' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer"><div class="anchortext">Module Code: </div>
						<?php 
						foreach ($modules->result_array() as $key)
						{
							$mod[$key['id']] = $key["item"];
						}
						?>
						<div class="placeholdertb">
							<?php 
							$mod['#'] = 'Please Select';
							echo form_dropdown('module', $mod, '#','id="module" style="width:414px"'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Main Category: </div>
						<div class="placeholdertb">
							<select name="maincat" id="maincat" style="width:500px"></select>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Specific Category: </div>
						<div class="placeholdertb">
							<input id='speccat' name='speccat' type='text' style='width: 400px;' value='<?php echo set_value('speccat'); ?>' required />
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px; width:150px;float:left; font-size:25px; margin-left: 100px;" value="Save" /></div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php //require_once('include/footer.php'); ?>
</body>
</html>