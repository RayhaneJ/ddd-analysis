<head>

<head>
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/mainMenuGestion.css" rel="stylesheet">
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
      <li class="active"> <a class="nav-item nav-link" href="<?php echo base_url()?>"><div class="textblack">Intégration</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser/LoadMainMenuGestion')?>"><div class="textwhite">Gestion</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser')?>"><div class="textblack">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>



<body>



<div class = "container-fluid">
<div class = "flex">
<div class = "pdg">
<a class = "logo" href="<?php echo base_url('Upload/GestionPdg')?>">
<i class="fas fa-file-alt fa-10x" style="font-size: 15rem;"></i>
</a>
Gérer les pages de gardes
</div>
<div class = "support">
<a class="logo" href="<?php echo base_url('Visualiser/LoadGestionSupport')?>">
<i class="far fa-file-pdf fa-10x" style="font-size: 15rem;"></i>
</a>
Gérer les supports de cours
</div>
</div>
</div>



<script>


</script>

</body>

</head>