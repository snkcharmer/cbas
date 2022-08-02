<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column" style="height:700px">
				<div id="generalinfo_header"><p>Edit Question > <?php echo $module["item"]." - ".$module["dscrptn"] ?></p></div>
				<?php echo form_open_multipart('admin/savequestions');?>
				
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div style="float:left; width:49%;">
						<div class="spacer" style="height:210px">
							<div class="anchortext">Question: </div>
							<div class="placeholdertb">
								<textarea rows="4" cols="50" name='item' style='width:500px; height: 200px;'><?php echo $questions["item"] ?></textarea>
							</div>	
						</div>
						<div class="spacer"><div class="anchortext">Option 1: </div>
							<div class="placeholdertb">
								<input id='option1' name='opt1' type='text' style='width: 500px;' value='<?php echo $questions["opt1"] ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Option 2:</div>
							<div class="placeholdertb">
								<input id='option2' name='opt2' type='text' style='width: 500px;' value='<?php echo $questions["opt2"] ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Option 3:</div>
							<div class="placeholdertb">
								<input id='option3' name='opt3' type='text' style='width: 500px;' value='<?php echo $questions["opt3"] ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Option 4:</div>
							<div class="placeholdertb">
								<input id='option4' name='opt4' type='text' style='width: 500px;' value='<?php echo $questions["opt4"] ?>' required/>
							</div>
						</div>
						<div class="spacer"><div class="anchortext">Answer: </div>
							<div class="placeholdertb">
								<?php 
								$type['opt1'] = 'Option 1';
								$type['opt2'] = 'Option 2';
								$type['opt3'] = 'Option 3';
								$type['opt4'] = 'Option 4';
								echo form_dropdown('answer', $type, $questions["answer"],'id="answer" style="width:314px" required'); 
								?>
							</div>
						</div>
						
						
					 </div>
					<div style="float:left; width:50%;">
						<div class="spacer" style=""><div class="anchortext" style="width:400px"><b>Diagram / Illustration (400x300):</b>
						<input name="userfile" id="userfile" type="file" onchange="readURL(this,'userfile_preview');" /></div>
							<div class="placeholdertb">
				 
								 <div data-provides="fileupload" class="fileupload fileupload-new">
								  <div style="" class="fileupload-new img-thumbnail">
									<img id="userfile_preview" class="media-object img-thumbnail pull-left" src="<?php if(!empty($questions["banner"])){  echo base_url(); ?>images/questions/<?php echo $questions["banner"]; } ?>" alt="" />
								  </div>
								  </div>
							  </div>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px; margin-left: 100px;" value="Update" /></div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function readURL(input,id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#'+id).attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php //require_once('include/footer.php'); ?>
</body>
</html>