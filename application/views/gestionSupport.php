<head>

<head>
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/gestionSupport.css" rel="stylesheet">
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
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser/LoadMainMenuGestion')?>"><div class="textwhite">Gestion</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser')?>"><div class="textwhite">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>



<body>

<table class="table table-responsive-lg table-hover table-striped border-right border-left border-bottom">
  <thead id = "thead">
    <tr>
        <th scope="col" id ="id">id</th>
        <th scope="col">Date injection</th>
        <th scope="col">Date dernière modification</th>
        <th scope="col" id="cbCustom">Code Baps</th>
        <th scope="col">Code Rayhane</th>
        <th scope="col" class = "border-left text-center" id="download">Télécharger</th>
    </tr>
  </thead>
  <tbody id ='tbody'>

  </tbody>
</table>



<!-- Modal Change Cover Page -->
<div class="modal fade" id="ChangeCoverPage" tabindex="-1" role="dialog" aria-labelledby="ChangeCoverPage" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitleSettings">Remplacer les pages de gardes des supports de cours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermez">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-changeCoverPage">
      <form id = "ChangeCoverPage" action="<?php echo base_url() ?>AddPdg/ChangeCoverPage" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class = "textBlack">
        Sélectionnez la page de garde que vous souhaitez utilisez pour remplacer tout les pages de gardes des supports de cours déja générer
      </div>  
      <div class = "form-row">
      <select id="typeSupportSelect" class="custom-select custom-select-lg" name="pageDeGarde">
          <option value ="0"selected>Page de garde</option>
        </select>
      </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-12 text-center"> 
          <button type="submit" class="btn btn-primary col-md-6">Régénérer</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="settingPageDeGarde" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitleSettings">Veuillez confirmer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermez">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodyDel" class="modal-body">
        <button  id="oui"  type="button" class="btn btn-primary">Oui</button>
        <button" id="non" type="button" class="btn btn-danger">Non</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
      </div>
    </div>
  </div>
</div>

<div class="alert" role="alert" id="result"></div>


<script type="text/javascript" src="<?php echo base_url();?>js/gestionSupport.js">
</script>

<script>

var support = <?php echo json_encode($support); ?>;
var coverPage = <?php echo json_encode($libelle); ?>;

support.forEach(element => {
    AddSupportContent(element);
});

coverPage.forEach(element => {
 addPdgToList(element); 
})

</script>

</body>

</head>