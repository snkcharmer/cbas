<title>Computer-Based Assesment System - NMP</title>
<body>
	Exam Finished!

	<a href="showresults/<?php echo $trainingid.'/'.$retake.'/'; ?><?php if(!empty($submodid)){ echo $submodid;} ?>" target="_blank">Show Results</a>
	<br>
	<script>
		setTimeout(function(){
			window.location.href = '<?php echo base_url()?>';
		},4000)
	</script>
</body>