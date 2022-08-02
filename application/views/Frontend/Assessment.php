<html>
<head>
	<title>Computer-Based Assesment System - NMP</title>
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery.simplePagination.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>css/simplePagination.css"/>
	<script type="text/javascript">

	function startTimer(duration, display) {
		var timer = duration, minutes, seconds;
		setInterval(function () {
			minutes = parseInt(timer / 60, 10)
			seconds = parseInt(timer % 60, 10);

			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			display.text(minutes + ":" + seconds);
			
			if (--timer < 0) {
				timer = duration;
			}
			
			if (minutes==0&&seconds==0) {
				duration = 0;
				document.getElementById('timesup').submit();
			}
		}, 1000);
	}

	jQuery(function ($) {
		var fiveMinutes = 60 * <?php echo intval($duration) ?>,
			display = $('#time');
		startTimer(fiveMinutes, display);
	});

	</script>
	<script>
		if (sessionStorage.getItem("is_reloaded") == "true")
		{
			window.location.assign("<?php echo base_url()?>");
		}
		else
		{
			sessionStorage.setItem("is_reloaded", true);
		}
		
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
<?php /*<body style="background-color: #eee; background:url('<?php echo base_url()?>images/bg.jpg'); background-size:cover;"> */?>
	<div style="background:url('<?php echo base_url()?>images/timerbg.png') no-repeat; position: absolute; height:200px; width:200px;">
		<div style="background: transparent; height: 50px; margin-top:30px">
		<span id="time" style="font-size: 40px; margin-left:95px;"></span>
		</div>
	</div>
	<div style="width:750px; height:650px; margin:0 auto; background:#ddd; padding:10px; border:10px solid #005186">
		<form id="timesup" action='<?php echo base_url()?>assessment/finish' method='post'>
			<input type="text" name="code" value="<?php echo $code ?>" hidden />
			<input type="text" name="mcbasid" value="<?php echo $mcbasid ?>" hidden >
			<input type="text" name="retake" value="<?php echo $retake ?>" hidden />
			<input type="text" name="trainingid" value="<?php echo $trainingid ?>" hidden />
			<input type="text" name="submodid" value="<?php echo $submodid ?>" hidden />
			<div id="content" style="height:520px;z-index:999"> 
				<span style="display:block; text-align:center; margin-bottom:10px; font-size:20px"><?php echo $module; ?></span>
				
				<?php
					$x = 1;
					foreach ($questions->result_array() as $rows) 
					{ ?>
				<div>
				
				<p>
					<?php 
						echo $x.". ".$rows["item"];
						if (!empty($rows["banner"])){ ?>
						<br>
						<img src="<?php echo base_url()?>images/questions/<?php echo $rows["banner"]?>" />
					<?php } ?>
				</p>
				
				<table class="anstable">
						<tr>
							<td width="10px" align="left"><input type="radio" name="question[<?php echo $rows["id"]?>]" value="opt1" id="optt1<?php echo $rows["id"]?>" /></td>
							<td><label for="optt1<?php echo $rows["id"]?>"><?php echo $rows["opt1"]?></label><br></td>
						</tr>
						<tr>
							<td><input type="radio" name="question[<?php echo $rows["id"]?>]" value="opt2" id="optt2<?php echo $rows["id"]?>" /></td>
							<td><label for="optt2<?php echo $rows["id"]?>"><?php echo $rows["opt2"]?></label><br></td>
						</tr>
						<tr>
							<td><input type="radio" name="question[<?php echo $rows["id"]?>]" value="opt3" id="optt3<?php echo $rows["id"]?>" /></td>
							<td><label for="optt3<?php echo $rows["id"]?>"><?php echo $rows["opt3"]?></label><br></td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="question[<?php echo $rows["id"]?>]" value="opt4" id="optt4<?php echo $rows["id"]?>" />
								<input type="radio" name="question[<?php echo $rows["id"]?>]" value="" hidden checked />
							</td>
							<td><label for="optt4<?php echo $rows["id"]?>"><?php echo $rows["opt4"]?></label><br></td>
							
						</tr>
						
					
					</table>
				</div>
				<?php
						$x++;
						}
					?>
			</div>
			<div id="pagination" style="margin:0 auto; width:480px;"></div>
			
			<input type="submit" name="Submit" value="Finish" id="mybutt" style="margin-top:10px;"  onClick="return confirm('Finish exam?')"/>
			
			<script>
            jQuery(function($) {
                //var items = $("#content tbody tr");
				var items = $("#content div");
                var numItems = items.length;
                var perPage = 1;
                // only show the first 2 (or "first per_page") items initially
                items.slice(perPage).hide();
                // now setup pagination
                $("#pagination").pagination({
                    items: numItems,
                    itemsOnPage: perPage,
                    cssStyle: "light-theme",
                    onPageClick: function(pageNumber) { // this is where the magic happens
                        // someone changed page, lets hide/show trs appropriately
                        var showFrom = perPage * (pageNumber - 1);
                        var showTo = showFrom + perPage;
                        items.hide() // first hide everything, then show for the new page
                             .slice(showFrom, showTo).show();
                    }
                });
            });
			</script>
			
		</form>
	</div>
</body>

</html>