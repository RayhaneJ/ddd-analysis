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
    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sommaire
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Vignettes</a></li>
      <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Chapitres</a>
        <ul class="dropdown-menu" id = "sommaire">
        </ul>
      </li>
  </div>
  <div id="carouselId" class="carousel slide" data-interval="false" data-ride="carousel">
  <div class="carousel-inner">  
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


<div id = "modalThumbnails" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
    </div>
  </div>
</div>
			

<script src="<?php echo base_url();?>js/slideView.js"></script>

<script>

var filesSlides = <?php echo json_encode($files);?>;
var emplacementSlides = <?php echo json_encode($emplacementSlides);?>;

const filesArraySlides = Object.values(filesSlides);

var collator = new Intl.Collator(undefined, {numeric: true, sensitivity: 'base'});
filesArraySlides.sort(collator.compare);


filesArraySlides.forEach(element => {
  if(filesArraySlides[0]==element){
    AddFirstSlideToView(emplacementSlides, element);
  }
  else {
    AddSlideToView(emplacementSlides, element);
  }
});


var sommaire = <?php echo json_encode($sommaire);?>;

sommaire.forEach(element => {
  AddSummary(element);
});

var emplacementThumbnails = <?php echo json_encode($emplacementThumbnails);?>;
var filesTumbnails = <?php echo json_encode($thumbnailsFiles);?>;
const filesArrayThumbnails = Object.values(filesTumbnails);

filesArrayThumbnails.sort(collator.compare);

var i =0;
filesArrayThumbnails.forEach(element => {
  AddThumbnailsToModal(emplacementThumbnails, element, i);
  i++;
});


</script>

</body>

</html>