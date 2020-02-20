<html>
<head>
    
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/t.css" rel="stylesheet">
  <script>var base_url = '<?php echo base_url() ?>';</script>
  
</head>

<body>

<div class="container-">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button">Action</button>
    <button class="dropdown-item" type="button">Another action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>
  <div id="carouselExampleControls" class="carousel slide" data-interval="false" data-ride="carousel">
  <div class="carousel-inner">
  <!-- <div class="carousel-item active">
    <img class="d-block w-100 image" src="<?php echo base_url();?>uploads/images/output-0.png">
  </div>
  <div class="carousel-item">
    <img class="d-block w-100 image" src="http://localhost/SiteWebIntegrationWeb/uploads/sourcesSlides/20200219165320_387GKAG01_FR/Diapositive1.JPG">
  </div> -->
  <!-- <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-3.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-4.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/output-4.png" alt="Third slide">
    </div> -->
  
  </div>
  <a id="firstChildArrow">
    <img id ="arrow-left" src="<?php echo base_url();?>css/arrow-left.png"></img>
  </a>  
  <a>
    <img id = "arrow-right" src = "<?php echo base_url();?>css/arrow-right.png"></img>
  </a>
  <a>
    <img id = "fullScreen" src = "<?php echo base_url();?>css/fs.png"></img>
  </a>
  </div>
</div>
</div>
			

<script src="<?php echo base_url();?>js/slideView.js"></script>

<script>

var files = <?php echo json_encode($files);?>;
var emplacement = <?php echo json_encode($emplacement);?>;

const filesArray = Object.values(files);

var collator = new Intl.Collator(undefined, {numeric: true, sensitivity: 'base'});
filesArray.sort(collator.compare);

filesArray.forEach(element => {
  if(filesArray[0]==element){
    AddFirstSlideToView(emplacement, element);
  }
  else {
    AddSlideToView(emplacement, element);
  }
});


</script>

</body>

</html>