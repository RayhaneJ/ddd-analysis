
<html lang="en">
	<head>
    <link rel = "stylesheet" href = "<?php echo base_url()?>css/slideView.css"/>
    <link href="<?php echo base_url();?>assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>let base_url = "<?php echo base_url();?>";</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
<body>

  <!-- <div id = "count"><span>Page: <span id="page_num"></span> / <span id="page_count"></span></span></div> -->


<div class = "container">
  <canvas id="the-canvas" style = "height:100%; width:100%; ">
  </canvas>
  <div class="fas fa-arrow-circle-right" id = "next"></div>
  <div class="fas fa-arrow-circle-left" id ="prev"></div>
  <img id="fullscreen" src = "<?php echo base_url();?>css/fs.png"></img> 
</div>

<script src = "<?php echo base_url()?>js/slideView.js"></script>

	</body>
</html>
