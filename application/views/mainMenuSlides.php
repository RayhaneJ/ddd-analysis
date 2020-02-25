<head>

<head>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/mainMenuSlides.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/fontawesome/css/all.css" rel="stylesheet">
  <script>var base_url = '<?php echo base_url() ?>';</script>
  <title>Gestion slides</title>
  
</head>

<header>
<nav class="navbar  navbar-expand-lg navbar-light bg-dark shadow-sm ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="nav-link"><img src="<?php echo base_url();?>css/RGB-LogoGK.gif" width="155" height="70" alt=""></i></a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav">
      <li class="active"> <a class="nav-item nav-link" href="<?php echo base_url()?>"><div class="textwhite">Intégration</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Upload/GestionPdg')?>"><div class="textwhite">Gestion</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser')?>"><div class="textwhite">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>



<body>

    

<table class="table table-responsive-lg table-hover table-striped border-right border-left">
  <thead id = "thead">
    <tr >
        <th scope="col" id ="id">id</th>
        <th scope="col">Date injection</th>
        <th scope="col">Date dernière modification</th>
        <th scope="col" id="cbCustom">Code Baps</th>
        <th scope="col">Code Rayhane</th>
        <th scope="col" class = "border-left" id="edit">Editer</th>
    </tr>
  </thead>
  <tbody id ='tbody'>

  </tbody>
</table>


<script type="text/javascript" src="<?php echo base_url();?>js/mainMenuSlides.js">
</script>

<script>

var slides = <?php echo json_encode($slides); ?>;
console.log(slides);
slides.forEach(element => {
    AddSlideContent(element);
});

</script>

</body>

</head>