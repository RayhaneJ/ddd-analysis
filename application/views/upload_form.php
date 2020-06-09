<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link href="<?php echo base_url();?>css/upload.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/dropzone/dropzone.min.css">
  
  <script>var base_url = '<?php echo base_url() ?>';</script>
  
  <title>Formulaire Intégration</title>

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
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser/LoadMainMenuGestion')?>"><div class="textblack">Gestion</div></a></li>
      <li> <a class="nav-item nav-link" href="<?php echo base_url('Visualiser')?>"><div class="textblack">Visualisation</div></a></li>
    </ul>
  </div>
</nav>
</header>



<div id="mainContainer" class="container-fluid vertical-align">
<form method="post" action="<?php echo base_url() ?>upload/doUpload" class="dropzone" id="mydropzone" enctype='multipart/form-data'>  

    <div class="text">
      Veuillez remplir le formulaire : 
    </div>       
    
    <div class = "form-row mb-4  border border-top-0 rounded-bottom">
    <div class = "form-group-1 col-md-4 ">
      <input id="libelleCours" type="text" class="form-control form-control-lg"  placeholder="Libelle du cours" name='libelleCours' value = "">
    </div>
    <div class = "form-group-1 col-md-4">
      <input oninput="ActivateCodeRayhaneInput();" id="codeBaps"type="text" class="form-control form-control-lg" placeholder="Code Baps" name='codeBaps' value = "">
    </div>
    <div class = "form-group col-md-4">
      <input id="codeRayhane" type="text" class="form-control form-control-lg" placeholder="Code Rayhane (Optionnel) " name='codeRayhane' value = "" disabled>
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

    <div id="dropzonePreview"></div>
    <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block"><div class="texteButton">Commencer l'intégration</div></button>
</form>
<!-- <a href= "" id="buttonDownload"class ="btn btn-primary btn-lg btn-block" download>
<div class="texteButton">Télécharger le fichier PDF</div>
</a> -->
</div>
<div id="loading">
</div>
<div id="loaderAnimation"></div>


	<script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>vendor/dropzone/dropzone.min.js"></script>
	<script>
	

  Dropzone.prototype.defaultOptions.dictDefaultMessage = "Déposez les fichiers ici (CSV, Support de cours format PDF et le fichier ZIP contenant le dossier avec les slides)";
  Dropzone.options.mydropzone = {
    //url does not has to be written 
    //if we have wrote action in the form 
    //tag but i have mentioned here just for convenience sake 
        url: '<?php echo base_url() ?>upload/doUpload', 
        addRemoveLinks: true,
        autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
        autoDiscover: false,
        parallelUploads:10,
        maxFiles: 3,
        uploadMultiple:true,
        paramName: 'file', // this is optional Like this one will get accessed in php by writing $_FILE['pic'] // if you dont specify it then bydefault it taked 'file' as paramName eg: $_FILE['file'] 
        previewsContainer: '#dropzonePreview', // we specify on which div id we must show the files
        clickable: false, // this tells that the dropzone will not be clickable . we have to do it because v dont want the whole form to be clickable 
        accept: function(file, done) {
            done();
        },
        error: function(file, msg){
            alert(msg);
            document.getElementById("loading").style.visibility = "hidden"; 
        },
        success:function(file, response)
        {
            // Do what you want to do with your response
            // This return statement is necessary to remove progress bar after uploading.
            // console.log(response);
        },
        successmultiple:function(file,response){
          document.getElementById("loading").style.visibility = "hidden"; 
          if(response.status == "codeBapsError"){
            alert("Cette combinaison : code baps et/ou code rayhane a déja était attribué; veuillez réessayer une autre combinaison.");
            this.removeAllFiles();
            document.getElementById("loading").style.visibility = "hidden"; 
          }
          else {
            document.getElementById("mainContainer").innerHTML = "";
            var a = document.createElement("a");
            a.className = "btn btn-primary btn-lg btn-block";
            a.setAttribute("id", "buttonDownload"); 

            try {
              var filePath = JSON.parse(response);
            } catch (error) {
              alert('Erreur durant la génération :' + response);
            }

            if(filePath != null){
              a.href = '<?php echo base_url() ?>' + 'uploads/integrationPdf/' + filePath;
              a.setAttribute('download', filePath);

              var div = document.createElement("div");
              div.className = "texteButton";
              div.innerHTML = "Télécharger le fichier PDF";

              a.appendChild(div);

              document.getElementById("mainContainer").appendChild(a);

              document.getElementById("loading").style.visibility = "hidden"; 
            }
          }
        },
        totaluploadprogress:function(progress){
          if(progress == 100){
                var body = document.body,
                html = document.documentElement;

                var height = Math.max( body.scrollHeight, body.offsetHeight, 
                      html.clientHeight, html.scrollHeight, html.offsetHeight );
                      document.getElementById("loading").style.height = height; 

                document.getElementById("loading").style.visibility = "visible"; 
          }
        },
        init: function() {
            var myDropzone = this;
            //now we will submit the form when the button is clicked
            $("#submit").on('click',function(e) {
              e.preventDefault();
              let codeBapsValue = $("#codeBaps").val();
              let libelleCoursValue = $("#libelleCours").val();
              let numberOfFilesInDropzone = myDropzone.files.length;

              if(!codeBapsValue && !libelleCoursValue) [
                alert("Veillez à bien saisir le code baps et le libelle du cours")
              ]
              else {
                if(!codeBapsValue && libelleCoursValue){
                  alert("Veillez à bien saisir le code baps");
                }
                else {
                  if(codeBapsValue && !libelleCoursValue){
                    alert("Veillez à bien saisir le libelle du cours");
                  }
                  else {
                    if(numberOfFilesInDropzone != 3){
                      alert("Veillez à bien déposez le nombre de fichier requis");
                    }
                    else {
                      if(codeBapsValue && libelleCoursValue && numberOfFilesInDropzone == 3){
                        myDropzone.processQueue(); // this will submit your form to the specified action path
                        // after this, your whole form will get submitted with all the inputs + your files and the php code will remain as usual 
                        //REMEMBER you DON'T have to call ajax or anything by yourself, dropzone will take care of that
                      }
                    }
                  }
                }
              }
            });      
        } // init end
    };

  </script>
  
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