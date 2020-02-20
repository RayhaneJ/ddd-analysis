<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/upload.css" rel="stylesheet">
  
  <script>var base_url = '<?php echo base_url() ?>';</script>
  
  <title>Upload Form</title>

</head>

<body>


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
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser/Slides')?>"><div class="textwhite">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>

<div class="container-fluid vertical-align">
<form action="<?php echo base_url() ?>upload/doUpload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="text">
      Veuillez remplir le formulaire : 
    </div>
    <div class="custom-file mb-3">
      <input type="file" name="fichiers[]" class="custom-file-input " id="customFileLang" value = "<?php echo set_value('fichiers[0]');?>"> 
      <label class="custom-file-label " for="customFile">Insérez le fichier PDF</label>
    </div>
    <div class="custom-file mb-3">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile" value ="<?php echo set_value('fichiers[1]');?>"> 
      <label class="custom-file-label" for="customFile">Insérez le fichier zip</label>
    </div>
    <div class="custom-file mb-5 ">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile" value="<?php echo set_value('fichiers[2]');?>"> 
      <label class="custom-file-label" for="customFile">Insérez le fichier CSV</label>
    </div>
    <div class = "form-row mb-4  border border-top-0 rounded-bottom">
    <div class = "form-group-1 col-md-4 ">
      <input id="libelleCours" type="text" class="form-control form-control-lg"  placeholder="Libelle du cours" name='libelleCours' value = "<?php echo set_value('libelleCours');?>">
    </div>
    <div class = "form-group-1 col-md-4">
      <input oninput="ActivateCodeRayhaneInput();" id="codeBaps"type="text" class="form-control form-control-lg" placeholder="Code Baps" name='codeBaps' value ="<?php echo set_value('codeBaps');?>">
    </div>
    <div class = "form-group col-md-4">
      <input id="codeRayhane" type="text" class="form-control form-control-lg" placeholder="Code Rayhane (Optionnel) " name='CodeRayhane' value ="<?php echo set_value('CodeRayhane');?>" disabled>
    </div> 
    </div>
    <div class = "form-row mb-4 border border-top-0 rounded-bottom">
      <div class = "form-group col-md-6 ">
        <select name="pageDeGarde" id ="pdgSelect" class="custom-select custom-select-lg ">
          <option selected>Pages de garde</option>
        </select>
      </div>
      <div class = "form-group col-md-6">
        <select id="typeSupportSelect" class="custom-select custom-select-lg" name="typeSupport" disabled>
          <option value ="0"selected>Type du support</option>
          <option value="1">Support de cours</option>
          <option value="2">Cahier d'exercice</option>
        </select>
      </div>
  </div>
    <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block"><div class="texteButton">Commencer l'intégration</div></button>
</form>
</div>



<script type="text/javascript" src="<?php echo base_url();?>js/upload.js">
</script>


<?php 
$erreurCodeBaps = form_error('codeBaps');
$erreurLibelleCours = form_error('libelleCours');

if(empty($erreurCodeBaps) == FALSE) {
  echo "<script> erreurCodeBaps(); </script>";
}

if(empty($erreurLibelleCours) == FALSE) {
  echo "<script> erreurLibelleCours(); </script>";
}

if(empty($isMissing)==FALSE){
  foreach($isMissing as $key => $value) {
    if($value==TRUE) {
        echo "<script type='text/javascript'>MissingInputInView('$key');</script>";
    }
  }
}

if(empty($errorFile) == FALSE) {
  foreach($errorFile as $key => $value) {
    if($value == TRUE) {
      echo "<script> type='text/javascript'> InputErrorInView('$key');</script>";
    }
  }
}

?>

<script>

var dataPdfTab = <?php echo json_encode($libelle); ?>;

dataPdfTab.forEach(element => {
 
  addPdgToList(element); 
})


</script>

</body>

</html>