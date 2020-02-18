<!DOCTYPE html>
<html lang="en">
<head>
    
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/t.css" rel="stylesheet">
  <script>var base_url = '<?php echo base_url() ?>';</script>
  
</head>

<body>

<div class="container-">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-3.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-4.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-4.png" alt="Third slide">
    </div>
  </div>
  <a >
    <img id ="arrow-left" src="<?php echo base_url();?>css/arrow-left.png"></img>
  </a>  
  <a >
    <img id = "arrow-right" src = "<?php echo base_url();?>css/arrow-right.png"></img>
  </a>
  </div>

  <a>
    <img id = "fullScreen" src = "<?php echo base_url();?>css/fs.png"></img>
  </a>
</div>
			

<script src="<?php echo base_url();?>js/t.js"></script>

</body>

</html>