<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/upload.css" rel="stylesheet">
  <title>Upload Form</title>

</head>

<body>



<header>
<nav class="navbar  navbar-expand-lg navbar-light bg-dark shadow-sm ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="nav-link"><img src="<?php echo base_url();?>css/RGB-LogoGK.gif" width="145" height="70" alt=""></i></a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav">
      <li class="active"> <a class="nav-item nav-link" href="<?php echo base_url()?>"><div class="textwhite">Intégration</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Upload/GestionPdg')?>"><div class="textwhite">Gestion</div></a></li>
      <li> <a class="nav-item nav-link" href="#"><div class="textwhite">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>


<div class="container-fluid vertical-align">
<form action="http://localhost/IntegrSupCours/upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="text">
      Veuillez remplir le formulaire : 
    </div>
    <?php if(empty($error)) {
        return;
    }
        else {
          echo $error;
        }    
    ?>
      <div class="custom-file mb-3">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label " for="customFile">Insérez le fichier PDF</label>
    </div>
    <div class="custom-file mb-3">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label" for="customFile">Insérez le fichier zip</label>
    </div>
    <div class="custom-file mb-4 ">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label" for="customFile">Insérez le fichier CSV</label>
    </div>
    <input type="text" class="form-control mb-3" placeholder="Libelle du cours" name='libelleCours'>
    <input type="text" class="form-control mb-3" placeholder="Code Baps" name='codeBaps'>
    <select class="custom-select custom-select-lg mb-4">
      <option selected>Pages de garde</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <button type="submit" class="btn btn-primary btn-lg btn-block"><div class="texteButton">Commencer l'intégration</div></button>
</form>
</div>

    


<script type="text/javascript" src="js/upload.js"></script>
</body>

</html>