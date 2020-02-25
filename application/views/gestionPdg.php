<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<link href="<?php echo base_url();?>css/gestionPdg.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/fontawesome/css/all.css" rel="stylesheet">
<script>var base_url = '<?php echo base_url() ?>';</script>

<title>Gérer les pages de garde</title>

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
      <li> <a class="nav-item nav-link" href="#"><div class="textwhite">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>


<a href="#AddNewPdg" data-toggle="modal">
<div class="add">
<i class="fas fa-plus-circle fa-4x"></i>
</div>
</a>


<div class="container-fluid vertical-align">
 
</div>


<!-- ModalPdf -->
<div class="modal fade" id="viewPageDeGarde" tabindex="-1" role="dialog" aria-labelledby="viewPageDeGarde" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitlePdf"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermez">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9" id="modal">
          <iframe class="embed-responsive-item" src=<?php echo base_url($emplacementPdf)?> ></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
      </div>
    </div>
  </div>
</div>

<!-- ModalSettings -->
<div class="modal fade" id="SettingsPageDeGarde" tabindex="-1" role="dialog" aria-labelledby="settingPageDeGarde" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitleSettings"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermez">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button onclick="DeletePage();" type="button" class="btn btn-danger">Supprimer</button>
        <button type="button" class="btn btn-primary">Remplacer</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
      </div>
    </div>
  </div>
</div>

<!-- ModalAddNewPdg -->
<div class="modal fade" id="AddNewPdg" tabindex="-1" role="dialog" aria-labelledby="AddNewPdg" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitleSettings">Ajouter une nouvelle page de garde</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermez">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-bodyAddPdg">
      <form id = "AddPdgForm" action="<?php echo base_url() ?>AddPdg/AddNewPageDeGarde" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class = "form-row">
        <input id="libellePdg" type="text" class="form-control mb-2 col-md-5" placeholder="Libelle page de garde" name='libellePdg'>
        <div class="custom-file col-md-5">
          <input id ="file" type="file" name="file" class="custom-file-input" id="customFileLang" lang="fr"> 
          <label class="custom-file-label " for="customFile">Fichier PDF</label> 
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-12 text-center"> 
          <button type="submit" class="btn btn-primary col-md-6">Ajouter</button>
        </div>
      </form>
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button> -->
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="<?php echo base_url();?>js/gestionPdg.js"></script>

<script>

var libellePdfTab = <?php echo json_encode($libelle); ?>;

libellePdfTab.forEach(element => addPdfLogo(element)); {
}

</script>
</body>
</html>